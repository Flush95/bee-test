<?php

namespace Bee\Search\Api;

use Bee\Search\Api\Data\ProfileInterface;

interface ProfileServiceInterface
{

    /**
     * Build Requests Summary
     *
     * @param string $company
     * @param string $name
     * @param string $linkedIn
     * @return string
     */
    public function getSummary(
        string $company,
        string $name,
        string $linkedIn
    ): string;

    /**
     * Get Profile
     *
     * @param int $providerId
     * @param string $linkedIn
     * @param string $company
     * @param string $name
     * @return ProfileInterface
     */
    public function getProfile(
        int $providerId,
        string $linkedIn,
        string $company,
        string $name
    ): ProfileInterface;

    /**
     * Save Profile
     *
     * @param ProfileInterface $profile
     * @return void
     */
    public function saveProfile(
        ProfileInterface $profile
    ): void;
}
