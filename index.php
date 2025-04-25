<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <title>Login</title>
    </head>
    
    <body>

        <div class="container">

    <?php
                        $errors=array();
                        $isConnected=false;
                        $isPassLong=false;
                        $PassMatch=false;
                        require_once "database.php"; // must define $connect here

                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $repeat_password = $_POST['repeat_password'];

                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        $sql = "INSERT INTO users (username, password, repeat_password) VALUES (?, ?, ?)";
                        $stmt = mysqli_stmt_init($connect);

                        if (mysqli_stmt_prepare($stmt, $sql)) {
                            mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $repeat_password);

                            // Execute and check
                            if (mysqli_stmt_execute($stmt)) {
                                echo " User registered successfully!";
                            } else {
                                echo " Failed to execute: " . mysqli_stmt_error($stmt);
                            }
                        } else {
                            echo " Failed to prepare: " . mysqli_error($connect);
                        }
?>
            <div class="box form-box">
                <header>Log in</header>
                <?php if ($isConnected and $isPassLong and $PassMatch) { 
                            header("Location: home.html");
                            exit();
                } ?>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" autocomplete="off" required>
                    </div>    
                    
                    <div class="field input">
                        <label for="password">Password</label>
                        <div style="position: relative;">
                            <input type="password" name="password" id="password" autocomplete="off" required>
                            <i class="fa-solid fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                        </div>
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
                        <input type="submit" class="btn" name="submit" value="Login" required>
                    </div> 

                    <div class="links">
                        Don't have an account? <a href="register.php">Sign Up Now</a>
                    </div>                     
                </form>
            </div>   
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
