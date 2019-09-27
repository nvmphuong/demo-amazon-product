<?php
global $config;
/**
 * Init global config value
 */
foreach (glob(__DIR__ . '/../config/*.php') as $configFile) {
    $path_parts = pathinfo($configFile);
    $config[$path_parts['filename']] = include $configFile;
}
/**
 * Helper for get config value
 *
 * @param $name
 * @param null $default
 * @return null
 */
function config($name, $default = null)
{
    global $config;
    if (!$name) {
        return $default;
    }
    if (isset($config[$name])) {
        return $config[$name];
    }
    $keys = explode('.', $name);
    if (!isset($config[$keys[0]])) {
        return $default;
    }
    $result = $config[$keys[0]];
    array_shift($keys);
    $mainConfigKey = implode('.', $keys);
    if (isset($result[$mainConfigKey])) {
        return $result[$mainConfigKey];
    }
    foreach ($keys as $key) {
        if (!isset($result[$key])) {
            return $default;
        }
        $result = $result[$key];
    }
    return $result;
}

/**
 * Custom curl request
 *
 * @param $url
 * @param string $ref
 * @return mixed
 */
function get_shop_html($url, $ref = '')
{
    $user_agent = "Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Mobile Safari/537.36";
// pull down the content that the url pointing to
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_VERBOSE, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_AUTOREFERER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($curl, CURLOPT_REFERER, $ref);
    $cookie = __DIR__ . '/../cookie.txt';
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($curl, CURLOPT_FAILONERROR, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_ENCODING, '');
    $content = curl_exec($curl);
    curl_close($curl);
    return $content;
}