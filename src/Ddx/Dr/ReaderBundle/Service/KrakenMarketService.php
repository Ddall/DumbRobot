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
        // find the latest trade 
        
//        $trades = 
    }
    
    
    public function updateTradingPairs(){
        $pairsData = $this->api->getTradingPairs();
        $pairsEntities = array();
        $kraken = $this->getMarketEntity();
        
        foreach($pairsData as $name => $pair){
            
            $localPair = $this->getTradingPairRepository()->findOneBy(array(
                'market' => $kraken,
                'remoteName' => $name,
            ));
            
            if($localPair != null){ 
                
                
                
            }else{
                $pairsEntities[$name] = new TradingPair($kraken, $name, $name);
                $this->getManager($pairsEntities[$name]);
            }
            
        }
        
        
    }
    
    /**
     * @return \Ddx\Dr\MarketBundle\Entity\Market Instance of Kraken Entity
     */
    private function getMarketEntity(){
        return $this->getDoctrine()->getManager()->getRepository('DdxDrMarketBundle:Market')->findOneByName('Kraken');
    }
    

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getManager(){
        return $this->getDoctrine()->getManager();
    }

}
