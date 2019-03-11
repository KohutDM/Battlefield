<?php
/**
 * Class ModelFight
 * Created and called by BattlefieldController
 * Contains all methods related with directly fight compute
 * Haven`t fight strategy methods
 */
class ModelFight implements SplSubject
{
    const ARCHERS_ATTACK_RATIO = 5;
    private $winner;
    private $army_1;
    private $army_2;
    private $storage;
    private $statistic_story = null;

    function __construct($army_1, $army_2)
    {
        $this->army_1 = $army_1;
        $this->army_2 = $army_2;
        $this->storage = new SplObjectStorage();
    }
    /**
     * While each army has at least one unit, choose fight strategy
     * and delete dead unit from the corresponding array
     * @return array with units (UnitComposite $object) of winner army
     */
    public function armyFight()
    {
        $fight_strategy = new FightStrategy($this);
        while (!empty($this->getArmy_1()) and !empty($this->getArmy_2())){
            $dead_unit = $fight_strategy->fightStrategy();

            if (is_string($dead_unit)){
                $this->winner .= $dead_unit;
                break;
            }
            if (array_search($dead_unit,$this->getArmy_1()) !== false){
                unset($this->army_1[array_search($dead_unit,$this->getArmy_1())]);
            }
            else{
                unset($this->army_2[array_search($dead_unit,$this->getArmy_2())]);
            }
        }

        if (empty($this->army_1)){
            $winner_army = $this->army_2;
            $this->winner .= 'The German army wins!';
            $this->setStatisticStory("</br> ~ " . $this->winner);
            $this->notify();
        }
        else {
            $winner_army = $this->army_1;
            $this->winner .= 'The British army wins!';
            $this->setStatisticStory("</br> ~ " . $this->winner);
            $this->notify();
        }

        return $winner_army;
    }
    /**
     * Make fight between two units until one of them will die
     * @param UnitComposite $unit_1
     * @param UnitComposite $unit_2
     * @return UnitComposite object (dead unit)
     */
    public function unitFight(UnitComposite $unit_1, UnitComposite $unit_2)
    {
        while ($unit_1->getHp() > 0 and $unit_2->getHp() > 0){
            $hit_order_array = $this->hitOrder($unit_1, $unit_2);
            $first_unit = array_shift($hit_order_array);
            $second_unit = array_shift($hit_order_array);

            if ($this->criticalHit($first_unit, $second_unit)== true){
                break;
            }
            else{
                $this->damage($first_unit, $second_unit);
            }
        }
        return $this->findDeadUnit($unit_1,$unit_2);
    }
    /**
     * @param $unit1
     * @param $unit2
     * @return UnitCompositeObject (dead unit)
     */
    public function findDeadUnit($unit_1,$unit_2)
    {
        if ($unit_1->getHp() <= 0) {
            $unit_2->setFrags();
            if ((method_exists($unit_2, 'getFirstHit') and
                $unit_2->getFirstHit() == false)) {
                $unit_2->setFirstHit(true);
                $this->setStatisticStory("</br> ~ " . $unit_2->getYourArmy() .
                    " " . $unit_2->getUnitType() . " refresh his first hit ability");
                $this->notify();
            }
            $this->setStatisticStory("</br> ~ " . $unit_1->getYourArmy() .
                " " . $unit_1->getUnitType() . " dies!<br/>");
            $this->notify();
            return $unit_1;
        } else {
            $unit_1->setFrags();
            if ((method_exists($unit_1, 'getFirstHit') and
                $unit_1->getFirstHit() == false)) {
                $unit_1->setFirstHit(true);
                $this->setStatisticStory("</br> ~ " . $unit_1->getYourArmy() .
                    " " . $unit_1->getUnitType() . " refresh his first hit ability");
                $this->notify();
            }
            $this->setStatisticStory("</br> ~ " . $unit_2->getYourArmy() .
                " " . $unit_2->getUnitType() . " dies!<br/>");
            $this->notify();
            return $unit_2;
        }
    }

    public function getStatisticStory()
    {
        return $this->statistic_story;
    }

    public function setStatisticStory($string_value)
    {
        $this->statistic_story = $string_value;
        return true;
    }

    function attach(SplObserver $observer)
    {
        $this->storage->attach($observer);
    }

    function detach(SplObserver $observer)
    {
        $this->storage->detach($observer);
    }

    public function notify()
    {
        foreach ($this->storage as $obs){
            $obs->update($this);
        }
    }
    /**
    * String message of winner
    * @return string
    */
    public function getWinner()
    {
        return $this->winner;
    }
    /**
     * Army_1
     * @return array
     */
    public function getArmy_1()
    {
        return $this->army_1;
    }

