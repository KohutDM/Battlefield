<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Battlefield Result</title>
</head>

<body>
<h1><?php echo $object_model_fight->getWinner(); ?><h1/>
<h2>Stats of the winner</h2>
<h2><?php
    foreach ($winner_army as $unit) {
    echo "<br/> Unit type-  " . $unit->getUnitType() . "<br/> HP - " . $unit->getHp() . "<br/> Frags - " . $unit->getFrags() .  "<br/> Critical hits - " .
        $unit->critical_hits . "<br/>";
    if (method_exists($unit, 'getFirstHitCount') and $unit->getFirstHitCount()>0){
        echo "First hit ability used - " . $unit->getFirstHitCount() . "<br/>";}
    elseif (method_exists($unit, 'getFirstHitCount') and $unit->getFirstHitCount()==0){
        echo "First hit ability not used" . "<br/>";
    }
    } ?></h2>
<h4><?php
    echo $statistic_watcher->getResultStatisticText();
    ?></h4>
</body>
</html>