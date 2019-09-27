<?php
/**
 * Created by PhpStorm.
 * User: Phuong Nguyen
 * Date: 27/09/2019
 * Time: 3:43 PM
 */

declare(strict_types=1);
use App\Classes\ItemDimension;
use PHPUnit\Framework\TestCase;

class ItemDimensionTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(
            ItemDimension::class,
            new ItemDimension(1, 1, 1,  'inches')
        );
    }
    public function testCanGetVolume(): void
    {
        $itemDimension =  new ItemDimension(1, 1, 1, 'inches');

        $this->assertEquals(
            1,
            $itemDimension->getVolume()
        );
    }
    public function testCanConvertVolume(): void
    {
        $itemDimension =  new ItemDimension(1, 1, 1, 'inches');

        $this->assertEquals(
            0.000016387064000196646,
            $itemDimension->getM3Volume()
        );
    }

}