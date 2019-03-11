<?php
/**
 * Class FightStrategyGeneral
 * Contains ModelFight object
 * Created and called by FightStrategy
 */
class FightStrategyGeneral extends FightStrategy
{
    /**
     * Choose two fight units from two armies that contain no Archers
     * Figure out winner unit in separate unit`s fight
     * @return UnitComposite object (dead unit)
     */
    public function fightGeneral()
    {
        $unit_1 = $this->model_fight_object->getArmy_1()
        [array_rand($this->model_fight_object->getArmy_1(), 1)];
        $unit_2 = $this->model_fight_object->getArmy_2()
        [array_rand($this->model_fight_object->getArmy_2(), 1)];

        return $this->model_fight_object->unitFight($unit_1, $unit_2);
    }
}