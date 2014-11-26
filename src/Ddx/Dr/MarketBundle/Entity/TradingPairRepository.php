<?php

namespace Ddx\Dr\MarketBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TradeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TradingPairRepository extends EntityRepository
{
    public function getLastTrade($marketId){
        return $this->createQueryBuilder('t')
                ->select('t')
                ->where('t.market_id = :market')
                ->orderBy('t.id', 'DESC')
                ->setParameter('market', $marketId)
                ->getQuery()->getSingleResult()
                ;
    }
}
