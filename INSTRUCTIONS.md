
## Description

Fork Spryker B2B Demo Shop that enriched with 1 extra simple checkout step to set up some order details.

### Install the Demo Shop

Same way as described in origin install guid described [here](./README.md#install-the-b2b-demo-shop) with only difference of name of GitHub repository name.

- for step `2. Clone the B2B Demo Shop` use `https://github.com/az-joss/spk-b2b-demo-shop`

#### Set up a development environment

Same way as described in origin install guid described [here](./README.md#set-up-a-development-environment) with only difference of name of repository branch name.

- for step `4. Switch to your branch, re-build the application` use `feature/add-order-details-step-to-checkout-process` branch name.

### Check scenario

- login with valid account: email `sonia@spryker.com`

| email                | password    |
|----------------------|-------------|
| `sonia@spryker.com`  | `change123` |

- add any item to cart;
> NOTE: after fresh set up this account already has a few carts.
- proceed to checkout;
- the new checkout process starts from a new order details step
- fill provided form with order name
- proceed checkout with default steps out of the box
- place an order
- repeat this as many as need providing different names
> NOTE: order names do not have unique constraints.
- got to `customer/order` page which is "Order history" under account profile page.
- ensure that new order name column is visible
- ensure that new order name column is filterable via provided form
- ensure that new order name column is sortable

### Running test

1. Run testing mode executing command
```bash
docker/sdk testing
```
2. Simply run codeception with provided config for functional tests as follows
```bash
codecept run -c codeception.functional.yml
```
>NOTE:  you can use `--group` filters to reach only new tests. The added groups are: `OrderDetailsStepTest`, `SalesFacadeTest`
