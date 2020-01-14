<?php

/**
 * A gráf egy éle, és a hozzá tartozó adatok.
 */
class El {
    /**
     * Az egyik csúcs indexe
     * 
     * @var int
     */
    private $csucs1;
    /**
     * A másik csúcs indexe
     * 
     * @var int
     */
    private $csucs2;
    
    /**
     * Létrehoz egy úgy élt.
     * 
     * @param int $cs1 Az egyik csúcs indexe
     * @param int $cs2 A másik csúcs indexe
     */
    public function __construct($cs1, $cs2) {
        $this->csucs1 = $cs1;
        $this->csucs2 = $cs2;
    }
    
    /**
     * A másik csúcs indexe
     * @return int
     */
    public function getCsucs1() {
        return $this->csucs1;
        
    }
    
    /**
     * Az egyik csúcs indexe
     * @return int
     */
    public function getCsucs2() {
        return $this->csucs2;
    }
    
    public function __toString() {
        return sprintf("(%d - %d)", $this->csucs1, $this->csucs2);
    }
}
