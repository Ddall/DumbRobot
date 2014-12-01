<?php
namespace Ddx\Dr\ReaderBundle\Service;

/**
 * DdxDrBaseService
 * @author Allan
 */

use Ddx\Dr\ReaderBundle\Service\AbstractDdxDrService;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DdxDrBaseService  extends AbstractDdxDrService{
    
    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        parent::__construct($container);
    }
    
}
