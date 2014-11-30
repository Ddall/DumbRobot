<?php
/**
 *
 * @author Allan
 */
namespace Ddx\Dr\ReaderBundle\Market;

use Payward\KrakenAPI;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Ddx\Dr\MarketBundle\Entity\TradingPair;
use \Exception;

class KrakenApiWrapper extends AbstractMarket{


    /**
     * @var KrakenAPI 
     */
    protected $api;
    
    /**
     * @var ContainerInterface 
     */
    protected $container;

    /**
     * __ctor
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        parent::__construct($container);
        $params = $this->getParameters();
        
        $this->api = new KrakenAPI(
                $params['api_key'],
                $params['secret'],
                $params['api_url'],
                $params['api_version'],
                $params['ssl_verify']
            );
    }

    /**
     * Returns the servers current time in DateTime format
     * @throws \Exception
     * @return \DateTime
     */
    public function getCurrentTime() {
        $result = $this->publicQueryHelper('Time');
        
        return new \DateTime($result['rfc1123']);
    }

    
    /**
     * Returns the current trading pairs available on Kraken.
     * Response structure
     * array[_PAIR_NAME_](
     *      [_INFOS_]
     * )
     * @throws Exception
     * @return array|null
     */
    public function getTradingPairs() {
        return $this->publicQueryHelper('AssetPairs');
    }

    /**
     * @return array
     */
    public function getAvailableAssets(){
        return $this->publicQueryHelper('Assets');
    }
    
    
    /**
     * @param TradingPair $tradingPair
     * @param string $since
     * @return array
     */
    public function getTradeHistory(TradingPair $tradingPair = null, $since = null){
        $request = array();
        
        if($tradingPair && $tradingPair->isActive() ){
            $request['pair'] = (string)$tradingPair->getRemoteName();
        }else{
            $request['pair'] = '';
        }
        
        if($since){
            $request['since'] = $since;
        }

        return $this->api->QueryPublic('Trades', $request);
    }
    
    /**
     * OUTPUTS
     * <pair_name> = pair name
     *   asks = ask side array of array entries(<price>, <volume>, <timestamp>)
     *   bids = bid side array of array entries(<price>, <volume>, <timestamp>)
     * @param TradingPair $pair 
     * @param integer $limit (optionnal) limit
     * @return arrray() 
     */
    public function getOrderBook(TradingPair $pair, integer $limit = NULL){
        $request = array(
            'pair' => (string)$pair->getRemoteName()
        );
        
        if($limit !== NULL){
            $request['count'] = (integer)$limit;
        }
            
        return $this->api->QueryPublic('Depth', $request);
    }
    /**
     * TOOLS
     */
    
    /**
     * Helper for public queries
     * @param string $request
     * @return array
     * @throws Exception
     */
    private function publicQueryHelper($request){
        $tmp = $this->api->QueryPublic($request);
        
        if(count($tmp['error'])){
            throw new Exception(print_r($tmp['error'], true));
        }
        
        return $tmp['result'];
    }
    
    // HANDLE API LIMITATIONS
    public function getApiCurrentScore(){
        return 'NOT IMPLEMENTED';
    }
    
    /**
     * Checks if API has at least two hits left
     * @todo IMPLEMENT THIS
     * @return boolean
     */
    public function hasApiCallsLeft(){
        return true;
    }
    
    /**
     * Adds $count number of points to the api score counter.
     * Exception is thrown if no score more points are available
     * @param type $count
     * @return string
     * @throws Exception
     */
    public function addApiCall($count = 1){
        if( ($this->getApiCurrentScore() + $count ) > $this->getApiMaxScore() ){
            throw new Exception('API_LIMIT_EXCEEDED');
        }
        
        return 'NOT_IMPLEMENTED';
    }

    /**
     * Returns the point limit on the API
     * Exceeding this threshold WILL result in a 15min ban from the api
     * @return string
     */
    static function getApiMaxScore(){
        return '10';
    }
    
    // PARAMETERS
    /**
     * Reads the global parameters.yml
     * @return array
     * @throws Exception
     */
    private function getParameters(){
        $params = $this->readParameter('kraken');
        
        if(!$params && is_array($params) && array_key_exists('enable', $params) && $params['enable'] == true ){
            throw new Exception('KRAKEN IS NOT ENABLED');
        }
        
        if(!array_key_exists('api_key', $params) || empty($params['api_key'])){
            $params['api_key'] = null;
        }
        
        if(!array_key_exists('secret', $params) || empty($params['secret'])){
            $params['secret'] = null;
        }
        
        if(!array_key_exists('api_url', $params) || empty($params['api_url'])){
            $params['api_url'] = 'https://api.kraken.com';
        }
        
        if(!array_key_exists('api_version', $params) || empty($params['api_version'])){
            $params['api_version'] = 0;
        }
        
        if(!array_key_exists('ssl_verify', $params) || empty($params['ssl_verify'])){
            $params['ssl_verify'] = FALSE;
        }
        
        return $params;
    }
}
