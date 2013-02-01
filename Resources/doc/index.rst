Provides email management in your Symfony2 Project.

Features
========

TransactionalEmailBundle features
-----------------------------


Installation
============

Bring in the vendor libraries
-----------------------------

This can be done in two different ways:

**Method #1**) Use composer

::

    "require": {
        "php": ">=5.3.2",
        "symfony/symfony": "2.1.*",
        "_comment": "your other packages",

        "yv/transactional-email-bundle": "dev-master",
    }


**Method #2**) Use git submodules

::

    git submodule add git://github.com/yourvine/YVTransactionalEmailBundle.git vendor/bundles/YV/TransactionalEmailBundle

Register the TransactionalEmailBundle and YV namespaces
---------------------------------------------------

Only required, when using submodules.

::

    // app/autoload.php
    $loader->registerNamespaces(array(
        'YV'  => __DIR__.'/../vendor/bundles',
        // your other namespaces
    ));

Add TransactionalEmailBundle to your application kernel
-------------------------------------------------------

::

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new YV\TransactionalEmailBundle(),
            // ...
        );
    }


Configure the bundle
====================

All available configuration options are listed below with their default values.

::

    # app/config/config.yml
    yv_transactional_email:
        transactional_email_class:      ~ # Required
        default_locale:                 en
        service:
            transactional_email_type_holder:     ~ # Required
            transactional_email_manager:         transactional_email_manager.default
            transactional_email_mailer:          transactional_email_mailer.default           
        email:
            sending_enabled:    true
            address:            admin@example.com
            sender_name:        Admin
        crud:
            form_name:  yv_transactional_email  
            form_type:  yv_transactional_email
