<?php


namespace FondOfSpryker\Zed\CompanyUserApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserApi\Business\Model\CompanyUserApi;
use FondOfSpryker\Zed\CompanyUserApi\Business\Model\Validator\CompanyUserApiValidator;
use FondOfSpryker\Zed\CompanyUserApi\CompanyUserApiConfig;
use FondOfSpryker\Zed\CompanyUserApi\CompanyUserApiDependencyProvider;
use FondOfSpryker\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeInterface;
use FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryBuilderQueryContainerInterface;
use FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryContainerInterface;
use FondOfSpryker\Zed\CompanyUserApi\Persistence\CompanyUserApiQueryContainer;
use Spryker\Zed\Kernel\Container;

class CompanyUserApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserApi\Business\CompanyUserApiBusinessFactory
     */
    protected $companyApiBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserApi\Persistence\CompanyUserApiQueryContainer
     */
    protected $queryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserApi\CompanyUserApiConfig
     */
    protected $companyApiConfigMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyApiConfigMock = $this->getMockBuilder(CompanyUserApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryContainerMock = $this->getMockBuilder(CompanyUserApiQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyApiBusinessFactory = new CompanyUserApiBusinessFactory();

        $this->companyApiBusinessFactory->setConfig($this->companyApiConfigMock);
        $this->companyApiBusinessFactory->setQueryContainer($this->queryContainerMock);
        $this->companyApiBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyApi(): void
    {
        $apiQueryContainerMock = $this->getMockBuilder(CompanyUserApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $apiQueryBuilderQueryContainerMock = $this->getMockBuilder(CompanyUserApiToApiQueryBuilderQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $apiToCompanyFacadeMock = $this->getMockBuilder(CompanyUserApiToCompanyUserFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CompanyUserApiDependencyProvider::QUERY_CONTAINER_API],
                [CompanyUserApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER],
                [CompanyUserApiDependencyProvider::FACADE_COMPANY_USER]
            )->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyUserApiDependencyProvider::QUERY_CONTAINER_API],
                [CompanyUserApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER],
                [CompanyUserApiDependencyProvider::FACADE_COMPANY_USER]
            )
            ->willReturnOnConsecutiveCalls(
                $apiQueryContainerMock,
                $apiQueryBuilderQueryContainerMock,
                $apiToCompanyFacadeMock
            );

        $company = $this->companyApiBusinessFactory->createCompanyUserApi();

        $this->assertInstanceOf(CompanyUserApi::class, $company);
    }

    /**
     * @return void
     */
    public function testCreateCompanyApiValidator(): void
    {
        $validator = $this->companyApiBusinessFactory->createCompanyUserApiValidator();

        $this->assertInstanceOf(CompanyUserApiValidator::class, $validator);
    }
}
