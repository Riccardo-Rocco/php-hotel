<?php

include 'alberghi_data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $minVote = isset($_POST['min_vote']) ? (int)$_POST['min_vote'] : 0;

    $filteredHotels = array_filter($hotels, function ($hotel) use ($minVote) {
        return $hotel['vote'] >= $minVote;
    });
} else {
    $filteredHotels = $hotels;
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Ricerca Hotel</title>
</head>
<body>

<div class="container">
    <h2>Ricerca Hotel</h2>
    <a href="alberghi.php">Torna a Informazioni sugli Hotel</a>
    <form method="post">
        <div class="mb-3">
            <label for="min_vote" class="form-label">Voto minimo:</label>
            <input type="number" class="form-control" id="min_vote" name="min_vote" min="0" value="<?= $minVote ?? '' ?>">
        </div>
        <button type="submit" class="btn btn-primary">Cerca</button>
    </form>

    <h2>Risultati</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrizione</th>
                <th>Parcheggio</th>
                <th>Voto</th>
                <th>Distanza dal centro</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filteredHotels as $hotel): ?>
                <tr>
                    <td><?= $hotel['name'] ?></td>
                    <td><?= $hotel['description'] ?></td>
                    <td><?= $hotel['parking'] ? 'Sì' : 'No' ?></td>
                    <td><?= $hotel['vote'] ?></td>
                    <td><?= $hotel['distance_to_center'] ?> km</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
