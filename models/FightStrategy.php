<?php

/**
 * Class FightStrategy
 * Created and called by armyFight() ModelFight
 * Contain ModelFight object and all separate fight strategies
 */
class FightStrategy
{
    protected $model_fight_object;
    protected $fight_strategy_archers;
    protected $fight_strategy_only_animals;
    protected $fight_strategy_general;

    function __construct(ModelFight $object)
    {
        $this->model_fight_object=$object;
    }

    /**
     * Choose fight strategy corresponding to armies array`s content
     * @return UnitComposite Object (dead unit) or
     * string value with winner army number for dead unit variable
     */
    public function fightStrategy()
    {
        $this->fight_strategy_archers = new FightStrategyArchers($this->model_fight_object);
        $this->fight_strategy_only_animals = new FightStrategyOnlyAnimals($this->model_fight_object);
        $this->fight_strategy_general = new FightStrategyGeneral($this->model_fight_object);

        if ($this->model_fight_object->getAnimalCount($this->model_fight_object->getArmy_1())==
            count($this->model_fight_object->getArmy_1())){
            return $this->fight_strategy_only_animals->fightOnlyAnimals('1');
        }
        if ($this->model_fight_object->getAnimalCount($this->model_fight_object->getArmy_2())==
            count($this->model_fight_object->getArmy_2())){
            return $this->fight_strategy_only_animals->fightOnlyAnimals('2');
        }

        foreach ($this->model_fight_object->getTwoArmies() as $unit){
            if ($unit instanceof Archers){
                return $this->fight_strategy_archers->fightArchers();
            }
        }

        return $this->fight_strategy_general->fightGeneral();
    }
}
