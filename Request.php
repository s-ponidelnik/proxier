<?php
/**
 * Created by PhpStorm.
 * User: Sergey Ponidelnik
 * Date: 20/07/2018
 * Time: 13:14
 */
include_once 'interface/RequestInterface.php';
class Request implements RequestInterface
{
    /**
     * @var
     */
    private $address;
    /**
     * @var
     */
    private $contentType;
    /**
     * @var
     */
    private $data;

    /**
     * @param string $address
     * @return RequestInterface
     */
    public function setAddress(string $address): RequestInterface
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $contentType
     * @return RequestInterface
     */
    public function setContentType(string $contentType): RequestInterface
    {
        $this->contentType = $contentType;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    /**
     * @param array $data
     * @return RequestInterface
     */
    public function setData(array $data): RequestInterface
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}