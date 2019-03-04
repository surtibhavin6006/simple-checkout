## System Information

* Php 7.2 or Above
* Laravel Framework : 5.7

## Installation and Guide

We have used UUID instead of default auto incremented id.

### Installation
* Clone a project.
* Apply below command to install packages:
    * `composer install`


### Data

`$productAndScheme = new App\ProductAndScheme();`

**To get Schemes**
`$schemes = $productAndScheme->getScheme();`

**To get Products**
`$products = $productAndScheme->getProducts();`

**To get Products**
`$products = $productAndScheme->getProductById(productId);`


**Explore how system work**

- example : src/App/example.php

- Checkout Class : src/App/CheckOut.php
    
    - scan : here item as key and units are stored as its value.
    
    - total : wll check if any scheme is applied or not and created a final method and call the *finalCalculation*
    
    - finalCalculation : will check below things:
        
        - freeItems : 
            
            - if free items are scanned already and equal to freeItems.It will adjust finalPrice.
            - if free items are not scanned .It will add free item and adjust finalPrice.
            
        - discount :
            
            - Adjust totalAmount on discount amount.

## TESTING

- on terminal to project directory fire "vendor/phpunit/phpunit/phpunit" command.