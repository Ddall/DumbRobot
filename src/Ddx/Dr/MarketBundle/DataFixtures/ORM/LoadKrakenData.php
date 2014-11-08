<?php

namespace Ddx\Dr\MarketBundle\DataFixtures\ORM;

/**
 * @author Allan
 */

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadKrakenData implements FixtureInterface{
    
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager){
        $market = new \Ddx\Dr\MarketBundle\Entity\Market();
        $market->setName('Kraken');
        
        $manager->persist($market);
        $manager->flush();
    }
}
