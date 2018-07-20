<?php
/**
 * Created by PhpStorm.
 * User: Sergey Ponidelnik
 * Date: 20/07/2018
 * Time: 13:22
 */

class Parser
{
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

    /**
     * @param string $url
     * @param array $data
     * @param string $regularEx
     * @return array|null
     */
    public function parse(string $url, array $data, string $regularEx): ?array
    {
        $request = $this->requestFactory->build($url, $data);
        $request->setContentType('application/x-www-form-urlencoded');
        $response = $this->transport->send($request);
        if ($response) {
            preg_match_all($regularEx, $response, $matchAll);
            return $matchAll;
        }
        return null;
    }
}