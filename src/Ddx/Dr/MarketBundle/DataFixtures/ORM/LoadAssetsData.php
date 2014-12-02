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
            'Euro' => array('EUR', '€'),
            'Dollar' => array('USD', '$'),
            'Bitcoin' => array('BTC', '฿'),
            'Litecoin' => array('LTC', 'Ł'),
            'Dogecoin' => array('DOGE', 'Ð'),
            'Pound' => array('Pound', '£'),
            'Yen' => array('JPY', '¥'),
        );
        
        $entities = array();
        foreach($data as $name => $abbr){
            $entities[$abbr] = new Asset($name, $abbr);
            $manager->persist($entities[$abbr]);
        }
                
        $manager->flush();
    }
}
