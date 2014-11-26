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

    
    public function updateTradeHistory(){
        $kraken = $this->getMarketEntity();
        $trades = array();
        
        foreach($kraken->getTradingPairs() as $pair){
            if( $pair->isActive() && $this->api->hasApiCallleft() ){
                $lastId = $this->getTradingPairRepository()->getLastTrade($kraken, $pair)->getRemoteName();
                
                $pairHistory= $this->readMarketHistory($pair, $lastId);
                $trades = 
                
            }
        }
        
        foreach($history as $key => $tdata){
            $trade = new Trade();
            $trade->setMarket($kraken);
            $trade->setTradingPair($tradingPair);
            $trades[$key] = $trade;
        }
        
        $this->getManager()->flush();
    }
    
    /**
     * Returns the history of a certain market (defined by the tradingpairs)
     * @param TradingPair $pair
     * @param string $lastId id of the last trade
     * @return array
     */
    public function readMarketHistory(TradingPair $pair, $lastId){
        if(!$this->api->hasApiCallleft()){
            throw new Exception('API CALLS EXECEEDED');
        }
        
        $output = array();
        if($pair->isActive()){
            $output[] = $this->api->getTradeHistory($pair, $lastId);
        }
        
        return $output;
    }
    
    /**
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
            
            if($localPair != null){ 
                //DO NOTHING: MARKET PPL DONT CHANGE THEIR MINDS ON NAMING STUFF
            }else{
                $pairsEntities[$name] = new TradingPair($kraken, $name, $name);
                $this->getManager()->persist($pairsEntities[$name]);
            }
            
        }
        
        if(!$dryrun){
            $this->getManager()->flush();
        }
    }
    
    /**
     * @param TradingPair $tradingPair
     * @param array $history
     * @return array
     */
    private function historyToTrades(TradingPair $tradingPair, array $history){
        $trades = array(); 
        $krakenMarket = $this->getMarketEntity();
        foreach($history as $data){
            $tmp = new Trade();
            $tmp
                    ->setMarket($krakenMarket)
                    ->setTradingPair($tradingPair)
                    ->setVolume($data['volume'])
                    ->setPrice($data['price'])
                    ->setOrderType($data)
                    ;
            
        }
         
    }
    
    // -- TOOLS
    /**
     * @throws Exception
     * @return \Ddx\Dr\MarketBundle\Entity\Market Instance of Kraken Entity
     */
    protected function getMarketEntity(){
        $kraken =  $this->container->get('doctrine')->getManager()->getRepository('DdxDrMarketBundle:Market')->findOneByName('Kraken');
        if(!$kraken){
            throw new Exception('KrakenMarketService: Market entity was not found');
        }
        
        return $kraken;
    }
    

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getManager(){
        return $this->container->get('doctrine')->getManager();
    }

}
