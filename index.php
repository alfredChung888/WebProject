<!-- 20463494 Alfred Chung -->

<?php
require_once("nocache.php");
$errorMessage = '';
$errorLoggedIn='';




if (isset($_POST["submit"])) {
          if (empty($_POST['employeeId']) || empty($_POST['password'])) {
                    $errorMessage = "Both employeeId and password are required";
          }else {
                    // connect to the database
                    require_once('dbconn.php');

                    // parse username and password for special characters
                    $employeeId = $dbConn->escape_string($_POST['employeeId']);
                    $password = $dbConn->escape_string($_POST['password']);


                    // hash the password so it can be compared with the db value
                    $hashedPassword = hash('sha256', $password);

                    // query the db
                    $sql = "select supervisor_id,firstname, surname, employee_id, password from employee where employee_id = '$employeeId' and password = '$hashedPassword'";
                    $rs = $dbConn->query($sql);

                    // check number of rows in record set. What does this mean in this context?
                    if ($rs->num_rows) {
                              // start a new session for the user
                              session_start();

                              // Store the user details in session variables
                              $user = $rs->fetch_assoc();
                              $_SESSION['employeeId'] = $user['employee_id'];
                              $_SESSION['firstname'] = $user['firstname'];
                              $_SESSION['surname'] = $user['surname'];
                              $_SESSION['supervisorId'] = $user['supervisor_id'];

                              

                              // Redirect the user to the secure page
                              header('Location: choosereview.php');
                    } else {
                              $errorMessage = "Invalid EmployeeId or Password";
                    }
          }
}
if(isset($_GET['errorLoggedMsg'])){
  $errorLoggedIn=$_GET['errorLoggedMsg'];
}
  

?>

<!DOCTYPE html>
<html lang="en">

<head>
          <meta charset="utf-8">
          <title>Login</title>
          <link rel="stylesheet" href="/twa/twa370/project/css/projectmaster.css">

</head>


<body>
          <h1 id="titleLogin">Login to Your Account </h1>
          
          <div class="image">
          <img id="logginImg" src="/twa/twa370/project/images/projectlogo.png"/>
          </div>
          
          <p style="color:red;"><?php echo $errorMessage; ?></p>
          <p style="color:red;"><?php echo $errorLoggedIn ?></p>




          <div class="container">

                    <form id="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                              <div class="logIn">
					<div class="item">
                                        <label for="employeeId">EmployeeId: </label>
                                        <input type="text" name="employeeId" maxlength=20 id="employeeId" placeholder="Employee Id">
                                        </div>
                 
                                     	<div class="item">
                                        <label for="password">Password: </label>
                                        <input type="password" name="password" maxlength=10 id="password" placeholder="Password">
                                        </div>

                                        </p>
                                     
                                        <input type="submit" value="Login" name="submit">
				</div>
                             
                    </form>

                    <div class="texts">
                              <div class="splitTextLeft">
                                        <p>The Dunder Mifflin performance planning and review process is intended to assist
                                                  supervisors to review the performance of staff annually and develop agreed performance
                                                  plans based on workload agreements and the strategic direction of Dunder Mifflin.
                                        </p>
                              </div>
                              <div class="splitTextRight">
                                        <p>
                                                  The Performance Planning and Review system covers both results (what was accomplished), and
                                                  behaviours (how those results were achieved). The most important aspect is what will be
                                                  accomplished in the future and how this will be achieved within a defined period. The process
                                                  is continually working towards creating improved performance and behaviours that align and
                                                  contribute to the mission and values of Dunder Mifflin. </p>
                              </div>

                    </div>


          </div>


</body>

</html>