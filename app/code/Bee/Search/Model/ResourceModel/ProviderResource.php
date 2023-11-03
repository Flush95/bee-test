<?php

namespace Bee\Search\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ProviderResource extends AbstractDb
{

    protected const MAIN_TABLE = 'providers';
    protected const ID_FIELD_NAME = 'provider_id';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
