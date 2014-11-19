<?php

namespace Ddx\Dr\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ddx\Dr\MarketBundle\Entity\Trade;

/**
 * Market
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Market
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var Trade
     * 
     * @ORM\OneToMany(targetEntity="Ddx\Dr\MarketBundle\Entity\Trade", mappedBy="market", orphanRemoval=true)
     */
    private $trades;
    
    /**
     *
     * @var TradingPair
     * @ORM\ManyToMany(targetEntity="Ddx\Dr\MarketBundle\Entity\TradingPair", orphanRemoval=true) 
     */
    private $tradingPairs;
    
    // MANUAL METHODS
    
    
    // AUTO METHODS

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Market
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->trades = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add trades
     *
     * @param \Ddx\Dr\MarketBundle\Entity\Trade $trades
     * @return Market
     */
    public function addTrade(\Ddx\Dr\MarketBundle\Entity\Trade $trades)
    {
        $this->trades[] = $trades;

        return $this;
    }

    /**
     * Remove trades
     *
     * @param \Ddx\Dr\MarketBundle\Entity\Trade $trades
     */
    public function removeTrade(\Ddx\Dr\MarketBundle\Entity\Trade $trades)
    {
        $this->trades->removeElement($trades);
    }

    /**
     * Get trades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTrades()
    {
        return $this->trades;
    }
}
