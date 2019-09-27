<?php
/**
 * Created by PhpStorm.
 * User: Phuong Nguyen
 * Date: 27/09/2019
 * Time: 12:04 PM
 */

namespace App\Interfaces;


interface ShopProductParser
{

    public function __construct($html);

    public function getProductType();

    public function getProductPrice();

    public function getAttributes();
}