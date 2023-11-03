<?php

namespace Bee\Search\Model;

use Bee\Search\Api\ConfigResolverInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ConfigResolver implements ConfigResolverInterface
{

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

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
    ): ?string {
        return $this->scopeConfig->getValue($path, $scopeType, $scopeCode);
    }

    /**
     * Get Stored Api Key
     *
     * @return string|null
     */
    public function getApiKey(): ?string
    {
        return $this->resolveConfig(
            'beecoded_section/general/api_key'
        );
    }
}
