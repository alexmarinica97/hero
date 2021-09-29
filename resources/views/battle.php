<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hero Game</title>
</head>

<?php
$firstOpponent = \App\models\Character::findOrFail($battle->first_opponent_id);
$secondOpponent = \App\models\Character::findOrFail($battle->second_opponent_id);
$beforeFirstRound = \App\models\Round::where('battle_id', $battle->id)->where('number', 0)->firstOrFail();
$firstOpponentStats = $firstOpponent->id == $beforeFirstRound->attacker_stats['id'] ? $beforeFirstRound->attacker_stats : $beforeFirstRound->defender_stats;
$secondOpponentStats = $secondOpponent->id == $beforeFirstRound->attacker_stats['id'] ? $beforeFirstRound->attacker_stats : $beforeFirstRound->defender_stats;
?>

<body style="background-color: #e2e2e2">
<div class="container">
    <div class="card w-100 text-center my-4 mx-auto">
        <div class="card-header">
            <h3 class="font-weight-bolder">Battle #<?=$battle->number?></h3>
        </div>
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="font-weight-bolder">First Fighter: </h5>
                    <h5><?=$firstOpponent->name?></h5>
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseFirstOpponent" role="button" aria-expanded="false" aria-controls="collapseFirstOpponent">
                        Stats
                    </a>
                    <div class="collapse my-2" id="collapseFirstOpponent" style="width: 280px">
                        <div class="card card-body">
                            <div class="d-flex justify-content-between">
                                <a class="font-weight-bolder">
                                    Health:
                                </a>
                                <a><?=$firstOpponentStats['health']?></a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a class="font-weight-bolder">
                                    Strength:
                                </a>
                                <a><?=$firstOpponentStats['strength']?></a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a class="font-weight-bolder">
                                    Defence:
                                </a>
                                <a><?=$firstOpponentStats['defence']?></a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a class="font-weight-bolder">
                                    Speed:
                                </a>
                                <a><?=$firstOpponentStats['speed']?></a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a class="font-weight-bolder">
                                    Luck:
                                </a>
                                <a><?=$firstOpponentStats['luck']?></a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a class="font-weight-bolder">
                                    Skills:
                                </a>
                                <a>
                                    <?php if ($firstOpponentStats['skills']):?>
                                    <?php foreach ($firstOpponentStats['skills'] as $skill):?>
                                        <?=$skill['name'] . ' '?>
                                    <?php endforeach;?>
                                    <?php else:?>
                                    None
                                    <?php endif;?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h5 class="font-weight-bolder">Second Fighter: </h5>
                    <h5><?=$secondOpponent->name?></h5>
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseSecondOpponent" role="button" aria-expanded="false" aria-controls="collapseSecondOpponent">
                        Stats
                    </a>
                    <div class="collapse my-2" id="collapseSecondOpponent" style="width: 280px">
                        <div class="card card-body">
                            <div class="d-flex justify-content-between">
                                <a class="font-weight-bolder">
                                    Health:
                                </a>
                                <a><?=$secondOpponentStats['health']?></a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a class="font-weight-bolder">
                                    Strength:
                                </a>
                                <a><?=$secondOpponentStats['strength']?></a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a class="font-weight-bolder">
                                    Defence:
                                </a>
                                <a><?=$secondOpponentStats['defence']?></a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a class="font-weight-bolder">
                                    Speed:
                                </a>
                                <a><?=$secondOpponentStats['speed']?></a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a class="font-weight-bolder">
                                    Luck:
                                </a>
                                <a><?=$secondOpponentStats['luck']?></a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a class="font-weight-bolder">
                                    Skills:
                                </a>
                                <a>
                                    <?php if ($secondOpponentStats['skills']):?>
                                        <?php foreach ($secondOpponentStats['skills'] as $skill):?>
                                            <?=$skill['name'] . ' '?>
                                        <?php endforeach;?>
                                    <?php else:?>
                                        None
                                    <?php endif;?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <?php foreach($battle->rounds()->get() as $round):
                    $attacker = \App\models\Character::findOrFail($round->attacker_id);
                    $defender = \App\models\Character::findOrFail($round->defender_id); ?>
                <?php if ($round->number > 0):?>
                    <li class="list-group-item">
                        <h5 class="font-weight-bolder">Round #<?=$round->number?></h5>
                        <div class="d-flex justify-content-between">
                            <div>
                                <a>
                                    Attacker
                                </a>
                                <b>
                                    <?=$attacker->name?>
                                </b>
                            </div>
                            <div>
                                <a>
                                    Defender
                                </a>
                                <b>
                                    <?=$defender->name?>
                                </b>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div>Lucky:</div>
                            <div>
                                <b><?=$round->is_luck ? 'Yes' : 'No'?></b>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div>Damage:</div>
                            <div>
                                <b><?=isset($round->attacker_stats['damage']) && $round->attacker_stats['damage'] ? $round->attacker_stats['damage'] : '' ?></b>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div>Any skills used:</div>
                            <div>
                                <?php
                                $anySkillUsed = false;
                                if ($round->attacker_stats['skills']) {
                                    foreach ($round->attacker_stats['skills'] as $skill) {
                                        if ($skill['used'] && $skill['usage'] == \App\models\Skill::USAGE_ATTACK) {
                                            $anySkillUsed = true;
                                            echo "<b>Yes, attacker used " . $skill['name'] .  "</b>";
                                        }
                                    }
                                }
                                if ($round->defender_stats['skills']) {
                                    foreach ($round->defender_stats['skills'] as $skill) {
                                        if ($skill['used'] && $skill['usage'] == \App\models\Skill::USAGE_DEFENCE) {
                                            $anySkillUsed = true;
                                            echo "<b>Yes, defender used " . $skill['name'] . "</b>";
                                        }
                                    }
                                }
                                if (!$anySkillUsed) {
                                    echo '<b>No</b>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                Health
                                <b><?=$round->attacker_stats['health']?></b>
                            </div>
                            <div>
                                Health
                                <b><?=$round->defender_stats['health']?></b>
                            </div>
                        </div>
                    </li>
                <?php endif;?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="card-footer">
            <?php if ($battle->winner_id):?>
                <h5>
                    The winner is <?php if($firstOpponent->id == $battle->winner_id):?>
                        <?=$firstOpponent->name?>
                    <?php else:?>
                        <?=$secondOpponent->name?>
                    <?php endif;?>
                </h5>
            <?php else:?>
            <h5 class="font-weight-bolder">We have a draw!</h5>
            <?php endif;?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>