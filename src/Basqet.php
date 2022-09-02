<?php
declare(strict_types=1);
namespace Basqet;

require __DIR__ .'/../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;


class Basqet  {
    
    protected static String $secretKey;
    protected static String $publicKey;
    protected static String $currency;
    protected static String $data;
    protected static String $transactionid; 
    protected static String $currencyid;     
    protected static String $base_url = "https://api.basqet.com/v1";
    public function __construct($secretKey, $publicKey)
    {

        self::$publicKey = $publicKey;
        self::$secretKey = $secretKey;
    }

    /**
     * Fetch Available currency
     * @param {string} currenyType - 'FIAT' | 'CRYPTO'
     * @returns {JSON} The response
     */

    public static function fetchAllCurrency(String $currency){
        try {
            self::$currency = $currency;
            $response = (new Client())->request('GET', self::$base_url.'/currency?type='.self::$currency, [
                'headers' => self::setHeader(),
            ]);              
              
            return $response->getBody();
              
        } catch (BadResponseException $th) {
            throw $th;
        }
    }

    /**
     * Initialize transaction
     * @param  [[customer=>[name: string, email: string] , amount=> int, curreny=> string, meta=> array]] data 
     * @returns {JSON} The response
     */

     public static function initializeTransaction(array $data){
        try {
            
            self::$data = json_encode($data);
            
            $response = (new Client())->request('POST', 'https://api.basqet.com/v1/transaction', [
            'body' => self::$data,
            'headers' => self::setHeader(),
            ]);

             return $response->getBody();
              
        } catch (BadResponseException $th) {
            throw $th;
        }
     }


    /**
     * Initiate transaction
     * @param string transactionId 
     * @param  array [currency_id=> string ]
     * @returns {JSON} The response
     */

     public static function initiateTransaction(String $transactionid, array $data){
        try {
            
            self::$transactionid = $transactionid; 
            self::$data = json_encode($data); 

            $response = (new Client())->request('POST', self::$base_url.'/transaction/'.self::$transactionid.'/pay', [
                'body' => self::$data,
                'headers' => self::setHeader(),
              ]);
              
              
            return $response->getBody();
              
        } catch (BadResponseException $th) {
            return $th->getMessage();
        }
     }


    /**
     * Verify transaction
     * @param string transactionId 
     * @returns {JSON} The response
     */

    public static function verifyTransaction(String $transactionid){
        try {
            
            self::$transactionid = $transactionid; 

            $response = (new Client())->request('GET', self::$base_url.'/transaction/'.self::$transactionid.'/status', [
                'headers' => self::setHeader(),
              ]);              
              
            return $response->getBody();
              
        } catch (BadResponseException $th) {
            throw $th;
        }
     }


    /**
     * Mock webhook events
     * @param {string} transactionId 
     * @param {{ status: string }} data 
     * @returns {Promise<any | undefined>} The response
     */
    public static function triggerWebhook(String $transactionid, array $data){
        try {
            
            self::$transactionid = $transactionid; 
            self::$data = json_encode($data); 

            $response = (new Client())->request('POST', self::$base_url.'/transaction/'.self::$transactionid.'/trigger', [
                'body' => self::$data,
                'headers' => self::setHeader(),
              ]);              
              
            return $response->getBody();
              
        } catch (BadResponseException $th) {
            throw $th;
        }
     }



     protected static function setHeader(){

        return [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.self::$publicKey,
            'Content-Type' => 'application/json',
            ];
     }


     public static function getBody():string{
        return file_get_contents('php://input');
     }
}