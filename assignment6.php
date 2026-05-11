<?php
    require_once __DIR__ . '/../includes/load_data.php';
    $characterDataset = load_data();

    // Opdracht 6: Kies een willekeurig personage en toon zijn/haar afbeelding.
    // Tip: Gebruik de array_rand() functie om een willekeurige key uit de array te halen.

unset($characterDataset['_feature_order']);

$randomName = array_rand($characterDataset);
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>willekeurig personage</title>
</head>
<body>

<h1><?= $randomName ?></h1>

<img src="../images/<?= $randomName ?>.png" alt="<?= $randomName ?>">

</body>
</html>