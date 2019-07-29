<?php

namespace FondOfSpryker\Zed\CompanyUserApi\Persistence;

use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfSpryker\Zed\CompanyUserApi\Persistence\CompanyUserApiPersistenceFactory getFactory()
 */
class CompanyUserApiQueryContainer extends AbstractQueryContainer implements CompanyUserApiQueryContainerInterface
{
    /**
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery
     */
    public function queryFind(): SpyCompanyUserQuery
    {
        return $this->getFactory()->getCompanyUserQuery();
    }
}
