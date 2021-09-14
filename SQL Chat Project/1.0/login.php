<?php
if($_POST["username"] && $_POST["password"])
{
    $JSONData = "";
    $conn = new mysqli("localhost", "sa", "Suncoast$1", "CHAT"); // Create connection
    $result = $conn->query("CALL LOGIN_USER('". $_POST["username"] ."','". $_POST["password"] ."');");
    if ($result->num_rows > 0) {     // output data of each row
        while($row = $result->fetch_assoc()) {        
            $JSONData .= "{" . 
            "\"VALID\":" . $row["VALID"] . "," .
            "\"TOKEN\":\"" . $row["TOKEN"] . "\"" .
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
    echo $JSONData;
}
else
{
    echo "{\"error\":true}";
}
?>
