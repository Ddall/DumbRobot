<?php

namespace Ddx\Dr\StrategyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrunchedData
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ddx\Dr\StrategyBundle\Entity\CrunchedDataRepository")
 */
class CrunchedData
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
     * @var \DateTime
     *
     * @ORM\Column(name="startPeriod", type="datetime")
     */
    private $startPeriod;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration;

    /**
     * @var float
     *
     * @ORM\Column(name="value", type="float")
     */
    private $value;

    /**
     * @var Cruncher
     * 
     * @ORM\ManyToOne(targetEntity="Ddx\Dr\StrategyBundle\Entity\Cruncher")
     * @ORM\JoinColumn(name="cruncher_id", referencedColumnName="id", nullable=false)
     */
    private $cruncher;
    
    /**
     * @var TradingPairph
     * 
     * @ORM\ManyToOne(targetEntity="Ddx\Dr\MarketBundle\Entity\TradingPair")
     * @ORM\JoinColumn(name="tradingPair_id", referencedColumnName="id", nullable=false)
     */
    private $tradingPair;
    
    /**
     * @var Market
     * 
     * @ORM\ManyToOne(targetEntity="Ddx\Dr\MarketBundle\Entity\Market", inversedBy="trades")
     * @ORM\JoinColumn(name="market_id", referencedColumnName="id", nullable=false)
     */
    private $market;
    
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
     * Set startPeriod
     *
     * @param \DateTime $startPeriod
     * @return CrunchedData
     */
    public function setStartPeriod($startPeriod)
    {
        $this->startPeriod = $startPeriod;

        return $this;
    }

    /**
     * Get startPeriod
     *
     * @return \DateTime 
     */
    public function getStartPeriod()
    {
        return $this->startPeriod;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return CrunchedData
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set value
     *
     * @param float $value
     * @return CrunchedData
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set cruncher
     *
     * @param \Ddx\Dr\StrategyBundle\Entity\Cruncher $cruncher
     * @return CrunchedData
     */
    public function setCruncher(\Ddx\Dr\StrategyBundle\Entity\Cruncher $cruncher)
    {
        $this->cruncher = $cruncher;

        return $this;
    }

    /**
     * Get cruncher
     *
     * @return \Ddx\Dr\StrategyBundle\Entity\Cruncher 
     */
    public function getCruncher()
    {
        return $this->cruncher;
    }

    /**
     * Set tradingPair
     *
     * @param \Ddx\Dr\MarketBundle\Entity\TradingPair $tradingPair
     * @return CrunchedData
     */
    public function setTradingPair(\Ddx\Dr\MarketBundle\Entity\TradingPair $tradingPair)
    {
        $this->tradingPair = $tradingPair;

        return $this;
    }

    /**
     * Get tradingPair
     *
     * @return \Ddx\Dr\MarketBundle\Entity\TradingPair 
     */
    public function getTradingPair()
    {
        return $this->tradingPair;
    }

    /**
     * Set market
     *
     * @param \Ddx\Dr\MarketBundle\Entity\Market $market
     * @return CrunchedData
     */
    public function setMarket(\Ddx\Dr\MarketBundle\Entity\Market $market)
    {
        $this->market = $market;

        return $this;
    }

    /**
     * Get market
     *
     * @return \Ddx\Dr\MarketBundle\Entity\Market 
     */
    public function getMarket()
    {
        return $this->market;
    }
}
