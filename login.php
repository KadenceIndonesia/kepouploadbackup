<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/mystyle.css">
    <link rel="stylesheet" href="./styles/style_button.css">
    <link rel="stylesheet" href="./styles/component.css">
</head>
<body>
<div class="wrapper">
    <div class="login-wrap">
        <div class="fixMiddle loginBoxsize">
            <div class="headLogin">
                <img src="./images/kadence_icon.png" alt="kadence">
            </div>
            <form action="./auth.php" method="POST">
            <div class="bodyLogin">
                <table>
                    <tr>
                        <td>
                            <p><input type="text" name="username" placeholder="Username" value=""></p>
                            <p>
                                
                            </p>
                            <p><input type="password" name="pass" placeholder="Your password" value=""></p>
                            <p><input type="submit" value="Login" class="myButton-flat-green"></p>
                        </td>
                    </tr>
                </table>
            </div>
            </form>
            <div class="bottomLogin">
                <p class="size-std" style="position: absolute; bottom: 10px; left: 0; right: 0; height: 20px;">&copy;Copyright by Kadence Indonesia All right reserved</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>