<?php
namespace Ddx\Dr\ReaderBundle\Service;

/**
 * AbstractDdxHelper
 * @author Allan
 */

use Ddx\Dr\MarketBundle\Service\TradeService;
use Ddx\Dr\MarketBundle\Service\TradingPairService;
use Ddx\Dr\ReaderBundle\Service\KrakenMarketService;

abstract class AbstractDdxHelper{

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;
    
    /**
     * @param EntityManagerInterface $entityManager
     * @return \Ddx\Dr\ReaderBundle\Service\AbstractDdxDrService
     */
    protected function setEntityManager($entityManager){
        $this->entityManager = $entityManager;
        return $this;
    }
    
    /**
     * @return \Doctrine\ORM\EntityManagerInterface
     */
    public function getEntityManager(){
        return $this->entityManager;
    }
    
    /**
     * Shortcut for getEntityManager
     * @return EntityManagerInterface
     */
    public function getManager(){
        return $this->getEntityManager();
    }

    /**
     * @var TradeService
     */
    protected $tradeService;

    /**
     * @param TradeService $tradeService
     * @return \Ddx\Dr\ReaderBundle\Service\AbstractDdxDrService
     */
    protected function setTradeService(TradeService $tradeService){
        $this->tradeService = $tradeService;
        return $this;
    }
    
    /**
     * @return TradeService
     */
    public function getTradeService(){
        return $this->tradeService;
    }

    /**
     * @var TradingPairService
     */
    protected $tradingPairService;
    
    /**
     * @param TradingPairService $tradingPairService
     * @return \Ddx\Dr\ReaderBundle\Service\AbstractDdxDrService
     */
    protected function setTradingPairService(TradingPairService $tradingPairService){
        $this->tradingPairService = $tradingPairService;
        return $this;
    }
    
    /**
     * @return TradingPairService
     */
    public function getTradingPairService(){
        return $this->tradingPairService;
    }
    
    /**
     * @var KrakenMarketService
     */
    protected $krakenMarketService;
    
    /**
     * @param KrakenMarketService $krakenMarketService
     * @return \Ddx\Dr\ReaderBundle\Service\AbstractDdxDrService
     */
    protected function setKrakenMarketService(KrakenMarketService $krakenMarketService){
        $this->krakenMarketService = $krakenMarketService;
        return $this;
    }

    /**
     * @return KrakenMarketService
     */
    public function getKrakenMarketService(){
        return $this->krakenMarketService;
    }
    
}
