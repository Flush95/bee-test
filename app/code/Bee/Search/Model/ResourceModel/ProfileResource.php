<?php

namespace Bee\Search\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ProfileResource extends AbstractDb
{

    protected const MAIN_TABLE = 'profiles';
    protected const ID_FIELD_NAME = 'profile_id';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
