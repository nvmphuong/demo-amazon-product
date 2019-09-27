<?php
/**
 * Created by PhpStorm.
 * User: Phuong Nguyen
 * Date: 27/09/2019
 * Time: 3:43 PM
 */

declare(strict_types=1);
use App\ShopGateway;
use PHPUnit\Framework\TestCase;

class ShopGatewayTest extends TestCase
{
    public function testCanBeCreatedFromValidArray(): void
    {
        $this->assertInstanceOf(
            ShopGateway::class,
            new ShopGateway([])
        );
    }
    public function testGetShopDomain(): void
    {
        $gateWay =  new ShopGateway([]);
        $this->assertEquals(
            'www.amazon.com',
            $gateWay->getShopDomain('https://www.amazon.com/dp/B077KCCFSL/ref=dp_cr_wdg_tit_rfb')
        );
        $this->assertEquals(
            'www.ebay.com',
            $gateWay->getShopDomain('https://www.ebay.com/itm/Casio-Standard-Digital-Vintage-Series-Watch-A168WEGB-1B/222527855039?_trkparms=pageci%3A53b0c305-e105-11e9-bb8d-74dbd180a863%7Cparentrq%3A71f3b72916d0a4b7fcd8c589ff79fdd4%7Ciid%3A1')
        );
    }
    public function testGetShopService(): void
    {
        $gateWay =  new ShopGateway(config('shop'));
        $this->assertInstanceOf(
            \App\Shops\Amazon\Service::class,
            $gateWay->getShopService('https://www.amazon.com/dp/B077KCCFSL/ref=dp_cr_wdg_tit_rfb')
        );
        $this->assertEquals(
            null,
            $gateWay->getShopService('https://www.ebay.com/itm/Casio-Standard-Digital-Vintage-Series-Watch-A168WEGB-1B/222527855039?_trkparms=pageci%3A53b0c305-e105-11e9-bb8d-74dbd180a863%7Cparentrq%3A71f3b72916d0a4b7fcd8c589ff79fdd4%7Ciid%3A1')
        );
    }
}