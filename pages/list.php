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
      data: {
        genre: selected_genre,
        director: selected_director,
        releaseYear: selected_year
      },
      success: function(data) {
        $("#movie_list").html(data);
        initializeLoanButtons();
      }
    });
  }

  function initializeLoanButtons() {
    $(".BtnLoan").each(function() {
      var movieId = $(this).data("id");
      var buttonElement = $(this).find(".loan-button");

      buttonElement.click(function() {
        var loanButton = $(this);
        $.ajax({
          url: "../php/borrow.php",
          method: "POST",
          data: { id: movieId },
          success: function() {
            loanButton.attr("disabled", true).text("Wypożyczone");
          }
        });
      });
    });
  }
});

  </script>
  <style>
    .flex-wrapper {
  display: flex;
  min-height: 82vh;
  flex-direction: column;
  justify-content: flex-start;
}
.footer {
  margin-top: auto;
}
  </style>
</head>
<body>
  <!-- Responsive navbar-->
  <?php include "../php/header.php" ?>
        <!-- Page Content-->
  <div class="flex-wrapper" >
  <div class="container px-4 px-lg-5">
    <br><h1>Wszystkie filmy</h1><br>
    <div class="row align-items-center">
      <div class="col-lg-2">      
        <label for="genre">Wybierz gatunek:</label>
        <select class="form-select" name="genre" id="genre">
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
      </div>
      <div class="col-lg-2">
        <label for="director">Wybierz reżysera:</label>
        <select class="form-select" name="director" id="director">
          <option value="">Wszyscy reżyserzy</option>
          <?php
          $sql = "SELECT DISTINCT director FROM videos";
          $result = $db->query($sql);
          while ($row = $result->fetch_assoc()) {
          echo "<option value='".$row['director']."'>".$row['director']."</option>";
          }
          ?>
        </select>
      </div>
      <div class="col-lg-2">      
        <label for="releaseYear">Wybierz rok premiery:</label>
          <select class="form-select" name="releaseYear" id="releaseYear">
            <option value="">---</option>
              <?php
                $sql = "SELECT DISTINCT releaseYear FROM videos ORDER BY releaseYear DESC";
                $result = $db->query($sql);
                while ($row = $result->fetch_assoc()) {
                  echo "<option value='".$row['releaseYear']."'>".$row['releaseYear']."</option>";
                }
              ?>
          </select>
      </div>
    </div>
    <br><br>
  
        <div class="container px-4 px-lg-5" id="movie_list"></div>
    </div>
  </div>
      <!-- Footer-->
      <div class="footer">
      <footer class="py-5 bg-dark">
            <div class="container px-4 px-lg-5"><span class="text-muted"><p class="m-0 text-center text-white">KNS Web Services &copy; Wypożyczalnia DVD 2023</p></span></div>
        </footer>
      </div>
  </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script> 
</body>
    <script>
    function req(id)
    {
            const xhr=new XMLHttpRequest();
            xhr.open("POST","../php/borrow.php",true);

            xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            xhr.onreadystatechange=()=>{}
            xhr.send("id="+id);
            //window.location.reload()
            //document.getElementById("BtnLoan"+id).innerHTML="<button class=\"btn btn-theme btn-sm\" disabled>Wypożyczone</button>";//Make to work with multiple
            for(part of document.getElementsByClassName("BtnLoan"+id))
            {
                part.innerHTML="<button class=\"btn btn-theme btn-sm\" disabled>Wypożyczone</button>";
            }
        
    }

    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
    myInput.focus()
    })

</script>
</html>
