<?php

/**
 * @package Flextype Components
 *
 * @author Sergey Romanenko <awilum@yandex.ru>
 * @link http://components.flextype.org
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Flextype\Component\Curl;

class Curl
{
    /**
     * Default curl options.
     *
     * @var array
     */
    protected static $default_options = array(
        CURLOPT_USERAGENT      => 'Mozilla/5.0 (compatible; Monstra CMS; +http://monstra.org)',
        CURLOPT_RETURNTRANSFER => true
    );

    /**
     * Information about the last transfer.
     *
     * @var array
     */
    protected static $info;

    /**
     * Performs a curl GET request.
     *
     * $res = Curl::get('http://site.com/');
     *
     * @param  string $url     The URL to fetch
     * @param  array  $options An array specifying which options to set and their values
     * @return string
     */
    public static function get(string $url, array $options = null) : string
    {
        // Check if curl is available
        if ( ! function_exists('curl_init')) throw new RuntimeException(vsprintf("%s(): This method requires cURL (http://php.net/curl), it seems like the extension isn't installed.", array(__METHOD__)));

        // Initialize a cURL session
        $handle = curl_init($url);

        // Merge options
        $options = (array) $options + Curl::$default_options;

        // Set multiple options for a cURL transfer
        curl_setopt_array($handle, $options);

        // Perform a cURL session
        $response = curl_exec($handle);

        // Set information regarding a specific transfer
        Curl::$info = curl_getinfo($handle);

        // Close a cURL session
        curl_close($handle);

        // Return response
        return $response;
    }

    /**
     * Performs a curl POST request.
     *
     * $res = Curl::post('http://site.com/login');
     *
     * @param  string  $url       The URL to fetch
     * @param  array   $data      An array with the field name as key and field data as value
     * @param  bool    $multipart True to send data as multipart/form-data and false to send as application/x-www-form-urlencoded
     * @param  array   $options   An array specifying which options to set and their values
     * @return string
     */
    public static function post(string $url, array $data = null, bool $multipart = false, array $options = null) : string
    {
        // Check if curl is available
        if ( ! function_exists('curl_init')) throw new RuntimeException(vsprintf("%s(): This method requires cURL (http://php.net/curl), it seems like the extension isn't installed.", array(__METHOD__)));

        // Initialize a cURL session
        $handle = curl_init($url);

        // Merge options
        $options = (array) $options + Curl::$default_options;

        // Add options
        $options[CURLOPT_POST]       = true;
        $options[CURLOPT_POSTFIELDS] = ($multipart === true) ? (array) $data : http_build_query((array) $data);

        // Set multiple options for a cURL transfer
        curl_setopt_array($handle, $options);

        // Perform a cURL session
        $response = curl_exec($handle);

        // Set information regarding a specific transfer
        Curl::$info = curl_getinfo($handle);

        // Close a cURL session
        curl_close($handle);

        // Return response
        return $response;
    }

    /**
     * Gets information about the last transfer.
     *
     * $res = Curl::getInfo();
     *
     * @param  string $value Array key of the array returned by curl_getinfo()
     * @return mixed
     */
    public static function getInfo($value = null)
    {
        if (empty(Curl::$info)) {
            return false;
        }

        return ($value === null) ? Curl::$info : Curl::$info[$value];
    }

}
