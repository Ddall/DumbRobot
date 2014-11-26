<?php

namespace Ddx\Dr\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TradingPair
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ddx\Dr\MarketBundle\Entity\TradingPairRepository")
 */
class TradingPair
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="remoteName", type="string", length=50)
     */
    private $remoteName;
    
    /**
     * @var Market 
     * @ORM\ManyToOne(targetEntity="Ddx\Dr\MarketBundle\Entity\Market", inversedBy="tradingPairs")
     * @ORM\JoinColumn(name="market_id", referencedColumnName="id")
     */
    private $market;
    
    /**
     * @var boolean
     * @ORM\Column(name="isActive", type="boolean", nullable=false)
     */
    private $isActive;

    // MANUAL METHODS

    /**
     * __ctor
     * @param \Ddx\Dr\MarketBundle\Entity\Market $market
     * @param string $name
     * @param string $remoteName
     * @return \Ddx\Dr\MarketBundle\Entity\TradingPair
     */
    public function __construct(Market $market = null,  $name = null, $remoteName = null) {
        $this->setMarket($market);
        $this->setName($name);
        $this->setRemoteName($remoteName);
        $this->isActive = false;
        return $this;
    }
    
    
    /**
     * @return string
     */
    public function __toString() {
        return $this->getName();
    }

    /**
     * @return boolean
     */
    public function isActive(){
        return $this->isActive;
    }
    
    /**
     * @return \Ddx\Dr\MarketBundle\Entity\TradingPair
     */
    public function enable(){
        $this->isActive = true;
        return $this;
    }
    
    /**
     * @return \Ddx\Dr\MarketBundle\Entity\TradingPair
     */
    public function disable(){
        $this->isActive = false;
        return $this;
    }

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
     * @return TradingPair
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
     * Set remoteName
     *
     * @param string $remoteName
     * @return TradingPair
     */
    public function setRemoteName($remoteName)
    {
        $this->remoteName = $remoteName;

        return $this;
    }

    /**
     * Get remoteName
     *
     * @return string 
     */
    public function getRemoteName()
    {
        return $this->remoteName;
    }

    /**
     * Set market
     *
     * @param \Ddx\Dr\MarketBundle\Entity\Market $market
     * @return TradingPair
     */
    public function setMarket(\Ddx\Dr\MarketBundle\Entity\Market $market = null)
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
     * Set isActive
     *
     * @param boolean $isActive
     * @return TradingPair
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}
