<?php

namespace Pyz\Yves\CheckoutPage\Form;

use Pyz\Yves\CheckoutPage\Form\Steps\OrderDetailsForm;
use Spryker\Yves\StepEngine\Form\FormCollectionHandlerInterface;
use SprykerShop\Yves\CheckoutPage\Form\FormFactory as SprykerFormFactory;

class FormFactory extends SprykerFormFactory
{
    public function createOrderFormCollection(): FormCollectionHandlerInterface
    {
        return $this->createFormCollection(
            $this->getOrderFormTypes(),
        );
    }

    /**
     * @return array<string>
     */
    public function getOrderFormTypes(): array
    {
        return [
            OrderDetailsForm::class,
        ];
    }
}
