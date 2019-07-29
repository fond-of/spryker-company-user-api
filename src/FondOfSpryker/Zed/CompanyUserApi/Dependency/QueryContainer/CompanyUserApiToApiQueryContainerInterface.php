<?php

namespace FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;

interface CompanyUserApiToApiQueryContainerInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function createApiCollection(array $data): ApiCollectionTransfer;

    /**
     * @param array|\Spryker\Shared\Kernel\Transfer\AbstractTransfer $data
     * @param int|null $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function createApiItem($data, ?int $id = null): ApiItemTransfer;
}
