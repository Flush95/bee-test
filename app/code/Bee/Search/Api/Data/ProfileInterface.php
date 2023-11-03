<?php

namespace Bee\Search\Api\Data;

interface ProfileInterface
{

    /**
     * String constants for property names
     */
    public const PROFILE_ID = "profile_id";
    public const EMAIL = "email";
    public const LINKEDIN = "linkedInProfileUrl";
    public const NAME = "name";
    public const COMPANY = "company";

    /**
     * Getter for ProfileId.
     *
     * @return int|null
     */
    public function getProfileId(): ?int;

    /**
     * Setter for ProfileId.
     *
     * @param int|null $profileId
     *
     * @return void
     */
    public function setProfileId(?int $profileId): void;

    /**
     * Getter for Email.
     *
     * @return string|null
     */
    public function getEmail(): ?string;

    /**
     * Setter for Email.
     *
     * @param string|null $email
     *
     * @return void
     */
    public function setEmail(?string $email): void;

    /**
     * Getter for Linkedin.
     *
     * @return string|null
     */
    public function getLinkedin(): ?string;

    /**
     * Setter for Linkedin.
     *
     * @param string|null $linkedin
     *
     * @return void
     */
    public function setLinkedin(?string $linkedin): void;

    /**
     * Getter for Name.
     *
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * Setter for Name.
     *
     * @param string|null $name
     *
     * @return void
     */
    public function setName(?string $name): void;

    /**
     * Getter for Company.
     *
     * @return string|null
     */
    public function getCompany(): ?string;

    /**
     * Setter for Company.
     *
     * @param string|null $company
     *
     * @return void
     */
    public function setCompany(?string $company): void;
}
