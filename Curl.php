<?php
/**
 * Created by PhpStorm.
 * User: Sergey Ponidelnik
 * Date: 20/07/2018
 * Time: 12:25
 */
include_once 'interface/TransportInterface.php';
class Curl implements TransportInterface
{
    /**
     * @var resource
     */
    private $curl;

    /**
     * @var
     */
    private $errors;
    /**
     * @var bool
     */
    private $isPost = true;

    /**
     * @var int
     */
    private $timeout = 30;

    /**
     * @var array
     */
    private $httpHeaderList = [];
    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $url;
    /**
     *
     */
    const POST = "POST";
    /**
     *
     */
    const GET = "GET";

    /**
     * Curl constructor.
     * @throws Exception
     */
    public function __construct()
    {
        /** @var resource $curl */
        $this->curl = curl_init();
        curl_setopt($this->getCurl(), CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($this->getCurl(), CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * @param string $url
     * @return Curl
     * @throws Exception
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param string $encoding
     * @return Curl
     * @throws Exception
     */
    public function setEncoding(string $encoding): self
    {
        curl_setopt($this->getCurl(), CURLOPT_ENCODING, $encoding);
        return $this;
    }

    /**
     * @param int $maxRedirs
     * @return Curl
     * @throws Exception
     */
    public function setMaxRedirs(int $maxRedirs): self
    {
        curl_setopt($this->getCurl(), CURLOPT_MAXREDIRS, $maxRedirs);
        return $this;
    }

    /**
     * @param int $timeout
     * @return Curl
     * @throws Exception
     */
    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;
    }

    /**
     * @param string $jsessionId
     * @return Curl
     * @throws Exception
     */
    public function setCookie(string $jsessionId): self
    {
        curl_setopt($this->getCurl(), CURLOPT_COOKIE, $jsessionId);
        return $this;
    }

    /**
     * @return array
     */
    public function getHttpHeaders(): array
    {
        return $this->httpHeaderList;
    }

    /**
     * @param string $header
     * @return Curl
     */
    public function addHttpHeader(string $header): self
    {
        if (!in_array($header, $this->httpHeaderList)) {
            $this->httpHeaderList[] = $header;
        }
        return $this;
    }

    /**
     * @param string $contentType
     * @return Curl
     */
    public function setContentType(string $contentType): self
    {
        $this->addHttpHeader("content-type: " . $contentType);
        return $this;
    }

    /**
     * @param RequestInterface $request
     * @return null|string
     * @throws Exception
     */
    public function send(RequestInterface $request): ?string
    {
        if ($request->getAddress()) {
            $this->setUrl($request->getAddress());
        }
        if ($request->getContentType()) {
            $this->setContentType($request->getContentType());
        }
        if ($request->getData()) {
            $this->setData($request->getData());
        }
        return $this->exec();
    }

    /**
     * @return null|string
     * @throws Exception
     */
    private function exec(): ?string
    {
        if (!$this->url) {
            throw new Exception('Url not set');
        }
        if ($this->isPost) {
            curl_setopt($this->getCurl(), CURLOPT_POSTFIELDS, $this->data);
        }
        if ($this->isPost) {
            curl_setopt($this->getCurl(), CURLOPT_CUSTOMREQUEST, self::POST);
            curl_setopt($this->getCurl(), CURLOPT_URL, $this->url);
        } else {
            curl_setopt($this->getCurl(), CURLOPT_CUSTOMREQUEST, self::GET);
            curl_setopt($this->getCurl(), CURLOPT_URL, $this->url . '?' . http_build_query($this->data));
        }

        curl_setopt($this->getCurl(), CURLOPT_TIMEOUT, $this->timeout);

        $response = curl_exec($this->getCurl());
        $error = curl_error($this->getCurl());
        if ($error) {
            $this->addErrorMsg($error);
        }
        return $response ? $response : null;
    }

    private function addErrorMsg(string $errorMsg): self
    {
        $this->errors[] = $errorMsg;
    }

    public function errors(): ?array
    {
        return $this->errors;
    }

    /**
     * @param array $data
     * @return Curl
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param bool $isPost
     * @return Curl
     */
    public function setPost(bool $isPost): self
    {
        $this->isPost = $isPost;
        return $this;
    }

    /**
     * @return resource
     * @throws Exception
     */
    private function getCurl()
    {
        if (!$this->curl) {
            throw new Exception('Curl not init');
        }
        return $this->curl;
    }
}