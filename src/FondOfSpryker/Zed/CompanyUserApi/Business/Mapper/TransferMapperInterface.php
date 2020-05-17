<?php

namespace FondOfSpryker\Zed\CompanyUserApi\Business\Mapper;

use Generated\Shared\Transfer\CompanyUserApiTransfer;

interface TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\CompanyUserApiTransfer
     */
    public function toTransfer(array $data): CompanyUserApiTransfer;

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\CompanyUserApiTransfer[]
     */
    public function toTransferCollection(array $data): array;
}
