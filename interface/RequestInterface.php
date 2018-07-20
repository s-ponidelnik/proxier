<?php
/**
 * Created by PhpStorm.
 * User: Sergey Ponidelnik
 * Date: 20/07/2018
 * Time: 12:27
 */

interface RequestInterface
{
    public function setAddress(string $address): RequestInterface;

    public function getAddress(): ?string;

    public function setContentType(string $contentType): RequestInterface;

    public function getContentType(): ?string;

    public function setData(array $data): RequestInterface;

    public function getData(): array;
}