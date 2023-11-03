<?php

namespace Bee\Search\Model\Data;

use Bee\Search\Api\Data\ProviderInterface;
use Magento\Framework\Model\AbstractModel;

class Provider extends AbstractModel implements ProviderInterface
{

    /**
     * Model initialization.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Bee\Search\Model\ResourceModel\ProviderResource');
    }

    /**
     * Getter for ProviderId.
     *
     * @return int|null
     */
    public function getProviderId(): ?int
    {
        return $this->getData(self::PROVIDER_ID) === null ? null
            : (int)$this->getData(self::PROVIDER_ID);
    }

    /**
     * Setter for ProviderId.
     *
     * @param int|null $providerId
     *
     * @return void
     */
    public function setProviderId(?int $providerId): void
    {
        $this->setData(self::PROVIDER_ID, $providerId);
    }

    /**
     * Getter for ProviderUrl.
     *
     * @return string|null
     */
    public function getProviderUrl(): ?string
    {
        return $this->getData(self::PROVIDER_URL);
    }

    /**
     * Setter for ProviderUrl.
     *
     * @param string|null $providerUrl
     *
     * @return void
     */
    public function setProviderUrl(?string $providerUrl): void
    {
        $this->setData(self::PROVIDER_URL, $providerUrl);
    }


    /**
     * Getter for Required Fields.
     *
     * @return string|null
     */
    public function getRequiredFields(): ?string
    {
        return $this->getData(self::REQUIRED_FIELDS);
    }

    /**
     * Setter for for Required Fields.
     *
     * @param string|null $requiredFields
     *
     * @return void
     */
    public function setRequiredFields(?string $requiredFields): void
    {
        $this->setData(self::REQUIRED_FIELDS, $requiredFields);
    }
}
