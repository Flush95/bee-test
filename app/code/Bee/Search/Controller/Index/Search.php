<?php

namespace Bee\Search\Controller\Index;

use Bee\Search\Api\ConfigResolverInterface;
use Bee\Search\Api\ProfileServiceInterface;
use Bee\Search\Api\RequestHandlerInterface;
use Bee\Search\Model\Data\ProfileFactory;
use Bee\Search\Model\ResourceModel\Collection\ProviderCollectionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;

class Search implements ActionInterface
{

    /**
     * @var RequestHandlerInterface
     */
    private RequestHandlerInterface $requestHandler;

    /**
     * @var ConfigResolverInterface
     */
    private ConfigResolverInterface $configResolver;

    /**
     * @var JsonFactory
     */
    private JsonFactory $resultJsonFactory;

    /**
     * @var RequestInterface
     */
    private RequestInterface $request;

    /**
     * @var ProviderCollectionFactory
     */
    private ProviderCollectionFactory $providerCollectionFactory;

    /**
     * @var ProfileFactory
     */
    private ProfileFactory $profile;

    /**
     * @var ProfileServiceInterface
     */
    private ProfileServiceInterface $profileService;

    /**
     * @param RequestHandlerInterface $requestHandler
     * @param ConfigResolverInterface $configResolver
     * @param JsonFactory $resultJsonFactory
     * @param RequestInterface $request
     * @param ProfileServiceInterface $profileService
     * @param ProviderCollectionFactory $providerCollectionFactory
     * @param ProfileFactory $profile
     */
    public function __construct(
        RequestHandlerInterface $requestHandler,
        ConfigResolverInterface $configResolver,
        JsonFactory $resultJsonFactory,
        RequestInterface $request,
        ProfileServiceInterface $profileService,
        ProviderCollectionFactory $providerCollectionFactory,
        ProfileFactory $profile
    ) {
        $this->requestHandler = $requestHandler;
        $this->configResolver = $configResolver;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->request = $request;
        $this->profileService = $profileService;
        $this->providerCollectionFactory = $providerCollectionFactory;
        $this->profile = $profile;
    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute(): ResultInterface|ResponseInterface
    {
        $result = $this->resultJsonFactory->create();

        $requestParams = $this->request->getParams();
        if (empty($requestParams['name']) || empty($requestParams['company']) || empty($requestParams['linkedInProfileUrl'])) {
            $result->setHttpResponseCode(400);
            $result->setData([
                'success' => false,
                'message' => 'An Name, Company and LinkedIn link should be provided.'
            ]);
            return $result;
        }

        $apiKey = $this->configResolver->getApiKey();

        $linkedIn = $requestParams['linkedInProfileUrl'];
        $name = $requestParams['name'];
        $company = $requestParams['company'];
        $providers = $this->providerCollectionFactory->create()->getItems();

        foreach ($providers as $provider) {
            $providerId = $provider->getProviderId();
            $providerUrl = $provider->getProviderUrl();
            $fields = $provider->getRequiredFields();

            $profile = $this->profileService->getProfile($providerId, $linkedIn, $company, $name);

            if ($profile->getProfileId() !== null) {
                continue;
            }

            $fieldsArray = explode(',', $fields);

            $params = [];
            foreach ($fieldsArray as $field) {
                $params[$field] = $requestParams[$field];
            }

            $profile = $this->profile->create();
            $profile->setLinkedin($linkedIn);
            $profile->setName($name);
            $profile->setCompany($company);
            $profile->setProviderId($providerId);

            $response = $this->requestHandler->sendRequest($providerUrl, $apiKey, $params);

            if ($response === null) {
                $profile->setSearchable(0);
                $this->profileService->saveProfile($profile);
                continue;
            }

            $emails = [];
            foreach ($response as $record) {
                if (isset($record['email'])) {
                    $emails[] = $record['email'];
                } elseif (isset($record['Email'])) {
                    $emails[] = $record['Email'];
                } else {
                    $emails[] = $record;
                }
            }

            $profile->setEmail(json_encode($emails));
            $this->profileService->saveProfile($profile);
            break;
        }

        $result->setData([
            'success' => true,
            'message' => $this->profileService->getSummary($company, $name, $linkedIn)
        ]);

        return $result;
    }
}
