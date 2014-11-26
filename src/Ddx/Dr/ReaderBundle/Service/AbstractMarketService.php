<?php

namespace Ddx\Dr\ReaderBundle\Service;

/**
 * @author Allan
 */

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Ddx\Dr\ReaderBundle\Market\AbstractMarket;

abstract class AbstractMarketService extends ContainerAware{
    
    /**
     * @var AbstractMarket
     */
    protected $api;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        parent::setContainer($container);
    }
    
    /**
     * @param AbstractMarket $api
     * @throws Exception
     */
//    protected function setApi(AbstractMarket $market){
//        throw new \ Exception('You must overload AbstractMarket::setApi()');
//    }
    
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
