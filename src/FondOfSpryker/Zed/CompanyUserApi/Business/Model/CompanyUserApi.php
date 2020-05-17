<?php

namespace FondOfSpryker\Zed\CompanyUserApi\Business\Model;

use FondOfSpryker\Zed\CompanyUserApi\Business\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeInterface;
use FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryBuilderQueryContainerInterface;
use FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryContainerInterface;
use FondOfSpryker\Zed\CompanyUserApi\Persistence\CompanyUserApiQueryContainerInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiPaginationTransfer;
use Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\PropelQueryBuilderColumnSelectionTransfer;
use Generated\Shared\Transfer\PropelQueryBuilderColumnTransfer;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\TableMap;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyUserApi implements CompanyUserApiInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryContainerInterface
     */
    protected $apiQueryContainer;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryBuilderQueryContainerInterface
     */
    protected $apiQueryBuilderQueryContainer;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserApi\Persistence\CompanyUserApiQueryContainerInterface
     */
    protected $companyUserApiQueryContainer;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeInterface
     */
    protected $companyUserFacade;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserApi\Business\Mapper\TransferMapperInterface
     */
    protected $transferMapper;

    /**
     * @param \FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryContainerInterface $apiQueryContainer
     * @param \FondOfSpryker\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryBuilderQueryContainerInterface $apiQueryBuilderQueryContainer
     * @param \FondOfSpryker\Zed\CompanyUserApi\Persistence\CompanyUserApiQueryContainerInterface $companyUserApiQueryContainer
     * @param \FondOfSpryker\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeInterface $companyUserFacade
     * @param \FondOfSpryker\Zed\CompanyUserApi\Business\Mapper\TransferMapperInterface $transferMapper
     */
    public function __construct(
        CompanyUserApiToApiQueryContainerInterface $apiQueryContainer,
        CompanyUserApiToApiQueryBuilderQueryContainerInterface $apiQueryBuilderQueryContainer,
        CompanyUserApiQueryContainerInterface $companyUserApiQueryContainer,
        CompanyUserApiToCompanyUserFacadeInterface $companyUserFacade,
        TransferMapperInterface $transferMapper
    ) {
        $this->apiQueryContainer = $apiQueryContainer;
        $this->apiQueryBuilderQueryContainer = $apiQueryBuilderQueryContainer;
        $this->companyUserApiQueryContainer = $companyUserApiQueryContainer;
        $this->companyUserFacade = $companyUserFacade;
        $this->transferMapper = $transferMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $data = (array)$apiDataTransfer->getData();
        $companyUserTransfer = (new CompanyUserTransfer())->fromArray($data, true);
        $companyUserResponseTransfer = $this->companyUserFacade->create($companyUserTransfer);

        if (!$companyUserResponseTransfer->getIsSuccessful()) {
            $errors = [];

            foreach ($companyUserResponseTransfer->getMessages() as $error) {
                $errors[] = $error->getText();
            }

            throw new EntityNotSavedException('Could not add company user: ' . implode(',', $errors));
        }

        $companyUserTransfer = $this->companyUserFacade->getCompanyUserById($companyUserTransfer->getIdCompanyUser());

        return $this->apiQueryContainer->createApiItem($companyUserTransfer, $companyUserTransfer->getIdCompanyUser());
    }

    /**
     * @param int $idCompanyUser
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idCompanyUser): ApiItemTransfer
    {
        $companyUserTransfer = $this->companyUserFacade->getCompanyUserById($idCompanyUser);

        if ($companyUserTransfer->getIdCompanyUser() === null) {
            throw new EntityNotFoundException(sprintf('Company user not found for id %s', $idCompanyUser));
        }

        return $this->apiQueryContainer->createApiItem($companyUserTransfer, $idCompanyUser);
    }

    /**
     * @param int $idCompanyUser
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idCompanyUser, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $companyUserTransfer = $this->companyUserFacade->getCompanyUserById($idCompanyUser);

        if ($companyUserTransfer->getIdCompanyUser() === null) {
            throw new EntityNotFoundException(sprintf('Company user not found: %s', $idCompanyUser));
        }

        $data = (array)$apiDataTransfer->getData();
        $companyUserTransfer = (new CompanyUserTransfer())
            ->fromArray($data, true)
            ->setIdCompanyUser($idCompanyUser);

        $companyUserResponseTransfer = $this->companyUserFacade->update($companyUserTransfer);

        if (!$companyUserResponseTransfer->getIsSuccessful()) {
            $errors = [];

            foreach ($companyUserResponseTransfer->getMessages() as $message) {
                $errors[] = $message->getText();
            }

            throw new EntityNotSavedException('Could not update company user: ' . implode(',', $errors));
        }

        $companyUserTransfer = $this->companyUserFacade->getCompanyUserById($companyUserTransfer->getIdCompanyUser());

        return $this->apiQueryContainer->createApiItem($companyUserTransfer, $companyUserTransfer->getIdCompanyUser());
    }

    /**
     * @param int $idCompanyUser
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove(int $idCompanyUser): ApiItemTransfer
    {
        $companyUserTransfer = (new CompanyUserTransfer())->setIdCompanyUser($idCompanyUser);

        $this->companyUserFacade->delete($companyUserTransfer);

        return $this->apiQueryContainer->createApiItem([], $idCompanyUser);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        $query = $this->buildQuery($apiRequestTransfer);
        $collection = $this->transferMapper->toTransferCollection($query->find()->toArray());

        foreach ($collection as $k => $companyApiTransfer) {
            $collection[$k] = $this->get($companyApiTransfer->getIdCompanyUser())->getData();
        }

        $apiCollectionTransfer = $this->apiQueryContainer->createApiCollection($collection);
        $apiCollectionTransfer = $this->addPagination($query, $apiCollectionTransfer, $apiRequestTransfer);

        return $apiCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function buildQuery(ApiRequestTransfer $apiRequestTransfer): ModelCriteria
    {
        $apiQueryBuilderQueryTransfer = $this->buildApiQueryBuilderQuery($apiRequestTransfer);
        $query = $this->companyUserApiQueryContainer->queryFind();
        $query = $this->apiQueryBuilderQueryContainer->buildQueryFromRequest($query, $apiQueryBuilderQueryTransfer);

        return $query;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer
     */
    protected function buildApiQueryBuilderQuery(ApiRequestTransfer $apiRequestTransfer): ApiQueryBuilderQueryTransfer
    {
        $columnSelectionTransfer = $this->buildColumnSelection();

        $apiQueryBuilderQueryTransfer = (new ApiQueryBuilderQueryTransfer())
            ->setApiRequest($apiRequestTransfer)
            ->setColumnSelection($columnSelectionTransfer);

        return $apiQueryBuilderQueryTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\PropelQueryBuilderColumnSelectionTransfer
     */
    protected function buildColumnSelection(): PropelQueryBuilderColumnSelectionTransfer
    {
        $columnSelectionTransfer = new PropelQueryBuilderColumnSelectionTransfer();
        $tableColumns = SpyCompanyUserTableMap::getFieldNames(TableMap::TYPE_FIELDNAME);

        foreach ($tableColumns as $columnAlias) {
            $columnTransfer = (new PropelQueryBuilderColumnTransfer())
                ->setName(SpyCompanyUserTableMap::TABLE_NAME . '.' . $columnAlias)
                ->setAlias($columnAlias);

            $columnSelectionTransfer->addTableColumn($columnTransfer);
        }

        return $columnSelectionTransfer;
    }

    /**
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $query
     * @param \Generated\Shared\Transfer\ApiCollectionTransfer $apiCollectionTransfer
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected function addPagination(
        ModelCriteria $query,
        ApiCollectionTransfer $apiCollectionTransfer,
        ApiRequestTransfer $apiRequestTransfer
    ): ApiCollectionTransfer {
        $query->setOffset(0)
            ->setLimit(-1);

        $total = $query->count();
        $page = $apiRequestTransfer->getFilter()->getLimit() ? ($apiRequestTransfer->getFilter()->getOffset() / $apiRequestTransfer->getFilter()->getLimit() + 1) : 1;
        $pageTotal = ($total && $apiRequestTransfer->getFilter()->getLimit()) ? (int)ceil($total / $apiRequestTransfer->getFilter()->getLimit()) : 1;

        if ($page > $pageTotal) {
            throw new NotFoundHttpException('Out of bounds.', null, ApiConfig::HTTP_CODE_NOT_FOUND);
        }

        $apiPaginationTransfer = (new ApiPaginationTransfer())
            ->setItemsPerPage($apiRequestTransfer->getFilter()->getLimit())
            ->setPage($page)
            ->setTotal($total)
            ->setPageTotal($pageTotal);

        $apiCollectionTransfer->setPagination($apiPaginationTransfer);

        return $apiCollectionTransfer;
    }
}
