<?php
class ModelUnit
{
    private $unit_iterator = 1;
    private $max_unit_iterator = 5;

    public function makeArmy($user_data)
    {
        $army = [];
        for ($this->unit_iterator; $this->unit_iterator<=$this->max_unit_iterator; $this->unit_iterator++){
        array_push($army, UnitFactory::makeUnit($user_data['unit' . $this->unit_iterator]));
        }
        $this->max_unit_iterator = 10;
        return $army;
    }

    /**
     * @param $army
     * @return array if army isn`t empty and string if it is
     */
    static function checkArmy($army)
    {
        $null_iterator=0;

        foreach ($army as $unit){
            if (is_null($unit)){
                $null_iterator++;
            }
        }
        if ($null_iterator==5)
        {
            return false;
        }
            return true;
    }

    static function checkAnimalsOnly(array $army) {
        if (ModelFight::getAnimalCount($army)==
            count(array_filter($army,'is_object')) and ModelFight::getAnimalCount($army)!==0){ 
            return false;
        }
        return true;
    }
}