<?php

namespace FondOfSpryker\Zed\CompanyUserApi;

use FondOfSpryker\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeBridge;
use FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryBuilderQueryContainerBridge;
use FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryContainerBridge;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompanyUserApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_COMPANY_USER = 'FACADE_COMPANY_USER';
    public const PROPEL_QUERY_COMPANY_USER = 'PROPEL_QUERY_COMPANY_USER';
    public const QUERY_CONTAINER_API = 'QUERY_CONTAINER_API';
    public const QUERY_CONTAINER_API_QUERY_BUILDER = 'QUERY_CONTAINER_API_QUERY_BUILDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCompanyUserFacade($container);
        $container = $this->addApiQueryContainer($container);
        $container = $this->addApiQueryBuilderQueryContainer($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addCompanyUserPropelQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUserFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_USER] = function (Container $container) {
            return new CompanyUserApiToCompanyUserFacadeBridge(
                $container->getLocator()->companyUser()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUserPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COMPANY_USER] = function () {
            return SpyCompanyUserQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_API] = function (Container $container) {
            return new CompanyUserApiToApiQueryContainerBridge($container->getLocator()->api()->queryContainer());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiQueryBuilderQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_API_QUERY_BUILDER] = function (Container $container) {
            return new CompanyUserApiToApiQueryBuilderQueryContainerBridge(
                $container->getLocator()->apiQueryBuilder()->queryContainer()
            );
        };

        return $container;
    }
}
