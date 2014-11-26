<?php

namespace Ddx\Dr\MarketBundle\Entity;

use Doctrine\ORM\EntityRepository;
//use Ddx\Dr\ReaderBundle\Market;
use Ddx\Dr\MarketBundle\Entity\TradingPair;

/**
 * TradeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TradeRepository extends EntityRepository
{
    /**
     * @param Market $market
     * @param TradingPair $tradingPair
     * @return Trade
     */
    public function getLastTrade(Market $market, TradingPair $tradingPair){
        return $this->createQueryBuilder('t')
                ->select('t')
                ->where('t.market_id = :m_id')
                ->andWhere('t.trading')
                ->setParameter('m_id', $market->getId())
                ->getQuery()->getOneOrNullResult()
                ;
    }
}
