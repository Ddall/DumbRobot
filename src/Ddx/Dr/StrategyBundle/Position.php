<?php
namespace Ddx\Dr\StrategyBundle;

/**
 * Position.php - UTF-8
 * @author Allan
 */

class Position {

    const STAY  = 0;
    const BUY   = 1;
    const HOLD  = 2;
    const SELL  = 3;

    /**
     * @var integer
     */
    private $value;
    

    /**
     * @param integer|NULL $value
     */
    public function __construct($value = null){
        $this->value = $value;
    }

    /**
     * @return integer
     */
    public function __sleep(){
        return (integer) $this->value;
    }
    
    /**
     * Use this to go down one step in the position index
     * @return \Ddx\Dr\StrategyBundle\Position
     */
    public function moveUp(){
        $this->value = ($this->value+1 % 4);
        return $this;
    }
    
    /**
     * Use this to go one step down in the Position index
     * @return \Ddx\Dr\StrategyBundle\Position
     */
    public function moveDown(){
        $this->value = ($this->value-1 % 4);
        return $this;
    }
    
}
