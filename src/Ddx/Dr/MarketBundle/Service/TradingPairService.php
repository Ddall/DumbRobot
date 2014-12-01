<?php
namespace Ddx\Dr\MarketBundle\Service;
/**
 * @author Allan
 */

use Ddx\Dr\ReaderBundle\Service\AbstractDdxDrService;
use Doctrine\ORM\EntityManagerInterface;
use \Exception as Exception;

class TradingPairService extends AbstractDdxDrService {
    
    /**
     * @param EntityManagerInterface $entityManager
     * @return \Ddx\Dr\MarketBundle\Service\TradingPairService
     */
    public function __construct(EntityManagerInterface $entityManager) {
        $this->setEntityManager($entityManager);
        return $this;
    }
    
    /**
     * Use this to enable or disable a tradingpair for Kraken
     * @param string $marketName
     * @param string $tradingPairName
     * @param boolean $enable
     */
    public function manageTradingPair($marketName, $tradingPairName, $enable = null){
        $market = $this->getMarketRepository()->findOneByName($marketName);
        if(!$market){
            throw new Exception('UNKNOWN MARKET');
        }
        
        $pair = $this->getTradingPairRepository()->findOneBy(array(
            'name' => $tradingPairName,
            'market' => $market->getId(),
        ));
        if(!$pair){
            $pair = $this->getTradingPairRepository()->findOneBy(array(
                'remoteName' => $tradingPairName,
                'market' => $market->getId(),
            ));
        }
        
        if(!$pair){
            throw new Exception('Trading pair not found');
        }
        
        if($enable !== NULL){
            $pair->setActive($enable);
            $this->getManager()->persist($pair);
            $this->getManager()->flush();
        }
        
        return array(
            'pair' => $pair->getName(),
            'isActive' => $pair->isActive(),
        );
    }
    
}
