<?php
    
    
    class Register
    {
        private $username;
        private $email;
        private $password;
        private $user_type;
        
        private $cxn;       // database object
        
        
        function __construct($register_data)
        {
            // set data
            $this->set_data($register_data);
            
            
            // connect DB
            $this->connect_db();
            
            
            // register User
            $this->register_user();
            
        }
        
        
        private function set_data($register_data)
        {
            $this->username = $register_data['username'];
            $this->email = $register_data['email'];
            $this->password = $register_data['password'];
            $this->user_type = $register_data['user_type'];
        }
        
        
        private function connect_db()
        {
            include '../models/Database.php';
            $this->cxn = new Database();
        }
        
        
        private function register_user()
        {
            
            //validation
            
            $validation_query = "SELECT * FROM users WHERE email = '$this->email'";
            
            $validation_query_result = mysqli_query($this->cxn->conn,$validation_query);
            
            $num_rows = mysqli_num_rows($validation_query_result);
            
            
            
            if ($num_rows)
            {
                throw new Exception(" ");
                
                
            }
            else
            {
                //insert in db
                
                $insert_query_01 = "INSERT INTO users (username , email , password , user_type) VALUES ('$this->username' , '$this->email' , '$this->password' , '$this->user_type');";
                
                mysqli_query($this->cxn->conn,$insert_query_01);
                
                if ($this->user_type == 'patient')
                {
                    $insert_query_02 = "INSERT INTO patients (name , user_id)VALUES ('$this->username' , LAST_INSERT_ID());";
                    
                    mysqli_query($this->cxn->conn,$insert_query_02);
                }
                
                return TRUE;
            }
        }
        
        
        
        
        
        public function close()
        {
            $this->cxn->close();
        }
        
    }


