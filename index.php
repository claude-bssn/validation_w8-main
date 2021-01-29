<?php

spl_autoload_register(function ($class) {
    require 'classes/' . $class . '.php';
});

$player1 = new Archer('Cloup');
$player2 = new Magician('Vivi');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Baston</title>
</head>
<body>
    <header>
        <h1 class='title'>La bataille des Champions </h1>
    </header>

    <div class="board">
    <div></div>
    <div>
    <?php while ($player1->isAlive() && $player2->isAlive()): ?>
        <div>
            <p class="player1"><?= $player1->turn($player2) ?></p>
            <?php $result = "$player1->name a gagné !" ?>
            <?php if ($player2->isAlive()): ?>
                <p class='player2'><?= $player2->turn($player1) ?></p>
                <?php $result = "$player2->name a gagné !" ?>
            <?php endif ?>
        </div>
    <?php endwhile ?>
    </div>
    <div></div>
</div>
<p class='result'><?= $result ?></p>
    
</body>
</html>
