<?php

session_start();
require_once("dbconn.php");

if (!$_SESSION["employeeId"]) {
	$errorLoggedIn="Error has occured. Please log in";
          header("Location:logoff.php?errorLoggedIn=$errorLoggedIn");
          
}

if(isset($_POST["submit"])){
$reviewId=$_POST["hiddenreviewid"]; //from hidden type
}
else{
$reviewId=$_GET["reviewId"];

}

$messageConfirm="";

$sql = "SELECT review.employee_id,employee.surname, employee.firstname,review.review_year, ";
$sql = $sql . "review.job_knowledge, review.work_quality, review.initiative, review.communication, review.dependability, ";
$sql = $sql . "review.additional_comment,review.date_completed ";
$sql = $sql . "FROM review INNER JOIN employee ON employee.employee_id=review.employee_id ";
$sql = $sql . "WHERE review.review_id='$reviewId'";


$rs = $dbConn->query($sql)
          or die('Problem with query' . $dbConn->error);


if (isset($_POST["submit"])) {

          $dateAccepted = date("Y-m-d");
                    
          if (isset($_POST["checkbox"])) {
                    $sql = "UPDATE review SET accepted='Y', date_accepted='$dateAccepted' WHERE review_id='$reviewId'";
                    //$sql = "UPDATE review SET accepted='N', date_accepted=NULL WHERE review_id='$reviewId'";

          }
          if ($dbConn->query($sql) == TRUE) {
                    $messageConfirm= "You have accepted this review!";
          } else {
                    echo "Error: " . $sql . "<br>" . $dbConn->error;
          }
          
      
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
          <meta charset="utf-8">
          <title>View Review</title>
          <link rel="stylesheet" href="/twa/twa370/project/css/projectmaster.css">

</head>



<body>
<div class="image">
          <img class="imgInView" src="/twa/twa370/project/images/projectlogo.png"/>
 </div>
   

<h2 id="titleOfView">Employee Performance Review</h2>
 <p><b>Date: </b><?php echo date("l jS \of F Y"); ?></p>
 <p><b>Logged In as: </b><?php echo $_SESSION['firstname'] . " " . $_SESSION['surname']; ?>

          <h3 class="title">Employee Information Section</h3>
          <table>
                    <tr>
                              <td><b>EmployeeId</b></td>
                              <td><b>Surname</b></td>
                              <td><b>FirstName</b></td>
                              <td><b>ReviewYear</b></td>
                    </tr>
                    <?php while ($row = $rs->fetch_assoc()) { ?>
                    
                              <tr>
                                        <td><?php echo $row["employee_id"]; ?></td>
                                        <td><?php echo $row["surname"]; ?></td>
                                        <td><?php echo $row["firstname"]; ?></td>
                                        <td><?php echo $row["review_year"]; ?></td>

                              </tr>
          </table>



          <h3 class="title">Ratings Information Section:</h3>
          <table>
                    <tr>
                              <td><b>Job Knowledge</b></td>
                              <td><b>WorkQuality</b></td>
                              <td><b>Initiative</b></td>
                              <td><b>Communication</b></td>
                              <td><b>Dependability</b></td>
                    </tr>

                    <tr>

                              <td><?php echo $row["job_knowledge"] . "/5" ?></td>
                              <td><?php echo $row["work_quality"] . "/5" ?></td>
                              <td><?php echo $row["initiative"] . "/5" ?></td>
                              <td><?php echo $row["communication"] . "/5" ?></td>
                              <td><?php echo $row["dependability"] . "/5" ?></td>

                    </tr>
          </table>

          <h3 class="title">Evaluation Section:</h3>
          <table>
                    <tr>
                              <td><b>AdditionalComments</b></td>
                              <td><b>DateCompleted</b></td>

                    </tr>
                    <tr>
                              <td><?php echo $row["additional_comment"]; ?></td>
                              <td><?php echo $row["date_completed"]; ?></td>

                    </tr>
          </table>


          <?php if (empty($row["date_accepted"])) {;
          ?>
          <h3 class="title">Accept Employee Performance Review</h3>
          
                    <form id="acceptReviewForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                          <div id="acceptReviewText">    
                              <p>Thank you for taking part in your Dunder Mifflin Performance Review. This review is an important aspect of the development of our organisation and its profits and of you as a valued employee. </br></p>
                                       <p> <b>By electronically signing this form, you confirm that you have discussed this review in detail with your supervisor.</b></p>
                              <p style="font-style:italic;">The fine print: Signing this form does not necessarily indicate that you agree with this evaluation.</p>
                              
                         </div> 
                              </br>
                           
                              <label for="checkbox" id="acceptCheckbox">Accept Review </label>
                              <input type="checkbox" name="checkbox" id="checkbox">
                             
                              </br>
                              
                              
                              <input type="submit" id="acceptReview" name="submit" value="Submit">
                              <input type="hidden" name="hiddenreviewid" id="hiddenreviewid" value=<?php echo $reviewId?>>

                              </br>
                    </form>

          <?php
                              }
                           
          ?>
<?php } ?>


<?php $dbConn->close(); 
echo $messageConfirm;
?>

<p><a href="choosereview.php">Return to Choose Review Page</a></p>
<p><a href="logoff.php">Log off</a></p>
</body>

</html>