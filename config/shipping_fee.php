<?php
/**
 * Created by PhpStorm.
 * User: Phuong Nguyen
 * Date: 27/09/2019
 * Time: 12:11 PM
 */
return [
    /**
     * Current we only support shipping fee for kg and m3
     * Another unit will be convert to kg and m3
     */
    'default' => [
        'weight_coefficient' => '11'
        , 'dimension_coefficient' => '11'
        , 'min_fee' => '5'
    ],
    'phone' => [
        'weight_coefficient' => '20'
        , 'dimension_coefficient' => '20'
        , 'min_fee' => '50'

    ],
    'jewelry' => [
        'weight_coefficient' => '50'
        , 'dimension_coefficient' => '50'
        , 'min_fee' => '20'

    ], 'furniture' => [
        'weight_coefficient' => '30'
        , 'dimension_coefficient' => '30'
        , 'min_fee' => '20'

    ],

];