    public function setArmy_1($new_value)
    {
        return $this->army_1 = $new_value;
    }
    /**
     * Army_2
     * @return array
     */
    public function getArmy_2()
    {
        return $this->army_2;
    }

    public function setArmy_2($new_value)
    {
    return $this->army_2 = $new_value;
    }
    /**
     * Join two armies into one array
     * @return array
     */
    public function getTwoArmies()
    {
        $two_armies_array = [];
        foreach ($this->getArmy_1() as $unit) {
            array_push($two_armies_array, $unit);
        }
        foreach ($this->getArmy_2() as $unit) {
            array_push($two_armies_array, $unit);
        }
        return $two_armies_array;
    }
    /**
     * Estimate animals in army array
     * @param $army_array
     * @return int
     */
    public static function getAnimalCount($army_array)
    {
        $animal_count=0;
        foreach ($army_array as $unit){
            if ($unit instanceof Animal){
                $animal_count++;
            }
        }
        return $animal_count;
    }
    /**
     * Estimate archers in army array
     * @param $army_array
     * @return int
     */
    public function getArchersCount($army_array)
    {
        $archers_count=0;
        foreach ($army_array as $unit){
            if ($unit instanceof Archers){
                $archers_count++;
            }
        }
        return $archers_count;
    }
    /**
     * Return certain unit`s army
     * @param $unit
     * @return array
     */
    public function armySearch($unit)
    {
        if (array_search($unit,$this->getArmy_1()) !== false){
            return $this->getArmy_1();
        }
        else{
            return $this->getArmy_2();
        }
    }
    /**
     * Check existing of firstHit method in units
     * If not - launch lot
     * @param UnitComposite $unit_1
     * @param UnitComposite $unit_2
     * @return array (two units - first and second)
     */
    public function hitOrder(UnitComposite $unit_1, UnitComposite $unit_2)
    {
        if (method_exists($unit_1,'getFirstHit') or
            (method_exists($unit_2, 'getFirstHit'))){
            $hit_order_array = FirstHit::firstHit($unit_1, $unit_2);
            return $hit_order_array;
        }
        $hit_order_array = self::lot($unit_1, $unit_2);
        return $hit_order_array;
    }
    /**
     * Launch lot
     * @param UnitComposite $unit_1
     * @param UnitComposite $unit_2
     * @return array (two units - first and second)
     * @throws Exception
     */
    static function lot (UnitComposite $unit_1, UnitComposite $unit_2)
    {
        $hit_order_array=[];

        $lot = random_int(0, 1);
        if ($lot == 0) {
            $first_unit = $unit_1;
            $second_unit = $unit_2;
        } else {
            $first_unit = $unit_2;
            $second_unit = $unit_1;
        }
        array_push($hit_order_array, $first_unit, $second_unit);
        return $hit_order_array;
    }
    /**
     * Make changes into UnitComposite object setHp()
     * @param $first_unit
     * @param $second_unit
     * @return bool
     */
    public function criticalHit($first_unit, $second_unit)
    {
        $critical_hit_chance = rand (1,10);
        if ($critical_hit_chance == 1) {
        $second_unit->setHp(0);
        $first_unit->setCriticalHits();
        $this->setStatisticStory("</br> ~ " . $first_unit->getYourArmy() .
            " " . $first_unit->getUnitType() . " makes critical hit!");
        $this->notify();
        return true;
        }
    }
    /**
     * Make changes into UnitComposite object setHp()
     * @param $first_unit
     * @param $second_unit
     * @return bool
     */
    public function damage ($first_unit, $second_unit)
    {
        $damage=$first_unit->unitAttack()-$second_unit->unitDefence();
        if ($damage>0){
            $second_unit->setHp($second_unit->getHp() - $damage);
        }
        $this->setStatisticStory("</br> ~ " . $first_unit->getYourArmy() .
            " " . $first_unit->getUnitType() . " hits " . $second_unit->getYourArmy() .
            " " . $second_unit->getUnitType());
        $this->notify();

        $first_unit_army = $this->armySearch($first_unit);
        $first_unit_archers_damage = 0;
        foreach ($first_unit_army as $unit) {
            if ($unit instanceof Archers) {
                $first_unit_archers_damage += $unit->unitAttack();
            }
        }
        if (($first_unit_archers_damage>0 and
            $this->getArchersCount($first_unit_army)>1 and
            $first_unit instanceof Archers) or 
            ($first_unit_archers_damage>0 and !$first_unit instanceof Archers)) {
            $second_unit->setHp($second_unit->getHp() - $first_unit_archers_damage /
                self::ARCHERS_ATTACK_RATIO);

            $this->setStatisticStory("</br> ~ " . $first_unit->getYourArmy() .
                " archers make additional damage");
            $this->notify();
        }
        return true;
    }
}
