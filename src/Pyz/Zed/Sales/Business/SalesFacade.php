<?php

namespace Pyz\Zed\Sales\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SpySalesOrderEntityTransfer;
use Spryker\Zed\Sales\Business\SalesFacade as SprykerSalesFacade;

/**
* @method \Pyz\Zed\Sales\Business\SalesBusinessFactory getFactory()
* @method \Spryker\Zed\Sales\Persistence\SalesEntityManagerInterface getEntityManager()
* @method \Spryker\Zed\Sales\Persistence\SalesRepositoryInterface getRepository()
*/
class SalesFacade extends SprykerSalesFacade implements SalesFacadeInterface
{
    public function expandSalesOrderEntityTransferWithOrderDetails(
        SpySalesOrderEntityTransfer $salesOrderEntityTransfer,
        QuoteTransfer $quoteTransfer,
    ): SpySalesOrderEntityTransfer {
        return $this->getFactory()
            ->getOrderDetailsExpander()
            ->expandSalesOrderEntityTransferWithOrderDetails($salesOrderEntityTransfer, $quoteTransfer);
    }
}
