<?php include("includes/init.php"); ?>

<?php 

// If user is not logged in
// if(!$session->is_signed_in()) {
//     // redirect($location);
//     redirect("login.php");
//  }

if(empty($_GET['id'])) {
    redirect("photos.php");
}

$photo = Photo::find_by_id($_GET['id']);

if($photo) {

    $photo->delete_photo();
    $session->message("The {$photo->filename} has been deleted");
    redirect("photos.php");

} else {

    redirect("photos.php");
}

?>

  <?php include("includes/footer.php"); ?>