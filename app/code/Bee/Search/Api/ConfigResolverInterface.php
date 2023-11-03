<?php

namespace Bee\Search\Api;

use Magento\Framework\App\Config\ScopeConfigInterface;

interface ConfigResolverInterface
{

    /**
     * Resolve Config Value
     *
     * @param string $path
     * @param string $scopeType
     * @param string|null $scopeCode
     * @return string|null
     */
    public function resolveConfig(
        string $path,
        string $scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
        ?string $scopeCode = null
    ): ?string;

    /**
     * Get Stored Api Key
     *
     * @return string|null
     */
    public function getApiKey(): ?string;
}
