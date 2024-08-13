<?php
    include('dbcon.php');
?>
<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student Change Info</title>
  </head>
  <body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student View Details
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                            if(isset($_GET['id'])){
                                $admin_id = mysqli_real_escape_string($con, $_GET['admin_id']);
                                $query = "SELECT * FROM admin WHERE id='$admin_id' ";
                                $query_run = mysqli_query($con, $query);

                                if(mysqli_num_rows($query_run) > 0){
                                    $student = mysqli_fetch_array($query_run);
                                    ?>
                                        <div class="mb-3">
                                            <label>First Name</label>
                                            <p class="form-control"><?=$student['firstname'];?></p>
                                        </div>

                                        <div class="mb-3">
                                            <label>Last Name</label>
                                            <p class="form-control"><?=$student['lastname'];?></p>
                                        </div>

                                        <div class="mb-3">
                                            <label>Email</label>
                                            <p class="form-control"><?=$student['email'];?></p>
                                        </div>

                                    <?php
                                }else{
                                    echo "<h4>No Such ID Found</h4>";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>