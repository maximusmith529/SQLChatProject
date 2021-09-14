<?php
if($_POST["sessionToken"])
{
    $JSONData = "[";
    $conn = new mysqli("localhost", "sa", "Suncoast$1", "CHAT"); // Create connection
    $sql = "CALL GET_ROOMS('". $_POST["sessionToken"] ."');";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {     // output data of each row 
        while($row = $result->fetch_assoc()) {        
            $JSONData .= "{" . 
            "\"VALID\":" . $row["VALID"] . "," .
            "\"ROOM_NAME\":\"" . $row["ROOM_NAME"] . "\"," .
            "\"ROOM_DESC\":\"" . $row["ROOM_DESC"] . "\"" .
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
