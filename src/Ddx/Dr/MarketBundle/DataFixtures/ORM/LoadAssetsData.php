<?php

namespace Ddx\Dr\MarketBundle\DataFixtures\ORM;

/**
 * @author Allan
 */

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Ddx\Dr\MarketBundle\Entity\Asset;

class LoadAssetsData implements FixtureInterface{
    
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager){
        $data = array(
            'Euro' => 'EUR',
            'Dollar' => 'USD',
            'Bitcoin' => 'BTC',
            'Litecoin' => 'LTC',
            'Dogecoin' => 'DOGE',
            'Pound' => 'GBP',
            'Yen' => 'JPY',
        );
        
        $entities = array();
        foreach($data as $name => $abbr){
            $entities[$abbr] = new Asset($name, $abbr);
            $manager->persist($entities[$abbr]);
        }
                
        $manager->flush();
    }
}
