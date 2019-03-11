<?php
class UnitFactory
{
    const PIKEMAN = 'Pikeman';

    const BEAR = 'Bear';

    const SLINGSHOOTER = 'SlingShooter';

    static function makeUnit($unit_name)
    {
       $army_number = substr($unit_name, 0, 1);
       $name = substr($unit_name,1);
       switch ($name){
           case self::BEAR:
               return new Bear($army_number);
           case self::PIKEMAN:
               return new Pikeman($army_number);
           case self::SLINGSHOOTER:
               return new SlingShooter($army_number);
       }
    }
}