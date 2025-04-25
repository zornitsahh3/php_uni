<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css_register.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <title>Login</title>
    </head>
    
    <body>
    <div class="left-side">
        <div class="container">
            <?php
            $errors=array();
            if(isset($_POST["submit"])){
                $username=$_POST["username"];
                //example password: R@ndomP@ssw0rd123!
                $password=$_POST["password"];
                $repeat_password=$_POST["repeat_password"];
                $email=$_POST["email"];

                if (strlen($password) < 1) {
                    array_push($errors,"Password must be at least 8 characters long");
                }
                if ($password!=$repeat_password){
                    array_push($errors,"Passwords does not match.");
                }

                #connection to the database
                require_once "database.php";
                $sql = "INSERT INTO register (username, email, password, repeat_password) VALUES ('$username', '$email', $password', '$repeat_password')";
                $stat = mysqli_stmt_init($connect);
                $var = mysqli_stmt_prepare($stat, $sql);
                if ($var) {
                    mysqli_stmt_execute($stat);
                } else {
                    echo "Failed to prepare the statement.";
                }
            }
            ?>  
            <div class="box form-box">
                <header>Register</header>

                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Username</label>
                        <div style="position: relative;">
                            <input type="text" name="username" id="username" autocomplete="off" required>
                        </div>
                        <small class="username-note">
                            Username may only contain alphanumeric characters or single hyphens, and cannot begin or end with a hyphen.
                        </small>
                    </div>    
                    
                    <div class="field input">
                        <label for="email">Email</label>
                        <div style="position: relative;">
                            <input type="email" name="email" id="email" autocomplete="off" required>
                        </div>       
                    </div>
                    
                    <div class="field input">
                        <label for="password">Password</label>
                        <div style="position: relative;">
                            <input type="password" name="password" id="password" autocomplete="off" required>
                            <i class="fa-solid fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                        </div>
                        <small class="password-note">
                            Password should be at least 15 characters OR at least 8 characters including a number and a lowercase letter.
                        </small>
                    </div>

                    <div class="field input">
                        <label for="repeat_password">Repeat Password</label>
                        <div style="position: relative;">
                            <input type="password" name="repeat_password" id="repeat_password" autocomplete="off" required>
                            <i class="fa-solid fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                        </div>
                    </div>
                    
                    <div class="error-message">  
                            <?php if (isset($errors)) { ?>
                                <?php if (in_array("Password must be at least 8 characters long", $errors)) { ?>
                                    <span class="error" style="color: #D74646;">Password must be at least 8 characters long.</span><br>
                                <?php } ?>
                                <?php if (in_array("Passwords does not match.", $errors)) { ?>
                                    <span class="error" style="color: #D74646;">Passwords do not match.</span>
                                <?php } ?>
                            <?php } ?>
                    </div>
                    
                    <div class="field input">
                        <input type="submit" class="btn" name="submit" value="Register" required>
                    </div> 
                    
                    <div class="links">
                        Already have an account? <a href="index.php">Log in Now</a>
                    </div>     
                    
                </form>
            </div>   
        </div>  
    </div>    
    <div class="right_side">
        
    </div>  
        <?php
        // put your code here
        ?>
    </body>
</html>
