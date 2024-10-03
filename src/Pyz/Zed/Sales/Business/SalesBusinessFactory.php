<?php

namespace Pyz\Zed\Sales\Business;

use Pyz\Zed\Sales\Business\Expander\OrderDetailsExpander;
use Spryker\Zed\Sales\Business\SalesBusinessFactory as SprykerSalesBusinessFactory;

class SalesBusinessFactory extends SprykerSalesBusinessFactory
{
    public function createOrderDetailsExpander(): OrderDetailsExpander
    {
        return new OrderDetailsExpander();
    }
}
