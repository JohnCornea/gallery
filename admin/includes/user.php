<?php 
    class User extends Db_object {
        // Properties
        // Implementing of abstraction using the protected static...
        protected static $db_table = "users";
        protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image'); 
        public $id;
        public $username;
        public $password;
        public $first_name;
        public $last_name;
        public $user_image;
        public $upload_directory = "images";
        public $image_placeholder = "http://place-hold.it/400x400&text=icornea";


        public function upload_photo() {

            // if($this->id) {
            //     $this->update();
                
            // } else {
                if(!empty($this->errors)) {
                    return false;
                }

                if(empty($this->user_image) || empty($this->tmp_path)) {
                    $this->errors[] = "the file was not available";
                    return false;
                }

                 $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;

                 if(file_exists($target_path)) {
                    $this->errors[] = "This file{$this->user_image} already exists";
                    return false;
                 }

                 if(move_uploaded_file($this->tmp_path, $target_path)) {
                    // if($this->create()) {
                        unset($this->tmp_path);
                        return true;
                    // }
                 } else {
                    $this->errors[] = "The file directory doesn't have permission";
                    return false;
                 }

            // }
        }

        public function image_path_and_placeholder() {
            return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
        }

        // $username & $password parameters are escaped below
        public static function verify_user($username, $password) {
            global $database;

            $username = $database->escape_string($username);
            $password = $database->escape_string($password);

            $sql =  "SELECT * FROM " . static::$db_table . " WHERE ";
            $sql .= "username = '{$username}' ";
            $sql .= "AND password = '{$password}' ";
            $sql .= "LIMIT 1";

            $the_result_array = static::find_by_query($sql);
    
            // Ternary syntax
            return !empty($the_result_array) ? array_shift($the_result_array) : false;

        }

        // AJAX PHP Method
        public function ajax_save_user_image($user_image, $user_id) {
            // $this->user_image = $user_image;
            // $this->id         = $user_id;

            // // We lose the image info because of this save() method
            // $this->save();
            global $database;

            $user_image = $database->escape_string($user_image);
            $user_id    = $database->escape_string($user_id);

            $this->user_image = $user_image;
            $this->id         = $user_id;

            $sql = "UPDATE " . self::$db_table . " SET user_image = '{$this->user_image}' ";
            $sql .= " WHERE id = {$this->id} ";
            $update_image = $database->query($sql);

            echo $this->image_path_and_placeholder();
        }

        public function delete_photo() {
            if($this->delete()) {
                
                $target_path = SITE_ROOT.DS. 'admin' . DS . $this->upload_directory . DS . $this->user_image;
                
                return unlink($target_path) ? true : false;

            } else {
                return false;
            }
        }

        // NOT WORKING YET
        // public function photos() {

        //     return Photo::find_by_query("SELECT * FROM photos WHERE user_id= " . $this->id);
        // }

    } // End User Class


?>