<?php
session_start();
//INSERT INTO `notes` (`SL`, `Title`, `Description`, `DateTime`) VALUES (NULL, 'Reminder', 'I have to do my homework', current_timestamp());
include 'connect.php';
$al=false;
if($_SERVER['REQUEST_METHOD']=="POST"){
  $tit=$_POST['title'];
  $det=$_POST['des'];
  $sqll = "INSERT INTO `notes` (`SL`, `Title`, `Description`, `DateTime`) VALUES (NULL, '$tit', '$det', current_timestamp())";
  $r=mysqli_query($conn,$sqll);
  if($r){
   $al=true;
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <style>
       body{
        background-color: #fff;
       }
       
      .d{
        background-color:red;
        color:white;
        height:100px;
        width:300px;
       
      }
      </style>
     <title>MakeEasyNotes</title>
  </head>
  <body>


  
    <nav class="navbar fixed-topnavbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">MakeEasyNotes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact US</a>
              </li>
          
            
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
      <?php
      if($al){
      echo "<<div class='alert alert-success alert-dismissible' role='alert'>
      <span type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></span>
      <strong>Success!</strong> Note Added.
    </div>";
       
      }
      ?>
<?php
if (isset($_GET['status']) && $_GET['status'] === 'success') {
        echo '<div class="alert alert-success alert-dismissible" role="alert">
                Data deleted successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
    ?>

      <div class="container my-4">
        <?php
       echo " Welcome! ". $_SESSION['username'];
        ?>
        <h1>Add a Note</h1>
        <form action ="index.php" method ="post">
            <div class="form-group">
              <label for="title">Title </label>
              <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter Title of your Note">
              
            </div>
            <div class="form-group">
                <label for="des">Description</label>
                <textarea class="form-control" name="des" placeholder="Enter Description of your Note" id="des" rows="5"></textarea>
              </div>
            
            <button type="submit" class="btn btn-primary">Add</button>
          </form>


      </div>

<div class="container my-4">
         



<table class="table table-striped" id="myTable">
  <thead>
    <tr>
      <th scope="col">SL</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $sql = "SELECT * FROM `notes`";
    $rs = mysqli_query($conn, $sql);
    $no = 1;
    while ($row = mysqli_fetch_assoc($rs)) {
      echo " <tr>
               <td scope='row'>" . $no . "</td>
               <td>" . $row['Title'] . "</td>
               <td>" . $row['Description'] . "</td>
               <td>
                   <div class='btn-group' role='group'>
                       <form action='delete_data.php' method='post'>
                           <input type='hidden' name='id' value='" . $row['SL'] . "'>
                           <button type='submit' class='btn btn-danger'>Delete</button>
                       </form>
                       <form action='#' method='post'>
                           <input type='hidden' name='id' value='" . $row['SL'] . "'>
                           <button type='submit' class='btn btn-primary'>Edit</button>
                       </form>
                   </div>
               </td>
             </tr> ";
      $no++;
    }
  ?>
  </tbody>
</table>



<form id="logout-form" action="logout.php" method="post">
        <button class ="d" type="submit">Logout</button>
    </form>
<hr>

</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
    let table = new DataTable('#myTable');
    </script>
  
  </body>

</html>



