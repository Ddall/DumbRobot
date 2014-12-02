<?php

namespace Ddx\Dr\MarketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asset
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Asset
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
     * @var string
     *
     * @ORM\Column(name="abbr", type="string", length=10)
     */
    private $abbr;

    /**
     * @var string
     *
     * @ORM\Column(name="symbol", type="string", length=3)
     */
    private $symbol;

    /**
     * @param string $name
     * @param string $abbr
     * @param string $symbol
     * @return \Ddx\Dr\MarketBundle\Entity\Asset
     */
    public function __construct($name = null, $abbr = null, $symbol = null) {
        $this->setName($name);
        $this->setAbbr($abbr);
        $this->setSymbol($symbol);
        
        return $this;
    }

    /**
     * @return string
     */
    public function __toString() {
        if($this->getSymbol()){
            return $this->getSymbol();
        }
        
        return $this->getAbbr();
    }
    
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
     * @return Asset
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
     * Set abbr
     *
     * @param string $abbr
     * @return Asset
     */
    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;

        return $this;
    }

    /**
     * Get abbr
     *
     * @return string 
     */
    public function getAbbr()
    {
        return $this->abbr;
    }

    /**
     * Set symbol
     *
     * @param string $symbol
     * @return Asset
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get symbol
     *
     * @return string 
     */
    public function getSymbol()
    {
        return $this->symbol;
    }
}
