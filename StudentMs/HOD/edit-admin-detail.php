<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
  header('location:logout.php');
  } else{
   if(isset($_POST['submit']))
  {
 $stuname=$_POST['stuname'];
 $stuemail=$_POST['stuemail'];
 
 $gender=$_POST['gender'];
 $dob=$_POST['dob'];
 $stuid=$_POST['stuid'];


 $connum=$_POST['connum'];
 $altconnum=$_POST['altconnum'];
 $address=$_POST['address'];
 $eid=$_GET['editid'];
$sql="update tbladmin set AdminName=:stuname,AdminEmail=:stuemail,Gender=:gender,DOB=:dob,AdminID=:stuid,ContactNumber=:connum,AltenateNumber=:altconnum,Address=:address where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':stuname',$stuname,PDO::PARAM_STR);
$query->bindParam(':stuemail',$stuemail,PDO::PARAM_STR);

$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':stuid',$stuid,PDO::PARAM_STR);


$query->bindParam(':connum',$connum,PDO::PARAM_STR);
$query->bindParam(':altconnum',$altconnum,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();
  echo '<script>alert("Faculty has been updated")</script>';
}

  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>College Space|| Update Faculty</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css" />
    
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
     <?php include_once('includes/header.php');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
      <?php include_once('includes/sidebar.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Update Faculty </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Update Faculty</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Update Faculty</h4>
                   
                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                      <?php
                            if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        // Formula for pagination
        $no_of_records_per_page =15;
        $offset = ($pageno-1) * $no_of_records_per_page;
       $ret = "SELECT ID FROM tbladmin";
$query1 = $dbh -> prepare($ret);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$total_rows=$query1->rowCount();
$total_pages = ceil($total_rows / $no_of_records_per_page);
$sql="SELECT * from tbladmin";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>   
                          
                      <div class="form-group">
                        <label for="exampleInputName1">Faculty Name</label>
                        <input type="text" name="stuname" value="<?php  echo htmlentities($row->AdminName);?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Faculty Email</label>
                        <input type="text" name="stuemail" value="<?php  echo htmlentities($row->AdminEmail);?>" class="form-control" required='true'>
                      </div>
                      


                      <div class="form-group">
                        <label for="exampleInputName1">Gender</label>
                        <select name="gender" value="" class="form-control" required='true'>
                          <option value="<?php  echo htmlentities($row->Gender);?>"><?php  echo htmlentities($row->Gender);?></option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Date of Birth</label>
                        <input type="date" name="dob" value="<?php  echo htmlentities($row->DOB);?>" class="form-control" required='true'>
                      </div>
                     
                      <div class="form-group">
                        <label for="exampleInputName1">Faculty ID</label>
                        <input type="text" name="stuid" value="<?php  echo htmlentities($row->AdminID);?>" class="form-control" readonly='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Faculty Image</label>
                        <img src="images/<?php echo $row->Image;?>" width="100" height="100" value="<?php  echo $row->Image;?>"><a href="changeimage.php?editid=<?php echo $row->ID;?>"> &nbsp; Edit Image</a>
                      </div>
                    
                      <div class="form-group">
                        <label for="exampleInputName1">Contact Number</label>
                        <input type="text" name="connum" value="<?php  echo htmlentities($row->ContactNumber);?>" class="form-control" required='true' maxlength="10" pattern="[0-9]+">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Alternate Contact Number</label>
                        <input type="text" name="altconnum" value="<?php  echo htmlentities($row->AltenateNumber);?>" class="form-control" required='true' maxlength="10" pattern="[0-9]+">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Address</label>
                        <textarea name="address" class="form-control" required='true'><?php  echo htmlentities($row->Address);?></textarea>
                      </div>
<h3>Login details</h3>
<div class="form-group">
                        <label for="exampleInputName1">User Name</label>
                        <input type="text" name="uname" value="<?php  echo htmlentities($row->UserName);?>" class="form-control" readonly='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Password</label>
                        <input type="Password" name="password" value="<?php  echo htmlentities($row->Password);?>" class="form-control" readonly='true'>
                      </div><?php $cnt=$cnt+1;}} ?>
                      <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
                     
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
         <?php include_once('includes/footer.php');?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/select2/select2.min.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
    <!-- End custom js for this page -->
  </body>
</html><?php }  ?>