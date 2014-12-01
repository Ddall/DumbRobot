<?php
/**
 * MathService
 * @author Allan
 */
namespace Ddx\Dr\MarketBundle\Service;

use Ddx\Dr\ReaderBundle\Service\AbstractDdxDrService;
use Doctrine\ORM\EntityManagerInterface;

class MathService extends AbstractDdxDrService{

    /**
     * @param EntityManagerInterface $entityManager
     * @return \Ddx\Dr\MarketBundle\Service\MathService
     */
    public function __construct(EntityManagerInterface $entityManager) {
        $this->setEntityManager($entityManager);
        return $this;
    }
}
