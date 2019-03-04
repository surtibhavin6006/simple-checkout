<?php

use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 3/3/19
 * Time: 11:56 AM
 */

class CheckOutTest extends TestCase
{
    protected $checkOut;

    public function setUp(): void
    {
        parent::setUp();

        //include __DIR__ .'/../src/Data.php';

        $schemes = array();
        $schemes['atv'] = array();
        $schemes['atv']['type'] = 1;
        $schemes['atv']['free'] = array(
            'purchase' => 2,
            'free_item' => 'atv',
            'free_number_of_item' => 1,
        );

        $schemes['ipd'] = array();
        $schemes['ipd']['type'] = 2;
        $schemes['ipd']['free'] = array(
            'purchase' => 4,
            'bulk_discount' => 499.99,
        );

        $schemes['mbp'] = array();
        $schemes['mbp']['type'] = 3;
        $schemes['mbp']['free'] = array(
            'purchase' => 1,
            'free_item' => 'vga',
            'free_number_of_item' => 1,
        );

        $this->checkOut = new App\CheckOut($schemes);
    }

    public function testItemsAreEmptyByDefault() : void
    {
        $items = $this->checkOut->items;
        $this->assertEmpty($items);
    }

    public function testScanItems() : void
    {
        $this->checkOut->scan('iq');
        $items = $this->checkOut->items;
        $this->assertContains('iq',$items);
    }


    public function testScanItemsSchemeType1() : void
    {
        /**
         * Case 1 buy 2 ipd and no scheme applied
         */
        $this->checkOut->scan('ipd');
        $this->checkOut->scan('ipd');
        $billAmount = $this->checkOut->total();
        $this->assertSame($billAmount);

    }
}