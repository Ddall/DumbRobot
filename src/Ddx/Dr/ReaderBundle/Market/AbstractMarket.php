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
    protected function __construct(ContainerInterface $container) {
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
    
    
    // TOOLS
    /**
     * This functions checks if a parameter is defined in the container and returns it if it exists
     * if not, returns FALSE
     * @param type $param
     * @return boolean|string
     */
    public function readParameter($param){
        if($this->hasParameter($param)){
            return $this->getParameter($param);
        }else{
            return FALSE;
        }
    }
}
