<div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin
                            <small>Dashboard</small>
                        </h1>
                        
                        <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $session->count; ?></div>
                                        <div>New Views</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                  <span class="pull-left">View Details</span> 
                               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> 
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-photo fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo Photo::count_all(); ?></div>
                                        <div>Photos</div>
                                    </div>
                                </div>
                            </div>
                            <a href="photos.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Total Photos in Gallery</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo User::count_all(); ?>

                                        </div>

                                        <div>Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Total Users</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                      <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo Comment::count_all(); ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Total Comments</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                        </div> <!--First Row-->

                        <div class="row">
                            <div id="piechart" style="width: 900px; height: 500px;"></div>
                        </div>

                        <?php 
                        
                        // We create a new User Object
                        // $user = new User();
                        
                        // // // This data is coming from the form
                        // $user->username = "BSTO_username";
                        // $user->password ="BSTO_password";
                        // $user->first_name ="Johnny";
                        // $user->last_name ="Doe";
                        // $user->create();

                        // $user = User::find_by_id(12);
                        // $user->username = "God";
                        // $user->password = "111";
                        // $user->first_name = "The Father";
                        // $user->last_name = "Elohim";
                        // $user->update();

                        // $user = User::find_user_by_id(10);
                        // $user->delete();

                        // $user = User::find_user_by_id(10);
                        // $user->password = "justPassword2";
                        // $user->save();

                        // $user = new User();
                        // $user->username = "Barbosu";
                        // $user->save();

                        // $users = User::find_all();
                        // foreach($users as $user) {
                        //     echo $user->username;
                        // }

                        // $user = User::find_by_id(12);
                        // echo $user->username;

                        $photo = Photo::find_by_id(81);
                        // echo $photo->filename;

                        $photos = Photo::find_all();

                        foreach($photos as $photo) {
                            // echo $photo->title;

                                                    // We create a new User Object
                        $photo = new Photo();
       
                        $photo->title = "Jesus Son of God";
                        $photo->description ="True Messiah";
                        $photo->filename ="About The Savior";
                        $photo->type ="Image";
                        $photo->size ="10";
                        // $photo->create();
                        }

                        ?>

                        <?php 
                            // === procedural way ===
                            // $sql = "SELECT * FROM users WHERE id=1";
                            // $result = $database->query($sql);
                            // === OOP way ===
                            // #1 We have the $result_set functionality from the find_all_user() method from user.php saved in the $result_set method
                            // #2 Then we loop through it with the mysqli_fetch_array and bring it back as an ARRAY and we assign the values to $row
                            // #3 We echo the value inside the $row, by echoing
                            // $result_set = User::find_all_users();
                            // // 
                            // while($row = mysqli_fetch_array($result_set)) {
                            //     echo $row['username'] . "<br>";
                            // }
                            // === procedural way ===
                            // mysqli_fetch_array to pull out the results
                            // $user_found = mysqli_fetch_array($result);
                            // echo $user_found['username'];

                            // === NOT THE BEST OOP APPROACH ===  
                            // $user = new User();
                            // $result_set = $user->find_all_users(); // UPDATE $result_set = User::find_all_users(); + add STATIC to the method
                            // // 
                            // while($row = mysqli_fetch_array($result_set)) {
                            //     echo $row['username'] . "<br>";
                            // }

                            // $found_user = User::find_user_by_id(1);
                            // // echo $found_user['username'];  // We return an array -> NOT WHAT WE WANT IN AN OOP COURSE 

                            // $user = User::instantiation($found_user);
                            
                            // echo $user->username;
                            // echo "<br>";
                            // $users = User::find_all_users();
                            // foreach($users as $user) {
                            //     echo $user->username . "<br>";
                            // }

                            $found_user = User::find_by_id(1);
                            // echo $found_user->username;

                            // $pictures = new Picture();

                            // echo INCLUDES_PATH;

                            ?>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->