<?php
/**
 * Class FightStrategyArchers
 * Contains ModelFight object
 * Created and called by FightStrategy
 */
class FightStrategyArchers extends FightStrategy
{
    /**
     * Choose two fight units from two armies containing at least one Archers
     * Figure out winner unit in separate unit`s fight
     * @return UnitComposite object (dead unit)
     */
    public function fightArchers()
    {
        replayChoose:
        $unit_1 = $this->model_fight_object->getArmy_1()
        [array_rand($this->model_fight_object->getArmy_1(), 1)];
        $unit_2 = $this->model_fight_object->getArmy_2()
        [array_rand($this->model_fight_object->getArmy_2(), 1)];

        $hit_order_array = $this->model_fight_object->hitOrder($unit_1, $unit_2);
        $first_unit = array_shift($hit_order_array);
        $second_unit = array_shift($hit_order_array);

        $second_unit_army = $this->model_fight_object->armySearch($second_unit);

        if ($second_unit instanceof Archers and count($second_unit_army)
            > $this->model_fight_object->getArchersCount($second_unit_army))
        {
            goto replayChoose;
        }

        while ($first_unit->getHp() > 0 and $second_unit->getHp() > 0){

            if ($this->model_fight_object->criticalHit($first_unit, $second_unit) == true){
                break;
            }
            else{
                $this->model_fight_object->damage($first_unit, $second_unit);
            }
            $hit_order_array = $this->model_fight_object->hitOrder($first_unit, $second_unit);
            $first_unit = array_shift($hit_order_array);
            $second_unit = array_shift($hit_order_array);
        }
        return $this->model_fight_object->findDeadUnit($first_unit,$second_unit);
    }
}