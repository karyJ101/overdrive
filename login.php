<!DOCTYPE html>
<?php 
    include 'external_header.php';
    include 'form_handling.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        
        <link type="text/css" rel="stylesheet"
              href="external_styles.css">
         <link rel="stylesheet" type="text/css"
              href="custom-inputs.css">
        <title>Login</title>
    </head>
    
    
    <div class="parent-container">
        <div class="center-container">
            <h1 class="heading">Login</h1>
            
            <div class="alignment-container">
                <div class="form-container">
                    <form method="post" action="login.php">

                        
                        <input class="custom-input" 
                               type="text"
                               name="user"
                               placeholder="Enter Username"><br>
                        

                        
                        <input class="custom-input"
                               type="password"
                               name="pass"
                               placeholder="Enter Password">

                            <input  class="custom-submit"
                                    id="submit-font" 
                            type="submit" value="sign in">
                        
                    </form>                
                </div>
            </div>
            <br>
            <div class="alignment-container">
                <p><?php 
                        $user = $_POST["user"];
                        $pass = $_POST["pass"];                        
                        checkUserPass($conn, $user, $pass)
                ?></p>
            </div>
            <!-- <div class="alignment-container">
                <div class="error-container"> 
                    <body>
                    <?php 
                        // $user = $_POST["user"];
                        // $pass = $_POST["pass"];                        
                        // checkUserPass($conn, $user, $pass)
                    ?>
                    </body>                        
                </div>
            </div> -->
            <div class="link-custom">
            <a href="create.php">sign up</a>
            </div>
        </div>
    </div>
    <div id="footer-container2">
        <?php include 'footer.php';?>
    </div>
</html>
