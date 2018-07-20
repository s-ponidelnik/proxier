<?php
/**
 * Created by PhpStorm.
 * User: Sergey Ponidelnik
 * Date: 20/07/2018
 * Time: 13:26
 */

interface RequestFactoryInterface
{
    public function build(string $address,array $data):RequestInterface;
}