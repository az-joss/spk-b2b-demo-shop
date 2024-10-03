<?php


namespace PyzTest\Yves\Checkout\Process\Steps;

use Codeception\Attribute\DataProvider;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Pyz\Yves\CheckoutPage\Process\Steps\OrderDetailsStep;
use PyzTest\Yves\Checkout\CheckoutBusinessTester;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Yves
 * @group Checkout
 * @group Process
 * @group Steps
 * @group OrderDetailsStepTest
 * Add your own group annotations below this line
 */
class OrderDetailsStepTest extends Unit
{
    protected const STEP_ROUTE = 'step-route';

    protected const ESCAPE_ROUTE = 'escape-route';

    protected CheckoutBusinessTester $tester;

    private OrderDetailsStep $orderDetailsStep;

    protected function _before(): void
    {
        $this->initOderDetailsStep();
    }

    protected function initOderDetailsStep(): void
    {
        $this->orderDetailsStep = new OrderDetailsStep(
            static::STEP_ROUTE,
            static::ESCAPE_ROUTE,
        );
    }

    public function testRequireInputReturnsAlwaysTrue(): void
    {
        // Arrange
        $quoteTransfer = new QuoteTransfer();

        // Act
        $result = $this->orderDetailsStep->requireInput($quoteTransfer);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * @return array<string, array<array<string, mixed>>>
     */
    protected function postConditionDataProvider(): array
    {
        return [
            'Returns false if Quote.orderName is empty.' => [
                [
                    'orderName' => null,
                ],
                [
                    'result' => false,
                ],
            ],
            'Returns true if Quote.orderName is set.' => [
                [
                    'orderName' => 'test123',
                ],
                [
                    'result' => true,
                ],
            ],
        ];
    }

    #[DataProvider('postConditionDataProvider')]
    public function testPostCondition(array $input, array $expected)
    {
        // arrange
        $quoteTransfer = (new QuoteTransfer())->setOrderName($input['orderName']);

        // execute
        $result = $this->orderDetailsStep->postCondition($quoteTransfer);

        // assert
        $this->assertEquals($expected['result'], $result);
    }
}
