<?php
class Bear extends Animal
{
    use FirstHit;

    function __construct($army_number)
    {
        parent::__construct($army_number);
        $this->hp_value = random_int(10,13);
        $this->first_hit = true;
        $this->unit_type = 'Bear';
    }

    public function unitAttack()
    {
        $unit_attack = random_int(3,5);
        return $unit_attack;
    }

    public function unitDefence()
    {
        $unit_defence = random_int(1,4);
        return $unit_defence;
    }



}