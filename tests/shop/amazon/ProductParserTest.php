<?php
/**
 * Created by PhpStorm.
 * User: Phuong Nguyen
 * Date: 26/09/2019
 * Time: 2:26 PM
 */

use App\Shops\Amazon\ProductParser;
use PHPUnit\Framework\TestCase;

class ProductParserTest extends TestCase
{
    public function testCanGetDetail(): void
    {
        //Call curl request to shop
        $html = get_shop_html('https://www.amazon.com/dp/B077KCCFSL/ref=dp_cr_wdg_tit_rfb');
        //Get product attributes

        $this->assertInstanceOf(
            ProductParser::class,$parser = new ProductParser($html)
        );
        $attributes = $parser->getAttributes();
        $productType = $parser->getProductType();
        $price = $parser->getProductPrice();
        $this->assertNotNull(
            $price
        );
        $this->assertNotNull(
            $attributes
        );
        $this->assertNotNull(
            $productType
        );
    }
}