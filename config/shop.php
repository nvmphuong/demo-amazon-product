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
    'www.amazon.com' => \App\Shops\Amazon\Service::class
    , 'amazon.com' => \App\Shops\Amazon\Service::class

];