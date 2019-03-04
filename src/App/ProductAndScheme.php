<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 3/3/19
 * Time: 5:49 PM
 */

namespace App;


class ProductAndScheme
{
    public $products,$schemes;

    public function __construct()
    {
        $this->products = [
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

        $this->schemes = array();
        $this->schemes['atv'] = array();
        $this->schemes['atv']['type'] = 1;
        $this->schemes['atv']['purchase'] = 3;
        $this->schemes['atv']['free_item'] = 'atv';
        $this->schemes['atv']['free_on_purchase'] = 1;

        $this->schemes['ipd'] = array();
        $this->schemes['ipd']['type'] = 2;
        $this->schemes['ipd']['purchase'] = 4;
        $this->schemes['ipd']['bulk_discount'] = 499.99;

        $this->schemes['mbp'] = array();
        $this->schemes['mbp']['type'] = 3;
        $this->schemes['mbp']['purchase'] = 1;
        $this->schemes['mbp']['free_item'] = 'vga';
        $this->schemes['mbp']['free_number_of_item'] = 1;
    }

    public function getProducts() : array
    {
        return $this->products;
    }

    public function getScheme() : array
    {
        return $this->schemes;
    }

    public function getProductById(string $id) : array
    {
        $key = array_search($id,array_column($this->products,'sku'));

        if($this->products[$key]['sku'] == $id){
            return $this->products[$key];
        }

        return array();
    }
}