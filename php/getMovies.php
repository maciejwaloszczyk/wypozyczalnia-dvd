<?php
  include "../php/creds.php";
  $db = new mysqli('localhost:3306', USER, PASSWD, DBNAME);
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }
  

  $sql = "SELECT * FROM videos";

  if (isset($_POST['genre']) || isset($_POST['director']) || isset($_POST['releaseYear'])) {
    $genre = $_POST['genre'];
    $director = $_POST['director'];
    $releaseYear = $_POST['releaseYear'];

  if (!empty($genre)) {
    $sql .= " WHERE genre='" . $genre . "'";
  }
  if (!empty($director)) {
    if (strpos($sql, 'WHERE') === false) {
      $sql .= " WHERE director='" . $director . "'";
    } else {
      $sql .= " AND director='" . $director . "'";
    }
  }
  if (!empty($releaseYear)) {
    if (strpos($sql, 'WHERE') === false) {
      $sql .= " WHERE releaseYear='" . $releaseYear . "'";
    } else {
      $sql .= " AND releaseYear='" . $releaseYear . "'";
    }
  }}

  $result = $db->query($sql);
  if ($result->num_rows > 0) {
    echo "<div class='row gx-4 gx-lg-5'>";
    $i = 1;
    while ($row = $result->fetch_assoc()) {
      echo "<div class='col-md-4 mb-5'>";
      echo "<div class='card h-100'>";
      echo "<div class='card-body'>";
      echo "<h2 class='card-title'>" . $row['title'] . "</h2>";
      echo "<p class='card-text'> " . $row['genre'] . "</p>";
      echo "</div>";
      echo "<div class='nav-link' href='#!'><img class='mx-auto d-block col-md-11 mb-5' src='" . $row['photoDirectory'] . "'/></a></div>";
      echo "<div class='card-footer text-center'><a class='btn btn-light' href='../pages/moviePage.php?id=". $row['id'] . "'>Więcej informacji</a></div>";
      echo "</div>";
      echo "</div>";
      if ($i % 3 == 0 && $i != $result->num_rows) {
        echo "</div><div class='row gx-4 gx-lg-5'>";
      }
      $i++;
    }
    echo "</div>";
  } else {
    echo "<div class='no-movies-found-message'><h4>Nie znaleziono filmów według wybranych kategorii</h4></div>";
    echo "</div>";
  }

  $db->close();
?>
