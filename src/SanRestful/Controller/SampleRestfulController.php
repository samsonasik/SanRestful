<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/samsonasik/SanRestful for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SanRestful\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

class SampleRestfulController extends AbstractRestfulController
{    
    public function get($id)
    {
        $response = $this->getResponseWithHeader()
                         ->setContent( __METHOD__.' get current data with id =  '.$id);
        return $response;
    }
    
    public function getList()
    {
        $response = $this->getResponseWithHeader()
                         ->setContent( __METHOD__.' get the list of data');
        return $response;
    }
    
    public function create($data)
    {
        $response = $this->getResponseWithHeader()
                         ->setContent( __METHOD__.' create new item of data :
                                                    <b>'.$data['name'].'</b>');
        return $response;
    }
    
    public function update($id, $data)
    {
       $response = $this->getResponseWithHeader()
                        ->setContent(__METHOD__.' update current data with id =  '.$id.
                                            ' with data of name is '.$data['name']) ;
       return $response;
    }
    
    public function delete($id)
    {
        $response = $this->getResponseWithHeader()
                        ->setContent(__METHOD__.' delete current data with id =  '.$id) ;
        return $response;
    }
    
    public function getResponseWithHeader()
    {
        $response = $this->getResponse();
        $response->getHeaders()
                 ->addHeaderLine('Access-Control-Allow-Origin','*')
                 ->addHeaderLine('Access-Control-Allow-Methods','POST PUT DELETE GET');
        
        return $response;
    }
}
