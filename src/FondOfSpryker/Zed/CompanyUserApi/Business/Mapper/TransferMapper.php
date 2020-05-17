<?php

namespace FondOfSpryker\Zed\CompanyUserApi\Business\Mapper;

use Generated\Shared\Transfer\CompanyUserApiTransfer;

class TransferMapper implements TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\CompanyUserApiTransfer
     */
    public function toTransfer(array $data): CompanyUserApiTransfer
    {
        return (new CompanyUserApiTransfer())->fromArray($data, true);
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\CompanyUserApiTransfer[]
     */
    public function toTransferCollection(array $data): array
    {
        $transferCollection = [];

        foreach ($data as $itemData) {
            $transferCollection[] = $this->toTransfer($itemData);
        }

        return $transferCollection;
    }
}
