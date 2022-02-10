<?php

function connect($server, $user, $password, $db_name)
{
    $db = new mysqli(
        $server,
        $user,
        $password
    );

    if ($db->connect_error) {
        echo "cannot connect";
    }
    $sql = "CREATE DATABASE IF NOT EXISTS student_details";

    if ($db->query($sql) === true) {
        $db = new mysqli(
            $server,
            $user,
            $password,
            $db_name
        );
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
    }
    $sql1 = "CREATE TABLE IF NOT EXISTS student_data (ID int(11) AUTO_INCREMENT,
                      fname varchar(255) NOT NULL,
                      lname varchar(255) NOT NULL,
                      adm_number varchar(255) NOT NULL,
                      `status` varchar (255) NOT NULL,
                      completion int NOT NULL,
                      PRIMARY KEY  (ID))";
    if ($db->query($sql1) === TRUE) {
        echo "Database and Table Online";
    }
    return $db;
}
if (isset($_REQUEST['query'])) {
    function select()
    {
        $searchQuery = $_REQUEST['query'];
        $formattedQuery = trim($searchQuery);
        $conn = connect("localhost", "root", "", "student_details");


        $query2 = "SELECT * FROM student_data WHERE `fname`   LIKE  '" . $formattedQuery . "%'";
        $resultSet = mysqli_query($conn, $query2);

        if (mysqli_num_rows($resultSet)) {
            while ($row = mysqli_fetch_assoc($resultSet)) {
                echo "
        <tr>
        <td>" . $row['ID'] . "</td>
         <td>" . $row['fname'] . "</td>
         <td>" . $row['lname'] . "</td>
          <td>" . $row['adm_number'] . "</td>
           <td>" . $row['status'] . "</td>
           
             <td>" . $row['completion'] . "</td>

        </tr>
        ";
            }
        } else {
            echo "Person not found";
        }
    }
} else {
    function deleteRecords(mysqli $db,  $id)
    {
        $sql = "DELETE FROM student_data WHERE `ID` = '$id' ";
        $db->query($sql);
        $sql = "DELETE FROM university_enrollment_data WHERE `student_id` = '$id' ";
        $db->query($sql);
    }

    function insertRecords(mysqli $db, array $record)
    {
        $sql = "INSERT INTO student_data(`fname`,`lname`,`adm_number`,`status`,`completion`) VALUES('$record[0]','$record[1]', '$record[3]','$record[5]','$record[6]')";


        if ($db->query($sql)) {
            echo "records inserted succefully";
        } else {
            echo "failed";
            echo $db->error;
        }
    }
}
