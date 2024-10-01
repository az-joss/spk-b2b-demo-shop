<?php

namespace Pyz\Yves\CheckoutPage;

use Pyz\Yves\CheckoutPage\Form\FormFactory;
use Pyz\Yves\CheckoutPage\Process\StepFactory;
use SprykerShop\Yves\CheckoutPage\CheckoutPageFactory as SprykerCheckoutPageFactory;

/**
 * @method \Pyz\Yves\CheckoutPage\CheckoutPageConfig getConfig()
 */
class CheckoutPageFactory extends SprykerCheckoutPageFactory
{
    public function createStepFactory(): StepFactory
    {
        return new StepFactory();
    }

    public function createCheckoutFormFactory(): FormFactory
    {
        return new FormFactory();
    }
}
