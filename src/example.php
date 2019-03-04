<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 3/3/19
 * Time: 1:08 PM
 */

require_once __DIR__ . '/../vendor/autoload.php';

$productAndScheme = new App\ProductAndScheme();
$schemes = $productAndScheme->getScheme();

$checkOut = new App\CheckOut($schemes);

echo "<pre>";

$finalOutPut1 = $checkOut->scan('atv')
    ->scan('atv')
    ->scan('atv')
    ->scan('vga')
    ->total();
print_r($finalOutPut1);

$finalOutPut2 = $checkOut->scan('atv')
    ->scan('ipd')
    ->scan('ipd')
    ->scan('atv')
    ->scan('ipd')
    ->scan('ipd')
    ->scan('ipd')
    ->total();
print_r($finalOutPut2);

$finalOutPut3 = $checkOut->scan('mbp')
    ->scan('vga')
    ->scan('ipd')
    ->total();
print_r($finalOutPut3);