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
    echo "<table>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Continent</th>";
    echo "<th>Independence Year</th>";
    echo "<th>Head of State</th>";
    echo "</tr>";
    foreach ($results as $row):
      echo "<tr>";
      echo "<td>" . $row['name'] . "</td>";
      echo "<td>" . $row['continent'] . "</td>";
      echo "<td>" . $row['independence_year'] . "</td>";
      echo "<td>" . $row['head_of_state'] . "</td>";
      echo "</tr>";
    endforeach;
    echo "</table>";
  }
  else {
    if (empty($nuquery)) {
      echo "<h3>Country query empty???</h3>";
    }
    else {
      if (isset($_GET["lookup"])) {
        $stmt = $conn->query("SELECT countries.name AS countries_name, cities.name AS cities_name, cities.district, cities.population FROM cities INNER JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE '%$nuquery';");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<table>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>District</th>";
        echo "<th>Population</th>";
        echo "</tr>";
        foreach ($results as $row):
          echo "<tr>";
          echo "<td>" . $row['cities_name'] . "</td>";
          echo "<td>" . $row['district'] . "</td>";
          echo "<td>" . $row['population'] . "</td>";
          echo "</tr>";
        endforeach;
        echo "</table>";
      }
      else {
        $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$nuquery%';");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<table>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Continent</th>";
        echo "<th>Independence Year</th>";
        echo "<th>Head of State</th>";
        echo "</tr>";
        foreach ($results as $row):
          echo "<tr>";
          echo "<td>" . $row['name'] . "</td>";
          echo "<td>" . $row['continent'] . "</td>";
          echo "<td>" . $row['independence_year'] . "</td>";
          echo "<td>" . $row['head_of_state'] . "</td>";
          echo "</tr>";
        endforeach;
        echo "</table>";        
      }
    }
  }
}
else {
  echo "<table>";
  echo "<tr>";
  echo "<th>Name</th>";
  echo "<th>Continent</th>";
  echo "<th>Independence Year</th>";
  echo "<th>Head of State</th>";
  echo "</tr>";
  foreach ($results as $row):
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['continent'] . "</td>";
    echo "<td>" . $row['independence_year'] . "</td>";
    echo "<td>" . $row['head_of_state'] . "</td>";
    echo "</tr>";
  endforeach;
  echo "</table>";
}
?>