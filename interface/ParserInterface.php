<?php
/**
 * Created by PhpStorm.
 * User: Sergey Ponidelnik
 * Date: 20/07/2018
 * Time: 16:42
 */

interface ParserInterface
{
    public function parse(string $url, array $data = [], ?string $regularEx = null, $pregMatchFlag = null): ?array;
    public function getTransport():TransportInterface;

}