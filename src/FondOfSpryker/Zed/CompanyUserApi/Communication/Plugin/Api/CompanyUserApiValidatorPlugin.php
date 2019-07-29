<?php

namespace FondOfSpryker\Zed\CompanyUserApi\Communication\Plugin\Api;

use FondOfSpryker\Zed\CompanyUserApi\CompanyUserApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\CompanyUserApi\Business\CompanyUserApiFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\CompanyUserApi\CompanyUserApiConfig getConfig()
 * @method \FondOfSpryker\Zed\CompanyUserApi\Persistence\CompanyUserApiQueryContainerInterface getQueryContainer()
 */
class CompanyUserApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return CompanyUserApiConfig::RESOURCE_COMPANY_USERS;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiValidationErrorTransfer[]
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return $this->getFacade()->validate($apiDataTransfer);
    }
}
