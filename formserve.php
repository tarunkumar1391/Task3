<!DOCTYPE html>
<html>
<body>
<?php
/**
 * Hiwi: Task 3.
 * User: tarun
 *
 */
// DB credentials
$servername = "localhost";
$username = "root";
$password = "tarun1391";
$dbname = "clusterform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Prepared statement : Total of 28 input form elements  + 1 field in database for tu id

$stmt = $conn->prepare("INSERT INTO formgen (proj_title,prop_inst,dir_title,dir_lname,dir_fname,dir_street,dir_pcode,dir_city,dir_phone,dir_fax)
                            VALUES (?,?,?,?,?,?,?,?,?,?)");


if($_SERVER['REQUEST_METHOD'] == "POST"){
    $tempdir = '/home/tarun/Documents/HIWI/Task3/data';
    //1.Administrative Details
    $proj_title = isset($_POST['proj_title']) ? $_POST['proj_title'] : "0";
    echo "<p>The  title is $proj_title</p>";
    $file1 = tempnam($tempdir, time().'-').'txt';
    if( file_exists($file1)){
        unlink($file1);
    }
    mkdir($file1,0777,true);

    $prop_inst = isset($_POST['prop_inst']) ? $_POST['prop_inst'] : "0";
    echo "<p>The proposing institution is $prop_inst</p>";

//code for proposing state yet to come (2 input fields, one from dropdown and one to specify if the state wasn't present in the list

    $dir_title = isset($_POST['dir_title']) ? $_POST['dir_title'] : "0";
    echo "<p>The title is $dir_title </p>";

    $dir_lname = isset($_POST['dir_lname']) ? $_POST['dir_lname'] : "0";
    echo "<p>The lastname is $dir_lname </p>";

    $dir_fname = isset($_POST['dir_fname']) ? $_POST['dir_fname'] : "0";
    echo "<p>The firstname is $dir_fname </p>";

    $dir_street = isset($_POST['dir_street']) ? $_POST['dir_street'] : "0";
    echo "<p>The street is $dir_street </p>";

    $dir_pcode = isset($_POST['dir_pcode']) ? $_POST['dir_pcode'] : "0";
    echo "<p>The pin code is $dir_pcode </p>";

    $dir_city = isset($_POST['dir_city']) ? $_POST['dir_city'] : "0";
    echo "<p>The city is $dir_city </p>";

    $dir_phone = isset($_POST['dir_phone']) ? $_POST['dir_phone'] : "0";
    echo "<p>The phone num is is $dir_phone </p>";

    $dir_fax = isset($_POST['dir_fax']) ? $_POST['dir_fax'] : "0";
    echo "<p>The fax num is  is    $dir_fax </p>";



//Generate Error if prepare fails
    if(!$stmt){
        echo "Prepare failed:" . $mysqli->error;
    }
//Binding all 35 parameters
    if(!$stmt->bind_param("ssssssssss",$proj_title,$prop_inst,$dir_title,$dir_lname,$dir_fname,$dir_street,$dir_pcode,$dir_city,$dir_phone,$dir_fax)){
        echo "Binding paramaters failed:(" . $stmt->errno . ")" . $stmt->error;
    }
//Generate Error if statement execution fails
    if(!$stmt->execute()){
        echo "Execute failed: (" . $stmt->errno .")" . $stmt->error;
    }
    echo "new records created successfully";

}


$stmt->close();
$conn->close();

?>
</body>
</html>