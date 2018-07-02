<?php
    
    
    class Admin
    {
        private $username;
        private $email;
        private $password;
        private $user_type;
        
        //for edit - search in db with mail only "$new_email"
        private $new_username;
        private $new_email;
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
            $this->user_type = $data['user_type'];
            
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
            $this->new_password = $new_user_data['new_password'];
            $this->new_user_type = $new_user_data['new_user_type'];
            
            
            //validation
            
            $validation_query = "SELECT * FROM users WHERE email = '$this->email'";
            
            $validation_query_result = mysqli_query($this->cxn->conn,$validation_query);
            
            $num_rows = mysqli_num_rows($validation_query_result);
            
            
            if ($num_rows)
            {
                
                $user_id = NULL;
                
                $query = "SELECT * FROM users WHERE email = '$this->email'";
                
                $result = mysqli_query($this->cxn->conn,$query);
                
                while ($row = mysqli_fetch_assoc($result))
                {
                    $user_id = $row['id'];
                }
                
                
                //edit data in db
                $update_query_01 = "UPDATE patients SET name = '$this->new_username' WHERE user_id = '$user_id'";
                
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
        
        
        
        public function delete_user()
        {
            //validation
            
            $validation_query = "SELECT * FROM users WHERE email = '$this->email'";
            
            $validation_query_result = mysqli_query($this->cxn->conn,$validation_query);
            
            $num_rows = mysqli_num_rows($validation_query_result);
            
            
            if ($num_rows)
            {
                
                $user_id = NULL;
                
                $query = "SELECT * FROM users WHERE email = '$this->email'";
                
                $result = mysqli_query($this->cxn->conn,$query);
                
                while ($row = mysqli_fetch_assoc($result))
                {
                    $user_id = $row['id'];
                }
                
                $query_01 = "DELETE FROM patients WHERE user_id ='$user_id'";
                
                mysqli_query($this->cxn->conn,$query_01);
                
                
                //delete data in db
                
                $query_02 = "DELETE FROM users WHERE email='$this->email'";
                
                mysqli_query($this->cxn->conn,$query_02);
                
                return TRUE;
            }
            else
            {
                throw new Exception(" ");
            }
            
            
        }
        
        
        
        public function search_user()
        {
            $data = NULL;
            
            $query = "SELECT * FROM users ";
            
            $result = mysqli_query($this->cxn->conn,$query);
            
            $row = mysqli_fetch_assoc($result);
            
            
            while ($row = mysqli_fetch_assoc($result))
            {
                $data[] = $row['email'];
            }
            
            
            mysqli_free_result($result);
            
            return $data;
            
            
            
        }
        
        
        
        
        public function close()
        {
            $this->cxn->close();
        }
        
        
        
    }


