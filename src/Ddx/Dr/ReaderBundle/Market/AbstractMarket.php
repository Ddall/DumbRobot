<?php
namespace Ddx\Dr\ReaderBundle\Market;

/**
 * @author Allan
 */

use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractMarket extends \Symfony\Component\DependencyInjection\ContainerAware{
 
    /**
     * @var ContainerInterface 
     */
    protected $container;
    
    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        $this->setContainer($container);
    }
    
    /**
     * @return ContainerInterface
     */
    protected function getContainer(){
        return $this->container;
    }

    /**
     * @param string $service
     */
    protected function get($service){
        return $this->container->get($service);
    }
    
    /**
     * @return array Trading pairs
     */
    public function getTradingPairs(){
        
    }
    
    /**
     * @return \DateTime Time of the Market
     */
    public function getCurrentTime(){
        
    }
    
}
