<?php
/**
 * Created by PhpStorm.
 * User: Sergey Ponidelnik
 * Date: 20/07/2018
 * Time: 13:24
 */
include_once 'interface/RequestFactoryInterface.php';

class RequestFactory implements RequestFactoryInterface
{
    public function build($address, $data, $bool): RequestInterface
    {
        $request = new Request();
        $request->setAddress($address);
        $request->setData($data);
        $request->setContentType('text/html');
        return $request;
    }
}