<?php
    if(isset($_POST['add-em-submit'])) {
        require '../include/database-conn.php';

        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $rawDOJ = $_POST['dateOfJoin'];
        $DOJ = date('Y-m-d', strtotime($rawDOJ));
        $pwd = $_POST['pwd'];
        $designation = $_POST['designation'];
        $dept = $_POST['department'];
        $accNum = $_POST['accNum'];
        $ifsc = $_POST['ifsc'];
        $housing = $_POST['housing'];
        $bankName = $_POST['bankName'];

        if(empty($fName) || empty($DOJ) || empty($pwd) || empty($designation) || empty($dept) || empty($accNum) || empty($ifsc) || empty($housing) || empty($bankName)) {
            header("Location: ../admin.php?emptyfields");
            exit();
        }
        else {
            $sql = "SELECT * FROM employee WHERE firstName=? AND lastName=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../admin.php?sqlerror");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, 'ss', $fName, $lName);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $result = mysqli_stmt_num_rows($stmt);
                if($result > 0) {
                    header("Location: ../admin.php?error=usertaken");
                    exit();
                }
                else {
                    $num = mysqli_query($conn, "SELECT MAX(`employeeID`) AS max_id FROM employee", $resultmode = MYSQLI_STORE_RESULT);
                    $rows = mysqli_fetch_assoc($num);
                    if($rows['max_id'] = 'NULL') {
                        mysqli_query($conn, "ALTER TABLE employee AUTO_INCREMENT=0");
                    }
                    else {
                        mysqli_query($conn, "ALTER TABLE employee AUTO_INCREMENT='$num'");
                    }
                    $sql = "INSERT INTO `employee`(`firstName`, `lastName`, `dateOfJoin`, `accountNumber`, `ifscCode`, `employeePWD`, `designation`, `dept`, `housing`, `bankName`) VALUES (?,?,?,?,?,?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../admin.php?sqlerror");
                        exit();
                    }
                    else {
                        $hashedPWD = password_hash($pwd, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt, 'ssssssssss', $fName, $lName, $DOJ, $accNum, $ifsc, $hashedPWD, $designation, $dept, $housing, $bankName);
                        mysqli_stmt_execute($stmt);
                        /* Updating no of employees */
                        mysqli_query($conn, "UPDATE department SET noOfEmployees = noOfEmployees + 1 WHERE depName='$dept'");
                        header("Location: ../admin.php?employee_add=successfull");
                        exit();
                    }
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    else {
        header("location: ../admin.php");
        exit();
    }
?>