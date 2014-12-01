<?php
/**
 * MathService
 * @author Allan
 */

namespace Ddx\Dr\MarketBundle\Service;
use Ddx\Dr\ReaderBundle\Service\AbstractDdxDrService;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MathService extends AbstractDdxDrService{
    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        parent::setContainer($container);
    }
    
}
