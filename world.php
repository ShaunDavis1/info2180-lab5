<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// define country
$country = $_GET['country'] ?? '';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$sql = "SELECT * FROM countries WHERE name LIKE :country";

$stmt = $conn->prepare($sql);
$stmt->execute(['country' => "%$country%"]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<table>
    <tr>
        <th>Name</th>
        <th>Continent</th>
        <th>Independence</th>
        <th>Head of State</th>
    </tr>

    <?php foreach ($results as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['continent']) ?></td>
            <td><?= htmlspecialchars((string)($row['independence_year'] ?? '')) ?></td>
            <td><?= htmlspecialchars($row['head_of_state'] ?? '') ?></td>
        </tr>
    <?php endforeach; ?>
</table>
