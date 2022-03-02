<?php
/*members
CCS/00082/019 -> VINCENT MUNENE MWENDA
CCS/00008/019 -> PATRICE MULINDI
CCS/00092/019 -> TITUS MURITHI
CCS/00141/019 ->  DERROL EDWARD
CCS/00037/019 -> FREDY M. ODHIAMBO

*/
function connect($server, $user, $password, $db_name)
{
    $db = new mysqli(
        $server,
        $user,
        $password
    );

    $sql = "CREATE DATABASE IF NOT EXISTS students_information";

    if ($db->query($sql) === true) {
        $db = new mysqli(
            $server,
            $user,
            $password,
            $db_name
        );
      
    }

    $sql1 = "CREATE TABLE IF NOT EXISTS student_data (ID int(11) AUTO_INCREMENT,
                      fname varchar(255) NOT NULL,
                      lname varchar(255) NOT NULL,
                      adm_number varchar(255) NOT NULL,
                      `email` varchar (255) NOT NULL,
                      `stage` varchar (255) NOT NULL,
                      PRIMARY KEY  (ID))";
    $db->query($sql1);

    return $db;
}

    function deleteRecords(mysqli $db,  $id)
    {
        $sql = "DELETE FROM student_data WHERE `ID` = '$id' ";
        $db->query($sql);
        $sql = "DELETE FROM university_enrollment_data WHERE `student_id` = '$id' ";
        $db->query($sql);
    }

    function insertRecords(mysqli $db, array $record)
    {
        $sql = "INSERT INTO student_data(`fname`,`lname`,`adm_number`,`email`,`stage`) VALUES('$record[0]','$record[1]', '$record[2]','$record[3]','$record[4]')";


        $db->query($sql);
            

    }


