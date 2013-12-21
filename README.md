

![GoCardless](https://s3-eu-west-1.amazonaws.com/gocardless-logos/lo-res.jpg)

# Extended functionality

## All invoice types

__Now allows payment of all invoice types.__
The original module stored preauth ID against the client subsciption ID field and it was used only for 
invoices that were raised in relation to hosting services.

PreAuthIDs are now stored in a new dedicated table, allowing all invoice types to be charge via GoCardless.

## Preauthorisation via the new addon

__Now allows clients to set up the preauth without an invoice being due__
The original module would only allow the preauthorisation to be created at the point of making a payment 
against the first invoice.

By visiting whmcs_url/?m=gc_preauth clients can set up their own preauthorisation without waiting until 
an invoice has been raised.

# Announcement

__As of 15th August 2013, the GoCardless WHMCS module will no longer be supported.__
You are, however, welcome to continue using the module indefinitely. 

If changes to WHMCS break the module, it is likely that we will release fixes,
but technical assistance will not be available.

The module is open source, so anyone is welcome to modify and distribute the
module as they see fit.

## GoCardless WHMCS Module

The GoCardless WHMCS module provides a simple way to use GoCardless from within WHMCS.

## Requirements

You must have WHMCS version 5.1.2 or later to use this WHMCS module.

### WHMCS 5.2 instructions

WHMCS introduced some breaking changes for modules. To make this module
compatible with v5.2, open both redirect.php and callback.php and follow the
instructions in the first couple of lines of the file.

## Getting started

1. [Download](https://github.com/gocardless/gocardless-whmcs/zipball/master) the latest version of the module.
2. Unzip the downloaded archive
3. Copy the contents of the GoCardless_WHMCS directory into `your_whmcs_install/modules/gateways` so that it replaces the existing version
4. Follow our [dedicated guide](https://gocardless.com/partners/whmcs) to using the module on the GoCardless site

## Support

For help with using this module, contact the GoCardless support team at <help@gocardless.com>.

## Changelog

__v1.1.0__

* Designed for __variable payments__ - now always uses a £5000 pre-auth
* Always use the "mark as paid instantly" option - WHMCS will still be updated
down the line if there is a failure
* Updates descriptions on pre-authorisations and individual payments
* Prevents customers from setting up multiple pre-authorizations if there is
one set up but not yet billed again for an invoice
* General bug fixes

__v1.0.5__

* Updates for compatability with
[WHMCS Version 5.2](http://docs.whmcs.com/Version_5.2_Release_Notes)

__v1.0.4__

* Fixes an issue where the first payment amount differs from the recurring amount
* Improves support for WHMCS installations with SSL enabled
* Improves logging where WHMCS tries to capture payment for an invoice which
already has a pending bill on GoCardless

__v1.0.3__

* Fixes an issue with connection to our SSL service experienced on some environments

__v1.0.2__

* Fixes issue with the GoCardless payment button in Internet Explorer - only affects a subset of WHMCS installations

__v1.0.1__

* Updates the WHMCS cron so any issues whilst collecting do not affect other payment gateways

__v1.0__

* Adds support for setup fees, allowing one-off products at the beginning of a recurring package
* Support for GoCardless Sandbox mode
* Added "Instant Activation" option to mark payments as paid straight away, rather than waiting for feedback from GoCardless
* Reliability improvements and bug fixes

__v.01__

* Initial release
