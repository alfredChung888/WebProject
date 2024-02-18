<?php
// ensure the page is not cached
require_once("nocache.php");


// get access to the session variables
session_start();

// check if the user is logged in
if (!$_SESSION["employeeId"]) {
          $errorLoggedIn = "Error has occured. Please log in";
          header("Location:logoff.php?errorLoggedIn=$errorLoggedIn");
}
$employeeId = $_SESSION['employeeId'];
$completed = '';



require_once("dbconn.php");

if ($_SESSION['employeeId'] == 'DMCEO' || $_SESSION["employeeId"] == 'DM001' || $_SESSION["employeeId"] == 'DM002') {
          $sql = "SELECT employee.surname, employee.firstname,review.employee_id, review.review_year, review.date_completed,review.completed,review.review_id ";
          $sql = $sql . "FROM review INNER JOIN employee ON employee.employee_id=review.employee_id ";
          $sql = $sql . "WHERE review.employee_id='$employeeId' ";
          $sql = $sql . "ORDER BY review.completed ASC, review.review_year ASC";



          $sql2 = "SELECT * FROM review INNER JOIN employee ON employee.employee_id=review.employee_id AND employee.supervisor_id='$employeeId' AND review.completed='N'";
          $rs2 = $dbConn->query($sql2)
                    or die('Problem with query' . $dbConn->error);

          $sql3 = "SELECT * FROM review INNER JOIN employee ON employee.employee_id=review.employee_id AND employee.supervisor_id='$employeeId' AND review.completed='Y'";
          $rs3 = $dbConn->query($sql3)
                    or die('Problem with query' . $dbConn->error);
} else {
          $sql = "select review_year, date_completed, completed, review_id from review where employee_id='$employeeId' order by review_year DESC";
}


$rs = $dbConn->query($sql)
          or die('Problem with query' . $dbConn->error);





?>

<!DOCTYPE html>
<html>

<head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title>Menu</title>
          <link rel="stylesheet" href="/twa/twa370/project/css/projectmaster.css">

</head>

<body>
          <h1 id="titleChoose">Choose Review</h1>

          <div class="image">
                    <img class="resize" src="/twa/twa370/project/images/projectlogo.png" />
          </div>


          <p><b>Date: </b><?php echo date("l jS \of F Y"); ?></p>
          <p><b>Logged In as: </b><?php echo $_SESSION['firstname'] . " " . $_SESSION['surname']; ?>


                    <center>
                              <h2>Performance Reviews: </h2>
                    </center>


                    <?php
                    if ($_SESSION['employeeId'] == 'DMCEO' || $_SESSION["employeeId"] == 'DM001' || $_SESSION["employeeId"] == 'DM002') {

                    ?>
          <table class="centerTable">
                    <tr>
                              <td><b>Surname</b></td>
                              <td><b>FirstName</b></td>
                              <td><b>YearOfReview</b></td>
                              <td><b>ReviewId</b></td>
                              <td><b>EmployeeId</b></td>
                              <td><b>CompletedStatus</b></td>
                              <td><b>DateComplete</b></td>
                    </tr>
                    <?php
                              while ($row = $rs->fetch_assoc()) {

                    ?>

                              <tr>
                                        <td><a href="viewreview.php?reviewId=<?php echo $row["review_id"] ?>"><?php echo $row['surname']; ?></a></td>
                                        <td><?php echo $row["firstname"]; ?></td>
                                        <td><?php echo $row["review_year"]; ?></td>
                                        <td><?php echo $row["review_id"]; ?></td>
                                        <td><?php echo $row["employee_id"]; ?></td>
                                        <td><?php echo $row["completed"]; ?></td>
                                        <td><?php echo $row["date_completed"]; ?></td>
                              </tr>
                    <?php  } ?>
          </table>


          <center>
                    <h2> Current Reviews </h2>
          </center>
          <table class="centerTable">
                    <tr>
                              <td><b>Surname</b></td>
                              <td><b>FirstName</b></td>
                              <td><b>YearOfReview</b></td>
                              <td><b>ReviewId</b></td>
                              <td><b>EmployeeId</b></td>
                              <td><b>CompletedStatus</b></td>
                              <td><b>DateComplete</b></td>
                    </tr>
                    <?php while ($row2 = $rs2->fetch_assoc()) {   ?>
                              <tr>

                                        <td><a href="viewreview.php?reviewId=<?php echo $row2["review_id"] ?>"><?php echo $row2['surname']; ?></a></td>
                                        <td><?php echo $row2["firstname"]; ?></td>
                                        <td><?php echo $row2["review_year"]; ?></td>
                                        <td><?php echo $row2["review_id"]; ?></td>
                                        <td><?php echo $row2["employee_id"]; ?></td>
                                        <td><?php echo $row2["completed"]; ?></td>
                                        <td><?php echo $row2["date_completed"]; ?></td>

                              </tr>
                    <?php } ?>
          </table>


          <center>
                    <h2> Completed Reviews </h2>
          </center>
          <table class="centerTable">
                    <tr>
                              <td><b>Surname</b></td>
                              <td><b>FirstName</b></td>
                              <td><b>YearOfReview</b></td>
                              <td><b>ReviewId</b></td>
                              <td><b>EmployeeId</b></td>
                              <td><b>CompletedStatus</b></td>
                              <td><b>DateComplete</b></td>
                    </tr>
                    <?php
                              while ($row3 = $rs3->fetch_assoc()) {  ?>
                              <tr>

                                        <td><a href="viewreview.php?reviewId=<?php echo $row3["review_id"] ?>"><?php echo $row3['surname']; ?></a></td>
                                        <td><?php echo $row3["firstname"]; ?></td>
                                        <td><?php echo $row3["review_year"]; ?></td>
                                        <td><?php echo $row3["review_id"]; ?></td>
                                        <td><?php echo $row3["employee_id"]; ?></td>
                                        <td><?php echo $row3["completed"]; ?></td>
                                        <td><?php echo $row3["date_completed"]; ?></td>

                              </tr>
                    <?php } ?>

          </table>




<?php
                    } else {
?>
          <table class="centerTable">
                    <tr>
                              <td><b>Surname</b></td>
                              <td><b>FirstName</b></td>
                              <td><b>YearOfReview</b></td>
                              <td><b>ReviewId</b></td>
                              <td><b>EmployeeId</b></td>
                              <td><b>CompletedStatus</b></td>
                              <td><b>DateComplete</b></td>
                    </tr>
                    <?php while ($row = $rs->fetch_assoc()) { ?>
                              <tr>
                                        <td><a href="viewreview.php?reviewId=<?php echo $row["review_id"] ?>"><?php echo $row['surname']; ?></a></td>
                                        <td><?php echo $row["firstname"]; ?></td>
                                        <td><?php echo $row["review_year"]; ?></td>
                                        <td><?php echo $row["review_id"]; ?></td>
                                        <td><?php echo $row["employee_id"]; ?></td>
                                        <td><?php echo $row["completed"]; ?></td>
                                        <td><?php echo $row["date_completed"]; ?></td>
                              </tr>

          </table>



<?php
                              }
                    }

                    $dbConn->close();
?>

<?php
if ($_SESSION['employeeId'] == 'DMCEO' || $_SESSION["employeeId"] == 'DM001' || $_SESSION["employeeId"] == 'DM002') {
?>
          <p><a href="createreview.php">Create Review</a></p>
<?php
}
?>

<p><a href="logoff.php">Log off</a></p>

</body>

</html>