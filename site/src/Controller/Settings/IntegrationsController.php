<?php
declare(strict_types=1);

namespace App\Controller\Settings;

use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class IntegrationsController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function isAuthorized($user)
    {
        // TODO V1
        //return true;
        return false;
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('internal');
        $this->set('sidebar', 'account');
    }

    public function index(){
        $client = $this->_getClient();
        $events = null;
        $connected = (isset($client->url_redirect)) ? false : true;
        $this->set(compact('connected'));
    }

    public function sync(){
        $client = $this->_getClient();

        if (isset($client->url_redirect)){
            return $this->redirect($client->url_redirect);
        } else {
            return $this->redirect(['action'=>'index']);
        }
    }

    public function logoff(){
        $client = $this->_getClient();
        $client->revokeToken($client->getAccessToken());
        $tokenPath = Configure::read('FOLDER_TOKENS_GOOGLE').$this->Auth->user('id').'_token.json';
        if (file_exists($tokenPath)) {
            unlink($tokenPath);
        }
        return $this->redirect(['action'=>'index']);
    }

    private function _getClient(){

        $client = new Google_Client();
        $client->setApplicationName('Google Calendar Calligo');
        $client->setScopes(Google_Service_Calendar::CALENDAR);

        $client->setAuthConfig(ROOT.'/config/google_credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $tokenPath = Configure::read('FOLDER_TOKENS_GOOGLE').$this->Auth->user('id').'_token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        if ($client->isAccessTokenExpired()) {
            
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                if ($authCode = $this->request->getQuery('code')){
                    define('STDIN',fopen("php://stdin","r"));
                    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                    $client->setAccessToken($accessToken);
                } else {
                    $authUrl = $client->createAuthUrl();
                    return (object)['url_redirect'=>$authUrl];    
                }
                
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }
        return $client;
    }

    private function _teste_ADD_EVENTO($client){
        $service = new Google_Service_Calendar($client);
        $event = new Google_Service_Calendar_Event(array(
          'summary' => 'Google I/O 2021',
          'location' => '800 Howard St., San Francisco, CA 94103',
          'description' => 'A chance to hear more about Google\'s developer products.',
          'start' => array(
            'dateTime' => '2021-06-29T09:00:00-07:00',
            'timeZone' => 'America/Los_Angeles',
          ),
          'end' => array(
            'dateTime' => '2021-06-29T17:00:00-07:00',
            'timeZone' => 'America/Los_Angeles',
          ),
          'recurrence' => array(
            'RRULE:FREQ=DAILY;COUNT=2'
          ),
          'attendees' => array(
            array('email' => 'gustavo.souza@brave.ag'),
            array('email' => 'gustavocdesouza@gmail.com'),
          ),
          'reminders' => array(
            'useDefault' => FALSE,
            'overrides' => array(
              array('method' => 'email', 'minutes' => 24 * 60),
              array('method' => 'popup', 'minutes' => 10),
            ),
          ),
        ));

        $calendarId = 'primary';
        $event = $service->events->insert($calendarId, $event);
        printf('Event created: %s\n', $event->htmlLink);
        die;
    }

    private function _teste_LIST_EVENTOS($client){
        $service = new Google_Service_Calendar($client);
        
        $calendarId = 'primary';
        $optParams = array(
          'maxResults' => 10,
          'orderBy' => 'startTime',
          'singleEvents' => true,
          'timeMin' => date('c'),
        );
        $results = $service->events->listEvents($calendarId, $optParams);
        $events = $results->getItems();
        return $events;
    }
}
