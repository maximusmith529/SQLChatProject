<?php
if($_POST["sessionToken"] && $_POST["roomName"])
{
    //GET_ALL_ROOM_MESSAGES(IN PASSED_TOKEN VARCHAR(256), IN PROOM_NAME VARCHAR(64)) 
    $JSONData = "[";
    $conn = new mysqli("localhost", "sa", "Suncoast$1", "CHAT"); // Create connection
    $sql = "CALL GET_ALL_ROOM_MESSAGES('". $_POST["sessionToken"] ."','". $_POST["roomName"] ."');";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {     // output data of each row
        while($row = $result->fetch_assoc()) {        
            $JSONData .= "{" . 
            "\"VALID\":" . $row["VALID"] . "," .
            "\"USER_NAME\":\"" . $row["USER_NAME"] . "\"," .
            "\"MTIME\":\"" . $row["MTIME"] . "\"," .
            "\"MESSAGE\":\"" . $row["MESSAGE"] . "\"" .
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
