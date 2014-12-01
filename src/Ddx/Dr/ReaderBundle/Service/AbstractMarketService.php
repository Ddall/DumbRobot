<?php

namespace Ddx\Dr\ReaderBundle\Service;

/**
 * @author Allan
 */

use Ddx\Dr\ReaderBundle\Service\AbstractDdxDrService;

use Ddx\Dr\ReaderBundle\Market\AbstractMarket;

abstract class AbstractMarketService extends AbstractDdxDrService{
    
    /**
     * @var AbstractMarket
     */
    protected $api;
    
    /**
     * @param boolean $dryrun
     * @throws \Exception
     */
    public function updateAllTradeHistory($dryrun = false){
        throw new \ Exception('You must overload AbstractMarket::setApi()');
    }
    
}
