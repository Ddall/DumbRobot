<?php
namespace Ddx\Dr\ReaderBundle\Service;

/**
 * @author Allan
 */

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractDdxDrService extends ContainerAware{

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        parent::setContainer($container);
    }

    // SERVICES
    
    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getManager(){
        return $this->container->get('doctrine')->getManager();
    }
    
    /**
     * @return \Ddx\Dr\MarketBundle\Service\TradeService
     */
    protected function getTradeService(){
        return $this->container->get('ddx.trade');
    }
    
    /**
     * @return \Ddx\Dr\MarketBundle\Service\TradingPairService
     */
    protected function getTradingPairService(){
        return $this->container->get('ddx.tradingpair');
    }

    /**
     * @return KrakenMarketService
     */
    protected function getKrakenMarketService(){
        return $this->container->get('ddx.kraken');
    }

    // REPOSITORIES
    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getMarketRepository(){
        return $this->container->get('doctrine')->getManager()->getRepository('DdxDrMarketBundle:Market');
    }
    
    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getTradeRepository(){
        return $this->container->get('doctrine')->getManager()->getRepository('DdxDrMarketBundle:Trade');
    }
    
    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getTradingPairRepository(){
        return $this->container->get('doctrine')->getManager()->getRepository('DdxDrMarketBundle:TradingPair');
    }
    
}
