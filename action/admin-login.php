<?php
    if(isset($_POST['login-submit'])) {
        require '../include/database-conn.php';

        $mailID = $_POST['Email'];
        $pwd = $_POST['pwd'];

        if(empty($mailID) || empty($pwd)) {
            header("Location: ../index.php?error=emptyfields");
            exit();
        }
        else {
            $sql = "SELECT * FROM admins WHERE adminName=? OR adminEmail=?;";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../index.php?error=sqlerror");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, 'ss', $mailID, $mailID);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)) {
                    $pwdCheck = password_verify($pwd, $row['adminPWD']);
                    if($pwdCheck == false) {
                        echo "Wrong pwd";
                        header("Location: ../index.php?error=wrongpassword");
                        exit();
                    }
                    else if($pwdCheck == true) {
                        session_start();
                        $_SESSION['userID'] = $row['adminID'];
                        $_SESSION['userName'] = $row['adminName'];
                        $_SESSION['pageredirector'] = 'admin.php';

                        header("Location: ../admin.php?login=success");
                        exit();
                    }
                    else {
                        header("Location: ../index.php?error=wrongpassword");
                        exit();
                    }
                }
            }
        }
        mysqli_stmt_close("$stmt");
        mysqli_close("$conn");
    }
    else {
        header("Location: ../index.php");
        exit();
    }
?>