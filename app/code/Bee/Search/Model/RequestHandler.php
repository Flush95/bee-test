<?php

namespace Bee\Search\Model;

use Bee\Search\Api\RequestHandlerInterface;
use Exception;
use Magento\Framework\HTTP\Client\Curl;
use Psr\Log\LoggerInterface;

class RequestHandler implements RequestHandlerInterface
{

    /**
     * @var Curl
     */
    private Curl $curl;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * RequestHandler constructor
     *
     * @param Curl $curl
     * @param LoggerInterface $logger
     */
    public function __construct(
        Curl $curl,
        LoggerInterface $logger,
    ) {
        $this->curl = $curl;
        $this->logger = $logger;
    }

    /**
     * Send Request
     *
     * @param string $apiEndpoint
     * @param string $apiKey
     * @param array $params
     * @return array|null
     * @throws Exception
     */
    public function sendRequest(string $apiEndpoint, string $apiKey, array $params): ?array
    {
        $curl = $this->curl;
        $curl->addHeader('Authorization', 'Bearer ' . $apiKey);

        $apiEndpoint .= '?' . http_build_query($params);

        $this->curl->get($apiEndpoint);

        $statusCode = $curl->getStatus();
        $body = $curl->getBody();
        $body = json_decode($body, true);

        if ($statusCode < 200 || $statusCode > 299) {
            $error = $body['error'];
            $message = $body['message'];
            if (is_array($message)) {
                $message = implode(";\n", $message);
            }
            $this->logger->error("Error: {$error}. Details: {$message}");
            return null;
        }

        return $body;
    }
}
