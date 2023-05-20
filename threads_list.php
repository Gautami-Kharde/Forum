<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


    <title>Welcome to E-Forum - Environmental Science</title>
</head>

<body>


    <?php 
    include 'partials/_dbconnect.php'; 
    include 'partials/_header.php'; 
     ?>
    <?php
     $id=$_GET['catid'];
     $sql= "select * from categories where category_id=$id";
     $result = mysqli_query($conn, $sql);
     while($row= mysqli_fetch_assoc($result)){
        $catname= $row['category_name'];
        $catdesc = $row['category_description'];

     }
    
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method== 'POST'){
        //Insert thread into db
        $th_title = $_POST['title'];
        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">","&gt;",$th_title);

        $th_desc = $_POST['desc'];
        $th_desc = str_replace("<", "&lt;",  $th_desc);
        $th_desc = str_replace(">","&gt;",  $th_desc);

        $sno = $_POST['sno'];

        $sql_1 = "insert into threads(thread_title, thread_desc, thread_cat_id, thread_user_id, dt) values('$th_title', '$th_desc', $id , $sno, current_timestamp())";
        $result = mysqli_query($conn,$sql_1);
        $showAlert= true;
        if($showAlert){
            echo'
            <div class="alert alert-success" role="alert">
                Success! Thread added successfully. Please Wait for community to respond.
                </div>';

        }
    }

    ?>


    <div class="container my-4" style="background-color:#DAEDED; padding:30px;">
        <div>
            <h2 style="padding:30px; text-align:center;"> Welcome to <?php echo $catname; ?> - Forums </h2>
            <p class="lead my-4"> <?php echo $catdesc; ?>
            </p>
            <hr class="my-4">
            <p> This is a peer to peer forum for sharing environmental knowledge. Be respectful, even when there's a
                disagreement.
                No foul language or discriminatory comments. No spam or self-promotion.</p>
            <div style="text-align:center;">
                <a class="btn btn-lg my-4" style="color:blue;" href="#" role="button">Learn more</a>
            </div>
        </div>

    <?php

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo '</div>
    <div class="container">
        <h2 class="py-3"> Start a Discussion </h2>

        <form action="'.$_SERVER["REQUEST_URI"].'" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Keep your title as short and crisp as possible.</div>
            </div>
            <label for="desc" class="form-label">Elaborate your concern</label>
            <div class="input-group">
                <textarea class="form-control" aria-label="With textarea" id="desc" name="desc" rows="5"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
            </div>

            <button type="submit" class="btn btn-success my-2">Submit</button>
        </form>
    </div>
    </div>';
    }
    else{
        
        echo '</div><div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Alert!</strong> You have not logged in. Please login/signup to submit concern.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      </div>';
    
    }

    ?>
    <div class="container">
        <h2 class="py-3"> Browse Questions </h2>
        <?php
     $id=$_GET['catid'];
     $sql= "select * from threads where thread_cat_id=$id";
     $result = mysqli_query($conn, $sql);
     $noResult = true;
     while($row= mysqli_fetch_assoc($result)){
        $noResult = false;
        $id1 = $row['thread_id'];
        $title= $row['thread_title'];
        $desc = $row['thread_desc'];
        $time = $row['dt'];
        $user = $row['thread_user_id'];
        $sql2 = "select user_email from users where sno ='$user'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);

        
        echo '<div class="d-flex mb-5">
        <div class="flex-shrink-0">
            <img src="img/user.jpg" alt="Sample Image" width="40px">
        </div>
        <div class="flex-grow-1 ms-3">
            <h5><a class="text-dark" href="threads.php?thread_id='.$id1.'">'.$title.'  </a><small class="text-muted"><i> Posted on '.$time.' by '.substr($row2['user_email'],0, 5).'</i></small></h5>
            <p>'.$desc.'</p>
        </div>
    </div>';
     }

    //echo var_dump($noResult);
    if($noResult){
        echo '<div class="container my-4" style="background-color:#DAEDED; padding:30px;">
        <div>
            
            <p><b>No threads found. Be the first person to ask a question</b></p>
        </div>'
    ;
    
    }
       
    ?>

    </div>


    <?php
    include 'partials/_footer.php'; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>


</body>

</html>