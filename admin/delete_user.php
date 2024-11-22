<?php include("includes/init.php"); ?>

<?php 

// If user is not logged in
// if(!$session->is_signed_in()) {
//     // redirect($location);
//     redirect("login.php");
//  }

if(empty($_GET['id'])) {
    redirect("users.php");
}

$user = User::find_by_id($_GET['id']);

if($user) {

    $session->message("The {$user->username} has been deleted");

    $user->delete_photo();

    redirect("users.php");

} else {

    redirect("users.php");
    // $session->message("The user has been deleted");
}

?>

  <?php include("includes/footer.php"); ?>