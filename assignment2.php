<?php
    require_once __DIR__ . '/../includes/load_data.php';
    $characterDataset = load_data();

    // Opdracht 2: Kies één personage en toon al zijn/haar kenmerken (features).
    // Tip: Haal eerst de features op en loop er doorheen.
    // Toon per feature of het 'JA' (true) of 'NEE' (false) is.


require_once __DIR__ . '/../includes/load_data.php';
$characterDataset = load_data();

$character = $characterDataset['Mario'];

foreach ($character as $feature => $value) {

    if ($value == true) {
        echo $feature . ": JA<br>";
    } else {
        echo $feature . ": NEE<br>";
    }

}