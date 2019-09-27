<?php
/**
 * Created by PhpStorm.
 * User: Phuong Nguyen
 * Date: 26/09/2019
 * Time: 2:26 PM
 */

namespace App\Shops\Amazon;



use App\Interfaces\ShopService;

class Service implements ShopService
{
    /**
     * @param $url
     * @return array
     */
    public function getProductDetail($url)
    {
        //Call curl request to shop
        $html = get_shop_html($url);
        //Get product attributes
        $parser = new ProductParser($html);
        $attributes = $parser->getAttributes();
        $productType = $parser->getProductType();
        //Calculate shipping fee
        $shippingFee = new ShippingFee($attributes, $productType);
        return [
            'name' => $parser->getProductName()
            , 'price' => $parser->getProductPrice()
            , 'type' => $productType
            , 'attributes' => $attributes
            , 'shipping_fee' => $shippingFee->getPrice()
        ];
    }
}