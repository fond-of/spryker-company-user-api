<?php

namespace FondOfSpryker\Zed\CompanyUserApi\Persistence;

use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;

interface CompanyUserApiQueryContainerInterface
{
    /**
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery
     */
    public function queryFind(): SpyCompanyUserQuery;
}
