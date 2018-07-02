<?php
    
    
    class Login
    {
        private $email;
        private $password;
        
        private $cxn;       // database object
        
        function __construct($login_data)
        {
            // set data
            $this->set_data($login_data);
            
            
            // connect DB
            $this->connect_db();
            
            
            // get Data
            $this->get_data();
            
        }
        
        private function set_data($login_data)
        {
            $this->email = $login_data['email'];
            $this->password = $login_data['password'];
        }
        
        private function connect_db()
        {
            include '../models/Database.php';
            $this->cxn = new Database();
        }
        
        private function get_data()
        {
            $query = "SELECT * FROM users WHERE email = '$this->email'  AND password = '$this->password'";
            
            $query_result = mysqli_query($this->cxn->conn,$query);
            
            if (mysqli_num_rows($query_result) == 1)
            {
                return TRUE;
            }
            else
            {
                throw new Exception(" ");
                
            }
        }
        
        
       
        
        public function get_username()
        {
            $query = "SELECT * FROM users WHERE email = '$this->email'  AND password = '$this->password'";
            
            $result = mysqli_query($this->cxn->conn,$query);
            
            if ($result)
            {
                /* Get field information for all fields */
                while ($row = mysqli_fetch_row($result))
                {
                    return $row[1];
                }
                
                mysqli_free_result($result);
            }
            
            
        }
    
    
    
        public function get_email()
        {
            return $this->email;
        
        }
    
    
        public function get_user_id()
        {
            $query = "SELECT * FROM users WHERE email = '$this->email'";
    
            $result = mysqli_query($this->cxn->conn,$query);
    
            if ($result)
            {
                /* Get field information for all fields */
                while ($row = mysqli_fetch_row($result))
                {
                    return $row[0];
                }
                mysqli_free_result($result);
            }
        }
        
        
        public function close()
        {
            $this->cxn->close();
        }
        
    }


