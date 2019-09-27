<?php
/**
 * Created by PhpStorm.
 * User: Phuong Nguyen
 * Date: 26/09/2019
 * Time: 2:27 PM
 */

namespace App;

class ShopGateway
{
    //Config for mapping shop service
    protected $shopConfig;

    /**
     * ShopGateway constructor.
     * @param $shopConfig
     */
    public function __construct(Array $shopConfig)
    {
        $this->shopConfig = $shopConfig;
    }

    /**
     * Get shop domain by user url
     *
     * @param $url
     * @return string | null
     */
    public function getShopDomain($url)
    {
        //regex for get domain name
        preg_match('#://([^\/]+)#is', $url, $match);
        if (count($match) == 2) {
            return $match[1];
        }
        return null;
    }

    /**
     * Dynamic get shop service for frontend
     *
     * @param $url
     * @return null
     */
    public function getShopService($url)
    {
        $shopDomain = $this->getShopDomain($url);
        if(!$shopDomain){
            return null;
        }

        if(!isset($this->shopConfig[$shopDomain])){
            return null;
        }
        $shopService =  $this->shopConfig[$shopDomain];
        return new $shopService;
    }
}