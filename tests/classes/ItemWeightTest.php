<?php
/**
 * Created by PhpStorm.
 * User: Phuong Nguyen
 * Date: 27/09/2019
 * Time: 3:43 PM
 */

declare(strict_types=1);
use App\Classes\ItemWeight;
use PHPUnit\Framework\TestCase;

class ItemWeightTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(
            ItemWeight::class,
            new ItemWeight(1,  'pounds')
        );
    }
    public function testCanGetgetKg(): void
    {
        $itemWeight = new ItemWeight(1,  'pounds');

        $this->assertEquals(
            0.45359237,
            $itemWeight->getKg()
        );
        $itemWeight = new ItemWeight(1,  'ounces');

        $this->assertEquals(
            0.0283495231,
            $itemWeight->getKg()
        );
    }

}