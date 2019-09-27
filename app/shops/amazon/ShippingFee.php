<?php
/**
 * Created by PhpStorm.
 * User: Phuong Nguyen
 * Date: 27/09/2019
 * Time: 10:19 AM
 */

namespace App\Shops\Amazon;


use App\Classes\ItemDimension;
use App\Classes\ItemWeight;

class ShippingFee
{
    protected $config;
    protected $productType;
    protected $attributes;

    /**
     * ShippingFee constructor.
     * @param $attributes
     * @param $productType
     */
    public function __construct($attributes, $productType)
    {
        $this->attributes = $attributes;
        //Load fee config by product type
        $this->config = config('shipping_fee.' . $productType, config('shipping_fee.default'));
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        $weightFee = $this->calculateWeightFee();
        $dimensionFee = $this->calculateDimensionFee();
        //Find max feee
        return max($weightFee, $dimensionFee, $this->config['min_fee']);
    }

    /**
     * @return float|int
     */
    protected function calculateWeightFee()
    {
        //I select Shipping Weight is highest priority
        $weight = $this->attributes['Shipping Weight']??$this->attributes['Item Weight']??0;
        if (!$weight) {
            return 0;
        }
        //Regex for get weight value and unit
        preg_match_all('#(.+) (.+)#is', $weight, $weightMatch, PREG_SET_ORDER);
        //Init ItemWeight object will help calculate
        $itemWeight = new ItemWeight($weightMatch[0][1], $weightMatch[0][2]);
        return $itemWeight->getKg() * $this->config['weight_coefficient'];
    }

    /**
     * @return float|int
     */
    protected function calculateDimensionFee()
    {
        //I select Package Dimensions is highest priority

        $dimension = $this->attributes['Package Dimensions']??$this->attributes['Item Dimensions  L x W x H']??$this->attributes['Product Dimensions']??0;
        if (!$dimension) {
            return 0;
        }
        //Regex for get dimension value and unit
        preg_match_all('#(.+) x (.+) x (.+) (.+)#is', $dimension, $dimensionMatch, PREG_SET_ORDER);
        //Create ItemDimension will helpful for calculating
        $itemWeight = new ItemDimension($dimensionMatch[0][1], $dimensionMatch[0][2], $dimensionMatch[0][3], $dimensionMatch[0][4]);

        return $itemWeight->getM3Volume() * $this->config['dimension_coefficient'];
    }
}