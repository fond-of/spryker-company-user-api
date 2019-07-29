<?php

namespace FondOfSpryker\Zed\CompanyUserApi\Business;

use FondOfSpryker\Zed\CompanyUserApi\Business\Mapper\TransferMapper;
use FondOfSpryker\Zed\CompanyUserApi\Business\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\CompanyUserApi\Business\Model\CompanyUserApi;
use FondOfSpryker\Zed\CompanyUserApi\Business\Model\CompanyUserApiInterface;
use FondOfSpryker\Zed\CompanyUserApi\Business\Model\Validator\CompanyUserApiValidator;
use FondOfSpryker\Zed\CompanyUserApi\Business\Model\Validator\CompanyUserApiValidatorInterface;
use FondOfSpryker\Zed\CompanyUserApi\CompanyUserApiDependencyProvider;
use FondOfSpryker\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeInterface;
use FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryBuilderQueryContainerInterface;
use FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryContainerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\CompanyUserApi\CompanyUserApiConfig getConfig()
 * @method \FondOfSpryker\Zed\CompanyUserApi\Persistence\CompanyUserApiQueryContainerInterface getQueryContainer()
 */
class CompanyUserApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CompanyUserApi\Business\Model\CompanyUserApiInterface
     */
    public function createCompanyUserApi(): CompanyUserApiInterface
    {
        return new CompanyUserApi(
            $this->getApiQueryContainer(),
            $this->getApiQueryBuilderQueryContainer(),
            $this->getQueryContainer(),
            $this->getCompanyFacade(),
            $this->createTransferMapper()
        );
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryContainerInterface
     */
    protected function getApiQueryContainer(): CompanyUserApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(CompanyUserApiDependencyProvider::QUERY_CONTAINER_API);
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryBuilderQueryContainerInterface
     */
    protected function getApiQueryBuilderQueryContainer(): CompanyUserApiToApiQueryBuilderQueryContainerInterface
    {
        return $this->getProvidedDependency(CompanyUserApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER);
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeInterface
     */
    protected function getCompanyFacade(): CompanyUserApiToCompanyUserFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUserApiDependencyProvider::FACADE_COMPANY_USER);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUserApi\Business\Mapper\TransferMapperInterface
     */
    protected function createTransferMapper(): TransferMapperInterface
    {
        return new TransferMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUserApi\Business\Model\Validator\CompanyUserApiValidatorInterface
     */
    public function createCompanyUserApiValidator(): CompanyUserApiValidatorInterface
    {
        return new CompanyUserApiValidator();
    }
}
