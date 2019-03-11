<?php
/**
 * Contains ModelFight object
 * Makes the army of animals leave the battlefield
 * Assigns the victory to opposite army and generates the corresponding message
 */
class FightStrategyOnlyAnimals extends FightStrategy
{
    public function fightOnlyAnimals($army_number)
    {
        if ($army_number == '1') {
            $army_1 = $this->model_fight_object->getArmy_1();
            array_splice($army_1,0);
            $this->model_fight_object->setArmy_1($army_1);
            return 'The first army runs from the battlefield!' . "</br> ~ ";
        }
        else {
            $army_2=$this->model_fight_object->getArmy_2();
            array_splice($army_2,0);
            $this->model_fight_object->setArmy_2($army_2);
            return 'The second army runs from the battlefield!' . "</br> ~ ";
        }
    }
}
