<?php
    session_start();
?>
<?php require_once('connection.php'); ?>

<?php
    //check for form submission
    if (isset($_POST['submit'])){

        $errors = array();

        //check if the user name and password has been entered
        if (!isset($_POST['emaill']) || strlen(trim($_POST['emaill'])) < 1 ){
            $errors[] = 'Username is Missing / Invalid';    
        }

        if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1 ){
            $errors[] = 'Password is Missing / Invalid';
        }

        //check if there any errors in the form
        if (empty($errors)) {

            //save username and password into varible
            $email = mysqli_real_escape_string($connection, $_POST['emaill']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            // $hashed_password = sha1($password);
       
            $query = "SELECT * FROM user";

            $result_set = mysqli_query($connection, $query);

            if($result_set){
                while ($record = mysqli_fetch_assoc($result_set)){
                    $ema = $record ['email'];
                    $pass = $record ['password'];
                    $user_id = $record ['id'];
                    $num1 = 2;
                    $num2 = 3;
                    $num3 = 0;
                        if($email == $ema && $password == $pass){
                           $num3 = $num1 + $num2;
                           $user_id = $record ['id'];
                           $_SESSION['user_id'] = $user_id
                           header('Location: home.php');
                        }
                    }
            } 
            if($num3 != 5 ){
                $errors[] = "Invalid username and password";
            }
       }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="login">
        <form action="index.php" method="post">
            
                <legend><h1>Log In</h1></legend>

                <?php
                     if (isset($errors) && !empty($errors)) {
                         echo '<p class="error">Invalid username / password </p>';                     
                        }
                ?>

                <p>
                    <input type="text" name="emaill" id="" placeholder="Your username or email">
                </p>

                <p>
                    <input type="password" name="password" id="" placeholder="Your password">
                </p>

                <p>
                    <button type="submit" name="submit">Submit</button>
                    
                </p> 
        </form>
    </div> 
</body>
</html>
<?php mysqli_close($connection); ?>