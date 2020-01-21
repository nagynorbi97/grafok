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
	
	public function SzelessegiBejar($kezdopont){
		// Kezdetben egy pontot sem jártunk be
		$bejart = [];
		
		// A következőnek vizsgált elem a kezdőpont
		$kovetkezok = [];
		$kovetkezok[] = $kezdopont;
		$bejart[] = $kezdopont;
		
		// Amíg van következő, addig megyünk
		while(!empty($kovetkezok)){
			// A sor elejéről vesszük ki
			$k = array_shift($kovetkezok);
			
			// Elvégezzük a bejárási műveletet, pl. a konzolra kiírást:
			echo $this->csucsok[$k] . "\n";
			
			foreach($el as $this->elek){
				// Megkeressük azokat az éleket, amelyek k-ból indulnak
				// Ha az él másik felét még nem vizsgáltuk, akkor megvizsgáljuk
				if($el->getCsucs1() == $k and !in_array($el->getCsucs2(),$bejart)){
					// A sor végére és a bejártak közé szúrjuk be
					$kovetkezok[] = $el->getCsucs2();
					$bejart[] = $el->getCsucs2();
				}
			}
			
			// Jöhet a sor szerinti következő elem
		}
	}
	
	public function MelysegiBejar($kezdopont){
		// Kezdetben egy pontot sem jártunk be
		$bejart = [];
		
		// A következőnek vizsgált elem a kezdőpont
		$kovetkezok = [];
		$kovetkezok[] = $kezdopont;
		$bejart[] = $kezdopont;
		
		// Amíg van következő, addig megyünk
		while(!empty($kovetkezok)){
			// A verem tetejéről vesszük le
			$k = array_pop($kovetkezok);
			
			// Elvégezzük a bejárási műveletet, pl. a konzolra kiírást:
			echo $this->csucsok[$k] . "\n";
			
			foreach($el as $this->elek){
				// Megkeressük azokat az éleket, amelyek k-ból indulnak
				// Ha az él másik felét még nem vizsgáltuk, akkor megvizsgáljuk
				if($el->getCsucs1() == $k and !in_array($el->getCsucs2(),$bejart)){
					// A verem tetejére és a bejártak közé adjuk hozzá
					$kovetkezok[] = $el->getCsucs2();
					$bejart[] = $el->getCsucs2();
				}
			}
			
			// Jöhet a sor szerinti következő elem
		}
	}
	
	public function Osszefuggo() {
		$bejart = [];
		
		$kovetkezok = [];
		$kovetkezok[] = 0; // Tetszőleges, mondjuk 0 kezdőpont
		$bejart[] = 0;
		
		while(!empty($kovetkezok)){
			$k = array_shift($kovetkezok);
			
			// Bejárás közben nem kell semmit csinálni
			
			foreach($el as $this->elek){
				if($el->getCsucs1() == $k and !in_array($el->getCsucs2(),$bejart)){
					$kovetkezok[] = $el->getCsucs2();
					$bejart[] = $el->getCsucs2();
				}
			}
		}
		// A végén megvizsgáljuk, hogy minden pontot bejártunk-e
		if(count($bejart) == $this->csucsokSzama) {
			return true;
		} else {
			return false;
		}
	}
	
	public function Feszitofa() {
		// Új, kezdetben él nélküli gráf
		$fa = new Graf($this->csucsokSzama);
		
		// Bejáráshoz szükséges adatszerkezetek
		$bejart = [];
		$kovetkezok = [];
		
		// Tetszőleges, mondjuk 0 kezdőpont
		$kovetkezok[] = 0;
		$bejart[] = 0;
		
		// Szélességi bejárás
		while(!empty($kovetkezok)){
			$k = array_shift($kovetkezok);
			for($aktualisCsucs=0; $aktualisCsucs<$this->csucsokSzama-1; $aktualisCsucs++){
				foreach($el as $this->elek){
					if($el->getCsucs1==$aktualisCsucs){
						if(!in_array($el->getCsucs2(),$bejart)){
							$bejart[] = $el->getCsucs2();
							$kovetkezok[] = $el->getCsucs2();
							// A fába is vegyük bele az élt
							$fa->hozzaad($él->getCsucs1(), $él->getCsucs2());
						}
					}
				}
			}
		}
		
		// Az eredményül kapott gráf az eredeti gráf feszítőfája
		return $fa;
	}
	
	public function MohoSzinezes() {
		$szinezes = [];
		
		// Legrosszabb esetben minden csúcsot különböző színűre kell színezni,
		// ezért ennyi szín elég lesz
		$maxSzín = $this->csucsokSzama;
		
		for($aktualisCsucs=0; $aktualisCsucs<$this->csucsokSzama-1; $aktualisCsucs++){
			// Kezdetben bármely színt választhatjuk
			$valaszthatoSzinek = range(0,$maxSzín);
			
			// Vizsgáljuk meg a szomszédos csúcsokat:
			foreach($el as $this->elek){
				if($el->getCsucs1==$aktualisCsucs){
					// Ha a szomszédos csúcs már be van színezve,
					// azt a színt már nem választhatjuk
					if(array_key_exists($el->getCsucs2(), $szinezes)){
						$szin = $szinezes[$el->getCsucs2()];
						unset($valaszthatoSzinek[$szin]);
					}
				}
			}
			
			// A maradék színekből válasszuk ki a legkisebbet
			$valasztottSzin = min($valaszthatoSzinek);
			$szinezes[$aktualisCsucs] = $valasztottSzin;
		}
		
		return $szinezes;
	}
}
