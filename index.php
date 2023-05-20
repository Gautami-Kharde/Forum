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
     

    
    <!-- Slider starts here -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x800/?nature,landscape;" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x800/?water,landscape;" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x800/?nature,birds;" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span>Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span>Next</span>
        </button>
    </div>
    <!-- Category container starts here -->


    <div class="container my-3">
        <h2 class="text-center my-3">E-Forum Browse Categories</h2>
        <div class="row">

           <!-- Fetch all categories here and use a loop  to iterate through categories-->

           <?php $sql = "select * from categories";
           $result = mysqli_query($conn, $sql);
           while($row= mysqli_fetch_assoc($result)){
            //echo $row['category_id'];
            $id= $row['category_id'];
            $cat = $row['category_name'];
            $desc = $row['category_description'];
            echo '<div class="col-md-3">
                  <div class="card my-2" style="width: 18rem;">
                      <img src="https://source.unsplash.com/500x400/?' .$cat. ',nature;" class="card-img-top"
                          alt="...">
                      <div class="card-body">
                          <h5 class="card-title"><a href="threads_list.php?catid='.$id.'">' .$cat.'</a></h5>
                          <p class="card-text">'. substr($desc,0,90).'...</p>
                          <a href="threads_list.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                      </div>
                  </div>
              </div>';

           }

           ?>
            <!--Use a for loop to iterate through categories -->

            
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