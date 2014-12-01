<?php
namespace Ddx\Dr\MarketBundle\Service;
/**
 * @author Allan
 */

use Ddx\Dr\ReaderBundle\Service\AbstractDdxDrService;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Ddx\Dr\MarketBundle\Entity\Market;
use Ddx\Dr\MarketBundle\Entity\TradingPair;

use \Exception as Exception;

class TradeService extends AbstractDdxDrService {
    
    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        parent::setContainer($container);
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
    
}
