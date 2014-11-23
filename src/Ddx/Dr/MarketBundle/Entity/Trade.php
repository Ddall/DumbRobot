<?php

namespace Ddx\Dr\MarketBundle\Entity;

use Ddx\Dr\MarketBundle\Entity\Market;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trade
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ddx\Dr\MarketBundle\Entity\TradeRepository")
 */
class Trade
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
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="volume", type="float")
     */
    private $volume;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeLocal", type="datetime")
     */
    private $timeLocal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeRemote", type="datetime")
     */
    private $timeRemote;

    /**
     * @var string SELL|BUY
     *
     * @ORM\Column(name="orderType", type="string", length=10)
     */
    private $orderType;

    /**
     * @var string
     *
     * @ORM\Column(name="tradingPair", type="string", length=25)
     */
    private $tradingPair;

    
    /**
     * @var Market
     * 
     * @ORM\ManyToOne(targetEntity="Ddx\Dr\MarketBundle\Entity\Market", inversedBy="trades")
     * @ORM\JoinColumn(name="market_id", referencedColumnName="id")
     */
    private $market;
    
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
     * Set price
     *
     * @param float $price
     * @return Trade
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set volume
     *
     * @param float $volume
     * @return Trade
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return float 
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set timeLocal
     *
     * @param \DateTime $timeLocal
     * @return Trade
     */
    public function setTimeLocal($timeLocal)
    {
        $this->timeLocal = $timeLocal;

        return $this;
    }

    /**
     * Get timeLocal
     *
     * @return \DateTime 
     */
    public function getTimeLocal()
    {
        return $this->timeLocal;
    }

    /**
     * Set timeRemote
     *
     * @param \DateTime $timeRemote
     * @return Trade
     */
    public function setTimeRemote($timeRemote)
    {
        $this->timeRemote = $timeRemote;

        return $this;
    }

    /**
     * Get timeRemote
     *
     * @return \DateTime 
     */
    public function getTimeRemote()
    {
        return $this->timeRemote;
    }

    /**
     * Set orderType
     *
     * @param string $orderType
     * @return Trade
     */
    public function setOrderType($orderType)
    {
        $this->orderType = $orderType;

        return $this;
    }

    /**
     * Get orderType
     *
     * @return string 
     */
    public function getOrderType()
    {
        return $this->orderType;
    }

    /**
     * Set tradingPair
     *
     * @param string $tradingPair
     * @return Trade
     */
    public function setTradingPair($tradingPair)
    {
        $this->tradingPair = $tradingPair;

        return $this;
    }

    /**
     * Get tradingPair
     *
     * @return string 
     */
    public function getTradingPair()
    {
        return $this->tradingPair;
    }

    /**
     * Set market
     *
     * @param Market $market
     * @return Trade
     */
    public function setMarket(Market $market = null)
    {
        $this->market = $market;

        return $this;
    }

    /**
     * Get market
     *
     * @return Market
     */
    public function getMarket()
    {
        return $this->market;
    }
}
