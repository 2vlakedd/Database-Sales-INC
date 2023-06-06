<html>
<head>



<?php
if (isset($_POST['firstname'])||isset($_POST['lastname']) ||isset($_POST['middlename'])||isset($_POST['role'])||isset($_POST['empnumber']))
{
	$firstname = ($_POST['firstname']);
$lastname = ($_POST['lastname']);
$middlename = ($_POST['middlename']);
$role = ($_POST['role']);
$empnumber = ($_POST['empnumber']);
}
// Include config file
require_once "connection.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
   
    } else{
        // Prepare a select statement
        $sql = "SELECT id,role FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password,firstname,lastname,middlename,id,role) VALUES (?, ?,'$firstname','$lastname','$middlename','$empnumber','$role')";//'$lastname','$middlename','$role'  ,lastname,Middle Name,role
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>





 <meta charset="UTF-8">
    <title>Sign Up</title>
	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	
    <style>
	
	
	body, html {
  height: 100%;
  margin: 0;
}
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding-left: 60px; padding-top: 20px;}
		
		
		.all {
		background-image: url('PSE BG1.jpg');
		height: 100%;
		 background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  
		}
		h2 {
			  color: white;
		}
		td {
			 color: white;
		}
		p{
			 color: white;
		}
		
    </style>
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
   </head>
<body>
<div class="all">
<div class="wrapper">
<h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
<table>

<td><b>First Name:</td>
      <td><input type="text"  id="firstname"class="form-control" placeholder="Juan"  name="firstname"></td>
  </tr>
      </tr>
      <tr>
<td><b>Last Name:</td>
      <td><input type="text"  id="lastname"class="form-control" placeholder="Delacruz" name="lastname"></td>
  </tr>
        </tr>
       <tr>
<td><b>Middle Name:</td>
      <td><input type="text"  id="middlename" class="form-control" placeholder="B" name="middlename"></td>
  </tr>
 </tr>


     <tr>
<td><b>Employee Number
:</td>
      <td><input type="text"  id="empnumber"class="form-control" placeholder="PSE01" name="empnumber"></td>
  </tr><br>
  </tr>

 
 <tr>
 <td><b>Username:</td>
      <td> <input type="txt" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>"></td>
  </tr>



  <tr>
  <td><b>Password:</td>
      <td> <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>"></td>
  </tr>

  <td><b>Confirm Password:</td>
      <td> <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>"></td>
  </tr>
 <td><b>Role:</td>
      <td> <select name="role" class="form-control">
  <option value="Admin">Admin</option>
  <option value="Employee">Employee</option></td>
  </tr>


<tr>
<td>                      </td>
<td>

   <br>	   <input type="submit" name="insert"class="btn btn-primary" value="Register" />




    </td>
</tr>




  </div>
  </div>







</table >

  </form>
<form method="get" action="index.php">
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp<br>   <button type="submit"class="btn btn-secondary ml-2">Sign In Instead</button>
	
</form>
</body>
</html>
<?php

 /*if (isset($_POST["insert"]))
{
    mysqli_query($link,"insert into users values('$_POST[firstname]',
    '$_POST[lastname]','$_POST[middlename]','NULL','NULL',
    'NULL','NULL','$_POST[role]')");
    ?>
        <script type ="text/javascript">

        window.location.href=window.location.href;

        </script>
        <?php
    }
	?>*/
