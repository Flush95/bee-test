<?php

namespace Bee\Search\Api;

interface RequestHandlerInterface
{

    /**
     * Send Request
     *
     * @param string $apiEndpoint
     * @param string $apiKey
     * @param array $params
     * @return ?array
     */
    public function sendRequest(string $apiEndpoint, string $apiKey, array $params): ?array;
}
