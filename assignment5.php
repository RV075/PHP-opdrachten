<?php
    require_once __DIR__ . '/../includes/load_data.php';
    $characterDataset = load_data();

    // Opdracht 5: Toon alle personages met hun afbeelding.
    // Tip: De images staan in de map '../images/' en hebben de naam van het personage + '.png'.
    // Gebruik HTML om de lijst en images weer te geven.
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>alle personages</title>

    <style>
        .character {
            display: inline-block;
            margin: 10px;
            text-align: center;
        }

        img {
            width: 120px;
        }
    </style>
</head>
<body>

<h1>alle personages</h1>

<?php foreach ($characterDataset as $name => $data): ?>

    <?php if ($name === '_feature_order') continue; ?>

    <div class="character">
        <img src="../images/<?= $name ?>.png" alt="<?= $name ?>">
        <p><?= $name ?></p>
    </div>

<?php endforeach; ?>

</body>
</html>
