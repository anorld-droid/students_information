<?php
require_once "config.php";
require_once "database.php";

$db = connect(DB_SERVER, DB_USER, PASSWORD, DB_NAME);




if (isset($_REQUEST['query'])) {


    $searchQuery = $_REQUEST['query'];
    $formattedQuery = trim($searchQuery);
    $conn = connect("localhost", "root", "", "students_information");


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
           <td>" . $row['email'] . "</td>
           
             <td>" . $row['stage'] . "</td>
             

        </tr>
        ";
        }
    } else {
        echo "Person not found";
    }
} else {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $adm_number = $_POST['adm_number'];
    $stage = 'Y' . $_POST['year'] . 'S' . $_POST['sem'];
    $data = array($fname, $lname, $adm_number, $email, $stage);
    insertRecords($db, $data);


    echo "
    <script>
        window.location.href = 'signup.html';

        alert('successfully signed up');
        </script>
    
    ";
}
