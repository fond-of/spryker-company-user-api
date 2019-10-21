<?php


namespace FondOfSpryker\Zed\CompanyUserApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserApi\Business\Model\CompanyUserApi;
use FondOfSpryker\Zed\CompanyUserApi\Business\Model\Validator\CompanyUserApiValidator;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyUserApiFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

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
     * @var \FondOfSpryker\Zed\CompanyUserApi\Business\CompanyUserApiFacade
     */
    protected $companyUserApiFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserApi\Business\Model\Validator\CompanyUserApiValidator
     */
    protected $companyUserApiValidatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserApi\Business\CompanyUserApiBusinessFactory
     */
    protected $companyUserApiBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserApi\Business\Model\CompanyUserApi
     */
    protected $companyUserApiMock;

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

        $this->companyUserApiBusinessFactoryMock = $this->getMockBuilder(CompanyUserApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserApiMock = $this->getMockBuilder(CompanyUserApi::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserApiValidatorMock = $this->getMockBuilder(CompanyUserApiValidator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idCompanyUser = 1;

        $this->companyUserApiFacade = new CompanyUserApiFacade();

        $this->companyUserApiFacade->setFactory($this->companyUserApiBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testAddCompanyUser(): void
    {
        $this->companyUserApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUserApi')
            ->willReturn($this->companyUserApiMock);

        $this->companyUserApiMock->expects($this->atLeastOnce())
            ->method('add')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyUserApiFacade->addCompanyUser($this->apiDataTransferMock));
    }

    /**
     * @return void
     */
    public function testGetCompanyUser(): void
    {
        $this->companyUserApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUserApi')
            ->willReturn($this->companyUserApiMock);

        $this->companyUserApiMock->expects($this->atLeastOnce())
            ->method('get')
            ->with($this->idCompanyUser)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyUserApiFacade->getCompanyUser($this->idCompanyUser));
    }

    /**
     * @return void
     */
    public function testUpdateCompanyUser(): void
    {
        $this->companyUserApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUserApi')
            ->willReturn($this->companyUserApiMock);

        $this->companyUserApiMock->expects($this->atLeastOnce())
            ->method('update')
            ->with($this->idCompanyUser, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyUserApiFacade->updateCompanyUser($this->idCompanyUser, $this->apiDataTransferMock));
    }

    /**
     * @return void
     */
    public function testRemoveUpdate(): void
    {
        $this->companyUserApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUserApi')
            ->willReturn($this->companyUserApiMock);

        $this->companyUserApiMock->expects($this->atLeastOnce())
            ->method('remove')
            ->with($this->idCompanyUser)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyUserApiFacade->removeCompanyUser($this->idCompanyUser));
    }

    /**
     * @return void
     */
    public function testFindCompanies(): void
    {
        $this->companyUserApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUserApi')
            ->willReturn($this->companyUserApiMock);

        $this->companyUserApiMock->expects($this->atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        $this->assertInstanceOf(ApiCollectionTransfer::class, $this->companyUserApiFacade->findCompanyUsers($this->apiRequestTransferMock));
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->companyUserApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUserApiValidator')
            ->willReturn($this->companyUserApiValidatorMock);

        $this->companyUserApiValidatorMock->expects($this->atLeastOnce())
            ->method('validate')
            ->with($this->apiDataTransferMock)
            ->willReturn([]);

        $this->assertIsArray($this->companyUserApiFacade->validate($this->apiDataTransferMock));
    }
}
