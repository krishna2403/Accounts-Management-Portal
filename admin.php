<?php
require "include/database-conn.php";
session_start();
if(!isset($_SESSION['userName'])) {
    header("Location: index.php");
    die();
}
$userName = $_SESSION['userName'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="js/script.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <!-- <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script> -->
    <title>admin</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-dark fixed-top">
        <div class="container-fluid">
            <ul class="nav-list">  
                <a class="nav-item" href="#top">Home</a>
                <a class="nav-item" href="#top">Profile</a>
                <a class="nav-item" href="action/admin-logout.php"><button type="submit" name="logout-submit">Log Out</button></a>
            </ul>
        </div>
    </nav>

    <div class="container-fluid tab1" id="profile-tab">
        <div class="flex-container">
            <div class="tab1-col1">
                <h4 class="heading">Actions</h4>
                <hr class="line">
                <a href="#add-employee">Add new Employee</a>
                <hr class="line">
                <a href="#tab3">Delete Employee</a>
                <hr class="line">
                <a href="#tab4">Add new HOD</a>
                <hr class="line">
                <a href="#">Add Salaries</a>
                <hr class="line">
                <a href="#">Add New Administrator</a>
                <hr class="mb-0">
            </div>
            <div class="tab1-col2">
                <div id="profile">
                    <?php
                        $sql = "SELECT * FROM admins WHERE adminName='".$userName."';";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        echo '
                            <h6>First Name: ' .$row["firstName"]. '</h6>
                            <h6>Last Name: ' .$row["lastName"]. '</h6>
                            <h6>Name: ' .$row["adminName"]. '</h6>
                            <h6>ID: ' .$row["adminID"]. '</h6>
                            <h6>Email: ' .$row["adminEmail"]. '</h6>
                        ';
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="tab2" id="add-employee">
        <div class="flex-container tab2-flex">
            <div class="tab2-form">
                <form id="tab2-form1-scr" action="action/employee-add.php" method="post">
                    <div class="flex-container tab2-form-row">
                        <div class="tab2-form-col">
                            <label for="fName">First Name</label><br>
                            <input type="text" name="fName" placeholder="First Name"><br><br>
                            <label for="dateOfJoin">Date of Joining</label><br>
                            <input type="date" name="dateOfJoin" placeholder="YYYY-MM-DD"><br><br>
                            <label for="designation">Designation</label><br>
                            <select type="text" name="designation">
                                <option class="grey-text" disabled selected hidden>Select Designation</option>
                                <?php
                                    $dsgns = mysqli_query($conn, "SELECT desName FROM designation", $resultmode = MYSQLI_STORE_RESULT);
                                    while($rows = mysqli_fetch_assoc($dsgns)) {
                                        $var = $rows['desName'];
                                        echo "<option>$var</option>";
                                    }
                                ?>
                            </select><br><br>
                            <label for="accNum">Account number</label><br>
                            <input type="text" name="accNum" placeholder="Account Number"><br><br>
                            <label for="bankName">Bank Name</label><br>
                            <select type="text" name="bankName">
                                <option class="grey-text" disabled selected hidden>Select Bank</option>
                                <option>SBI</option>
                                <option>PNB</option>
                                <option>ICICI</option>
                                <option>HDFC</option>
                                <option>BOI</option>
                            </select><br><br><br>
                            <button type="submit" name="add-em-submit">Submit</button>
                        </div>
                        <div class="tab2-form-col">
                            <label for="lName">Last Name</label><br>
                            <input type="text" name="lName" placeholder="Last Name"><br><br>
                            <label for="lName">Temporary Password</label><br>
                            <input type="password" name="pwd" placeholder="Password"><br><br>
                            <label for="department">Department</label><br>
                            <select type="text" name="department">
                                <option class="grey-text" disabled selected hidden>Select Department</option>
                                <?php
                                    $depts = mysqli_query($conn, "SELECT depName FROM department", $resultmode = MYSQLI_STORE_RESULT);
                                    while($rows = mysqli_fetch_assoc($depts)) {
                                        $var = $rows['depName'];
                                        echo "<option>$var</option>";
                                    }
                                ?>
                            </select><br><br>
                            <label for="ifsc">IFSC code</label><br>
                            <input type="text" name="ifsc" placeholder="IFSC"><br><br>
                            <label for="housing">Housing</label><br>
                            <select type="text" name="housing">
                                <option class="grey-text" disabled selected hidden>Select Housing</option>
                                <option>YES</option>
                                <option>NO</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="tab3">
        <div class="tab3-display-emp-btn">
            <input type="button" id="tab3-emp-show" onclick="display_emp()" value="Hide Employee List">
        </div>

        <div id="tab3-del-emp" style="display:block;">
            <?php
                $records = mysqli_query($conn, "SELECT * FROM employee", $resultmode = MYSQLI_STORE_RESULT);
                if(mysqli_num_rows($records)) {
                    echo '<div class="tab3" id="delete-employee">
                            <div class="flex-container tab3-flex">
                                <form id="tab3-form" action="action/employee-delete.php" method="post">
                                    <table>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Department</th>
                                        </tr>';
                    while($row = mysqli_fetch_assoc($records)) {
                        echo "<tr>
                                <td><input name='del-check[]' value='".$row['employeeID']."' type='checkbox'></td>
                                <td>".$row['employeeID']."</td>
                                <td>".$row['employeeName']."</td>
                                <td>".$row['designation']."</td>
                                <td>".$row['dept']."</td>
                                </tr>";
                    }
                    echo '<br>
                            </table><br><br>
                            <button type="submit" name="del-submit">Delete</button>
                            </form>
                        </div>
                    </div>';
                }
                else {
                    echo "<div class='tab3-flex' style='text-align:center;padding-bottom:5em;'>
                            <h4 style='margin:0px;'>No employee records found</h4>
                          </div>
                            ";
                }
            ?>
        </div>
    </div>

    <div id="tab4">
        <div class="tab4-display-hod-btn">
            <button type="button" id="tab4-hod-show" onclick="display_hod()" name="hod-list-show">Hide HOD List</button>
        </div>

        <div id="tab4-hod-add" style="display:block;">
            <div class="tab4-hod-list">
                <?php
                    $result = mysqli_query($conn, "SELECT depName, HODid, employeeName FROM department LEFT JOIN employee ON department.HODid = employee.employeeID", $resultmode = MYSQLI_STORE_RESULT);
                    if(mysqli_num_rows($result)) {
                        echo "<table width='100%'>
                                <tr>
                                    <th width='25%'>Department</th>
                                    <th width='25%'>HOD_ID</th>
                                    <th width='30%'>HOD Name</th>
                                    <th width='10%'></th>
                                    <th width='10%'></th>
                                </tr>";
                        while($row = mysqli_fetch_assoc($result)) {
                            if(is_null($row['HODid'])) {
                                $btn = "Assign";
                                $sig = 0;
                            }
                            else {
                                $btn = "Change";
                                $sig = 1;
                            }
                            $department = $row['depName'];
                            echo "<tr>
                                    <td>".$row['depName']."</td>
                                    <td><div id='".$row['depName']."-id' style='display:block;'>".$row['HODid']."</div>
                                        <div id='".$row['depName']."-id1' style='display:none;'>
                                            <form id='tab4-".$row['depName']."-id' action='action/hod-man.php' method='post'>
                                                <select id='select-hod-id-".$row['depName']."' name='select-hod-id' onchange="; echo '"var val1='; echo 'selected_id('; echo "'".$row['depName']."'"; echo ')" '; echo "type='number'>
                                                    <option disabled selected hidden>Select by ID</option>";
                                                    $empList = mysqli_query($conn, "SELECT employeeID FROM employee WHERE dept='$department'", $resultmode = MYSQLI_STORE_RESULT);
                                                    while($row1 = mysqli_fetch_assoc($empList)) {
                                                        echo "<option>".$row1['employeeID']."</option>";
                                                    }
                                            echo "</select>";
                                            echo "<input name='invisible' style='display:none;' value='".$row['depName']."'>
                                            </form>
                                        </div>";
                                    
                            echo "</td>
                                    <td><div id='".$row['depName']."-name' style='display:block;'>".$row['employeeName']."</div>
                                        <div id='".$row['depName']."-name1' style='display:none;'>
                                            <form id='tab4-".$row['depName']."-name' action='action/hod-man.php' method='post'>
                                                <select id='select-hod-name-".$row['depName']."' name='select-hod-name' onchange="; echo '"var val2='; echo 'selected_name('; echo "'".$row['depName']."'"; echo ')" '; echo "type='text'>
                                                    <option disabled selected hidden>Select by Name</option>";
                                                    $empList = mysqli_query($conn, "SELECT employeeName FROM employee WHERE dept='$department'", $resultmode = MYSQLI_STORE_RESULT);
                                                    while($row1 = mysqli_fetch_assoc($empList)) {
                                                        echo "<option>".$row1['employeeName']."</option>";
                                                    }
                                            echo "</select>";
                                            echo "<input name='invisible' style='display:none;' value='".$row['depName']."'>
                                            </form>
                                        </div>";
                                   
                            echo "</td>
                                    <td>
                                        <input id='".$row['depName']."-btn' type='button' class='hod-man-btn' onclick="; echo '"hod_man('; echo "'".$row['depName']; echo "', "; echo $sig.")"; echo '" '; echo  "value='$btn'>
                                    </td>
                                    <td>
                                        <div id='tab4-".$row['depName']."-form-submit' style='display:none;'>
                                            <input class='hod-man-btn' type='submit' onclick="; echo '"submitForm('; echo "'".$row['depName']."')"; echo '"'; echo " value='Submit'>
                                        </div>
                                    </td>
                                  </tr>";
                        }
                        echo "</table>";
                    }
                    else {
                        echo "<div class='tab4-hod-add'>
                                <h4>No records found</h4>
                              </div> 
                            ";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>