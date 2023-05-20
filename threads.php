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

/*    $id=$_GET['catid'];
    $sql= "select * from categories where category_id=$id";
    $result = mysqli_query($conn, $sql);
    while($row= mysqli_fetch_assoc($result)){
        $catname= $row['category_name'];
        $catdesc = $row['category_description'];

}
*/

     $id=$_GET['thread_id'];
     $sql= "select * from threads where thread_id=$id";
     $result = mysqli_query($conn, $sql);
     $noResult = true;
     while($row= mysqli_fetch_assoc($result)){
       
        $id = $row['thread_id'];
        $title= $row['thread_title'];
        $desc = $row['thread_desc'];
        $time = $row['dt'];

        $user = $row['thread_user_id'];
        $sql_2 = "select user_email from users where sno ='$user'";
        $result_2 = mysqli_query($conn, $sql_2);
        $row_2 = mysqli_fetch_assoc($result_2);
        
        echo '<div class="container my-4" style="background-color:#DAEDED; padding:30px;">
        
            <h2 style="padding:30px; text-align:center;">'.$title.'</h2>
            <p class="lead my-4">'.$desc.'
            </p>
            <p>Posted by: <em>'.substr($row_2['user_email'],0, 5).'</em></p>
            <hr class="my-4">
            <p> This is a peer to peer forum for sharing environmental knowledge. Be respectful, even when there\'s a
                disagreement.
                No foul language or discriminatory comments. No spam or self-promotion.</p>
            <div style="text-align:center;">
                <a class="btn btn-lg my-4" style="color:blue;" href="#" role="button">Learn more</a>
            </div>
        </div>';
     }

    

   
       
    ?>
    <?php
$showAlert = false;
$method = $_SERVER['REQUEST_METHOD'];
if($method== 'POST'){
    //Insert into comments db
    $comment = $_POST['comment'];
    $comment = str_replace("<", "&lt;", $comment);
    $comment = str_replace(">","&gt;", $comment);
    $sno = $_POST['sno'];
    $sql_1 = "insert into comments(comment_content, thread_id, comment_time, comment_by) values('$comment', $id , current_timestamp(), sno)";
    $result = mysqli_query($conn,$sql_1);
    $showAlert= true;
    if($showAlert){
        echo'
        <div class="alert alert-success" role="alert">
            Success! Your comment has been added successfully.
        </div>';

    }
}
?>

    </div>

    <div class="container my-4">
        <div class="text-center">
            <h2><u> Discussions </u></h2>
        </div>

        <?php
    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo'
        <div class="container">
            <h3 class="py-3"> Post a Comment </h3>
            <form action="'. $_SERVER['REQUEST_URI'].'" method="POST">

                <label for="comment" class="form-label">Type your comment</label>
                <div class="input-group">
                    <textarea class="form-control" aria-label="With textarea" id="comment" name="comment"
                        rows="5"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
                </div>

                <button type="submit" class="btn btn-success my-2">Post Comment</button>
            </form>
        </div>';
    }
    else{
            echo '</div><div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Alert!</strong> You have not logged in. Please login/signup to post a comment.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            </div>';
    }
    ?>
    
    <div class="container">
    <h4 class="py-3"> Comments </h4>
    <?php
     $id1=$_GET['thread_id'];
     $sql2= "select * from comments where thread_id=$id1";
     $result2 = mysqli_query($conn, $sql2);
     $noResult = true;
     while($row= mysqli_fetch_assoc($result2)){
        $noResult = false;
        $id1 = $row['comment_id'];
        $content = $row['comment_content'];
        $t = $row['comment_time'];
        $user = $row['comment_by'];
        $sql3 = "select user_email from users where sno ='$user'";
        $result3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_assoc($result3);
        
        echo '<div class="d-flex mb-5">
        <div class="flex-shrink-0">
            <img src="img/user.jpg" alt="Sample Image" width="40px">
        </div>
    
        <div class="flex-grow-1 ms-3">
            <h6><i> Posted on '.$t.' by '.substr($row3['user_email'],0, 5).' </i></small></h6>
            <p>'.$content.'</p>
        </div>
    </div>';
     }

    //echo var_dump($noResult);
    if($noResult){
        echo '<div class="container my-4" style="background-color:#DAEDED; padding:30px;">
            
            <p><b>No comments found. Be the first person to post a comment</b></p>
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