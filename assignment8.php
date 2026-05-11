<?php
    session_start();
    require_once __DIR__ . '/../includes/load_data.php';
    $characterDataset = load_data();

    // Opdracht 7: Bouw het "Wie is het?" spel.
    // 1. Kies een willekeurig personage en sla dit op in de sessie.
    // 2. Maak een formulier waarmee de speler een feature kan kiezen om te vragen.
    // 3. Vergelijk de gekozen feature met die van het geheime personage.
    // 4. Geef antwoord ("Ja" of "Nee").
    // 5. Filter de lijst van overgebleven kandidaten op basis van het antwoord.
    // 6. Toon de overgebleven kandidaten.
    // 7. Voeg een reset-knop toe om een nieuw spel te starten.

unset($characterDataset['_feature_order']);

// Nieuw spel starten
if (isset($_POST['reset'])) {

    unset($_SESSION['secretCharacter']);
    unset($_SESSION['remainingCharacters']);
}

// Geheime personage kiezen
if (!isset($_SESSION['secretCharacter'])) {

    $randomName = array_rand($characterDataset);

    $_SESSION['secretCharacter'] = $randomName;
    $_SESSION['remainingCharacters'] = array_keys($characterDataset);
}

$secretCharacter = $_SESSION['secretCharacter'];

$result = null;

// Vraag verwerken
if (isset($_POST['feature'])) {

    $feature = $_POST['feature'];

    $secretFeatures = $characterDataset[$secretCharacter]['features'];

    if ($secretFeatures[$feature] == 1) {

        $result = "Ja";

        $_SESSION['remainingCharacters'] = array_filter(
                $_SESSION['remainingCharacters'],
                function ($name) use ($characterDataset, $feature) {

                    return $characterDataset[$name]['features'][$feature] == 1;
                }
        );

    } else {

        $result = "Nee";

        $_SESSION['remainingCharacters'] = array_filter(
                $_SESSION['remainingCharacters'],
                function ($name) use ($characterDataset, $feature) {

                    return $characterDataset[$name]['features'][$feature] == 0;
                }
        );
    }
}

$remainingCharacters = $_SESSION['remainingCharacters'];

$features = [
        "man",
        "woman",
        "hair_blond",
        "hair_brown",
        "hair_black",
        "hair_red",
        "hair_white",
        "bald",
        "mustache",
        "beard",
        "glasses",
        "hat",
        "earrings"
];

?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Guess Who – Board Game</title>
    <!-- je mag met AI een passende CSS thema genereren -->
    <style>
        body {
            font-family: "Verdana", "Segoe UI", sans-serif
            padding: 20px;
        }

        .board {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .card {
            border: 1px solid #ccc;
            padding: 10px;
            width: 120px;
            text-align: center;
        }

        img {
            width: 100px;
        }
    </style>
</head>
<body>
    <!-- Hier komt de HTML voor je spel. Bouw de interface met de game board, de vragen en de kandidaten. -->
    <h1>Wie is het?</h1>

    <form method="post">

        <select name="feature">

            <?php foreach ($features as $feature): ?>

                <option value="<?= $feature ?>">
                    <?= $feature ?>
                </option>

            <?php endforeach; ?>

        </select>

        <button type="submit">
            Vraag stellen
        </button>

    </form>

    <?php if ($result !== null): ?>

        <h2>Antwoord: <?= $result ?></h2>

    <?php endif; ?>

    <form method="post">

        <button type="submit" name="reset">
            Nieuw spel
        </button>

    </form>

    <h2>Overgebleven kandidaten</h2>

    <div class="board">

        <?php foreach ($remainingCharacters as $name): ?>

            <div class="card">

                <img src="../images/<?= $name ?>.png" alt="<?= $name ?>">

                <p><?= $name ?></p>

            </div>

        <?php endforeach; ?>

    </div>
</body>
</html>
