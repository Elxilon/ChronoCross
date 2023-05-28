<?php

/*
require "database.php";
$db = new Database();
$courses = $db->getAllCourses();
*/

$token_icon = [
    '1' => "img/hourglass_empty.svg",
    '2' => "img/hourglass_top.svg",
    '3' => "img/hourglass_top.svg",
    '4' => "img/hourglass_top.svg",
    '5' => "img/hourglass_top.svg",
    '6' => "img/hourglass_bottom.svg",
];

// temporaire, à enlever quand BDD connectée
$courses = [
    [
        'id' => 0,
        'token' => 1,
        'nom' => "course_1",
        'distance' => 10,
        'heure_depart' => null,
        'heure_depart_theorique' => getdate(),
    ],
    [
        'id' => 1,
        'token' => 2,
        'nom' => "course_2",
        'distance' => 8,
        'heure_depart' => getdate(),
        'heure_depart_theorique' => getdate(),
    ],
    [
        'id' => 2,
        'token' => 6,
        'nom' => "course_3",
        'distance' => 26,
        'heure_depart' => getdate(),
        'heure_depart_theorique' => getdate(),
    ],
    [
        'id' => 3,
        'token' => 6,
        'nom' => "course_4",
        'distance' => 22,
        'heure_depart' => getdate(),
        'heure_depart_theorique' => getdate(),
    ],
    [
        'id' => 4,
        'token' => 6,
        'nom' => "course_5",
        'distance' => 26,
        'heure_depart' => getdate(),
        'heure_depart_theorique' => getdate(),
    ],
    [
        'id' => 5,
        'token' => 6,
        'nom' => "course_6",
        'distance' => 26,
        'heure_depart' => getdate(),
        'heure_depart_theorique' => getdate(),
    ]
]

?>

<!DOCTYPE html>
<html lang="en">
 <head>
    <title>Chronocross</title>
    <link rel="stylesheet" type="text/css" href="style.css">
 </head>

 <body>
    <div id="container">
        <div id="title">
            <img src="img/running.svg" />
            <h1>ChronoCross</h1>
        </div>
        <div id="array-header">
            <div class="column_type">
                <img src="img/nom.svg" />
                <p>Nom</p>
            </div>
            <div class="column_type column_sized">
                <img src="img/dist.svg" />
                <p>Distance</p>
            </div>
            <div class="column_type column_sized">
                <img src="img/timer.svg" />
                <p>Heure départ</p>
            </div>
        </div>
        <div id="array-content">
            <?php foreach ($courses as $course): ?>
            <div class="array-item">
                <p class="item-name">
                    <img src="<?= $token_icon[$course['token']] ?>">
                    <?= $course['nom'] ?>
                </p>
                <p class="column_sized"><?= $course['distance'] ?> km</p>
                <p style="max-width: 135px">
                    <?= isset($course['heure_depart']) ?
                        $course['heure_depart']["hours"] . "h" . $course['heure_depart']["minutes"] :
                        $course['heure_depart_theorique']["hours"] . "h" . $course['heure_depart_theorique']["minutes"] ?>
                </p>
            </div>
            <div class="array-item-results hide">
                <div class="coureur-item">
                    <img src="img/medal-1.svg" />
                    <div>
                        <p class="coureur-name">DUTROUC Marc</p>
                        <p class="coureur-time">1:69:042</p>
                    </div>
                </div>
                <div class="coureur-item">
                    <img src="img/medal-2.svg" />
                    <div>
                        <p class="coureur-name">DUPONT DE LIGONNES Xavier</p>
                        <p class="coureur-time">1:42:069</p>
                    </div>
                </div>
                <div class="coureur-item">
                    <img src="img/medal-3.svg" />
                    <div>
                        <p class="coureur-name">SPIGARELLI Thomas</p>
                        <p class="coureur-time">UNKWOWN</p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script type="text/javascript" src="script.js"></script>
 </body>
</html>

