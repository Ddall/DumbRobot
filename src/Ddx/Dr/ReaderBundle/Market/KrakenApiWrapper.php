<?php
/**
 *
 * @author Allan
 */
namespace Ddx\Dr\ReaderBundle\Market;

use Payward\KrakenAPI;
use Symfony\Component\DependencyInjection\ContainerInterface;
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
     * @todo Add dependency injection to get api params
     */
    public function __construct(ContainerInterface $container) {
        parent::__construct($container);
        $this->api = new KrakenAPI(null, null);
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
        return $this->publicQueryHelper('AssetPairslol');
    }

    /**
     * @return array
     */
    public function getAvailableAssets(){
        return $this->publicQueryHelper('Assets');
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
    
}
