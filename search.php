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
    <style> #maincontainer{min-height:55vh;} </style>
</head>

<body>


    <?php
    include 'partials/_dbconnect.php';
    include 'partials/_header.php'; 
      ?>
     
    <!--Search Results -->

    


    <div class="container my-3" id="maincontainer">
        <h1 class="py-3"> Search results for <em>"<?php echo $_GET['search']; ?>"</em></h1>
    <?php
    $query = $_GET['search'];
    //$sql ="alter table threads add FULLTEXT('thread_title','thread_desc')";
    $sql = "select * from threads where match(thread_title, thread_desc) against('$query')";
    $result = mysqli_query($conn, $sql);
    $noResult= TRUE;
     while($row= mysqli_fetch_assoc($result)){
        $noResult= FALSE;
        $id = $row['thread_id'];
        $title= $row['thread_title'];
        $desc = $row['thread_desc'];
        $url = "threads.php?thread_id=$id";

        echo '<div class="result">
                        <h4><a class="text-dark" href="'.$url.'">'.$title.'</a></h4>
                        <p>'.$desc.' </p>
            </div>';
        }
    if($noResult){
        echo '<div class="container my-2" style="background-color:#DAEDED; padding:30px;">
            <div>
                <p><b>No Results Found</b></p>
                <p><b>Suggestions:</b></p>
                <ul>
                <li>Make sure that all words are spelled correctly</li>
                <li>Try Different Keywords.</li>
                <li>Try more general words.</li>
                </ul>
            </div>
            </div>'
        ;
        
        }
        ?>


</div>
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