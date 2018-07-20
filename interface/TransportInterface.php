<?php
/**
 * Created by PhpStorm.
 * User: Sergey Ponidelnik
 * Date: 20/07/2018
 * Time: 12:26
 */

interface TransportInterface
{
    public function send(RequestInterface $request): ?string;

    public function errors(): ?array;
}