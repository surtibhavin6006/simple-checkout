<?php

$products = [
    [
        'sku' => 'ipd',
        'name' => 'Super IPad',
        'price' => 549.99
    ],
    [
        'sku' => 'mbp',
        'name' => 'MacBook Pro',
        'price' => 1399.99
    ],
    [
        'sku' => 'atv',
        'name' => 'Apple TV',
        'price' => 109.50
    ],
    [
        'sku' => 'vga',
        'name' => 'VGA adapter',
        'price' => 30.00
    ]
];

$schemes = array();
$schemes['atv'] = array();
$schemes['atv']['type'] = 1;
$schemes['atv']['purchase'] = 3;
$schemes['atv']['free_item'] = 'atv';
$schemes['atv']['free_on_purchase'] = 1;

$schemes['ipd'] = array();
$schemes['ipd']['type'] = 2;
$schemes['ipd']['purchase'] = 4;
    $schemes['ipd']['bulk_discount'] = 499.99;

$schemes['mbp'] = array();
$schemes['mbp']['type'] = 3;
$schemes['mbp']['purchase'] = 1;
$schemes['mbp']['free_item'] = 'vga';
$schemes['mbp']['free_number_of_item'] = 1;