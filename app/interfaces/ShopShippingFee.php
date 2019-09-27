<?php
/**
 * Created by PhpStorm.
 * User: Phuong Nguyen
 * Date: 27/09/2019
 * Time: 12:04 PM
 */

namespace App\Interfaces;


interface ShopShippingFee
{
    function __construct($attributes, $productType);

    function getPrice();

    function calculateWeightFee();

    function calculateDimensionFee();
}