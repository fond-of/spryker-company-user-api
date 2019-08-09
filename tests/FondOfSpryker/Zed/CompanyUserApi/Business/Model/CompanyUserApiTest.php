<?php


namespace FondOfSpryker\Zed\CompanyUserApi\Business\Model;

use ArrayObject;
use Codeception\Test\Unit;
use Exception;
use FondOfSpryker\Zed\CompanyUserApi\Business\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeInterface;
use FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryBuilderQueryContainerInterface;
use FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryContainerInterface;
use FondOfSpryker\Zed\CompanyUserApi\Persistence\CompanyUserApiQueryContainerInterface;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\ResponseMessageTransfer;
use Iterator;

class CompanyUserApiTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserApi\Business\Model\CompanyUserApi
     */
    protected $companyUserApi;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryContainerInterface
     */
    protected $apiQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryBuilderQueryContainerInterface
     */
    protected $apiQueryBuilderQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserApi\Persistence\CompanyUserApiQueryContainerInterface
     */
    protected $companyUserApiQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeInterface
     */
    protected $companyUserFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserApi\Business\Mapper\TransferMapperInterface
     */
    protected $transferMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserResponseTransfer
     */
    protected $companyUserResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Iterator
     */
    protected $iteratorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ResponseMessageTransfer
     */
    protected $responseMessageTransferMock;

    /**
     * @var \ArrayObject
     */
    protected $responseMessages;

    /**
     * @var array
     */
    protected $transferData;

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

        $this->apiQueryContainerMock = $this->getMockBuilder(CompanyUserApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryBuilderQueryContainerMock = $this->getMockBuilder(CompanyUserApiToApiQueryBuilderQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserApiQueryContainerMock = $this->getMockBuilder(CompanyUserApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserFacadeMock = $this->getMockBuilder(CompanyUserApiToCompanyUserFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferMapperMock = $this->getMockBuilder(TransferMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserResponseTransferMock = $this->getMockBuilder(CompanyUserResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMessageTransferMock = $this->getMockBuilder(ResponseMessageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->iteratorMock = $this->getMockBuilder(Iterator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferData = [["idCompanyUser" => 1]];

        $this->idCompanyUser = 1;

        $this->responseMessages = new ArrayObject(
            [$this->responseMessageTransferMock]
        );

        $this->companyUserApi = new CompanyUserApi(
            $this->apiQueryContainerMock,
            $this->apiQueryBuilderQueryContainerMock,
            $this->companyUserApiQueryContainerMock,
            $this->companyUserFacadeMock,
            $this->transferMapperMock
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->apiDataTransferMock->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn($this->transferData[0]);

        $this->companyUserFacadeMock->expects($this->atLeastOnce())
            ->method('create')
            ->willReturn($this->companyUserResponseTransferMock);

        $this->companyUserResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyUserFacadeMock->expects($this->atLeastOnce())
            ->method('getCompanyUserById')
            ->willReturn($this->companyUserTransferMock);

        $this->apiQueryContainerMock->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyUserApi->add($this->apiDataTransferMock));
    }

    /**
     * @return void
     */
    public function testAddEntityNotSavedException(): void
    {
        $this->apiDataTransferMock->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn($this->transferData[0]);

        $this->companyUserFacadeMock->expects($this->atLeastOnce())
            ->method('create')
            ->willReturn($this->companyUserResponseTransferMock);

        $this->companyUserResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->companyUserResponseTransferMock->expects($this->atLeastOnce())
            ->method('getMessages')
            ->willReturn($this->iteratorMock);

        $this->iteratorMock->expects($this->once())
            ->method('rewind');

        $this->iteratorMock->expects($this->exactly(1))
            ->method('next');

        $this->iteratorMock->expects($this->exactly(2))
            ->method('valid')
            ->willReturnOnConsecutiveCalls(true);

        $this->iteratorMock->expects($this->exactly(1))
            ->method('current')
            ->willReturn($this->responseMessageTransferMock);

        try {
            $this->companyUserApi->add($this->apiDataTransferMock);
            $this->fail();
        } catch (Exception $e) {
        }
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->companyUserFacadeMock->expects($this->atLeastOnce())
            ->method('getCompanyUserById')
            ->willReturn($this->companyUserTransferMock);

        $this->apiQueryContainerMock->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->with($this->companyUserTransferMock, $this->idCompanyUser)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyUserApi->get($this->idCompanyUser));
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->companyUserFacadeMock->expects($this->atLeastOnce())
            ->method('getCompanyUserById')
            ->with($this->idCompanyUser)
            ->willReturn($this->companyUserTransferMock);

        $this->apiDataTransferMock->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn($this->transferData);

        $this->companyUserFacadeMock->expects($this->atLeastOnce())
            ->method('update')
            ->willReturn($this->companyUserResponseTransferMock);

        $this->companyUserResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->apiQueryContainerMock->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyUserApi->update($this->idCompanyUser, $this->apiDataTransferMock));
    }

    /**
     * @return void
     */
    public function testUpdateEntityNotSavedException(): void
    {
        $this->companyUserFacadeMock->expects($this->atLeastOnce())
            ->method('getCompanyUserById')
            ->with($this->idCompanyUser)
            ->willReturn($this->companyUserTransferMock);

        $this->apiDataTransferMock->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn($this->transferData);

        $this->companyUserFacadeMock->expects($this->atLeastOnce())
            ->method('update')
            ->willReturn($this->companyUserResponseTransferMock);

        $this->companyUserResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->companyUserResponseTransferMock->expects($this->atLeastOnce())
            ->method('getMessages')
            ->willReturn($this->iteratorMock);

        $this->iteratorMock->expects($this->once())
            ->method('rewind');

        $this->iteratorMock->expects($this->exactly(1))
            ->method('next');

        $this->iteratorMock->expects($this->exactly(2))
            ->method('valid')
            ->willReturnOnConsecutiveCalls(true);

        $this->iteratorMock->expects($this->exactly(1))
            ->method('current')
            ->willReturn($this->responseMessageTransferMock);

        try {
            $this->companyUserApi->update($this->idCompanyUser, $this->apiDataTransferMock);
            $this->fail();
        } catch (Exception $e) {
        }
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $this->companyUserFacadeMock->expects($this->atLeastOnce())
            ->method('delete')
            ->willReturn($this->companyUserResponseTransferMock);

        $this->apiQueryContainerMock->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->with([], $this->idCompanyUser);

        $this->assertInstanceOf(ApiItemTransfer::class, $this->companyUserApi->remove($this->idCompanyUser));
    }
}
