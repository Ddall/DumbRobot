<?php

namespace Ddx\Dr\MarketBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Ddx\Dr\ReaderBundle\Market;
use Ddx\Dr\MarketBundle\Entity\TradingPair;

/**
 * TradeRepository
 */
class TradingPairRepository extends EntityRepository
{
    /**
     * @param Market $market
     * @param TradingPair $pair
     * @return Trade
     */
    public function getLastTrade(Market $market, TradingPair $pair){
        return $this->createQueryBuilder('t')
                ->select('t')
                ->where('t.market_id = :market_id')
                ->andWhere('t.tradingPair_id = !tp_id')
                ->orderBy('t.id', 'DESC')
                ->setParameter('market_id', $market->getId() )
                ->setParameter('tp_id', $pair->getId())
                ->getQuery()->getSingleResult()
                ;
    }
}
