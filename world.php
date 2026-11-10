<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// define country
$country = $_GET['country'] ?? '';
$lookup = $_GET['lookup'] ?? '';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Choose the appropriate sql query
if($lookup === 'cities') {
  $sql = "SELECT ci.name AS city,
                  ci.district,
                  ci.population
          FROM countries c
          JOIN cities ci 
            ON c.code = country_code
          WHERE c.name LIKE :country";
} else {
  $sql = "SELECT * 
          FROM countries 
          WHERE name LIKE :country";

}

$stmt = $conn->prepare($sql);
$stmt->execute(['country' => "%$country%"]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php if($lookup === 'cities'): ?>

  <table>
    <tr>
      <th>Name</th>
      <th>District</th>
      <th>Population</th>
    </tr>

    <?php foreach ($results as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['city']) ?></td>
        <td><?= htmlspecialchars($row['district']) ?></td>
        <td><?= htmlspecialchars((string)$row['population']) ?></td>
      </tr>
    <?php endforeach; ?>
  </table>

<?php else: ?>
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
<?php endif; ?>

