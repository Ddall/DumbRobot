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
        
        $this->setApi(new KrakenApiWrapper($container) );
        
        
    }
      
    public function setApi(KrakenApiWrapper $api) {
        $this->api = $api
    }

    public function refreshMarketHistory(){
//        $this->api->
    }
    
}
