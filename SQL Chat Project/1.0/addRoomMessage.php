<?php
if($_POST["sessionToken"] && $_POST["roomName"] && $_POST["roomName"] && $_POST["message"])
{
    $JSONData = "[";
    $conn = new mysqli("localhost", "sa", "Suncoast$1", "CHAT"); // Create connection
    $_POST["message"] = str_replace("\"","\\\\\"",str_replace("'", "''", $_POST["message"]));
    $sql = "CALL ADD_ROOM_MESSAGE('". $_POST["sessionToken"] ."','". $_POST["roomName"] ."','" . $_POST["message"]. "');";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {     // output data of each row
        while($row = $result->fetch_assoc()) {        
            $JSONData .= "{" . 
            "\"VALID\":" . $row["VALID"] .
            "},";
        }
    }
    else
    {
        echo "{\"error\":true}";
        $conn->close();
        return;
    }
    $conn->close();
    $JSONData = substr ( $JSONData, 0, strlen($JSONData)-1 );
    $JSONData .= "]";
    echo $JSONData;
}
else
{
    echo "{\"error\":true}";
}
?>
