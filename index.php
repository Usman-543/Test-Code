<?php 
$insert = false;
$update = false;
$delete = false;
//connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "Tasks";

// Create a MySQLi connection
$conn = new mysqli($servername, $username, $password, $database,3307);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//  else {
//     echo "Connecting was successful <br />";
// }

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `tasks` WHERE `sno` = $sno";
  $result = mysqli_query($conn,$sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST['snoEdit'])){
    $sno = $_POST['snoEdit'];
    $title = $_POST['titleEdit'];
$description =$_POST['descriptionEdit']; 
$sql = "UPDATE `tasks` SET `title` = '$title' , `description` = '$description' WHERE `tasks`.`sno` = $sno";
$result = mysqli_query($conn,$sql);
if($result){
  $update = true;
}
else{
  echo "The Record was not updated";
}
  }
  else{
  $title = $_POST['title'];
$description =$_POST['description']; ;
$sql = "INSERT INTO `tasks` (`title`, `description`) VALUES ( '$title', '$description')";
$result = mysqli_query($conn,$sql);
//Check query run successfully or not
if($result){
    // echo "The record  was successfully created <br />";
    $insert = true;
}
else{
    echo "The record was  not be created".mysqli_error($conn);
}
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
  <!-- Add Bootstrap CSS and JS in your HTML -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

 
  <title>Task Management System</title>
</head>

<body>
  <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit modal
</button> -->

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Edit Task</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <span aria-hidden="true"></span>
        </div>
        <form action="/crud/index.php" method="post">
        <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Task Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="desc">Task Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>
        </div>
        <div class="modal-footer d-block mr-auto">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
</form>
      </div>
    </div>
  </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">MySQl CRUD</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/crud/login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>

  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Task has inserted successfully'
    <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
  }
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Task has deleted successfully'
    <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
  }
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Task has updated successfully'
    <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
  }
  ?>
  <div class="container my-4">
    <h1 class="text-center shadow p-3 mb-5 bg-white rounded">Task Management System</h1>
    <h2>Add Tasks</h2>
    <form action="/crud/index.php" method="post">
      <div class="form-group">
        <label for="title">Task Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="desc">Task Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Task</button>
    </form>
  </div>

  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $sql = "SELECT * FROM `tasks`";
        $result = mysqli_query($conn,$sql);
        $sno = 0;
        while($row=mysqli_fetch_assoc($result)){
          $sno ++;
          echo " <tr>
          <th scope='row'>".$sno."</th>
          <td>".$row['title']."</td>
          <td>".$row['description']."</td>
          <td><button class=' edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button></td>
        </tr>";
          } 
        
        
        ?>
      </tbody>
    </table>
  </div>
  <hr>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
   <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener('click', (e) => {
        console.log("edit");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName('td')[0].innerText;
        description = tr.getElementsByTagName('td')[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');
      });
    });
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener('click', (e) => {
        console.log("edit");
        sno = e.target.id.substr(1,);
        window.location =`/crud/index.php?delete=${sno}`;
        
        if(confirm("Are you sure you want to delete this Task?")){
          console.log("Yes");
        }else{
          console.log("No");
        }
      });
    });
  </script>
</body>

</html>