<?php
// Initialize the session
//session_start();
 
// Check if the user is logged in, if not then redirect him to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     header("location: login.php");
//     exit;
// }
include "db.php";
$query = "select * from news";
$result= mysqli_query($conn, $query);
?>

       <?php include "nav.php" ?>
        <div id="layoutSidenav">
           <?php include "sidebar.php"?>
            <div id="layoutSidenav_content">


               


                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"> <i>TRU</i> - Dashboard</h1>

                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               view news
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                    
                                        <tr>
                                            <th> I D </th>
                                            <th>Tittle</th>
                                            <th>details</th>
                                            <th>image</th>
                                            <th>date</th>
                                            <th> Action</th>
        
                                        </tr>
</thead>
                                       
                                 
                                  
                                    <tbody>
                                        <?php  
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo "<tr>
                                      <td>{$row['id']}</td>
                                      <td>{$row['title']}</td>
                                      <td>{$row['details']}</td>
                                      <td>{$row['images']}</td>
                                      <td>{$row['created_date']}</td>
</tr>";
                                        }
                                        ?>
                                        
                                        
                                       
                                    </tbody>
                                </table>
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