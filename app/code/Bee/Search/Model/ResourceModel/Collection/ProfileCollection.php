<?php

namespace Bee\Search\Model\ResourceModel\Collection;

use Bee\Search\Model\Data\Profile;
use Bee\Search\Model\ResourceModel\ProfileResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class ProfileCollection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init(Profile::class, ProfileResource::class);
    }
}
