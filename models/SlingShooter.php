<?php

/**
 * Class SlingShooter
 * describes the SlingShooter unit
 */
class SlingShooter extends Archers
{
    function __construct($army_number)
    {
        parent::__construct($army_number);
        $this->hp_value = random_int(8,10);
        $this->unit_type = 'SlingShooter';
    }

    public function unitAttack()
    {
        $unit_attack = random_int(2,3);
        return $unit_attack;
    }

    public function unitDefence()
    {
        $unit_defence = random_int(1,3);
        return $unit_defence;
    }
}