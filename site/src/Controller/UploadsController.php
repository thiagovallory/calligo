<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Core\Configure;

class UploadsController extends AppController
{
    public $folder = 'uploads';

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function isAuthorized($user)
    {
        return true;
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }

    public function send($module=null)
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
        	$data = $this->request->getData();
        	if ((isset($data['attachment'])) && ($data['attachment'])) {
        		$attachment = $data['attachment'];
                $name = $attachment->getClientFilename();
	            $name_unique = uniqid().'_'.$name;
	            $type = $attachment->getClientMediaType();
	            $size = $attachment->getSize();
	            $tmpName = $attachment->getStream()->getMetadata('uri');
	            $error = $attachment->getError();

                if ($module=='doc'){
                    $path = Configure::read('FOLDER_DOCS'). $name_unique;
                    $media_view = null;
                    $media_key = $name_unique;
                } else{ 
                    $path = WWW_ROOT. $this->folder. DS. $name_unique;
                    $media_view = Configure::read('SERVER_PHOTOS').$this->folder.DS.$name_unique;
                    $media_key = $this->folder.DS.$name_unique;
                }
	            
	            $attachment->moveTo($path);

            	$return = [
					'media_view'=>$media_view,
                    'media_name'=>$name,
                    'media_key'=>$media_key,
                    'type'=> $type,
                    'size'=>$size
				];

	            return $this->responseJSON($return,200);
        	}
        }
        return $this->responseJSON(false,400);
    }
    

}
