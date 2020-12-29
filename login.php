<?php
    require_once 'model/user.php';
?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>Login Fog 652 System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
        <link rel="shortcut icon" href="images/masr.png" />
        <link rel="stylesheet" href="css/base.css">
        <link rel="stylesheet" href="css/login.css">
    </head>

    <body>
        
        <div class="cont">
          <div class="demo">
            <?php
                if(isset($_POST['signin'])){
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $user = User::UserLogin($username, $password);
                    if(is_numeric($user['userID'])){
                        if($user['type'] == 0){
                            $_SESSION["Admin"] = $user['userID'];
                            $_SESSION["User"] = $user['userID'];
                            // header used  to redirect to another page 
                            header("location: pages/soldierSystem/allSoldiers.php");
                            exit();
                        }else{
                            $_SESSION["User"] = $user['userID'];
                            // header used  to redirect to another page 
                            header("location: pages/entertainmentSystem/orders.php?flag=0");
                            exit();
                        }
                    }else{
                        header("location: login.php?message=error");
                        exit();
                    }
                }
                
            ?>
            <div class="login">
                <?php
                    if(isset($_GET['message'])){
                        echo '<div class="redMessage">
                                <p style="font-size:35px">الدخول مش مسموح </p>
                            </div>';
                    }
                ?>
              <div class="login__form">
                  <form action="login.php" method="POST">
                    <div class="login__row">
                      <svg class="login__icon name svg-icon">
                            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                      </svg>
                      <input type="text" class="login__input name" placeholder="Username"  name="username" style="color:#FE3C47"/>
                    </div>
                    <div class="login__row">
                      <svg class="login__icon pass svg-icon">
                            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                      </svg>
                      <input type="password" class="login__input pass" placeholder="Password" name="password" style="color:#FE3C47"/>
                    </div>
                    <button type="sumit" class="login__submit" name="signin" value="signin">Sign in</button>
                </form>
              </div>
            </div>
          </div>
        </div>
    </body>
</html>
