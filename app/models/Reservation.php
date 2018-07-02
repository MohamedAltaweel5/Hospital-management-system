<?php
    
    
    class Reservation
    {
        private $patient_id;
        private $doctor_id;
        private $day;
        
        private $appointment;
        
        
        private $cxn;       // database object
        
        
        function __construct($reservation)
        {
            // set data
            $this->set_data($reservation);
            
            
            // connect DB
            $this->connect_db();
            
            
            // reserve appointment
            
            $this->reserve();
            
        }
        
        
        private function set_data($reservation)
        {
            $this->patient_id = $reservation['patient_id'];
            $this->doctor_id = $reservation['doctor_id'];
            $this->day = $reservation['day'];
            
            
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
        
        
        private function reserve()
        {
            $validation_query = "SELECT * FROM reservations WHERE  patient_id = '$this->patient_id'";
            
            $validation_query_result = mysqli_query($this->cxn->conn,$validation_query);
            
            $num_rows = mysqli_num_rows($validation_query_result);
            
            
            if ($num_rows)
            {
                $this->appointment = TRUE;
            }
            
            
            
            else
            {
                
                $insert_query = "INSERT INTO reservations (day, patient_id, doctor_id) VALUES ('$this->day','$this->patient_id','$this->doctor_id');";
                
                mysqli_query($this->cxn->conn,$insert_query);
                
                
                $select_query = "SELECT price FROM doctors WHERE id = '$this->doctor_id';";
                
                $result = mysqli_query($this->cxn->conn,$select_query);
                
                $price = NULL;
                
                while ($row = mysqli_fetch_assoc($result))
                {
                    
                    $price = $row['price'];
                }
                
                
                $insert_query = "UPDATE reservations SET invoice = '$price' WHERE id = last_insert_id();";
                mysqli_query($this->cxn->conn,$insert_query);
                
                
            }
            
        }
        
        
        
        
        
        
        
        public function close()
        {
            $this->cxn->close();
        }
        
    }
    
    
    