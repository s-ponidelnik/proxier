<?php
/**
 * Created by PhpStorm.
 * User: Sergey Ponidelnik
 * Date: 20/07/2018
 * Time: 13:22
 */
include_once 'interface/ParserInterface.php';

class Parser implements ParserInterface
{
    /**
     * @var bool
     */
    private $post = false;
    /**
     * @var TransportInterface
     */
    private $transport;
    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;

    /**
     * Parser constructor.
     * @param TransportInterface $transport
     * @param RequestFactoryInterface $requestFactory
     */
    public function __construct(TransportInterface $transport, RequestFactoryInterface $requestFactory)
    {
        $this->transport = $transport;
        $this->requestFactory = $requestFactory;

    }

    public function getTransport(): TransportInterface
    {
        return $this->transport;
    }

    public function setPost(bool $post): ParserInterface
    {
        $this->post = $post;
        return $this;
    }

    /**
     * @param string $url
     * @param array $data
     * @param string $regularEx
     * @return array|null
     */
    public function parse(string $url, array $data = [], ?string $regularEx = null, $pregMatchFlag = null): ?array
    {
        $request = $this->requestFactory->build($url, $data, $this->post);
        $response = $this->transport->send($request);
        if ($response) {
            if ($regularEx) {
                if ($pregMatchFlag) {
                    preg_match_all($regularEx, $response, $matchAll, $pregMatchFlag);
                } else {
                    preg_match_all($regularEx, $response, $matchAll);
                }
            } else {
                $matchAll = [$response];
            }
            return $matchAll;
        }
        return null;
    }
}