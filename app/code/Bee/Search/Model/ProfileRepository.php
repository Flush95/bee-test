<?php

namespace Bee\Search\Model;

use Bee\Search\Api\ProfileRepositoryInterface;
use Bee\Search\Api\Data\ProfileInterface;
use Bee\Search\Model\ResourceModel\ProfileResource;
use Bee\Search\Model\Data\ProfileFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;

class ProfileRepository implements ProfileRepositoryInterface
{

    /**
     * @var ProfileResource
     */
    private ProfileResource $resource;

    /**
     * @var ProfileFactory
     */
    private ProfileFactory $profileFactory;

    /**
     * ProfileRepository Constructor
     *
     * @param ProfileResource $resource
     * @param ProfileFactory $profileFactory
     */
    public function __construct(
        ProfileResource $resource,
        ProfileFactory $profileFactory,
    ) {
        $this->resource = $resource;
        $this->profileFactory = $profileFactory;
    }

    /**
     * @param ProfileInterface $profileInterface
     * @return ProfileInterface
     * @throws LocalizedException
     */
    public function save(ProfileInterface $profileInterface): ProfileInterface
    {
        try {
            $this->resource->save($profileInterface);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $profileInterface;
    }

    /**
     * @param int $id
     * @return ProfileInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): ProfileInterface
    {
        $profile = $this->profileFactory->create();
        $this->resource->load($profile, $id);

        if (!$profile->getId()) {
            throw new NoSuchEntityException(__('Profile with id "%1" does not exist.', $id));
        }

        return $profile;
    }

    /**
     * @param ProfileInterface $profileInterface
     * @return bool
     * @throws LocalizedException
     */
    public function delete(ProfileInterface $profileInterface): bool
    {
        try {
            $this->resource->delete($profileInterface);
        } catch (\Exception $exception) {
            throw new StateException(__(
                'Could not delete the profile: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @param int $profileId
     * @return bool
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $profileId): bool
    {
        $profile = $this->getById($profileId);
        return $this->delete($profile);
    }
}
