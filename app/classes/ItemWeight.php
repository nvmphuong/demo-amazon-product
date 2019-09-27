<?php

namespace App\Classes;
/**
 * Created by PhpStorm.
 * User: Phuong Nguyen
 * Date: 27/09/2019
 * Time: 10:49 AM
 */
class ItemWeight
{
    protected $value;
    protected $unit;
    const POUNDS_TO_KG = 0.45359237;
    const OUNCES_TO_KG = 0.0283495231;

    public function __construct($value, $unit)
    {
        $this->value = (float)$value;
        $this->unit = trim((string)$unit);
    }

    public function getKg()
    {
        if ($this->unit == 'pounds') {
            return $this->value * self::POUNDS_TO_KG;
        }
        if ($this->unit == 'ounces') {
            return $this->value * self::OUNCES_TO_KG;
        }
        return $this->value;

    }
}