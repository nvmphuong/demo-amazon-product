<?php
/**
 * Created by PhpStorm.
 * User: Phuong Nguyen
 * Date: 26/09/2019
 * Time: 2:57 PM
 */

namespace App\Shops\Amazon;


use App\Interfaces\ShopProductParser;

class ProductParser implements ShopProductParser
{

    /**
     * @var string
     */
    protected $html;

    /**
     * ProductParser constructor.
     * @param $html
     */
    public function __construct($html)
    {
        $this->html = $html;
    }

    /**
     * @return string
     */
    public function getProductType()
    {
        $types = ['phone','jewelry','furniture'];
        return $types[array_rand($types)];
    }

    /**
     * @return string
     */
    public function getProductName()
    {
        preg_match_all('#<span id="title" class="a-size-small">(.+?)</span>#is', $this->html, $titleMatch, PREG_SET_ORDER);
        if (!count($titleMatch)) {
            return '';
        }
        return trim($titleMatch[0][1]);
    }
    /**
     * @return string
     */
    public function getProductPrice()
    {
        preg_match_all('#<span class="price-large">(.+?)</span>.+?<span class="a-size-small price-info-superscript">(.+?)</span>#is', $this->html, $priceMatch, PREG_SET_ORDER);
        //Maybe can find price in another element
        if (!count($priceMatch)) {
            preg_match_all('#<span class="priceBlockDealPriceString">\$(\d+?)\.(\d+?)</span>#is', $this->html, $priceMatch, PREG_SET_ORDER);
        }
        //Maybe can find price in another element
        if (!count($priceMatch)) {
            preg_match_all('#<span id="priceblock_ourprice" class="a-size-medium a-color-price priceBlockBuyingPriceString">.+?\$(\d+?)\.(\d+?).+?</span>#is', $this->html, $priceMatch, PREG_SET_ORDER);
        }
        //Maybe can find price in another element
        if (!count($priceMatch)) {
            preg_match_all('#<span id="priceblock_ourprice" class="a-size-medium a-color-price priceBlockBuyingPriceString">.+?\$(\d+?)\.(\d+?).+?</span>#is', $this->html, $priceMatch, PREG_SET_ORDER);
        }
        if (!count($priceMatch)) {
            return 0;
        }
        $price = trim(str_replace(['.', ',', '$'], '', $priceMatch[0][1]));
        if ($priceMatch[0][2]) {
            $subPrice = trim($priceMatch[0][2]);
            $price .= '.' . $subPrice;
        }
        return $price;
    }

    /**
     * Get product attribute in some case
     *
     * @return array
     */
    public function getAttributes()
    {
        preg_match_all('#<th class="a-span3 prodDetSectionEntry">(.+?)</th>.+?<td class="a-span9 a-align-center prodDetSectionEntry">(.+?)</td>#is', $this->html, $attributeMatchs, PREG_SET_ORDER);
        //Maybe have many regex for get product attribute
        preg_match_all('#<span class="a-text-bold">([^/<>]+):</span>[^\/<>]?<span>[^\/<>]?<span class="a-letter-space">[^\/<>]?</span>([^\/<>]+)</span>#is', $this->html, $additionalAtributeMatchs, PREG_SET_ORDER);
        //Combine all attributes together
        $attributeMatchs = array_merge($attributeMatchs, $additionalAtributeMatchs);
        $result = [];
        foreach ($attributeMatchs as $attributeMatch) {
            $result[trim($attributeMatch[1])] = trim($attributeMatch[2]);
        }
        return $result;
    }
}