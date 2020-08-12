<?php
    if(isset($_POST['del-submit'])) {
        require "../include/database-conn.php";

        if(!empty($_POST['del-check'])) {
            foreach ($_POST['del-check'] as $id) {
                $dep = mysqli_query($conn, "SELECT dept FROM employee WHERE employeeID=$id", $resultmode = MYSQLI_STORE_RESULT);
                while($row = mysqli_fetch_assoc($dep)) {
                    $dept = $row['dept'];
                    echo $dept;
                    mysqli_query($conn, "UPDATE department SET noOfEmployees = noOfEmployees - 1 WHERE depName='$dept'");
                }
                mysqli_query($conn, "DELETE FROM employee WHERE employeeID=$id");
            }
            header("Location: ../admin.php?deletion=success");
            exit();
        }
        else {
            header("Location: ../admin.php?selected=none");
            exit();
        }
    }
    else {
        header("Location: ../admin.php");
        exit();
    }
?>