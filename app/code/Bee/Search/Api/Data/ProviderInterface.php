<?php

namespace Bee\Search\Api\Data;

interface ProviderInterface
{

    /**
     * String constants for property names
     */
    public const PROVIDER_ID = "provider_id";
    public const PROVIDER_URL = "provider_url";
    public const REQUIRED_FIELDS = "required_fields";

    /**
     * Getter for ProviderId.
     *
     * @return int|null
     */
    public function getProviderId(): ?int;

    /**
     * Setter for ProviderId.
     *
     * @param int|null $providerId
     *
     * @return void
     */
    public function setProviderId(?int $providerId): void;

    /**
     * Getter for ProviderUrl.
     *
     * @return string|null
     */
    public function getProviderUrl(): ?string;

    /**
     * Setter for ProviderUrl.
     *
     * @param string|null $providerUrl
     *
     * @return void
     */
    public function setProviderUrl(?string $providerUrl): void;

    /**
     * Getter for Required Fields.
     *
     * @return string|null
     */
    public function getRequiredFields(): ?string;

    /**
     * Setter for for Required Fields.
     *
     * @param string|null $requiredFields
     *
     * @return void
     */
    public function setRequiredFields(?string $requiredFields): void;
}
