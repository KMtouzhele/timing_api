<?php
include_once("DBConn.php");  
include_once("Customer.php");  
  
class Model 
{  
    public function getCustomerList()  
    {  
        global $mysqli;

        $sql = "SELECT * FROM customer";

        $result = $mysqli->query($sql);

        $arr = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            $arr[$row['id']] = new Customer($row['id'], $row['fname'],$row['lname'],$row['email']);
        }
        return $arr;

    }
  
    public function getCustomerByID($id)  {
        global $mysqli;

        $sql = "SELECT * FROM customer WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $selected = array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $selected[] = new Customer($row['id'], $row['fname'], $row['lname'], $row['email']);
        }
        return $selected;
    }
    
    public function getCustomerByName($name)  {
        global $mysqli;

        $sql = "SELECT * FROM customer WHERE fname LIKE ? OR lname LIKE ?";
        $stmt = $mysqli->prepare($sql);
        $searchTerm = '%' . $name . '%';
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        $selected = array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $selected[] = new Customer($row['id'], $row['fname'], $row['lname'], $row['email']);
        }
        return $selected;
    }
} 
?>