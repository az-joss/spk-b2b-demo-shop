<?php


namespace PyzTest\Zed\Sales\Business;

use Codeception\Attribute\DataProvider;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\OrderListFormatTransfer;
use Generated\Shared\Transfer\OrderListTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SpySalesOrderEntityTransfer;
use Pyz\Zed\Sales\Business\SalesFacadeInterface;
use PyzTest\Zed\Sales\SalesBusinessTester;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Zed
 * @group Sales
 * @group Business
 * @group Facade
 * @group SalesFacadeTest
 * Add your own group annotations below this line
 */
class SalesFacadeTest extends Unit
{
    protected const FILTER_FIELD_TYPE_CUSTOMER_REFERENCE = 'customerReference';

    protected const FILTER_FIELD_TYPE_ORDER_BY = 'orderBy';

    /**
     * @uses \Pyz\Shared\Sales\SalesConfig::ORDER_SEARCH_TYPES
     *
     * @var string
     */
    protected const SEARCH_TYPE_ALL = 'all';

    /**
     * @uses \Pyz\Shared\Sales\SalesConfig::ORDER_SEARCH_TYPES
     *
     * @var string
     */
    protected const SEARCH_TYPE_ORDER_NAME = 'orderName';

    protected SalesBusinessTester $tester;

    protected SalesFacadeInterface $salesFacade;

    protected function _before(): void
    {
        $this->salesFacade = $this->tester->getFacade();
    }

    public function testExpandSalesOrderEntityTransferWithOrderDetails(): void
    {
        // Arrange
        $orderName = 'test123';
        $spySalesOrderEntityTransfer = new SpySalesOrderEntityTransfer();
        $quoteTransfer = (new QuoteTransfer())->setOrderName($orderName);

        // Act
        $result = $this->salesFacade->expandSalesOrderEntityTransferWithOrderDetails($spySalesOrderEntityTransfer, $quoteTransfer);

        // Assert
        $this->assertInstanceOf(SpySalesOrderEntityTransfer::class, $result);
        $this->assertEquals($orderName, $result->getOrderName());
    }

