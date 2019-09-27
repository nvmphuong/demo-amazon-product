<?php
/**
 * Created by PhpStorm.
 * User: Phuong Nguyen
 * Date: 26/09/2019
 * Time: 2:26 PM
 */

use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    public function testCanGetDetail(): void
    {
        $service  = new \App\Shops\Amazon\Service();
        $detail =$service->getProductDetail('https://www.amazon.com/dp/B077KCCFSL/ref=dp_cr_wdg_tit_rfb');
        $this->assertArrayHasKey(
            'name',
            $detail
        );
        $this->assertArrayHasKey(
            'price',
            $detail
        );
        $this->assertArrayHasKey(
            'attributes',
            $detail
        );
        $this->assertArrayHasKey(
            'shipping_fee',
            $detail
        );
    }
}