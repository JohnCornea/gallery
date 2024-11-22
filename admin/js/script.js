$(document).ready(function() {

    var user_href;
    var user_href_splitted;
    var user_id;
    var image_src;
    var image_href_splitted;
    var image_name;
    var photo_id;

    $('#summernote').summernote({
        height: 200
    });

    // JQUERY FOR MODAL
    $(".modal_thumbnails").click(function() {

        $("#set_user_image").prop('disabled', false);

        // Pulling the USER_ID with JQUERY and JAVASCRIPT
        $(this).addClass('selected');
        user_href = $("#user-id").prop('href');
        user_href_splitted = user_href.split("=");
        user_id = user_href_splitted[user_href_splitted.length -1];

        // alert(user_id);

        // Pulling the image name
        image_src = $(this).prop("src");
        image_href_splitted = image_src.split("/");
        image_name = image_href_splitted[image_href_splitted.length -1];

        photo_id = $(this).attr("data");

        $.ajax({
            url: "includes/ajax_code.php",
            data:{photo_id: photo_id},
            type: "POST",
            success:function(data) {
                if(!data.error) {
                    
                    $("#modal_sidebar").html(data);
                }
            }
        })

     });

     // Get img info after submit the button
     $("#set_user_image").click(function() {

        $.ajax({

            url: "includes/ajax_code.php",
            data:{image_name: image_name, user_id: user_id},
            type: "POST",
            success:function(data){

                if(!data.error) {
                    
                    // Doesn't work well with AJAX. The purpose of AJAX is not to reload the page
                    // location.reload(true);

                    $(".user_image_box a img").prop('src', data);
                }
            }
        });

     });

     /***** Edit Photo Sidebar */
     $(".info-box-header").click(function() {

        $('.inside').slideToggle("fast");

        $("#toggle").toggleClass("glyphicon-menu-down glyphicon , glyphicon-menu-up glyphicon");
     })

     /* Delete event */
     $(".delete_link").click(function() {

        return confirm("Are you sure you want to delete this item?");
     });

  }); 