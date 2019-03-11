<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Battlefield</title>
</head>

<body>
<?php
if (isset($errors) && is_array($errors)): ?>
    <ul>
    <?php foreach ($errors as $error): ?>
    <li> <?php echo $error; ?></li>
    <?php endforeach; ?>
    </ul>
    <?php endif; ?>

<form method="post" action="<?php echo
'/Battlefield/controllers/BattlefieldController.php'?>">

    <h2>Create British army</h2>

    <p><select name="unit1">
    <p><option value=""></option></p>
    <p><option value="1Pikeman">Pikeman</option></p>
    <p><option value="1Bear">Bear</option></p>
    <p><option value="1SlingShooter">SlingShooter</option></p>
    </select></p>

    <p><select name="unit2">
    <p><option value=""></option></p>
    <p><option value="1Pikeman">Pikeman</option></p>
    <p><option value="1Bear">Bear</option></p>
    <p><option value="1SlingShooter">SlingShooter</option></p>
    </select></p>

    <p><select name="unit3">
    <p><option value=""></option></p>
    <p><option value="1Pikeman">Pikeman</option></p>
    <p><option value="1Bear">Bear</option></p>
    <p><option value="1SlingShooter">SlingShooter</option></p>
    </select></p>

    <p><select name="unit4">
    <p><option value=""></option></p>
    <p><option value="1Pikeman">Pikeman</option></p>
    <p><option value="1Bear">Bear</option></p>
    <p><option value="1SlingShooter">SlingShooter</option></p>
    </select></p>

    <p><select name="unit5">
    <p><option value=""></option></p>
    <p><option value="1Pikeman">Pikeman</option></p>
    <p><option value="1Bear">Bear</option></p>
    <p><option value="1SlingShooter">SlingShooter</option></p>
    </select></p>


    <h2>Create the German army</h2>

    <p><select name="unit6">
    <p><option value=""></option></p>
    <p><option value="2Pikeman">Pikeman</option></p>
    <p><option value="2Bear">Bear</option></p>
    <p><option value="2SlingShooter">SlingShooter</option></p>
    </select></p>

    <p><select name="unit7">
    <p><option value=""></option></p>
    <p><option value="2Pikeman">Pikeman</option></p>
    <p><option value="2Bear">Bear</option></p>
    <p><option value="2SlingShooter">SlingShooter</option></p>
    </select></p>

    <p><select name="unit8">
    <p><option value=""></option></p>
    <p><option value="2Pikeman">Pikeman</option></p>
    <p><option value="2Bear">Bear</option></p>
    <p><option value="2SlingShooter">SlingShooter</option></p>
    </select></p>

    <p><select name="unit9">
    <p><option value=""></option></p>
    <p><option value="2Pikeman">Pikeman</option></p>
    <p><option value="2Bear">Bear</option></p>
    <p><option value="2SlingShooter">SlingShooter</option></p>
    </select></p>

    <p><select name="unit10">
    <p><option value=""></option></p>
    <p><option value="2Pikeman">Pikeman</option></p>
    <p><option value="2Bear">Bear</option></p>
    <p><option value="2SlingShooter">SlingShooter</option></p>
    </select></p>

    <input type="submit" name="submit" value="ENTER"/>

</form>
</body>
</html>

