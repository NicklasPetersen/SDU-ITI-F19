<!DOCTYPE html>
<html lang="en">
    <head>
        <title> The Website </title>
        <meta charset="utf-8"/>
    </head>
<body>
        <h1> Register on the Website! ™ </h1>
        
        <?php
    
    $username = "";
    $password = "";
    $confirmpw = "";
    
   if ($_SERVER["REQUEST_METHOD"] == "POST" & isset($_POST['submitregister'])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirmpw = $_POST["confirmpw"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $zip = $_POST["zip"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
    
    /*    if ($password != $confirmpw) { 
        
            echo("Entered passwords don't match!");
            
        } 
       
       else {
    */    
      require_once 'serverconn.php';

      if ($password === $confirmpw) {

        $sqlcheck = "SELECT EXISTS (SELECT * FROM user WHERE userName = '$username')";

        if ($sqlcheck = 0) {

        $sqlreg = "INSERT INTO user (userName, userPass, firstName, lastName, zip, phone, email) VALUES ('$username', '$password', '$firstname', '$lastname', '$zip', '$phone', '$email')";
            
            if ($conn->query($sqlreg) === TRUE) {
                $conn->close();
                header("Location: login.php");
                exit;
            }
            else { 
            echo "An error was encountered while parsing data to database! The error was: " . $conn->error . "while calling SQL method: " . $sqlreg;
    }
        } else {

            echo "Username already exists. Please log in!";

        } 
        }
    }
    
    ?>

    
<form id = "registerform" action="registeruser.php" method="post">
    <label for="firstname" >First name</label>
    <br>
    <input type="text" name="firstname" id="firstname"/> 
    <br>
    <label for="lastname" >Last name</label>
    <br>
    <input type="text" name="lastname" id="lastname"/> 
    <br>
    <label for="User name" style="color: red;">User name</label>
    <br> 
    <input type="text" name="username" id="username"/> 
    <br>
    <label for="zip" >ZIP code</label>
    <br>
    <input type="number" name="zip" id="zip"/> 
    <br>
    <label for="email" >E-mail address</label>
    <br>
    <input type="email" name="email" id="email"/> 
    <br>
    <label for="phone" >Phone number</label>
    <br>
    <input type="tel" name="phone" id="phone"/> 
    <br>
    <label for="password" style="color: red;">Password</label>
    <br> 
    <input type="password" name="password" id="password"/> 
    <br>
    <label for="confirmpw" style="color: red;" >Confirm password</label>
    <br>
    <input type="password" name="confirmpw" id="confirmpw"/> 
    <br>
    <input type="submit" name="submitregister" id="submitregister"/> 
</form>    
    
    <br>
    <?php include 'logout.php';?>
    
</body>
</html>