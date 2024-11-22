<?php require_once("includes/header.php"); ?>

<?php 

// Make sure the user is allowed
 if($session->is_signed_in()) {
    redirect("index.php");
 }

 // We detect if the form has been submitted
 if(isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Method to check database user
    // IMPORTANT TO UNDERSTAND
    // Use this method to verify the user in the db, the back result will be displayed in an array of objects
    $user_found = User::verify_user($username, $password);


    // Depending on the result above, we log the user using the logic below
    if($user_found) {

        $session->login($user_found);
        redirect("index.php");
    } else {
        $the_message = "Your username or password are wrong";
    }
} else {
    // If nothing was submitted we want to make sure that everything was unset
    $username = "";
    $password = "";
    $the_message = "";
}

?>


<div class="col-md-4 col-md-offset-3">

<h4 class="bg-danger"><?php echo $the_message; ?></h4>

<!-- <h4 class="bg-danger"><?php echo isset($the_message); ?></h4> -->
	
<form id="login-id" action="" method="post">
	
<div class="form-group">
	<label for="username">Username</label>
	<input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >

</div>

<div class="form-group">
	<label for="password">Password</label>
	<input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">
	
</div>


<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>


</form>


</div>