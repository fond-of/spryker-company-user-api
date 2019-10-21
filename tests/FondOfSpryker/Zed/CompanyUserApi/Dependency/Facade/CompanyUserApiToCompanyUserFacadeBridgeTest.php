<?php


namespace FondOfSpryker\Zed\CompanyApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeBridge;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Zed\CompanyUser\Business\CompanyUserFacade;

class CompanyUserApiToCompanyUserFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeBridge
     */
    protected $companyUserApiToCompanyUserFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyUser\Business\CompanyUserFacade
     */
    protected $companyUserFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserResponseTransfer
     */
    protected $companyUserResponseTransferMock;

    /**
     * @var int
     */
    protected $idCompanyUser;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserFacadeMock = $this->getMockBuilder(CompanyUserFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserResponseTransferMock = $this->getMockBuilder(CompanyUserResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idCompanyUser = 1;

        $this->companyUserApiToCompanyUserFacadeBridge = new CompanyUserApiToCompanyUserFacadeBridge(
            $this->companyUserFacadeMock
        );
    }

    /**
     * @return void
     */
    public function getCompanyUserById(): void
    {
        $this->companyUserFacadeMock->expects($this->atLeastOnce())
            ->method('getCompanyUserById')
            ->with($this->idCompanyUser)
            ->willReturn($this->companyUserTransferMock);

        $this->assertInstanceOf(CompanyUserTransfer::class, $this->companyUserApiToCompanyUserFacadeBridge->getCompanyUserById($this->idCompanyUser));
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->companyUserFacadeMock->expects($this->atLeastOnce())
            ->method('create')
            ->with($this->companyUserTransferMock)
            ->willReturn($this->companyUserResponseTransferMock);

        $this->assertInstanceOf(CompanyUserResponseTransfer::class, $this->companyUserApiToCompanyUserFacadeBridge->create($this->companyUserTransferMock));
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->companyUserFacadeMock->expects($this->atLeastOnce())
            ->method('update')
            ->with($this->companyUserTransferMock)
            ->willReturn($this->companyUserResponseTransferMock);

        $this->assertInstanceOf(CompanyUserResponseTransfer::class, $this->companyUserApiToCompanyUserFacadeBridge->update($this->companyUserTransferMock));
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $this->companyUserFacadeMock->expects($this->atLeastOnce())
            ->method('delete')
            ->with($this->companyUserTransferMock)
            ->willReturn($this->companyUserResponseTransferMock);

        $this->assertInstanceOf(CompanyUserResponseTransfer::class, $this->companyUserApiToCompanyUserFacadeBridge->delete($this->companyUserTransferMock));
    }
}
