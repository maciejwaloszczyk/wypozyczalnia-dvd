<?php
  session_start();
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

  $res=$db->query("SELECT videos.*,COUNT(videos.id) as num FROM rental_data JOIN videos ON videos.id=id_film GROUP BY id_film ORDER BY num DESC;")->fetch_all(MYSQLI_ASSOC);

  $result = $db->query($sql);
  if ($result->num_rows > 0) {
    echo "<div class='row gx-4 gx-lg-5'>";
    $i = 1;
    while ($row = $result->fetch_assoc()) {
      if (isset($_SESSION["user"])) {
          $conn = new mysqli('localhost:3306', USER, PASSWD, DBNAME);
          $isLoaned = $conn->query("SELECT * FROM rental_data WHERE id_film=" . $row["id"] . " AND id_user=" . $_SESSION["user"])->fetch_assoc();
    }
    
      echo "<div class='col-md-4 mb-5'>";
      echo "<div class='card h-100'>";
      echo "<div class='card-body'>";
      echo "<h2 class='card-title'>" . $row['title'] . "</h2>";
      echo "<p class='card-text'> " . $row['genre'] . "</p>";
      echo "</div>";
      echo "<div class='nav-link' href='#!'><img class='mx-auto d-block col-md-11 mb-5' src='" . $row['photoDirectory'] . "'/></a></div>";
      echo "<div class='card-footer text-center'><a class='btn btn-light' href='../pages/moviePage.php?id=". $row['id'] . "'>Więcej informacji</a></div>";
      
      echo "<div class='card text-right BtnLoan".$row['id']."'>";
    
      if (isset($_SESSION["user"])) {
          if ($isLoaned == NULL) {
              echo "<button type='button' class='btn btn-theme btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal".$row['id']."'>
                        Wypożycz
                    </button>
  
                    <div class='modal fade' id='exampleModal".$row['id']."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel'>Czy na pewno chcesz wypożyczyć ten film?</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    <p>Tytuł: ".$row['title']."</p>
                                    <p>Gatunek: ".$row['genre']."</p>
                                    <p>Reżyser: ".$row['director']."</p>
                                    <p>Data Wydania: ".$row['releaseYear']."</p>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Anuluj</button>
                                    <button type='button' class='btn btn-primary' data-bs-dismiss='modal' onclick='req(".$row['id'].")'>Wypożycz</button>
                                </div>
                            </div>
                        </div>
                    </div>";
          } else {
              echo "<button class='btn btn-theme btn-sm' disabled>Wypożyczone</button>";
          }
      }
  
      echo "</div>";

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
