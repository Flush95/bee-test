<?php
namespace Bee\Search\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class ProvidersDataPatch implements DataPatchInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $moduleDataSetup;

    /**
     * ProvidersDataPatch Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @return void
     */
    public function apply(): void
    {
        $data = [
            [
                'provider_url' => 'http://interview-api.stage1.beecoded.ro/mock/provider1/email',
                'required_fields' => 'name,company'
            ],
            [
                'provider_url' => 'http://interview-api.stage1.beecoded.ro/mock/provider2/email',
                'required_fields' => 'linkedin'
            ],
            [
                'provider_url' => 'http://interview-api.stage1.beecoded.ro/mock/provider3/email',
                'required_fields' => 'linkedin,company'
            ]
        ];

        $this->moduleDataSetup->startSetup();
        $this->moduleDataSetup->getConnection()->insertMultiple(
            $this->moduleDataSetup->getTable('providers'),
            $data
        );
        $this->moduleDataSetup->endSetup();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
