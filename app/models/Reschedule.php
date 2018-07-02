<?php
    
    
    class Reschedule
    {
        private $patient_id;
        private $doctor_id;
        private $day;
        
        private $appointment;
        
        
        private $cxn;       // database object
        
        
        function __construct($reschedule)
        {
            // set data
            $this->set_data($reschedule);
            
            
            // connect DB
            $this->connect_db();
            
            
            // reserve appointment
            
            $this->reschedule();
            
        }
        
        
        private function set_data($reschedule)
        {
            $this->patient_id = $reschedule['patient_id'];
            $this->doctor_id = $reschedule['doctor_id'];
            $this->day = $reschedule['r_day'];
            
            
        }
        
        
        private function connect_db()
        {
            include '../models/Database.php';
            $this->cxn = new Database();
        }
        
        
        
        public function get_appointment()
        {
            return $this->appointment;
        }
        
        
        private function reschedule()
        {
            
            
            
            $validation_query = "SELECT * FROM resevations WHERE  patient_id = '$this->patient_id'";
            
            $validation_query_result = mysqli_query($this->cxn->conn,$validation_query);
            
            $num_rows = mysqli_num_rows($validation_query_result);
            
            
            if ($num_rows)
            {
                
                $upadte_query = "UPDATE reservations set day = 'monday' WHERE patient_id='$this->patient_id' AND doctor_id='$this->doctor_id'";
                
                mysqli_query($this->cxn->conn,$upadte_query);
                
                
                $select_query = "SELECT price FROM doctors WHERE id = '$this->doctor_id';";
                
                $result = mysqli_query($this->cxn->conn,$select_query);
                
                $price = NULL;
                
                while ($row = mysqli_fetch_assoc($result))
                {
                    
                    $price = $row['price'];
                }
                
                
                $upadte_query_02 = "UPDATE reservations SET invoice = '$price' WHERE patient_id='$this->patient_id' AND doctor_id='$this->doctor_id'";
                
                mysqli_query($this->cxn->conn,$upadte_query_02);
                
                $this->appointment = TRUE;
            }
            
            
            
            else
            {
                
                $this->appointment = FALSE;
            }
            
        }
        
        
        
        
        public function close()
        {
            $this->cxn->close();
        }
        
    }
    
    
    