<?php
/**
 * Created by PhpStorm.
 * User: Phuong Nguyen
 * Date: 27/09/2019
 * Time: 10:49 AM
 */

namespace App\Classes;

class ItemDimension
{
    /**
     * @var float
     */
    protected $length;
    /**
     * @var float
     */
    protected $width;
    /**
     * @var float
     */
    protected $height;
    /**
     * @var string
     */
    protected $unit;

    const INCHES_TO_M3 = 0.000016387064000196646;

    /**
     * ItemDimension constructor.
     * @param $length
     * @param $width
     * @param $height
     * @param $unit
     */
    public function __construct($length, $width, $height, $unit)
    {
        $this->length = (float)$length;
        $this->width = (float)$width;
        $this->height = (float)$height;
        $this->unit = trim((string)$unit);
    }

    /**
     * Get item volume in m3
     *
     * @return float
     */
    public function getM3Volume()
    {
        $volume = $this->getVolume();
        if ($this->unit == 'inches') {
            return $volume * self::INCHES_TO_M3;
        }
        return $volume;

    }

    /**
     * Get item volume
     *
     * @return float
     */
    public function getVolume()
    {
        return $this->length * $this->width * $this->height;

    }
}