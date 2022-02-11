<?php
function connect($server, $user, $pass, $db_name)
{
    $db = new mysqli(
        $server,
        $user,
        $pass
    );
    $sql = "CREATE DATABASE IF NOT EXISTS students_information";

    if ($db->query($sql)) {
        $db = new mysqli(
            $server,
            $user,
            $pass,
            $db_name
        );

        echo "created";
    } else {
        echo "Failed";
    }
}
