<?php

namespace Bee\Search\Model\ResourceModel\Collection;

use Bee\Search\Model\Data\Provider;
use Bee\Search\Model\ResourceModel\ProviderResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class ProviderCollection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init(Provider::class, ProviderResource::class);
    }
}
