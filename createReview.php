<!DOCTYPE html>
<html lang="en">

<head>
          <meta charset="utf-8">
          <title>Create Review</title>
          <script src="/twa/twa370/project/javascript/createreview.js" defer></script>
          <link rel="stylesheet" href="/twa/twa370/project/css/projectmaster.css">


</head>



<?php
require_once("nocache.php");

// get access to the session variables
session_start();
$ratingErrorMsgKnow = "";
$ratingErrorMsgWQ = "";
$ratingErrorMsgIniti = "";
$ratingErrorMsgCom = "";
$ratingErrorMsgDepend = "";
$additionCommErrorMsg = "";
if (!$_SESSION["employeeId"]) {
          $errorLoggedIn = "Error has occured. Please log in";
          header("Location:logoff.php?errorLoggedIn=$errorLoggedIn");
}


if ($_SESSION['employeeId'] == 'DMCEO' || $_SESSION["employeeId"] == 'DM001' || $_SESSION["employeeId"] == 'DM002') {

          require_once("dbconn.php");
	  $supervisorId=$_SESSION['employeeId'];
          $sql = "SELECT employee_id, surname, firstname FROM employee WHERE supervisor_id='$supervisorId'";


          $rs = $dbConn->query($sql)
                    or die('Problem with query' . $dbConn->error);
} else {
          $getVariables = array(
                    'page-title' => 'Create Review',
                    'user-type' => 'Supervisors'
          );

          header("location: unauthorised.php?" . http_build_query($getVariables));
}

$year = 0;
$dropDown = 0;
$savedMsg = "";

if (isset($_POST["submit"])) {
          $insertedYear = $_POST["year"];
          $isSubmitSet = 1;


          if (empty($_POST["year"])) {
                    $year = 0;
          } else {
                    $year = 1;
          }

          if ($_POST["employeeIds"] == " ") {
                    $dropDown = 0;
          } else {
                    $dropDown = 1;
          }


          if ($year == 1 && $dropDown == 1 && $isSubmitSet == 1) {

                    $ReviewEmployeeId = $_POST["employeeIds"];

                    $sql2 = "SELECT DISTINCT review.employee_id,employee.surname, employee.firstname, job.job_title, department.department_name ";
                    $sql2 = $sql2 . "FROM (((employee 
	INNER JOIN review ON employee.employee_id=review.employee_id) 
	INNER JOIN job ON employee.job_id=job.job_id) 
	INNER JOIN department ON employee.department_id=department.department_id) ";

                    $sql2 = $sql2 . "WHERE employee.employee_id='$ReviewEmployeeId'";




                    $rs2 = $dbConn->query($sql2)
                              or die('Problem with query' . $dbConn->error);
          }
} else {
          $isSubmitSet = 0;
}

