<?php

namespace FondOfSpryker\Zed\CompanyUserApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\CompanyUserApi\Business\CompanyUserApiBusinessFactory getFactory()
 */
class CompanyUserApiFacade extends AbstractFacade implements CompanyUserApiFacadeInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function addCompanyUser(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()->createCompanyUserApi()->add($apiDataTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param int $idCompanyUser
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getCompanyUser(int $idCompanyUser): ApiItemTransfer
    {
        return $this->getFactory()->createCompanyUserApi()->get($idCompanyUser);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param int $idCompanyUser
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateCompanyUser(int $idCompanyUser, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()->createCompanyUserApi()->update($idCompanyUser, $apiDataTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param int $idCompanyUser
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function removeCompanyUser(int $idCompanyUser): ApiItemTransfer
    {
        return $this->getFactory()->createCompanyUserApi()->remove($idCompanyUser);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findCompanyUsers(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFactory()->createCompanyUserApi()->find($apiRequestTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return $this->getFactory()->createCompanyUserApiValidator()->validate($apiDataTransfer);
    }
}
