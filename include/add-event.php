<?php 
    //require("phpsqlajax_dbinfo.php");
    /*This handles the inputs in the form and appends to the database for events*/
    function create_event($user, $db){
        $errors = array();
        $name = mysqli_real_escape_string($db, $_POST['event_name']);
        $date = mysqli_real_escape_string($db, $_POST['event_date']);
        $address = mysqli_real_escape_string($db, $_POST['event_address']);
        $time = mysqli_real_escape_string($db, $_POST['event_time']);
        $description = mysqli_real_escape_string($db, $_POST['event_description']);
        /*makes sure all fields have an input*/
        if(empty($name)){
            array_push($errors, "Event Name is required"); 
        }
        if(empty($date)){
            array_push($errors, "Date is required"); 
        }
        if(empty($address)){
            array_push($errors, "Address is required");
        }
        if(empty($time)){
            array_push($errors, "Time is required");
        }
        if(empty($description)){
            array_push($errors, "Description is required");
        }
        /*if there are no errors add to the database*/
        if(count($errors) == 0){
            $sql = "INSERT INTO events (name, date, event_address, time, description, user_id) VALUES ('$name','$date','$address','$time','$description', '$user')";
            add_event_db($sql, $db);
            export_event_dom_xml();
        }
    }
    /*runs the addition to the database*/
    function add_event_db($sql, $db){
        mysqli_query($db, $sql);
        header("Location: events.php");
    }
    function export_event_dom_xml(){
        
        
        $dom = new DOMDocument("1.0");
        $node = $dom->createElement("markers");
        $parnode = $dom->appendChild($node);
        
        $query = "SELECT * FROM events";
        $result = mysql_query($query);
        if (!$result) {
          die('Invalid query: ' . mysql_error());
        }
        
        header("Content-type: text/xml");
        
        while ($row = @mysql_fetch_assoc($result)){
            // Add to XML document node
            $node = $doc->create_element("marker");
            $newnode = $parnode->append_child($node);
            
            $newnode->set_attribute("id", $row['event_id']);
            $newnode->set_attribute("name", $row['name']);
            $newnode->set_attribute("date", $row['date']);
            $newnode->set_attribute("time", $row['time']);
            $newnode->set_attribute("desc", $row['description']);
            $newnode->set_attribute("user_id", $row['user_id']);
            $newnode->set_attribute("address", $row['event_address']);
        }
        
        $filepath='/include/events.xml';
        $xmlfile = $doc;
        $dom->save($filepath);
    }
?>