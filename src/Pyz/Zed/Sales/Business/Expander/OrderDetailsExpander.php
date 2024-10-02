<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Sales\Business\Expander;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SpySalesOrderEntityTransfer;

class OrderDetailsExpander
{
    public function expandSalesOrderEntityTransferWithOrderDetails(
        SpySalesOrderEntityTransfer $salesOrderEntityTransfer,
        QuoteTransfer $quoteTransfer,
    ): SpySalesOrderEntityTransfer {
        $salesOrderEntityTransfer->setOrderName($quoteTransfer->getOrderName());

        return $salesOrderEntityTransfer;
    }
}
