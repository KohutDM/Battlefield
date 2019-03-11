<?php
trait FirstHit
{
    public $first_hit = true;
    public $first_hit_count = 0;

    static function firstHit(UnitComposite $unit_1, UnitComposite $unit_2)
    {
        $hit_order_array=[];

        if (method_exists($unit_1,'getFirstHit') and method_exists($unit_2,'getFirstHit')){
            return ModelFight::lot($unit_1, $unit_2);
        }

        if (method_exists($unit_1,'getFirstHit') and $unit_1->getFirstHit()==true){
            $first_unit = $unit_1;
            $second_unit = $unit_2;
            $first_unit->setFirstHit(false);
        }
        elseif (method_exists($unit_1,'getFirstHit') and $unit_1->getFirstHit()==false){
            return ModelFight::lot($unit_1, $unit_2);
        }
        if (method_exists($unit_2,'getFirstHit') and $unit_2->getFirstHit() == true){
            $first_unit = $unit_2;
            $second_unit = $unit_1;
            $first_unit->setFirstHit(false);
        }
        elseif (method_exists($unit_2,'getFirstHit') and $unit_2->getFirstHit() == false){
            return ModelFight::lot($unit_1, $unit_2);
        }

        array_push($hit_order_array, $first_unit, $second_unit);
        return $hit_order_array;
    }

    public function getFirstHit()
    {
        return $this->first_hit;
    }

    public function setFirstHit($value)
    {
        $this->first_hit = $value;
        $this->countFirstHit();
    }

    public function countFirstHit()
    {
        $this->first_hit_count = $this->first_hit_count+0.5;
    }

    public function getFirstHitCount()
    {
        return $this->first_hit_count;
    }
}