if (isset($_POST["saveReview"])) {
          $hiddenEmployeeId = $_POST["hiddenemployeeid"];
          $reviewYear = date("Y");

          $jobKnowledge = $dbConn->escape_string($_POST['jobKnowledge']);
          $workQuality = $dbConn->escape_string($_POST['workQuality']);
          $initiative = $dbConn->escape_string($_POST['initiative']);
          $communication = $dbConn->escape_string($_POST['communication']);
          $dependability = $dbConn->escape_string($_POST['dependability']);

          $additionalComment = $dbConn->escape_string($_POST['additionalComments']);
          $dateCompleted = "";
          $completeChar = "N";

          if (isset($_POST['complete'])) {
                    $dateCompleted = date("Y-m-d");
                    $completeChar = "Y";
          }

          //check Job Knowledge
          if (is_numeric($jobKnowledge)) {
                    $ratingErrorMsgKnow = "Please input a number between 1-5";
          } else if ($jobKnowledge > 5) {
                    $ratingErrorMsgKnow = "Please input a smaller number between 1-5";
          } else if ($jobKnowledge < 1 && !empty($jobKnowledge)) {
                    $ratingErrorMsgKnow = "Please input a larger number between 1-5";
          } else {
                    $ratingErrorMsgKnow = " ";
          }

          //check Work quality
          if (is_numeric($workQuality)) {
                    $ratingErrorMsgWQ = "Please input a number between 1-5";
          } else if ($workQuality > 5) {
                    $ratingErrorMsgWQ = "Please input a smaller number between 1-5";
          } else if ($workQuality < 1 && !empty($workQuality)) {
                    $ratingErrorMsgWQ = "Please input a larger number between 1-5";
          } else {
                    $ratingErrorMsgWQ = " ";
          }

          //check Initiative
          if (is_numeric($initiative)) {
                    $ratingErrorMsgIniti = "Please input a number between 1-5";
          } else if ($initiative > 5) {
                    $ratingErrorMsgInti = "Please input a smaller number between 1-5";
          } else if ($initiative < 1 && !empty($initiative)) {
                    $ratingErrorMsgInti = "Please input a larger number between 1-5";
          } else {
                    $ratingErrorMsgInti = " ";
          }

          //check Communication
          if (is_numeric($communication)) {
                    $ratingErrorMsgCom = "Please input a number between 1-5";
          } else if ($communication > 5) {
                    $ratingErrorMsgCom = "Please input a smaller number between 1-5";
          } else if ($communication < 1 && !empty($communication)) {
                    $ratingErrorMsgCom = "Please input a larger number between 1-5";
          } else {
                    $ratingErrorMsgCom = " ";
          }

          //check Dependability
          if (is_numeric($dependability)) {
                    $ratingErrorMsgDepend = "Please input a number between 1-5";
          } else if ($dependability > 5) {
                    $ratingErrorMsgDepend = "Please input a smaller number between 1-5";
          } else if ($dependability < 1 && !empty($dependability)) {
                    $ratingErrorMsgDepend = "Please input a larger number between 1-5";
          } else {
                    $ratingErrorMsgDepend = " ";
          }

          //check additional comments 
          if (!empty($additionalComment)) {
                    $regEx = "/[a-zA-Z0-9 .!?-]+$/";
                    if (!preg_match("/^[a-zA-Z-' ]*$/", $additionalComment)) {
                              $additionCommErrorMsg = "Please only use alphanumeric characters, spaces, hyphens, commas, periods and exclamation points.";
                    }
          } else {
                    $additionCommErrorMsg = " ";
          }


          //if valid 
          $sql3 = "INSERT INTO review (employee_id,review_year,completed,job_knowledge,work_quality,initiative,communication,dependability, ";
          $sql3 = $sql3 . "additional_comment,date_completed)
 	VALUES ('$hiddenEmployeeId','$reviewYear','$completeChar', NULLIF('$jobKnowledge', '') , NULLIF('$workQuality', ''),NULLIF('$initiative', ''),NULLIF('$communication', ''),NULLIF('$dependability', ''),NULLIF('$additionalComment', ''),NULLIF('$dateCompleted', ''))";


          $rs3 = $dbConn->query($sql3)
                    or die('Problem with query' . $dbConn->error);

          $savedMsg = "Review has been saved successfully!";
}




?>


