<?php
namespace Ddx\Dr\ReaderBundle\Service;

/**
 * @author Allan
 */

use Ddx\Dr\ReaderBundle\Service\AbstractDdxHelper;

abstract class AbstractDdxDrService extends AbstractDdxHelper{

    // REPOSITORIES
    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getMarketRepository(){
        return $this->getManager()->getRepository('DdxDrMarketBundle:Market');
    }
    
    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getTradeRepository(){
        return $this->getManager()->getRepository('DdxDrMarketBundle:Trade');
    }
    
    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getTradingPairRepository(){
        return $this->getManager()->getRepository('DdxDrMarketBundle:TradingPair');
    }
    
}
