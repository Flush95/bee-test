<?php

namespace Bee\Search\Api;

use Bee\Search\Api\Data\ProfileInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface ProfileRepositoryInterface
{

    /**
     * @param ProfileInterface $profileInterface
     * @return ProfileInterface
     * @throws LocalizedException
     */
    public function save(ProfileInterface $profileInterface): ProfileInterface;

    /**
     * @param int $id
     * @return ProfileInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): ProfileInterface;

    /**
     * @param ProfileInterface $profileInterface
     * @return bool
     * @throws LocalizedException
     */
    public function delete(ProfileInterface $profileInterface): bool;

    /**
     * @param int $profileId
     * @return bool
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $profileId): bool;
}
