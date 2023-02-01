<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Countries</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merienda:wght@500&family=Poppins&display=swap" rel="stylesheet">
<style>

:root{
  --teal: #2ec1ac;
  --teal_hover: #279e8c; 
}

{
    font-family: 'Poppins', sans-serif;
}

.h-font{
    font-family: 'Marienda', cursive;
}
.custome-bg{
  background-color: var(--teal);
  border: 1px solid var(--teal);
}
.custome-bg:hover{
  background-color: var(--teal_hover);
  border-color: var(--teal_hover);

}

#dashboard-menu{
  position: fixed;
  height: 100%;
}
  .availability-form{
  margin-top: -50px;
  z-index: 2;
  position: relative;
}
@media screen and (max-width: 575px){
  .availability-form{
  margin-top: 25px;
  padding: 0 35px;
}   
}
</style>  
</head>
<body>
<body class="bg-light">

<!-- navigation Bar -->
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-0 py-lg-2 shadow-sm sticky-top px-5">
  <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">Check Countries</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    </ul>
    <div class="form-inline my-2 my-lg-0">
      <!-- Button trigger modal -->
 </div>
  </div>
</nav>


<!-- carousel -->

<div class="container-fluid">
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="images\world.png" class="w-100 d-block" />
      </div>
    </div>
  </div>
</div>





<?php
require_once('countryconn.php');

$id = $_POST['counties'];
$searchBy = $_GET['id'];
$level = $_POST['levels'];

$result = country($id, $level, $conn, $searchBy);

?>
<div class="container">
    <div class="row">
    <form action="index.php" id="" method = "post">

<table class="table ">
  <div class="col-lg-4 mb-3 d-flex  justify-content-between">
  <thead>
    <tr>
      <th scope="col">
      <b><label for="county">A list of its <?php echo getName($level, $conn);?>(s)</label></b>

      </th>
    </tr>
  </thead>
  <tbody>

  <?php
    $db = mysqli_connect("localhost", "root", "", "counties");

    if (isset($_POST["viewsbtn"]))
    {
        while ($row = mysqli_fetch_array($result)) {
            ?>
    <tr>
        
      <td><?php echo$row['name']; ?></td>
      
    </tr>
    <?php
        }
    }
    ?>
  </tbody>

  </div>
</table>

    <input type = "submit" name = "back" value = "Back to Levels"  class="btn text-white shadow-none custome-bg"><br>
</form>
    </div>
</div>
</body>
</html>
