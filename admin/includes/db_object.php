<?php 
    // MAIN CLASS
    class Db_object {

        public $errors = array();
        public $upload_errors_array = array(

            UPLOAD_ERR_OK => "There is no error",
            UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds upload_max_filesize directive",
            UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive",
            UPLOAD_ERR_PARTIAL =>  "The uploaded file was only partially uploaded",
            UPLOAD_ERR_NO_FILE => "No file was uploaded",
            UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
            UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
            UPLOAD_ERR_OK => "A PHP extension stopped the file upload."
        );
        
        protected static $db_table = "users";

                        // This is passing $_FILES['uploaded_file'] as an argument to the parameter $file
        public function set_file($file) {

            // ERROR CHECKING
            // Checks if the file is empty, OR if it's not a file, OR if it's not an array
            if(empty($file) || !$file || !is_array($file)) {
                $this->errors[] = "There was no file uploaded here";
                return false;

            } elseif($file['error'] !=0) {
                $this->errors[] = $this->upload_errors_array[$file['error']];
                return false;
            } else {
                // We set the values here
                $this->user_image = basename($file['name']);
                $this->tmp_path = $file['tmp_name'];
                $this->type = $file['type'];
                $this->size = $file['size'];
            }

        }
         // In order to use this method, we have to instantiate our class --> go to admin_content.php 
        public static function find_all() {
            // global $database;

            // $result_set = $database->query("SELECT * FROM users");
            // // We return the $result_set that comes from the query 
            // return $result_set;
            // We cannot use SELF keyword "self::find_by_query", because we cannot use static methods in properties [LATE STATIC BINDING]
           return static::find_by_query("SELECT * FROM " . static::$db_table . " "); // OOP way of querying the DB
        }

        public static function find_by_id($id) {

            $the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id = $id LIMIT 1");
             
            // if(!empty($the_result_array)) {
            //     $first_item = array_shift($the_result_array);
            //     return $first_item;
            // } else {
            //     return false;
            // }
            return !empty($the_result_array) ? array_shift($the_result_array) : false;

            // return $found_user;
        }

            // It has the role to make the query
            public static function find_by_query($sql) {
                global $database;
                $result_set = $database->query($sql);
                $the_object_array = array();
    
                while($row = mysqli_fetch_array($result_set)) {
                    $the_object_array[] = static::instantiation($row);
                }
    
                return $the_object_array;
            }

            public static function instantiation($the_record) {
                // Here we instantiate the object
                $calling_class = get_called_class();
                $the_object = new $calling_class; // OOP WAY 
    
                // $the_object->id         = $found_user["id"];
                // $the_object->username   = $found_user["username"];  
                // $the_object->password   = $found_user["password"];
                // $the_object->first_name = $found_user["first_name"];
                // $the_object->last_name  = $found_user["last_name"];  
    
                foreach($the_record as $the_attribute => $value) {
                    
                    if($the_object->has_the_attribute($the_attribute)) {
                        $the_object->$the_attribute = $value;
                    }
                }
    
                return $the_object;
            }
            
            private function has_the_attribute($the_attribute) {
                $object_properties = get_object_vars($this);
    
                return array_key_exists($the_attribute, $object_properties);
            }

            protected function properties() {
                // return get_object_vars($this);
                $properties = array();
                foreach(static::$db_table_fields as $db_field) {
                    if(property_exists($this, $db_field)) {
                        $properties[$db_field] = $this->$db_field;
                    }
                }
                return $properties;
            }

        protected function clean_properties() {
            global $database;

            $clean_properties = array();

            // We're looping through the $properties array
            foreach($this->properties() as $key => $value) {
                // We're cleaning the value and we assign it to the $clean_properties array
                $clean_properties[$key] = $database->escape_string($value);
            }
            // Returning the array
            return $clean_properties;
        }
            
        public function save() {
            return isset($this->id) ? $this->update() : $this->create(); 
        }

        // Query Method | In this form, the method will create a lot of problems
        public function create() {
            global $database; 

            $properties = $this->clean_properties();

            $sql = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties)) . ")";
            // We're pulling out values with implode() & array_values()
            $sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";



            // OLD LOGIC BEFORE ABSTRACTION
            // $sql .= $database->escape_string($this->username) . "', '";
            // $sql .= $database->escape_string($this->password) . "', '";
            // $sql .= $database->escape_string($this->first_name) . "', '";
            // $sql .= $database->escape_string($this->last_name) . "')"; 

            // Return TRUE/FALSE
            if($database->query($sql)) {

                // We pull the last ID from the query above and assign it to the object property
                $this->id = $database->the_inserted_id(); 

                return true;
            } else {
                return false;
            }
        } // End Create Method

        public function update() {
            global $database;

            // Adding abstraction
            $properties = $this->clean_properties();
            $properties_pairs = array();
            foreach ($properties as $key => $value) {
                $properties_pairs[] = "{$key}='{$value}'";
            }

            $sql = "UPDATE " . static::$db_table . " SET ";
            $sql .= implode(", ", $properties_pairs);

            // $sql .= "username= '" . $database->escape_string($this->username) . "' ,";
            // $sql .= "password= '" . $database->escape_string($this->password) . "' ,";
            // $sql .= "first_name= '" . $database->escape_string($this->first_name) . "' ,";
            // $sql .= "last_name= '" . $database->escape_string($this->last_name) . "' ";
            $sql .= " WHERE id= " . $database->escape_string($this->id);

            $database->query($sql);

            return (mysqli_affected_rows($database->connection) == 1) ? true : false;
        }


        public function delete() {
            global $database;

            $sql = "DELETE FROM " . static::$db_table . " ";
            $sql .= "WHERE id=" . $database->escape_string($this->id);
            $sql .= " LIMIT 1";

            $database->query($sql);

            return (mysqli_affected_rows($database->connection) == 1) ? true : false;
        }

        public static function count_all() {

            global $database;

            $sql = "SELECT COUNT(*) FROM " . static::$db_table;
            $result_set = $database->query($sql);
            $row = mysqli_fetch_array($result_set); 

            return array_shift($row);
        }
    }
?>