<?php
abstract class UnitComposite
{
    public $unit_type;
    public $hp_value;
    public $frag_value = 0;
    public $critical_hits = 0;
    public $critical_misses = 0;
    private $unit_army;

    function __construct($army_number)
    {
        if ($army_number==1){
            $this->unit_army = 'British';
        }
        else{
            $this->unit_army = 'German';
        }
    }

    public function getYourArmy()
    {
        return $this->unit_army;
    }

    public function getUnitType()
    {
       return $this->unit_type;
    }

    public function getHp()
    {
        return $this->hp_value;
    }

    public function setHp($new_hp)
    {
        $this->hp_value = $new_hp;
    }

    public function getFrags()
    {
        return $this->frag_value;
    }

    public function setFrags()
    {
        $this->frag_value = $this->getFrags() + 1;
    }

    public function setCriticalHits(){
        $this->critical_hits += 1;
    }

    abstract function unitAttack();

    abstract function unitDefence();

}