<body>

          <div class="image">
                    <img class="imgInCreate" src="/twa/twa370/project/images/projectlogo.png" />
          </div>
          <h1 id="titleCreate">Create a Review</h1>
          <p><b>Date: </b><?php echo date("l jS \of F Y"); ?></p>
          <p><b>Logged In as: </b><?php echo $_SESSION['firstname'] . " " . $_SESSION['surname']; ?>

          <p id="instruction">Please fill in/select an option for the manditory fields</p>

          <form method="post" id="inputForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return validateForm()">
                    <label for="employeeIds" id="labelDropDown">Choose Employee:</label>
                    <select id="employeeIds" name="employeeIds" onblur="checkDropDown()">
                              <option value=" ">Option</option>
                              <?php while ($row = $rs->fetch_assoc()) { ?>
                                        <option value="<?php echo $row["employee_id"]; ?>"><?php echo $row["employee_id"]; ?> : <?php echo $row["firstname"]; ?> <?php echo $row["surname"]; ?></option>

                              <?php

                              }
                              ?>
                    </select>
                    <span class="error-messages" id="invalidPick"> Please pick 1 employee to review </span>

                    </br>
                    <label for="year">Year: </label>
                    <input type="number" id="year" name="year" placeholder="2022" size="4" onblur="checkValidYear()">
                    <span class="error-messages" id="invalidYear"> Please enter a 4 digit year between 2022-2030 </span>

                    </br>
                    <input type="submit" name="submit" value="Submit">



          </form>


          <?php if ($year == 1 && $dropDown == 1 && $isSubmitSet == 1) { ?>

                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return validateForm2()">
                              <h2 class="title">Employee Information Section</h2>
                              <table>
                                        <tr>
                                                  <td>EmployeeId</td>
                                                  <td>Surname</td>
                                                  <td>FirstName</td>
                                                  <td>JobTitle</td>
                                                  <td>DepartmentName</td>
                                                  <td>ReviewYear</td>
                                        </tr>
                                        <?php while ($row2 = $rs2->fetch_assoc()) { ?>

                                                  <tr>
                                                            <td><?php echo $row2["employee_id"]; ?></td>
                                                            <td><?php echo $row2["surname"]; ?></td>
                                                            <td><?php echo $row2["firstname"]; ?></td>
                                                            <td><?php echo $row2["job_title"]; ?></td>
                                                            <td><?php echo $row2["department_name"]; ?></td>
                                                            <td><?php echo $insertedYear ?></td>

                                                  </tr>
                              </table>
                              <input type="hidden" name="hiddenemployeeid" id="hiddenemployeeid" value=<?php echo $row2["employee_id"] ?>>
                    <?php } ?>


                    <h2 class="title">Ratings Information Section</h2>



                    <div class="flexContainer">
                              <div class="ratings" id="ratings">
                                        <div class="extraPadding">
                                                  <label for="jobKnowledge" id="JobKnow">Job Knowledge: </label>
                                                  <input type="text" name="jobKnowledge" id="jobKnowledge" onblur="checkNumbersKnow()"> /5 </input>
                                                  </br>
                                                  <p class="error-messages"><?php echo $ratingErrorMsgKnow ?></p>
                                                  <span class="error-messages" id="tooLargeknow"> Please enter a smaller value within 1-5 </span>
                                                  <span class="error-messages" id="tooSmallknow"> Please enter a larger value within 1-5 </span>
                                                  <span class="error-messages" id="notAnumberknow"> Please enter a numberic digit between 1-5 </span>

                                        </div>

                                        <div class="extraPadding">
                                                  <label for="workQuality" id="WorkQua">Work Quality: </label>
                                                  <input type="text" name="workQuality" id="workQuality" onblur="checkNumbersWorkQ()"> /5 </input>
                                                  </br>
                                                  <p class="error-messages"><?php echo $ratingErrorMsgWQ ?></p>
                                                  <span class="error-messages" id="tooLargeWQ"> Please enter a smaller value within 1-5 </span>
                                                  <span class="error-messages" id="tooSmallWQ"> Please enter a larger value within 1-5 </span>
                                                  <span class="error-messages" id="notAnumberWQ"> Please enter a numberic digit between 1-5 </span>
                                        </div>

                                        <div class="extraPadding">
                                                  <label for="initiative" id="Initi">Initiative: </label>
                                                  <input type="text" name="initiative" id="initiative" onblur="checkNumbersIniti()"> /5 </input>
                                                  </br>
                                                  <p class="error-messages"><?php echo $ratingErrorMsgIniti ?></p>
                                                  <span class="error-messages" id="tooLargeIni"> Please enter a smaller value within 1-5 </span>
                                                  <span class="error-messages" id="tooSmallIni"> Please enter a larger value within 1-5 </span>
                                                  <span class="error-messages" id="notAnumberIni"> Please enter a numberic digit between 1-5 </span>
                                        </div>

                                        <div class="extraPadding">
                                                  <label for="communication" id="Communi">Communication: </label>
                                                  <input type="text" name="communication" id="communication" onblur="checkNumbersCom()"> /5 </input>
                                                  </br>
                                                  <p class="error-messages"><?php echo $ratingErrorMsgDepend ?></p>
                                                  <span class="error-messages" id="tooLargeCom"> Please enter a smaller value within 1-5 </span>
                                                  <span class="error-messages" id="tooSmallCom"> Please enter a larger value within 1-5 </span>
                                                  <span class="error-messages" id="notAnumberCom"> Please enter a numberic digit between 1-5 </span>
                                        </div>

                                        <div class="extraPadding">
                                                  <label for="dependability" id="Depend">Dependability: </label>
                                                  <input type="text" name="dependability" id="dependability" onblur="checkNumbersDepend()"> /5
                                                  </br>
                                                  <p class="error-messages"><?php echo $additionCommErrorMsg ?></p>
                                                  <span class="error-messages" id="tooLargeDepend"> Please enter a smaller value within 1-5 </span>
                                                  <span class="error-messages" id="tooSmallDepend"> Please enter a larger value within 1-5 </span>
                                                  <span class="error-messages" id="notAnumberDepend"> Please enter a numberic digit between 1-5 </span>
                                        </div>
                              </div>




                              <h2 class="title">Evaluation Section:</h2>

                              <h3><label for="additionalComments" id="additionalCommentsTitle">Additional Comments:</label></h3>
                              <textarea rows="4" cols="50" name="additionalComments" id="additionalComments" onblur="checkAdditionalComments()"></textarea>
                              <p class="error-messages"><?php echo $additionCommErrorMsg ?> </p>
                              <span class="error-messages" id="invalidComment">Please only use alphanumeric characters, spaces, hyphens, commas, periods and exclamation points. </span>



                              </br>
                              <label for="checkbox" id="completeCheckbox">Review Complete? </label>
                              <input type="checkbox" name="complete" id="complete">
                              </br>
                              <input type="submit" name="saveReview" value="Save Review">


                    </form>
          <?php } ?>

          <?php $dbConn->close(); ?>

          <p><?php echo $savedMsg ?> </p>
          <p><a href="choosereview.php">Return to Choose Review Page</a></p>
          <p><a href="logoff.php">Log off</a></p>

</body>

</html>