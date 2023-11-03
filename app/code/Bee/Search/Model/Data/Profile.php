<?php

namespace Bee\Search\Model\Data;

use Bee\Search\Api\Data\ProfileInterface;
use Magento\Framework\Model\AbstractModel;

class Profile extends AbstractModel implements ProfileInterface
{

    /**
     * Model initialization.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Bee\Search\Model\ResourceModel\ProfileResource');
    }

    /**
     * Getter for ProfileId.
     *
     * @return int|null
     */
    public function getProfileId(): ?int
    {
        return $this->getData(self::PROFILE_ID) === null ? null
            : (int)$this->getData(self::PROFILE_ID);
    }

    /**
     * Setter for ProfileId.
     *
     * @param int|null $profileId
     *
     * @return void
     */
    public function setProfileId(?int $profileId): void
    {
        $this->setData(self::PROFILE_ID, $profileId);
    }

    /**
     * Getter for Email.
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Setter for Email.
     *
     * @param string|null $email
     *
     * @return void
     */
    public function setEmail(?string $email): void
    {
        $this->setData(self::EMAIL, $email);
    }

    /**
     * Getter for Linkedin.
     *
     * @return string|null
     */
    public function getLinkedin(): ?string
    {
        return $this->getData(self::LINKEDIN);
    }

    /**
     * Setter for Linkedin.
     *
     * @param string|null $linkedin
     *
     * @return void
     */
    public function setLinkedin(?string $linkedin): void
    {
        $this->setData(self::LINKEDIN, $linkedin);
    }

    /**
     * Getter for Name.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    /**
     * Setter for Name.
     *
     * @param string|null $name
     *
     * @return void
     */
    public function setName(?string $name): void
    {
        $this->setData(self::NAME, $name);
    }

    /**
     * Getter for Company.
     *
     * @return string|null
     */
    public function getCompany(): ?string
    {
        return $this->getData(self::COMPANY);
    }

    /**
     * Setter for Company.
     *
     * @param string|null $company
     *
     * @return void
     */
    public function setCompany(?string $company): void
    {
        $this->setData(self::COMPANY, $company);
    }
}
