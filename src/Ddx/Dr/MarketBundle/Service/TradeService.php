<?php
namespace Ddx\Dr\MarketBundle\Service;
/**
 * @author Allan
 */

use Ddx\Dr\ReaderBundle\Service\AbstractDdxDrService;

use Doctrine\ORM\EntityManagerInterface;
use Ddx\Dr\MarketBundle\Entity\Market;
use Ddx\Dr\MarketBundle\Entity\TradingPair;

use \Exception as Exception;

class TradeService extends AbstractDdxDrService {
    
    /**
     * @param EntityManagerInterface $entityManager
     * @return \Ddx\Dr\MarketBundle\Service\TradeService
     */
    public function __construct(EntityManagerInterface $entityManager) {
        $this->setEntityManager($entityManager);
        return $this;
    }

    /**
     * Returns trades for a Market and a TradingPair
     * @param Market $market
     * @param TradingPair $pair
     * @return array
     */
    public function getTrades(Market $market, TradingPair $pair){
        $trades = $this->getTradeRepository()->findBy(array(
            'market' => $market->getId(),
            'tradingPair' => $pair->getId(),
        ));
        
        if(!$trades){
            throw new Exception('NO TRADES FOUND');
        }
        
        return $trades;
    }
    
    /**
     * @param Market $market
     * @param TradingPair $pair
     * @param integer $interval
     * @return array
     */
    public function getAvgTrades(Market $market, TradingPair $pair, $interval = 300){
        $trades = $this->getTradeRepository()->getWeightedData($market, $pair, $interval);
        return $trades;
    }
    
    /**
     * Enriche
     * @param Market $market
     * @param TradingPair $pair
     */
    public function computeTrades(Market $market, TradingPair $pair){
        $trades = $this->getAvgTrades($market, $pair, 3600);
        $priceOnly = array();
        
        foreach($trades as $key => $trade){
            $priceOnly[$key] = $trade['vwap'];
        }
        
        $fuse = trader_wma($priceOnly, 24*3);
        
        foreach($fuse as $key => $value){
            $trade[$key]['vwap_3d'] = $value;
        }
        
        return $fuse;
    }
}
