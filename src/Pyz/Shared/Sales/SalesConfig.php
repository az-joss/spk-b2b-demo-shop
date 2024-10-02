<?php

namespace Pyz\Shared\Sales;

use Spryker\Shared\Sales\SalesConfig as SprykerSalesConfig;

class SalesConfig extends SprykerSalesConfig
{
    /**
     * @var array<string>
     */
    protected const ORDER_SEARCH_TYPES = [
        'all',
        'orderReference',
        'orderName',
        'itemName',
        'itemSku',
    ];
}
