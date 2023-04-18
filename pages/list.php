<?php include "../php/creds.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Wypożyczalnia DVD</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.png" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="../css/styles_2.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
     getMovies(); 

    $("#genre, #director, #releaseYear").change(function() {
      getMovies(); 
    });

    function getMovies() {
      var selected_genre = $("#genre").val();
      var selected_director = $("#director").val();
      var selected_year = $("#releaseYear").val();
      $.ajax({
        url: "../php/getMovies.php",
        method: "POST",
        data: {genre: selected_genre, director: selected_director, releaseYear: selected_year},
        success: function(data) {
          $("#movie_list").html(data);
        }
      });
    }
});
  </script>
</head>
<body>
  <label for="genre">Wybierz gatunek:</label>
  <select name="genre" id="genre">
    <option value="">Wszystkie gatunki</option>
    <?php
      $db = new mysqli('localhost:3306', USER, PASSWD, DBNAME);
      if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
      }
      $sql = "SELECT DISTINCT genre FROM videos";
      $result = $db->query($sql);
      while ($row = $result->fetch_assoc()) {
        echo "<option value='".$row['genre']."'>".$row['genre']."</option>";
      }
    ?>
  </select>
  <label for="director">Wybierz reżysera:</label>
  <select name="director" id="director">
    <option value="">Wszyscy reżyserzy</option>
    <?php
      $sql = "SELECT DISTINCT director FROM videos";
      $result = $db->query($sql);
      while ($row = $result->fetch_assoc()) {
        echo "<option value='".$row['director']."'>".$row['director']."</option>";
      }
    ?>
  </select>
  <label for="releaseYear">Wybierz rok premiery:</label>
  <select name="releaseYear" id="releaseYear">
    <option value="">---</option>
    <?php
      $sql = "SELECT DISTINCT releaseYear FROM videos";
      $result = $db->query($sql);
      while ($row = $result->fetch_assoc()) {
        echo "<option value='".$row['releaseYear']."'>".$row['releaseYear']."</option>";
      }
    ?>
  </select>

  </div>
  
  <div id="movie_list"></div>
  </div>
        <!-- Footer-->
      <!-- Footer-->
      <footer class="py-5 bg-dark">
            <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">KNS Web Services &copy; Wypożyczalnia DVD 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script> 
</body>
<script>
    function req(id)
    {
        if(confirm("Czy na pewno chcesz wypożyczyć ten film?"))
        {
            const xhr=new XMLHttpRequest();
            xhr.open("POST","php/borrow.php",true);

            xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            xhr.onreadystatechange=()=>{}
            xhr.send("id="+id);
        }
        
    }
</script>
</html>
