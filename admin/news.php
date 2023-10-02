<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="admin.php" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>GEOSYSTEMS ADMIN</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                       
                    </div>
                    <div class="pull-left info">
                        <h3><b>geosystems</b></h3>
                        
                    </div>
                </div>
              
                <ul class="sidebar-menu" data-widget="tree">
                    <!-- <li class="header">MAIN NAVIGATION</li> -->
                    <li class="active treeview">
                        <a href="admin.php">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>

                    </li>
                    <li class="">
                        <a href="project.php">
                            <i class="fa fa-files-o"></i>
                            <span>PROJECTS</span>
                            <span class="pull-right-container">
              
                            </span>
                        </a>
                       
                    </li>
                    <li><a href="projects.php"><i class="fa fa-book"></i> <span>ADD PROJECT</span></a></li>
                    <li><a href="logout.php"><i class="fa fa-book"></i> <span>LOGOUT</span></a></li>
                    
                  
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
          


<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="col-md-8 input_form">

                <form id="contactForm" method="POST" action="add.php" enctype="multipart/form-data">
                <div class="form-group has-feedback">
                <input id="" type="text" name="projectName" required placeholder="Project Tittle" class="form-control">
                </div>
                <div class="form-group has-feedback">
                <textarea id="project" rows="6" name="projectDescription" placeholder="Project Description" class="form-control"></textarea>
                </div>
                <div class="form-group has-feedback">
                <input type="file" class="form-control" name="files[]" required multiple >
    </div>
    <div class="form-group">
                  <input type="submit" name="post" class="btn btn-primary btn-block btn-flat" value="submit">
                </div>
              </form>
                </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
</div>
</body>

</html>