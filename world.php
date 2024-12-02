<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["country"])) {
  $slimquery = trim($_GET["country"]);
  $nuquery = filter_var($slimquery, FILTER_SANITIZE_STRING);
  if (empty($nuquery) || $nuquery == "" || $nuquery == " ") {
    echo "<ul>";
    foreach ($results as $row): 
      echo "<li>" . $row['name'] . " is ruled by" . $row['head_of_state'] . "</li>";
    endforeach;
    echo "</ul>";
  }
  else {
    if (empty($nuquery)) {
      echo "<h3>Country query empty???</h3>";
    }
    else {
      $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$nuquery%';");
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      echo "<ul>";
      foreach ($results as $row): 
        echo "<li>" . $row['name'] . " is ruled by" . $row['head_of_state'] . "</li>";
      endforeach;
      echo "</ul>";
    }
  }
}
else {
  echo "<ul>";
  foreach ($results as $row): 
    echo "<li>" . $row['name'] . " is ruled by" . $row['head_of_state'] . "</li>";
  endforeach;
  echo "</ul>";
}
?>