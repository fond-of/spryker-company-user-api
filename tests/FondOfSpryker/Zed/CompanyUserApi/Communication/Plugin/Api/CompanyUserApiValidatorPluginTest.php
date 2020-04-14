<?php

namespace FondOfSpryker\Zed\CompanyUserApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserApi\Business\CompanyUserApiFacade;
use FondOfSpryker\Zed\CompanyUserApi\CompanyUserApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;

class CompanyUserApiValidatorPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserApi\Communication\Plugin\Api\CompanyUserApiValidatorPlugin
     */
    protected $companyUserApiValidatorPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserApi\Business\CompanyUserApiFacade
     */
    protected $companyUserApiFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserApiFacadeMock = $this->getMockBuilder(CompanyUserApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserApiValidatorPlugin = new CompanyUserApiValidatorPlugin();

        $this->companyUserApiValidatorPlugin->setFacade($this->companyUserApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        $this->assertSame(CompanyUserApiConfig::RESOURCE_COMPANY_USERS, $this->companyUserApiValidatorPlugin->getResourceName());
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->companyUserApiFacadeMock->expects($this->atLeastOnce())
            ->method('validate')
            ->with($this->apiDataTransferMock)
            ->willReturn([]);

        $this->assertIsArray($this->companyUserApiValidatorPlugin->validate($this->apiDataTransferMock));
    }
}
