<?php

session_start();

//include 'partials/_dbconnect.php';




  echo'
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="/Forum">E-Discuss</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/Forum">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Top Categories
          </a>
          <ul class="dropdown-menu">';


          $sql = "select * from categories limit 3";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
            echo '
            <li><a class="dropdown-item" href="threads_list.php?catid=' .$row['category_id']. '">'.$row['category_name'].'</a></li>';
            

          };

           echo '
          </ul>
        </li>
          <li class="nav-item">
            <button class="btn mx-2 nav-link" data-bs-toggle="modal" data-bs-target="#contactModal">Contact</button>
          </li>';


      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo '
        <li class="nav-item">
          <a href="partials/_logOut.php" class="nav-link">Log Out</a>
        </li>
        </ul>
        <form class="d-flex" action="search.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success my-2 mx-2" id="search" name="search" type="submit">Search</button></input>
        <p class="my-0 mx-2">Welcome! '. $_SESSION['useremail'].'</p>
        </form>'
       ;
      }
      else{
        echo '<li class="nav-item">
        <button class="btn mx-2 nav-link" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        </li>
        <li class="nav-item">
        <button class="btn mx-2 nav-link" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>
        </li>
        </ul>
        <form class="d-flex" action="search.php" method="get">
        <input class="form-control me-2" type="search" id="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success my-2 my-sm-0 mx-2" type="submit">Search</button></input>
        </form>';
      }

    echo '</div>
  </div>
</nav>'; 

include 'partials\_loginModal.php';
include 'partials\_signupModal.php';
include 'partials\contactModal.php';

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Success! You can now login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

 
if(isset($_GET['loggedIn']) && $_GET['loggedIn'] == true){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Success! You are now logged in.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

};

?>