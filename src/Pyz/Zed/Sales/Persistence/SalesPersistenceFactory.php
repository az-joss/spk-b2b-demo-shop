<?php

namespace Pyz\Zed\Sales\Persistence;

use Pyz\Zed\Sales\Persistence\Propel\QueryBuilder\OrderSearchFilterFieldQueryBuilder;
use Spryker\Zed\Sales\Persistence\Propel\QueryBuilder\OrderSearchFilterFieldQueryBuilderInterface;
use Spryker\Zed\Sales\Persistence\SalesPersistenceFactory as SprykerSalesPersistenceFactory;

class SalesPersistenceFactory extends SprykerSalesPersistenceFactory
{
    public function createOrderSearchFilterFieldQueryBuilder(): OrderSearchFilterFieldQueryBuilderInterface
    {
        return new OrderSearchFilterFieldQueryBuilder();
    }
}
