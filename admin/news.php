<?php
include'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $imageFolder = 'images/';

// Check if the image folder exists, and if not, create it
    // if (!is_dir($imagefolder)) {
    //     mkdir($imageFolder);
    // }else{
    //     echo "folder created ";
    // }

    $title = $_POST['title'];
    $title = mysqli_real_escape_string($conn, $title);
    
    $details = $_POST['details'];
    $details = mysqli_real_escape_string($conn, $details);

    //handle tht uploaded image
$image = $_FILES['image']['tmp_name'];

if ($image) {
    echo "it is image". $image;
}
    // Generate a unique filename for the image
$imageName = uniqid() . '_' . $_FILES['image']['name'];
$imagePath = $imageFolder . $imageName;

if (move_uploaded_file($image, $imagePath)) {
    $sql ="INSERT INTO news (title, details, images) VALUES ('$title', '$details', '$imageName')";

if($conn->query($sql) === TRUE){
    echo 'successfully';
}else{
    echo "failed";
}
$conn->close();
}else{
    echo "error uploading images";
}

}
?>

       <?php include "nav.php" ?>
        <div id="layoutSidenav">
           <?php include "sidebar.php"?>
            <div id="layoutSidenav_content">


               


                <main>
                    <div class="container-fluid px-4">
                

                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               view news
                            </div>
                            <div class="card-body">
                            <div class="box">
            
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="col-md-8 input_form">

            <form id="contactForm" method="POST" action="" enctype="multipart/form-data">
            <div class="form-group has-feedback">
            <input id="" type="text" name="title" required placeholder="news Tittle" class="form-control">
            </div>
            <div class="form-group has-feedback m-4">
            <textarea id="project" rows="8" name="details" placeholder="details" class="form-control"></textarea>
            </div>
            <div class="form-group has-feedback mb-3">
            <input type="file" class="form-control" name="image" required multiple >
</div>
<div class="form-group ">
              <input type="submit" name="post" class="btn btn-primary btn-block btn-flat" value="submit">
            </div>
          </form>
            </div>
            </div>
            <!-- /.box-body -->
        </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>