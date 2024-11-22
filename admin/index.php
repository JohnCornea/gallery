<?php include("includes/header.php"); ?>

<?php 

// If user is not logged in
if(!$session->is_signed_in()) {
    // redirect($location);
    redirect("login.php");
 }

?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
   
            <?php include("includes/top_nav.php") ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
           <?php include("includes/side_nav.php") ?>
            <!-- /.navbar-collapse -->
        </nav>


        <div id="page-wrapper">

            <?php include("includes/admin_content.php") ?>

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>