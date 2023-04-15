<?php
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
    echo "<div style='display: flex; flex-wrap: wrap;'>";
    while ($row = $result->fetch_assoc()) {
      echo "<div style='width: 33.33%; box-sizing: border-box; padding: 10px;'>";
      echo "<a href='moviePage.php?id=" . $row['id'] . "'><h3>" . $row['title'] . "</h3></a>";
      echo "<p>Genre: " . $row['genre'] . "</p>";
      echo "<p>Director: " . $row['director'] . "</p>";
      echo "<p>Release Year: " . $row['releaseYear'] . "</p>";
      echo "<a href='moviePage.php?id=" . $row['id'] . "'><img src='" . $row['photoDirectory'] . "' style='width: 100%;'></a>";
      echo "<a class='btn btn-primary btn-sm' href='moviePage.php?id=" . $row['id'] . "'>More info</a>";
      echo "</div>";
    }
    echo "</div>";
  } else {
    echo "No movies found";
  }

  $db->close();
?>
