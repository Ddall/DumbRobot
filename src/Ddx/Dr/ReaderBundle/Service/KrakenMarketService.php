<?php
namespace Ddx\Dr\ReaderBundle\Service;

/**
 * @author Allan
 */

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Ddx\Dr\ReaderBundle\Market\KrakenApiWrapper;
use Ddx\Dr\ReaderBundle\Service\AbstractMarketService;

class KrakenMarketService extends AbstractMarketService{

    /**
     * @var KrakenApiWrapper
     */
    protected $api;


    public function __construct(ContainerInterface $container) {
        parent::__construct($container);
        
    }
      
    public function setApi( $api) {
        parent::setApi($api);
    }

    public function refreshMarketHistory(){
        $this->api->
    }
    
}
