<?php 
    
    $host         = "localhost";
    
    $username     = "aw";
    
    $password     = "aw";

    $dbname       = "game";
    
    $result_array = array();
    /* Create connection */
    $conn = new mysqli($host, $username, $password, $dbname);

    /* Check connection  */
    if ($conn->connect_error) {
         die("Connection to database failed: " . $conn->connect_error);
    }
    /* SQL query to get results from database */
    
    $sql = "SELECT idRoom, nivel, nameRoom, description, direccion, destino, imagen FROM rooms2 ";
    
    $result2 = $conn->query($sql);
    /* If there are results from database push to result array */
    
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            array_push($result_array, $row);
        }
    }
    /* send a JSON encded array to client */
    echo json_encode($result_array);
    
    $conn->close();
