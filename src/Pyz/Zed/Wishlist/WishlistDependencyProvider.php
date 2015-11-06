<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */
namespace Pyz\Zed\Wishlist;

use SprykerFeature\Zed\Wishlist\WishlistDependencyProvider as BaseWishlistDependencyProvider;
use SprykerEngine\Zed\Kernel\Container;
use SprykerFeature\Zed\Wishlist\Business\Operator\Add;
use SprykerFeature\Zed\Wishlist\Business\Operator\Decrease;
use SprykerFeature\Zed\Wishlist\Business\Operator\Increase;
use SprykerFeature\Zed\Wishlist\Business\Operator\Remove;

class WishlistDependencyProvider extends BaseWishlistDependencyProvider
{

    /**
     * @param Container $container
     *
     * @return array
     */
    protected function preSavePlugins(Container $container)
    {
        $groupingPlugin = $container->getLocator()->itemGrouperWishlistConnector()->pluginPreSaveItemGroupingPlugin();

        return [
            Add::OPERATION_NAME => [
                $container->getLocator()->wishlist()->pluginPreSaveSkuGroupKeyPlugin(),
                $container->getLocator()->productOptionWishlistConnector()->pluginPreSaveGroupKeyProductOptionPlugin(),
                $groupingPlugin,
            ],
            Decrease::OPERATION_NAME => [
                $groupingPlugin,
            ],
            Increase::OPERATION_NAME => [
                $groupingPlugin,
            ],
            Remove::OPERATION_NAME => [
                $groupingPlugin,
            ],
        ];
    }

}
