<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CheckoutPage\Process\Steps;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\StepEngine\Dependency\Step\StepWithBreadcrumbInterface;
use SprykerShop\Yves\CheckoutPage\Process\Steps\AbstractBaseStep;

class OrderDetailsStep extends AbstractBaseStep implements StepWithBreadcrumbInterface
{
    public function requireInput(AbstractTransfer $quoteTransfer): bool
    {
        return true;
    }

    public function postCondition(AbstractTransfer $quoteTransfer): bool
    {
        if ($quoteTransfer->getOrderName() === null) {
            return false;
        }

        return true;
    }

    public function getBreadcrumbItemTitle(): string
    {
        return 'checkout.step.order_details.title';
    }

    public function isBreadcrumbItemEnabled(AbstractTransfer $quoteTransfer): bool
    {
        return $this->postCondition($quoteTransfer);
    }

    public function isBreadcrumbItemHidden(AbstractTransfer $quoteTransfer): bool
    {
        return !$this->requireInput($quoteTransfer);
    }
}
