<?php

namespace FondOfSpryker\Zed\CompanyUserApi\Business\Model\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiDataTransfer;

class CompanyUserApiValidatorTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserApi\Business\Model\Validator\CompanyUserApiValidator
     */
    protected $companyUserApiValidator;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserApiValidator = new CompanyUserApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->assertIsArray($this->companyUserApiValidator->validate($this->apiDataTransferMock));
    }
}
