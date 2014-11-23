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
    protected function setApi(){
        throw new \ Exception('You must overload AbstractMarket::setApi()');
    }
    
    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    private function getTradeRepository(){
        return $this->getDoctrine()->getManager()->getRepository('DdxDrMarketBundle:Trade');
    }
    
    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    private function getTradingPairRepository(){
        return $this->getDoctrine()->getManager()->getRepository('DdxDrMarketBundle:TradingPair');
    }
    
}
