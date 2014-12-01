<?php

namespace Ddx\Dr\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderBook
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ddx\Dr\MarketBundle\Entity\OrderBookRepository")
 */
class OrderBook
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
     * @ORM\Column(name="timelocal", type="datetime")
     */
    private $timelocal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="remotetime", type="datetime")
     */
    private $remotetime;
    
    /**
     * @var TradingPair
     * 
     * @ORM\ManyToOne(targetEntity="Ddx\Dr\MarketBundle\Entity\TradingPair")
     * @ORM\JoinColumn(name="tradingPair_id", referencedColumnName="id", nullable=false)
     */
    private $tradingPair;
    
    /**
     * @var Market
     * 
     * @ORM\ManyToOne(targetEntity="Ddx\Dr\MarketBundle\Entity\Market")
     * @ORM\JoinColumn(name="market_id", referencedColumnName="id", nullable=false)
     */
    private $market;
    
    /**
     * @var Position
     * @ORM\ManyToMany(targetEntity="Ddx\Dr\MarketBundle\Entity\Position", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinTable(name="orderbook_asks",
     *      joinColumns={@ORM\JoinColumn(name="orderbook_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="position_id", referencedColumnName="id")}
     * )
     */
    private $asks;
    
    /**
     * @var Position
     * @ORM\ManyToMany(targetEntity="Ddx\Dr\MarketBundle\Entity\Position", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinTable(name="orderbook_bids",
     *      joinColumns={@ORM\JoinColumn(name="orderbook_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="position_id", referencedColumnName="id")}
     * )
     */
    private $bids;

    // -- PERSO -- PERSO -- PERSO -- PERSO -- PERSO -- PERSO -- PERSO
    
    /**
     * @return \Ddx\Dr\MarketBundle\Entity\OrderBook
     */
    public function __construct(){
        $this->timelocal = new \DateTime('now');
        $this->asks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bids = new \Doctrine\Common\Collections\ArrayCollection();
        return $this;
    }
    
    // -- AUTO -- AUTO -- AUTO -- AUTO -- AUTO -- AUTO -- AUTO -- AUTO

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
     * Set timelocal
     *
     * @param \DateTime $timelocal
     * @return OrderBook
     */
    public function setTimelocal($timelocal)
    {
        $this->timelocal = $timelocal;

        return $this;
    }

    /**
     * Get timelocal
     *
     * @return \DateTime 
     */
    public function getTimelocal()
    {
        return $this->timelocal;
    }

    /**
     * Set remotetime
     *
     * @param \DateTime $remotetime
     * @return OrderBook
     */
    public function setRemotetime($remotetime)
    {
        $this->remotetime = $remotetime;

        return $this;
    }

    /**
     * Get remotetime
     *
     * @return \DateTime 
     */
    public function getRemotetime()
    {
        return $this->remotetime;
    }

    /**
     * Set tradingPair
     *
     * @param \Ddx\Dr\MarketBundle\Entity\TradingPair $tradingPair
     * @return OrderBook
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
     * @return OrderBook
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

    /**
     * Add asks
     *
     * @param \Ddx\Dr\MarketBundle\Entity\Position $asks
     * @return OrderBook
     */
    public function addAsk(\Ddx\Dr\MarketBundle\Entity\Position $asks)
    {
        $this->asks[] = $asks;

        return $this;
    }

    /**
     * Remove asks
     *
     * @param \Ddx\Dr\MarketBundle\Entity\Position $asks
     */
    public function removeAsk(\Ddx\Dr\MarketBundle\Entity\Position $asks)
    {
        $this->asks->removeElement($asks);
    }

    /**
     * Get asks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAsks()
    {
        return $this->asks;
    }

    /**
     * Add bids
     *
     * @param \Ddx\Dr\MarketBundle\Entity\Position $bids
     * @return OrderBook
     */
    public function addBid(\Ddx\Dr\MarketBundle\Entity\Position $bids)
    {
        $this->bids[] = $bids;

        return $this;
    }

    /**
     * Remove bids
     *
     * @param \Ddx\Dr\MarketBundle\Entity\Position $bids
     */
    public function removeBid(\Ddx\Dr\MarketBundle\Entity\Position $bids)
    {
        $this->bids->removeElement($bids);
    }

    /**
     * Get bids
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBids()
    {
        return $this->bids;
    }
}
