<?php

/**
 * Irányítatlan, egyszeres gráf.
 */
class Graf {
    /**
     * @var int
     */
    private $csucsokSzama;
    /**
     * A gráf élei.
     * Ha a lista tartalmaz egy (A,B) élt, akkor tartalmaznia kell
     * a (B,A) vissza irányú élt is.
     * 
     * @var El[]
     */
    private $elek = [];
    /**
     * A gráf csúcsai.
     * A gráf létrehozása után új csúcsot nem lehet felvenni.
     * 
     * @var Csucs[]
     */
    private $csucsok = [];

    /**
     * Létehoz egy úgy, N pontú gráfot, élek nélkül.
     * 
     * @param int $csucsok A gráf csúcsainak száma
     */
    public function __construct($csucsok) {
        $this->csucsokSzama = $csucsok;
        
        // Minden csúcsnak hozzunk létre egy új objektumot
        for ($i = 0; $i < $csucsok; $i++) {
            $this->csucsok[] = new Csucs($i);
        }
    }
    
    /**
     * Hozzáad egy új élt a gráfhoz.
     * Mindkét csúcsnak érvényesnek kell lennie:
     * 0 &lt;= cs &lt; csúcsok száma.
     * 
     * @param int $cs1 Az él egyik pontja
     * @param int $cs2 Az él másik pontja
     * @throws Exception A csúcs indexe hibás
     */
    public function hozzaad($cs1, $cs2) {
        if ($cs1 < 0 || $cs1 >= $this->csucsokSzama ||
            $cs2 < 0 || $cs2 >= $this->csucsokSzama) {
            throw new Exception("Hibas csucs index");
        }
        
        // Ha már szerepel az él, akkor nem kell felvenni
        foreach ($this->elek as $el) {
            if ($el->getCsucs1() === $cs1 && $el->getCsucs2() === $cs2) {
                return;
            }
        }
        
        $this->elek[] = new El($cs1, $cs2);
        $this->elek[] = new El($cs2, $cs1);
    }
    
    public function __toString() {
        $str = "Csucsok:\n";
        foreach ($this->csucsok as $cs) {
            $str .= $cs . "\n";
        }
        $str .= "Elek:\n";
        foreach ($this->elek as $el) {
            $str .= $el . "\n";
        }
        return $str;
    }
}
