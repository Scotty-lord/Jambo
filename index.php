<?php
include 'inc/header.php';
include 'classes/dice.php';
include 'classes/player.php';
$tieCounter = 0;
$diceRounds = 10;
$player1Dice = new Dice(6);
$player2Dice = new Dice(6);
$player1 = new Players('Joueur 1', 'player1-color');
$player2 = new Players('Joueur 2', 'player2-color');

if (!array_key_exists('pseudo1', $_GET) ||
    !array_key_exists('pseudo2', $_GET) ||
    !array_key_exists('rounds', $_GET) ||
    !array_key_exists('faces', $_GET)) { ?>
<?php 
} ?>
<p class="text-center text-white text-bold">Veuillez entrer les informations pour jouer</p>
<div class="container player-form">
    <form method="get">
        <table>
            <tr>
            <td><label for="pseudo1">Nom du joueur 1:</label></td>
            <td><input type="text" name="pseudo1"></td>
            </tr>
            <tr>
            <td><label for="pseudo2">Nom du joueur 2:</label></td>
            <td><input type="text" name="pseudo2"></td>
            </tr>
            <tr>
            <tr>
            <td><label for="faces">Combien de face doit avoir votre dé?</label></td>
            <td><input class="w-50" type="text" name="faces"></td>
            </tr>
            <tr>
            <tr>
            <td><label for="rounds">combien de Round voulez vous?</label></td>
            <td><input class="w-50" type="text" name="rounds"></td>
            </tr>
            <tr>
            <td><input class="btn btn-primary" type="submit" value="Lancé!"></td>
            <td></td>
            </tr>
        </table>
    </form>
</div>

<?php
if (!empty($_GET['pseudo1'])) {
    $player1->setName($_GET['pseudo1']);
}
if (!empty($_GET['pseudo2'])) {
    $player2->setName($_GET['pseudo2']);
}
if (!empty($_GET['rounds'])) {
    $diceRounds = intval($_GET['rounds']);
}
if (!empty($_GET['faces'])) {
    $player1Dice->setSides(intval($_GET['faces']));
    $player2Dice->setSides(intval($_GET['faces']));
}
?>

</div>
<table border=1>
    <tr>
        <th class="bg-primary">
            # Lancé
        </th>
        <th class="player1-color">
            <?= $player1->getName() ?> a lancé
        </th>
        <th class="player2-color">
            <?= $player2->getName() ?> a lancé
        </th>
        <th class="bg-primary">
            Résultats
        </th>
    </tr>

<?php
        // lancé de dé
    for ($i = 1; $i <= $diceRounds; $i++) {
       $player1Dice->roll();
       $player2Dice->roll();
    ?>
        <tr>
            <td>
                <span class="badge badge-warning">
                        <?= $i ?>
                    </span>
                </td>
                <td>
                    <img src="images/<?php echo $player1Dice->get_face_value(); ?>.png" alt="<?php echo $player1Dice->get_face_value(); ?>">
                </td>
                <td>
                    <img src="images/<?php echo $player2Dice->get_face_value(); ?>.png" alt="<?php echo $player2Dice->get_face_value(); ?>">
                </td>

                <?php
                if ($player1Dice->get_face_value() > $player2Dice->get_face_value()) {
                ?>
                    <td class="<?= $player1->getColor() ?>">
                        <img src="images/<?php echo $player1Dice->get_face_value(); ?>.png" alt="<?php echo $player1Dice->get_face_value(); ?>">
                    </td>
                    <?php $player1Dice->score += 1; ?>

                <?php

                } else if ($player1Dice->get_face_value() == $player2Dice->get_face_value()) {
                ?>
                    <td class="tie-color">
                        égalité!
                    </td>
                    <?php $tieCounter += 1; ?>
                <?php

                } else {
                ?>
                    <td class="<?= $player2->getColor() ?>">
                        <img src="dice_images/<?php echo $player2Dice->get_face_value(); ?>.png" alt="<?php echo $player2Dice->get_face_value(); ?>">
                    </td>
                    <?php $player2Dice->score += 1 ?>

                <?php

} ?>
    </tr>
    <?php

} ?>
</table>
<div class="score">
    <h4><?= $player1->getName() ?> Score :
    <span class="badge badge-primary"><?= $player1Dice->score ?></span></h4>
    <h4><?= $player2->getName() ?> score : 
    <span class="badge badge-primary"><?= $player2Dice->score ?></span></h4>
    <h4>Il y a <?= $tieCounter ?> egalité !</h4>
<?php
if ($player1Dice->score > $player2Dice->score) { ?>
    <h4>Le vainqueur est : 
    <span class="badge badge-success">
    <?= $player1->getName() ?>
    </span>
    </h4>
<?php

} else if ($player1Dice->score == $player2Dice->score) { ?>
     <h4>Il y a  
     <span class="badge badge-danger">
     égalité
     </span>
     </h4>
<?php

} else { ?>
     <h4>Le vainqueur est : 
     <span class="badge badge-success">
     <?= $player2->getName() ?>
     </span>
     </h4>
<?php

}
?>
</div>
<?php
include 'inc/footer.php';
?>