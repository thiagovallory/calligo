<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

class VideoCallController extends AppController
{
	public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function isAuthorized($user)
    {    
        // TODO V1
        return true;
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('videocall');
    }

    public function index()
    {
        $user = $this->Users->get($this->Auth->user('id'));
        
        $identity = $user->username;

        // TODO: Validate if the user has an Appointment before continue
        $twilioAccountSid = 'ACd15a9917fc9768cc5eee38581342c3a0';
        $twilioApiKey = 'SK9f1215101dad7d69a7fda024730ba16a';
        $twilioApiSecret = '6s3dh6xbrcSNxWXdIG1wy79r1F39qXpP';

        $token = new AccessToken($twilioAccountSid, $twilioApiKey, $twilioApiSecret, 3600, $identity);

        // TODO: Generate room name based on the Appointment
        $roomName = 'TestRoom';
        $videoGrant = new VideoGrant();
        $videoGrant->setRoom($roomName);

        $token->addGrant($videoGrant);

        $tokenJWT = $token->toJWT();
        
        $this->set(compact('identity','roomName','tokenJWT'));
    }
}
