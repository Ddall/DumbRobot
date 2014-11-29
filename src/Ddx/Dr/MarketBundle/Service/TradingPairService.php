<?php
namespace Ddx\Dr\MarketBundle\Service;
/**
 * @author Allan
 */

use Ddx\Dr\ReaderBundle\Service\AbstractDdxDrService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use \Exception as Exception;

class TradingPairService extends AbstractDdxDrService {
    
    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        parent::setContainer($container);
    }
    
    /**
     * Use this to enable or disable a tradingpair for Kraken
     * @param string $marketName
     * @param string $tradingPairName
     * @param boolean $enable
     */
    public function manageTradingPair(string $marketName, string $tradingPairName, $enable = null){
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
            $pair->setIsActive($enable);
            $this->getManager()->persist($pair);
            $this->getManager()->flush();
        }
        
        return array(
            'pair' => $pair->getName(),
            'isActive' => $pair->isActive(),
        );
    }
    
}
