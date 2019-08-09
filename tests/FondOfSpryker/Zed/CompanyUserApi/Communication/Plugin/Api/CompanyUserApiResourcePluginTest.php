<?php

namespace FondOfSpryker\Zed\CompanyApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserApi\Business\CompanyUserApiFacade;
use FondOfSpryker\Zed\CompanyUserApi\Communication\Plugin\Api\CompanyUserApiResourcePlugin;
use FondOfSpryker\Zed\CompanyUserApi\CompanyUserApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyUserApiResourcePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserApi\Communication\Plugin\Api\CompanyUserApiResourcePlugin
     */
    protected $companyUserApiResourcePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserApi\Business\CompanyUserApiFacade
     */
    protected $companyUserApiFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var int
     */
    protected $idCompanyUser;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserApiFacadeMock = $this->getMockBuilder(CompanyUserApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idCompanyUser = 1;

        $this->companyUserApiResourcePlugin = new CompanyUserApiResourcePlugin();

        $this->companyUserApiResourcePlugin->setFacade($this->companyUserApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        $this->assertSame(CompanyUserApiConfig::RESOURCE_COMPANY_USERS, $this->companyUserApiResourcePlugin->getResourceName());
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->companyUserApiFacadeMock->expects($this->atLeastOnce())
            ->method('addCompanyUser')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyUserApiResourcePlugin->add($this->apiDataTransferMock));
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->companyUserApiFacadeMock->expects($this->atLeastOnce())
            ->method('getCompanyUser')
            ->with($this->idCompanyUser)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyUserApiResourcePlugin->get($this->idCompanyUser));
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->companyUserApiFacadeMock->expects($this->atLeastOnce())
            ->method('updateCompanyUser')
            ->with($this->idCompanyUser, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyUserApiResourcePlugin->update($this->idCompanyUser, $this->apiDataTransferMock));
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $this->companyUserApiFacadeMock->expects($this->atLeastOnce())
            ->method('removeCompanyUser')
            ->with($this->idCompanyUser)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyUserApiResourcePlugin->remove($this->idCompanyUser));
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->companyUserApiFacadeMock->expects($this->atLeastOnce())
            ->method('findCompanyUsers')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        $this->assertInstanceOf(ApiCollectionTransfer::class, $this->companyUserApiResourcePlugin->find($this->apiRequestTransferMock));
    }
}
