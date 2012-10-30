<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/samsonasik/SanRestful for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SanRestful\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Http\Client as HttpClient;

class SampleClientController extends AbstractActionController
{
    public function indexAction()
    {   
        $client = new HttpClient();
        $client->setAdapter('Zend\Http\Client\Adapter\Curl');
        
        $method = $this->params()->fromQuery('method', 'get');
        $client->setUri('http://localhost:80'.$this->getRequest()->getBaseUrl().'/san-restful');
        
        switch($method) {
            case 'get' :
                $client->setMethod('GET');
                break;
            case 'get-list' :
                $client->setMethod('GET');
                $client->setParameterGET(array('id'=>1));
                break;
            case 'create' :
                $client->setMethod('POST');
                $client->setParameterPOST(array('name'=>'samsonasik'));
                break;
            case 'update' :
                $data = array('name'=>'ikhsan');
                $adapter = $client->getAdapter();
                
                $adapter->connect('localhost', 80);
                $uri = $client->getUri().'?id=1';
                // send with PUT Method
                $adapter->write('PUT', new \Zend\Uri\Uri($uri), 1.1, array(), http_build_query($data)); 
                
                $responsecurl = $adapter->read();
                list($headers, $content) = explode("\r\n\r\n", $responsecurl, 2);
                $response = $this->getResponse();
                 
                $response->getHeaders()->addHeaderLine('content-type', 'text/html; charset=utf-8');
                $response->setContent($content);
                
                return $response;
            case 'delete' :
                $adapter = $client->getAdapter();
                
                $adapter->connect('localhost', 80);
                $uri = $client->getUri().'?id=1'; //send parameter id = 1
                // send with DELETE Method
                $adapter->write('DELETE', new \Zend\Uri\Uri($uri), 1.1, array());
                
                $responsecurl = $adapter->read();
                list($headers, $content) = explode("\r\n\r\n", $responsecurl, 2);
                $response = $this->getResponse();
                 
                $response->getHeaders()->addHeaderLine('content-type', 'text/html; charset=utf-8');
                $response->setContent($content);
                
                return $response;
        }
        
        //if get/get-list/create
        $response = $client->send();
        if (!$response->isSuccess()) {
            // report failure
            $message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();
            
            $response = $this->getResponse();
            $response->setContent($message);
            return $response;
        }
        $body = $response->getBody();
        
        $response = $this->getResponse();
        $response->setContent($body);
        
        return $response;
    }
}

// i hate stackoverflow moderator, do not hate the answer of users :p
//http://stackoverflow.com/questions/1691530/sending-a-file-via-http-put-in-php 


/*                $data = array('name'=>'ikhsan');
                $ch = curl_init($client->getUri().'?id=1');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
                
                $response = curl_exec($ch);
                echo $response;
                break;
                */
