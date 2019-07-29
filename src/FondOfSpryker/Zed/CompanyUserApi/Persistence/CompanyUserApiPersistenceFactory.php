<?php

namespace FondOfSpryker\Zed\CompanyUserApi\Persistence;

use FondOfSpryker\Zed\CompanyUserApi\CompanyUserApiDependencyProvider;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\CompanyUserApi\CompanyUserApiConfig getConfig()
 */
class CompanyUserApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery
     */
    public function getCompanyUserQuery(): SpyCompanyUserQuery
    {
        return $this->getProvidedDependency(CompanyUserApiDependencyProvider::PROPEL_QUERY_COMPANY_USER);
    }
}
