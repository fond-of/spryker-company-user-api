<?php


namespace FondOfSpryker\Zed\CompanyUserApi\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUserApiTransfer;

class TransferMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserApi\Business\Mapper\TransferMapper
     */
    protected $transferMapper;

    /**
     * @var array
     */
    protected $transferData;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->transferMapper = new TransferMapper();

        $this->transferData = [];
    }

    /**
     * @return void
     */
    public function testToTransfer(): void
    {
        $this->assertInstanceOf(CompanyUserApiTransfer::class, $this->transferMapper->toTransfer($this->transferData));
    }

    /**
     * @return void
     */
    public function testToTransferCollection(): void
    {
        $this->assertIsArray($this->transferMapper->toTransferCollection($this->transferData));
    }
}
