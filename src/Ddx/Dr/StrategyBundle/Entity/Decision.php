<?php

namespace Ddx\Dr\StrategyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Decision
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Decision
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
     * @ORM\Column(name="timeLocal", type="datetime")
     */
    private $timeLocal;

    /**
     * @var integer
     *
     * @ORM\Column(name="confidenceLevel", type="integer")
     */
    private $confidenceLevel;


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
     * Set timeLocal
     *
     * @param \DateTime $timeLocal
     * @return Decision
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
     * Set confidenceLevel
     *
     * @param integer $confidenceLevel
     * @return Decision
     */
    public function setConfidenceLevel($confidenceLevel)
    {
        $this->confidenceLevel = $confidenceLevel;

        return $this;
    }

    /**
     * Get confidenceLevel
     *
     * @return integer 
     */
    public function getConfidenceLevel()
    {
        return $this->confidenceLevel;
    }
}
