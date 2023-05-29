<?php
//require "Database.php";
//$db = new Database();
?>

<script>
    setInterval(() => {
        <?php // $courses = $db->getAllCourses(); ?>
    }, 1000);
</script>

<?php
$token_icon = [
    '1' => "img/hourglass_empty.svg",
    '2' => "img/hourglass_top.svg",
    '3' => "img/hourglass_top.svg",
    '4' => "img/hourglass_top.svg",
    '5' => "img/hourglass_top.svg",
    '6' => "img/hourglass_bottom.svg",
];

$medal_icon = [
    '1' => "img/medal-1.svg",
    '2' => "img/medal-2.svg",
    '3' => "img/medal-3.svg",
];

// temporaire, à commenter quand BDD connectée
$courses = [
    [
        'id' => 0,
        'token' => 1,
        'nom' => "course_1",
        'distance' => 10,
        'heure_depart' => null,
        'heure_depart_theorique' => '10:40:00',
        'coureurs' => [
            [
                'nom_prenom' => 'DUTROUC Marc',
                'Temps' => '14:40:00',
                'Classement' => 1,
            ],
            [
                'nom_prenom' => 'DUPONT DE LIGONNES Xavier',
                'Temps' => '14:50:00',
                'Classement' => 2,
            ],
            [
                'nom_prenom' => 'SPIGARELLI Thomas',
                'Temps' => '12:00:00',
                'Classement' => 3,
            ],
        ],
    ],
    [
        'id' => 1,
        'token' => 2,
        'nom' => "course_2",
        'distance' => 8,
        'heure_depart' => '11:40:00',
        'heure_depart_theorique' => '11:40:00',
        'coureurs' => [],
    ],
    [
        'id' => 2,
        'token' => 6,
        'nom' => "course_3",
        'distance' => 26,
        'heure_depart' => '9:40:00',
        'heure_depart_theorique' => '9:40:00',
        'coureurs' => [],
    ],
    [
        'id' => 3,
        'token' => 6,
        'nom' => "course_4",
        'distance' => 22,
        'heure_depart' => '8:40:00',
        'heure_depart_theorique' => '8:40:00',
        'coureurs' => [],
    ],
    [
        'id' => 4,
        'token' => 6,
        'nom' => "course_5",
        'distance' => 26,
        'heure_depart' => '11:40:00',
        'heure_depart_theorique' => '11:40:00',
        'coureurs' => [],
    ],
    [
        'id' => 5,
        'token' => 6,
        'nom' => "course_6",
        'distance' => 26,
        'heure_depart' => null,
        'heure_depart_theorique' => '11:40:00',
        'coureurs' => [],
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
                    <?= date("h\hi A", strtotime($course['heure_depart'] ?? $course['heure_depart_theorique'])); ?>
                </p>
            </div>
            <div class="array-item-results hide">
                <?php
                // si la liste n'est pas vide on liste les coureurs qui ont finit la course,
                // sinon on n'affiche qu'un texte générique
                if (!empty($course['coureurs'])) : ?>
                <?php foreach ($course['coureurs'] as $coureur) : ?>
                    <div class="coureur-item">
                        <img src="<?= $medal_icon[$coureur['Classement']] ?>" />
                        <div>
                            <p class="coureur-name"><?= $coureur['nom_prenom'] ?></p>
                            <p class="coureur-time"><?= $coureur['Temps'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php else : ?>
                    <p>Aucun coureur n'a terminé la course...</p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script type="text/javascript" src="script.js"></script>
 </body>
</html>
