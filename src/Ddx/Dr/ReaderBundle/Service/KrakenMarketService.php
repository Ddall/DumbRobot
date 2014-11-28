<?php
namespace Ddx\Dr\ReaderBundle\Service;

/**
 * @author Allan
 */

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Ddx\Dr\ReaderBundle\Market\KrakenApiWrapper;
use Ddx\Dr\ReaderBundle\Service\AbstractMarketService;
use Ddx\Dr\MarketBundle\Entity\TradingPair;
use Ddx\Dr\MarketBundle\Entity\Trade;
use \Exception as Exception;

class KrakenMarketService extends AbstractMarketService{

    /**
     * @var KrakenApiWrapper
     */
    protected $api;

    /**
     * Instance of Kraken
     * @var \Ddx\Dr\MarketBundle\Entity\Market
     */
    protected $_krakenEntity;


    // -- EXPOSED METHODS -- EXPOSED METHODS -- EXPOSED METHODS -- EXPOSED METHODS
    
    /**
     * Call this to update the trade history
     * @return integer Number of new Trades sent to the entityManager
     */
    public function updateTradeHistory($dryrun = false){
        $kraken = $this->getMarketEntity();
        $entities = array();
        
        foreach($kraken->getTradingPairs() as $pair){
            if( $pair->isActive() && $this->api->hasApiCallleft() ){
                // GET THE ID OF THE LAST TRADE IN DB
                $lastTrade = $this->getTradeRepository()->getLastTrade($kraken, $pair); 
                
                if($lastTrade){
                    $lastId = $lastTrade->getRemoteId();
                }else{
                    $lastId = null;
                }
                $pairHistory = $this->readMarketHistory($pair, $lastId);
                
                if(!array_key_exists('result', $pairHistory)){
                    throw new Exception('updateTradeHistory: No results from api. data: ' 
                            . print_r($pairHistory['error'], true));
                }
                $entities = array_merge($entities, $this->rawToTrades($pairHistory['result'][$pair->getRemoteName()], $pair, $pairHistory['result']['last']));
            }
        }
        
        foreach($entities as $e){
            $this->getManager()->persist($e);
        }
        
        if(!$dryrun){
            $this->getManager()->flush();
        }
        
        return count($entities);
    }
    
    /**
     * Use this to update the trading pairs available on Kraken
     * @param boolean $dryrun
     */
    public function updateTradingPairs($dryrun = false){
        $pairsData = $this->api->getTradingPairs();
        $pairsEntities = array();
        $kraken = $this->getMarketEntity();
        
        foreach($pairsData as $name => $pair){
            
            $localPair = $this->getTradingPairRepository()->findOneBy(array(
                'market' => $kraken,
                'remoteName' => $name,
            ));
            
            if($localPair == null){ 
                $pairsEntities[$name] = new TradingPair($kraken, $name, $name);
                $this->getManager()->persist($pairsEntities[$name]);
            }
        }
        
        if(!$dryrun){
            $this->getManager()->flush();
        }else{
            
            foreach($pairsEntities as $e){
                $this->getManager()->refresh($e);
            }
            
        }
        
        return $pairsEntities;
    }
    
    /**
     * @param string $tradingPairName
     * @param boolean $enable
     */
    public function manageTradingPairs(string $tradingPairName, $enable = null){
        
    }
    
        // -- TOOLS -- TOOLS -- TOOLS -- TOOLS -- TOOLS -- TOOLS -- TOOLS -- TOOLS
    
    /**
     * Returns the history of a certain market (defined by the tradingpairs)
     * @todo handle errors
     * @param TradingPair $pair
     * @param string $lastId id of the last trade
     * @return array|null
     */
    protected function readMarketHistory(TradingPair $pair, $lastId){
        if(!$this->api->hasApiCallleft()){
            throw new Exception('API CALLS EXECEEDED');
        }
        
        if($pair->isActive()){
            return $this->api->getTradeHistory($pair, $lastId);
        }
        
        return null;
    }
    /**
     * Converts a TWO DIMENSIONNAL ARRAY of API results to an array of Trade entities
     * @param array $rawTrades
     * @param TradingPair $tradingPair
     * @param string $lastId
     * @return array
     */
    private function rawToTrades($rawTrades, TradingPair $tradingPair, $lastId){
        $remoteId = null;
        $output = array();
        
//        file_put_contents('rawTrades', print_r($rawTrades, true));
        
        $len = count($rawTrades) - 1;
        $i = 0;
        foreach($rawTrades as $line){
            if($i == $len){
                $remoteId = $lastId;
            }
            $output[] = $this->rawToTrade($line, $tradingPair, $remoteId);
            $i++;
        }
        
        return $output;
    }

    /**
     * Converts an array from the Api to a Trade entity
     * @param array $rawTrade
     * @param TradingPair $tradingPair
     * @param string $remoteId
     * @return Trade
     */
    private function rawToTrade($rawTrade, TradingPair $tradingPair, $remoteId = null){
    
        $trade = new Trade();
        
        if($rawTrade[3] == 'b'){
            $direction = 'BUY';
        }else{
            $direction = 'SELL';
        }
        
        if($rawTrade[4] == 'l'){
            $orderType = 'LIMIT';
        }else{
            $orderType = 'MARKET';
        }
        
        $trade->setMarket($this->getMarketEntity())
                ->setTradingPair($tradingPair)
                ->setPrice($rawTrade[0])
                ->setVolume($rawTrade[1])
                ->setTimeRemoteFromTimestamp($rawTrade[2])
                ->setDirection($direction)
                ->setOrderType($orderType)
                ->setRemoteId($remoteId)
                ;
        
        return $trade;
    }
    
    /**
     * __ctor
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        parent::__construct($container);
        
        $this->setApi( new KrakenApiWrapper($container) );
    }
      
    /**
     * @param KrakenApiWrapper $api
     */
    public function setApi(KrakenApiWrapper $api) {
        $this->api = $api;
    }
    
    
    /**
     * @throws Exception
     * @return \Ddx\Dr\MarketBundle\Entity\Market Instance of Kraken Entity
     */
    protected function getMarketEntity(){
        if($this->_krakenEntity == null){
            $this->_krakenEntity =  $this->container->get('doctrine')->getManager()->getRepository('DdxDrMarketBundle:Market')->findOneByName('Kraken');
            if(!$this->_krakenEntity){
                throw new Exception('KrakenMarketService: Market entity was not found');
            }
        }
        
        return $this->_krakenEntity ;
    }
    

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getManager(){
        return $this->container->get('doctrine')->getManager();
    }

}
