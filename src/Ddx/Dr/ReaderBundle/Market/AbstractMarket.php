<?php
namespace Ddx\Dr\ReaderBundle\Market;

/**
 * @author Allan
 */

abstract class AbstractMarket{

    
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
