<?php
    
    
    class Patient
    {
        
        private $username;
        private $email;
        private $password;
        private $user_id ;
        
        
        //for edit - search in db with mail only "$new_email"
        private $new_username;
        private $new_email;
        private $new_age;
        private $new_gender;
        private $new_password;
        private $new_user_type;
        
        private $cxn;       // database object
        
        
        function __construct($data = NULL)
        {
            // set data
            $this->set_data($data);
            
            
            // connect DB
            $this->connect_db();
            
            
        }
        
        
        private function set_data($data)
        {
            $this->username = $data['username'];
            $this->email = $data['email'];
            $this->password = $data['password'];
            $this->user_id = $data['user_id'];
    
        }
        
        
        private function connect_db()
        {
            include '../models/Database.php';
            $this->cxn = new Database();
        }
        
        
        public function edit_user($new_user_data)
        {
            $this->new_username = $new_user_data['new_username'];
            $this->new_email = $new_user_data['new_email'];
            $this->new_age = $new_user_data['new_age'];
            $this->new_gender = $new_user_data['new_gender'];
            $this->new_password = $new_user_data['new_password'];
            $this->new_user_type = $new_user_data['new_user_type'];
            
            //validation
            
            $validation_query = "SELECT * FROM users WHERE email = '$this->email'";
            
            $validation_query_result = mysqli_query($this->cxn->conn,$validation_query);
            
            $num_rows = mysqli_num_rows($validation_query_result);
            
            
            if ($num_rows)
            {
                //edit data in db
    
                $update_query_01 = "UPDATE patients SET name = '$this->new_username' , age = '$this->new_age' , gender = '$this->new_gender' WHERE user_id = '$this->user_id';";
    
                mysqli_query($this->cxn->conn,$update_query_01);
    
                
                $update_query_02 = "UPDATE users SET username = '$this->new_username', email = '$this->new_email' , password = '$this->new_password',user_type = '$this->new_user_type' WHERE email = '$this->email';";
                
                mysqli_query($this->cxn->conn,$update_query_02);
                
                
                return TRUE;
                
            }
            else
            {
                throw new Exception(" ");
            }
        }
        
        
        
        
        
        
        
        
        
        public function close()
        {
            $this->cxn->close();
        }
        
    }
    
    
    