    /**
     * @return array<string, array<array<string, mixed>>>
     */
    protected function searchOrdersDataProvider(): array
    {
        return [
            'Can filter by \'all\' type including order name' => [
                [
                    'orderListData' => [
                        OrderListTransfer::FORMAT => [
                            OrderListFormatTransfer::EXPAND_WITH_ITEMS => false,
                        ],
                        OrderListTransfer::FILTER_FIELDS => [
                            [
                                FilterFieldTransfer::TYPE => static::SEARCH_TYPE_ALL,
                                FilterFieldTransfer::VALUE => 'order00',
                            ],
                        ],
                    ],
                    'quotes' => [
                        [
                            QuoteTransfer::ORDER_NAME => 'order00500',
                        ],
                        [
                            QuoteTransfer::ORDER_NAME => 'order00300',
                        ],
                        [
                            QuoteTransfer::ORDER_NAME => 'order00100',
                        ],
                        [
                            QuoteTransfer::ORDER_NAME => 'othername001',
                        ],
                    ],
                ],
                [
                    'orderCount' => 3,
                    'orderCollection' => [
                        [
                            QuoteTransfer::ORDER_NAME => 'order00500',
                        ],
                        [
                            QuoteTransfer::ORDER_NAME => 'order00300',
                        ],
                        [
                            QuoteTransfer::ORDER_NAME => 'order00100',
                        ],
                    ],
                ],
            ],
            'Can filter by \'orderName\' type explicitly' => [
                [
                    'orderListData' => [
                        OrderListTransfer::FORMAT => [
                            OrderListFormatTransfer::EXPAND_WITH_ITEMS => false,
                        ],
                        OrderListTransfer::FILTER_FIELDS => [
                            [
                                FilterFieldTransfer::TYPE => static::SEARCH_TYPE_ALL,
                                FilterFieldTransfer::VALUE => 'order00600',
                            ],
                        ],
                    ],
                    'quotes' => [
                        [
                            QuoteTransfer::ORDER_NAME => 'order00600',
                        ],
                        [
                            QuoteTransfer::ORDER_NAME => 'order00700',
                        ],
                        [
                            QuoteTransfer::ORDER_NAME => 'order00800',
                        ],
                        [
                            QuoteTransfer::ORDER_NAME => 'othername002',
                        ],
                    ],
                ],
                [
                    'orderCount' => 1,
                    'orderCollection' => [
                        [
                            QuoteTransfer::ORDER_NAME => 'order00600',
                        ],
                    ],
                ],
            ],
            'Can sort by \'orderName\' asc' => [
                [
                    'orderListData' => [
                        OrderListTransfer::FORMAT => [
                            OrderListFormatTransfer::EXPAND_WITH_ITEMS => false,
                        ],
                        OrderListTransfer::FILTER_FIELDS => [
                            [
                                FilterFieldTransfer::TYPE => static::FILTER_FIELD_TYPE_ORDER_BY,
                                FilterFieldTransfer::VALUE => 'orderName::asc',
                            ],
                        ],
                    ],
                    'quotes' => [
                        [
                            QuoteTransfer::ORDER_NAME => 'order00900',
                        ],
                        [
                            QuoteTransfer::ORDER_NAME => 'order01000',
                        ],
                        [
                            QuoteTransfer::ORDER_NAME => 'order01100',
                        ],
                        [
                            QuoteTransfer::ORDER_NAME => 'anothername003',
                        ],
                    ],
                ],
                [
                    'orderCount' => 4,
                    'orderCollection' => [
                        [
                            QuoteTransfer::ORDER_NAME => 'anothername003',
                        ],
                        [
                            QuoteTransfer::ORDER_NAME => 'order00900',
                        ],
                        [
                            QuoteTransfer::ORDER_NAME => 'order01000',
                        ],
                        [
                            QuoteTransfer::ORDER_NAME => 'order01100',
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * @param array<string, mixed> $input
     * @param array<string, mixed> $expected
     *
     * @return void
     */
    #[DataProvider('searchOrdersDataProvider')]
    public function testSearchOrders(array $input, array $expected): void
    {
        // Arrange
        $orderListData = $input['orderListData'];
        $customerTransfer = $this->tester->haveCustomer();
        // expand orderList with customer reference filter
        $orderListData[OrderListTransfer::FILTER_FIELDS][] = [
            FilterFieldTransfer::TYPE => static::FILTER_FIELD_TYPE_CUSTOMER_REFERENCE,
            FilterFieldTransfer::VALUE => $customerTransfer->getCustomerReference(),
        ];
        $orderListTransfer = $this->tester->createOrderListTransfer($orderListData);

        foreach ($input['quotes'] as $quoteData) {
            $quoteData = array_merge([
                QuoteTransfer::CUSTOMER_REFERENCE => $customerTransfer->getCustomerReference(),
                QuoteTransfer::CUSTOMER => $customerTransfer->toArray(),
            ], $quoteData);

            $this->tester->haveOrder($quoteData, 'DummyPayment01');
        }

        // Act
        $this->salesFacade->searchOrders($orderListTransfer);

        // Assert
        $this->assertEquals($expected['orderCount'], $orderListTransfer->getOrders()->count());
        foreach ($orderListTransfer->getOrders() as $index => $orderTransfer) {
            $expectedOrderData = $expected['orderCollection'][$index];
            $orderData = $orderTransfer->toArray(false, true);
            $this->assertEquals(
                count($expectedOrderData),
                count(array_intersect_assoc($orderData, $expectedOrderData)),
                sprintf(
                    'The order data miss expected property value pair: [%s]',
                    implode(', ', array_map(
                        fn($fieldName, $fieldValue) => ($fieldName . ':' . $fieldValue),
                        array_keys($expectedOrderData),
                        $expectedOrderData,
                    )),
                ),
            );
        }
    }
}
