<?php

namespace Bee\Search\Model;

use Bee\Search\Api\Data\ProfileInterface;
use Bee\Search\Api\ProfileRepositoryInterface;
use Bee\Search\Api\ProfileServiceInterface;
use Bee\Search\Model\ResourceModel\Collection\ProfileCollectionFactory;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

class ProfileService implements ProfileServiceInterface
{

    /**
     * @var ProfileCollectionFactory
     */
    private ProfileCollectionFactory $profileCollectionFactory;

    /**
     * @var ProfileRepositoryInterface
     */
    private ProfileRepositoryInterface $profileRepository;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * ProfileService Constructor
     *
     * @param ProfileCollectionFactory $profileCollectionFactory
     * @param ProfileRepositoryInterface $profileRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        ProfileCollectionFactory $profileCollectionFactory,
        ProfileRepositoryInterface $profileRepository,
        LoggerInterface $logger
    ) {
        $this->profileCollectionFactory = $profileCollectionFactory;
        $this->profileRepository = $profileRepository;
        $this->logger = $logger;
    }

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
    ): string {
        $profiles = $this->profileCollectionFactory->create();

        $profiles->getSelect()
            ->joinLeft(
                array('prov' => 'providers'),
                'main_table.provider_id=prov.provider_id'
            );

        $profiles
            ->addFieldToFilter('company', $company)
            ->addFieldToFilter('name', $name)
            ->addFieldToFilter('linkedInProfileUrl', $linkedIn)
            ->getItems();

        $text = '';
        foreach ($profiles as $profile) {
            $emails = $profile->getEmail();
            $emails = json_decode($emails);
            $providerUrl = $profile->getProviderUrl();

            $text .= "Provider with url: '{$providerUrl}' ";

            if (!$profile->getSearchable()) {
                $text .= "returned an error.<br>";
            } elseif (count($emails) === 0) {
                $text .= "returned 0 emails.<br>";
            } else {
                $text .= "returned next emails: <br>";
                foreach ($emails as $email) {
                    $text .= "$email<br>";
                }
            }
            $text .= "<br>";
        }

        return $text;
    }

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
    ): ProfileInterface {
        /** @var ProfileInterface $profile */
        $profile =  $this->profileCollectionFactory->create()
            ->addFieldToFilter('provider_id', $providerId)
            ->addFieldToFilter('linkedInProfileUrl', $linkedIn)
            ->addFieldToFilter('company', $company)
            ->addFieldToFilter('name', $name)
            ->getFirstItem();
        return $profile;
    }

    /**
     * Save Profile
     *
     * @param ProfileInterface $profile
     * @return void
     */
    public function saveProfile(
        ProfileInterface $profile
    ): void {
        try {
            $this->profileRepository->save($profile);
        } catch (LocalizedException $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
