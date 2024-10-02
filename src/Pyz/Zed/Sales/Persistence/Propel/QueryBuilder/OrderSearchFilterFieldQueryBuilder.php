<?php

namespace Pyz\Zed\Sales\Persistence\Propel\QueryBuilder;

use Orm\Zed\Sales\Persistence\Map\SpySalesOrderItemTableMap;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderTableMap;
use Spryker\Zed\Sales\Persistence\Propel\QueryBuilder\OrderSearchFilterFieldQueryBuilder as SprykerOrderSearchFilterFieldQueryBuilder;

class OrderSearchFilterFieldQueryBuilder extends SprykerOrderSearchFilterFieldQueryBuilder
{
    /**
     * @uses \Pyz\Shared\Sales\SalesConfig::ORDER_SEARCH_TYPES
     *
     * @var string
     */
    protected const SEARCH_TYPE_ORDER_NAME = 'orderName';

    protected const ORDER_SEARCH_TYPE_MAPPING = [
        self::SEARCH_TYPE_ORDER_REFERENCE => SpySalesOrderTableMap::COL_ORDER_REFERENCE,
        self::SEARCH_TYPE_ORDER_NAME => SpySalesOrderTableMap::COL_ORDER_NAME,
        self::SEARCH_TYPE_ITEM_NAME => SpySalesOrderItemTableMap::COL_NAME,
        self::SEARCH_TYPE_ITEM_SKU => SpySalesOrderItemTableMap::COL_SKU,
    ];

    protected const ORDER_BY_COLUMN_MAPPING = [
        self::SEARCH_TYPE_ORDER_REFERENCE => SpySalesOrderTableMap::COL_ID_SALES_ORDER,
        self::SEARCH_TYPE_ORDER_NAME => SpySalesOrderTableMap::COL_ORDER_NAME,
        'date' => SpySalesOrderTableMap::COL_CREATED_AT,
    ];
}
