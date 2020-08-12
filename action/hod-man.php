<?php
    require "../include/database-conn.php";

    $id = $_POST["select-hod-id"];
    $dept = $_POST["invisible"];
    mysqli_query($conn, "UPDATE department SET HODid=$id WHERE depName='$dept'");

    header("Location: ../admin.php#tab4");
    exit();

    // if(isset($_POST["new-hod-submit1"]) || isset($_POST["new-hod-submit2"])) {
    //     require "../include/database-conn.php";
    //     if(isset($_POST["new-hod-submit1"])) {
    //         $id = $_POST['select-hod'];
    //         $result = mysqli_query($conn, "SELECT employeeName FROM employee WHERE employeeID=$id", $resultmode = MYSQLI_STORE_RESULT);
    //         $row = mysqli_fetch_assoc($result);
    //         $ename = $row['employeeName'];
    //     }
    //     if(isset($_POST["new-hod-submit2"])) {
    //         $name = $_POST['select-hod'];
    //         $result = mysqli_query($conn, "SELECT employeeID FROM employee WHERE employeeName=$name", $resultmode = MYSQLI_STORE_RESULT);
    //         $row = mysqli_fetch_assoc($result);
    //         $eid = $row['employeeID'];
    //     }
    // }
    // else {
    //     header("Location: ../admin.php#tab4");
    //     exit();
    // }
?>