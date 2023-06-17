<?php
require_once "connection.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platforma web de jocuri si teste educationale</title>
    <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>">
    <link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css " />
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
</head>
<body>
    <header>  
        <div id="background-wrap">
            <div class="x1">
                <div class="cloud"></div>
            </div>
        
            <div class="x2">
                <div class="cloud"></div>
            </div>
        
            <div class="x3">
                <div class="cloud"></div>
            </div>
        
            <div class="x4">
                <div class="cloud"></div>
            </div>
        
            <div class="x5">
                <div class="cloud"></div>
            </div>

            <div class="x6">
                <div class="cloud"></div>
            </div>
        </div>
        <div class="logo-wrapper">
            <img class="dark" src="../resources/logos/3-dark.png" alt="">
            <img class="light" src="../resources/logos/3-light.png" alt="">
        </div> 
        <div class="sun-wrapper">
            <div class="sun"></div>
        </div> 
        <div class="moon">
            <div class="dark">
            </div>
            <div class="dark">
            </div>
            <div class="dark">
            </div>
            <div class="glow"></div>
        </div>
        <div class="switch">
            <img src="../resources/img/lamp-rope.png" alt="">
        </div>
    </header>

    <main>
        <div class="content">

            <h1>Welcome to Learnify - Play2Learn</h1>
            <section class="menu">
                <nav>
                    <ul>
                        <li>
                            <a href="">
                                <img src="../resources/img/plane1.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="../resources/img/plane2.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="../resources/img/plane3.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="../resources/img/history.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="../resources/img/plane4.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="../resources/img/geography.png" alt="">
                            </a>
                        </li>

                    </ul>
                    <div>
                        <?php  
                            $query = $conn->query("SELECT * FROM `games`") or die(mysqli_error());
                            while($fetch = $query->fetch_array()){
                        ?>
							<p><?php echo $fetch['name']?></p>
							<p><?php echo $fetch['questions_nr']?></p>
                        <?php
                            }
                        ?>
                </nav>
                <div class="login">
                    <p>Log In</p>
                    <form method = "POST" class="login-form">
                        <input type="email" name="email" id="email" placeholder="email" required>
                        <input type="password" name="password" id="password"  placeholder="password" required>
                        <input class="login-btn" type="submit" value="Log In">
					</form>
                    <p>You don't have an account?</p>
                    <a href="#" class="signin-btn">Sign in</a>
                    
                </div>
            </section>

        </div>

    </main>

    
    <footer>

        <div class="mountains">
            <div class='mountain-wrap foreground'>
                <div class='mountain'></div>
            </div>
            <div class='mountain-wrap background'>
                <div class='mountain'></div>
              </div>
        </div>

        <div class="hills"> 
            <div class="hill hill1"></div>
            <div class="hill hill2"></div>
            <div class="hill hill3"></div>
            <div class="hill hill4"></div>
            <div class="hill hill5"></div>
            <div class="hill hill6"></div>
        </div>

        <div class="ground">
            <div class="tree tree1">
                <img src="../resources/img/tree+grass.gif" alt="">
            </div>
            <div class="tree tree2">
                <img src="../resources/img/tree+grass.gif" alt="">
            </div>
            <div class="tree tree3">
                <img src="../resources/img/tree+grass.gif" alt="">
            </div>
            <div class="tree tree4">
                <img src="../resources/img/tree+grass.gif" alt="">
            </div>
            <div class="tree tree5">
                <img src="../resources/img/tree+grass.gif" alt="">
            </div>
            <div class="tree tree6">
                <img src="../resources/img/tree+grass.gif" alt="">
            </div>
            <div class="tree tree7">
                <img src="../resources/img/tree+grass.gif" alt="">
            </div>
            <div class="tree tree8">
                <img src="../resources/img/tree3.png" alt="">
            </div>
            <div class="castle">
                <img src="../resources/img/castle.png" alt="">
            </div>
            <div class="sakura">
                <img src="../resources/img/cherry-blossom-edited.png" alt="">
            </div>
            <div class="pond">
                <img src="../resources/img/pond.png" alt="">
            </div>
            <div class="kids-learning">
                <img src="../resources/img/kids-learning.png" alt="">
            </div>
            <div class="treehouse">
                <img src="../resources/img/treehouse.png" alt="">
            </div>
            <div class="birds">
                <img src="../resources/img/birds.png" alt="">
            </div>
            <div class="globe">
                <img src="../resources/img/globe-kid.png" alt="">
            </div>
            <div class="detective">
                <img src="../resources/img/detective.png" alt="">
            </div>
            <div class="kid-book">
                <img src="../resources/img/kid-book.png" alt="">
            </div>
        </div>
    </footer>


    <script src="./script.js?v=<?php echo time(); ?>"></script>
</body>
</html>

