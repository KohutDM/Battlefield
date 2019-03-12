<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

define('ROOT',dirname(__FILE__,2));
require_once (ROOT . '/components/Autoload.php');

$object_model_unit = new ModelUnit();

$army_1 = $object_model_unit->makeArmy($_POST);
$army_2 = $object_model_unit->makeArmy($_POST);


$errors = false;
 if (!ModelUnit::checkArmy($army_1) or !ModelUnit::checkArmy($army_2)) {
    $errors[] = 'The army should contain at least one unit!';
}
if (ModelUnit::checkAnimalsOnly($army_1) ===
    false and ModelUnit::checkAnimalsOnly($army_2) === false) {
    $errors[] = 'Two armies can not contain only animals!';
}   

if ($errors !== false) {
    require_once(ROOT.'/index.php');
    exit;
}

$army_1 = array_filter($army_1,'is_object');
$army_2 = array_filter($army_2,'is_object');

$object_model_fight = new ModelFight($army_1, $army_2);
$statistic_watcher = new StatisticWatcher();

$object_model_fight->attach($statistic_watcher);
$winner_army = $object_model_fight->armyFight();
try {
$statistic_watcher->makeStatisticFile();
}
catch (BattleException $exp){
    echo $exp->Message();
}
require (ROOT.'/result.php');
