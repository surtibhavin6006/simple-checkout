<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 3/3/19
 * Time: 12:24 PM
 */

namespace App\AppInterface;

interface CheckOutInterface
{
    public function __construct(array $pricingRules);
    public function scan(string $item_id);
    public function total() : array;
}