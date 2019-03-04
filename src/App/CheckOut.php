<?php
/**
 * Created by PhpStorm.
 * User: bhavin
 * Date: 2/3/19
 * Time: 4:54 PM
 */

namespace App;

//include 'AppInterface/CheckOutInterface.php';
use App\AppInterface\CheckOutInterface;

class CheckOut implements CheckOutInterface
{
    public $items;
    public $pricingRules;
    public $productAndScheme;

    public function __construct(array $pricingRules)
    {
        $this->pricingRules = $pricingRules;
        $this->items = array();

        $this->productAndScheme = new ProductAndScheme();
    }

    public function scan(string $item_id)
    {
        if(isset($this->items[$item_id])){
            ++$this->items[$item_id];
        } else {
            $this->items[$item_id] = 1;
        }

        return $this;
    }

    public function total(): array
    {
        $finalTotal = 0;

        foreach ($this->items as $item => $totalUnits) {

            $totalItemsCount = 0;
            $product = $this->productAndScheme->getProductById($item);
            $this->items[$item] = array();
            $price = $product['price'];

            if(!empty($this->pricingRules[$item])){

                $schemes = $this->pricingRules[$item];

                if($schemes['type'] == '1') {

                    $schemedUnits = $totalUnits / $schemes['purchase'];
                    $schemedUnits =  (integer) $schemedUnits;

                    for($i=1;$i<=$schemedUnits;$i++){
                        $totalItemsCount += $schemes['purchase'] - $schemes['free_on_purchase'];
                    }

                    $totalItemsCount += $totalUnits - ($schemedUnits * $schemes['purchase']);

                    /*$price = round($totalItemsCount * $product['price'],2);
                    $this->items[$item]['price'] = $price;*/

                } else if($schemes['type'] == '2') {

                    $totalItemsCount = $totalUnits;

                    if($totalUnits > $schemes['purchase']){
                        $this->items['discount'] = true;
                        $price = $schemes['bulk_discount_price'];
                    }

                } else if($schemes['type'] == '3') {

                    $totalItemsCount = $totalUnits;
                    $this->items['free_item'][$schemes['free_item']] = $schemes['free_number_of_item'] * $totalItemsCount;
                }

            } else {
                $totalItemsCount = $totalUnits;
            }

            $price = round($totalItemsCount * $price,2);
            $finalTotal += $price;
            $this->items[$item]['price'] = $price;
            $this->items[$item]['units'] = $totalUnits;
        }

        $this->items['finalTotal'] = $finalTotal;

        $finalData = $this->items;

        $this->items = array();

        return $this->finalCalculation($finalData);
    }

    protected function finalCalculation($finalData)
    {
        /**
         * Checking free item already scanned if not add it and added then remove it amount from total
         */
        if($finalData['free_item']){

            foreach ($finalData['free_item'] as $freeKey => $freeItem){

                if(isset($finalData[$freeKey])){
                    if($finalData[$freeKey]['units'] == $freeItem){
                        $finalData[$freeKey]['free'] = true;
                        $finalData[$freeKey]['free_unit'] = $freeItem;

                        $pPrice = $finalData[$freeKey]['price'];

                        $finalData['finalTotal'] = $finalData['finalTotal'] - $pPrice;
                    } else if($finalData[$freeKey]['units'] > $freeItem){
                        $finalData[$freeKey]['free'] = true;
                        $finalData[$freeKey]['free_unit'] = $freeItem;

                        $product = $this->productAndScheme->getProductById($freeKey);
                        $pPrice = $product['price'] * $freeItem;

                        $finalData['finalTotal'] = $finalData['finalTotal'] - $pPrice;
                    } else if($finalData[$freeKey]['units'] < $freeItem){
                        $finalData[$freeKey]['free'] = true;
                        $finalData[$freeKey]['free_unit'] = $freeItem;
                        $oldUnits = $finalData[$freeKey]['units'];
                        $finalData[$freeKey]['units'] = $freeItem;

                        $product = $this->productAndScheme->getProductById($freeKey);
                        $pPrice = $product['price'] * $oldUnits;

                        $finalData['finalTotal'] = $finalData['finalTotal'] + $pPrice;
                    }
                }
            }
        }

        return $finalData;
    }
}