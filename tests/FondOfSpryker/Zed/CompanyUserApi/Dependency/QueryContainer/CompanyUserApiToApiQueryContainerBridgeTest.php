<?php


namespace FondOfSpryker\Zed\CompanyApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryContainerBridge;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Zed\Api\Persistence\ApiQueryContainer;

class CompanyUserApiToApiQueryContainerBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryContainerBridge
     */
    protected $companyUserApiToApiQueryContainerBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockBuilder|\Spryker\Zed\Api\Persistence\ApiQueryContainer
     */
    protected $apiQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var array
     */
    protected $collectionData;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiQueryContainerMock = $this->getMockBuilder(ApiQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collectionData = [];

        $this->companyUserApiToApiQueryContainerBridge = new CompanyUserApiToApiQueryContainerBridge($this->apiQueryContainerMock);
    }

    /**
     * @return void
     */
    public function testCreateApiCollection(): void
    {
        $this->apiQueryContainerMock->expects($this->atLeastOnce())
            ->method('createApiCollection')
            ->with($this->collectionData)
            ->willReturn($this->apiCollectionTransferMock);

        $this->assertInstanceOf(ApiCollectionTransfer::class, $this->companyUserApiToApiQueryContainerBridge->createApiCollection($this->collectionData));
    }

    /**
     * @return void
     */
    public function testCreateApiItem(): void
    {
        $this->apiQueryContainerMock->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->with($this->collectionData)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyUserApiToApiQueryContainerBridge->createApiItem($this->collectionData));
    }
}
