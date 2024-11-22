<?php include("includes/init.php"); ?>

<?php 

if(empty($_GET['id'])) {
    redirect("comments.php");
}

$comment = Comment::find_by_id($_GET['id']);

if($comment) {

    $comment->delete();
    $session->message("The comment with the id {$comment->id} has been deleted");
    redirect("comment_photo.php?id={$comment->photo_id}");

} else {

    redirect("comment_photo.php?id={$_GET['id']}");
    // redirect("comment_photo.php?id={$comment->photo_id}");
}

?>

  <?php include("includes/footer.php"); ?>