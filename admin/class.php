<?php
include "db.php";
// Initialize the session
//session_start();
 
// Check if the user is logged in, if not then redirect him to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     header("location: login.php");
//     exit;
// }
$query="select * from news;";
$result=mysqli_query($conn,$query); 

?>
       <?php include "nav.php" ?>
        <div id="layoutSidenav">
           <?php include "sidebar.php"?>
            <div id="layoutSidenav_content">


               


                <main>
                    <div class="container-fluid px-4">
                       

                       
                        <!-- bus Table -->
    <section class="p-3">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card animated rotateInUpRight">
                        <div class="card-header bg-dark text-white">
                            <h3>news Details</h3>
                        </div>
                        <div class="card-body bg-light-blue">
                       
                    <table class='table table-hover text-center'>
                <thead class='bg-dark text-white'>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Details</th>
        <th>Image</th>
        <th>Date</th>
    </tr>
    </thead>
</div>
</div>
                    
                            
 <tbody>
<?php
while($out=mysqli_fetch_assoc($result)){
echo"<tr> 
<td>{$out['id']}</td>
<td>{$out['title']}</td>
<td>{$out['details']}<td>
<td>{$out['images']}</td>
<td>{$out['created_date']}</td>
 </tr>";
                                                                           
}   
  ?>
                                   
  </tbody>           
  </div>
    </section>
                    </div>
                    
                </main>
              
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