<!DOCTYPE html>
<?php 
    include 'external_header.php';
    include 'form_handling.php';
    $formElements = array();
    $valid = array();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet"
              href="external_styles.css">
         <link rel="stylesheet" type="text/css"
              href="custom-inputs.css">
        <title>Sign Up</title>
    </head>
    
    <div class="parent-container">
        <div class="center-container2">
            <h1 class="heading">Create Account</h1> <br>
            
            <div class="alignment-container">
            <div class="form-container">
                <form method="post" action="create.php">
                    
                    <div class="input-container">                        
                            <input class="custom-input"
                                   type="text" name="first"
                                   placeholder="First Name">                           
                        
                        <div class="error-container">
                            <?php 
                                $formElements["first"] = $_POST["first"];
                                $valid[] = checkValidChars(
                                        $formElements["first"]
                                        );                      
                            ?>
                        </div>
                    </div><br>
                    
                    <div class="input-container">                        
                        <input class="custom-input"
                               type="text" name="last"
                               placeholder="Last Name">
                                             
                         <div class="error-container">
                            <?php 
                                $formElements["last"] = $_POST["last"];
                                $valid[] = checkValidChars(
                                        $formElements["last"]
                                        );                      
                            ?>
                        </div>
                    </div><br>
                    
                    <div class="input-container">                        
                            <input class="custom-input"
                                   type="email" name="newEmail"
                               placeholder="Enter Email Address">
                       
                        <div class="error-container">
                            <?php 
                               $formElements["newEmail"] = $_POST["newEmail"];
                               $valid[] = checkUserExist(                                
                                       $conn,               
                                       $formElements["newEmail"],                
                                       "personal_info",                
                                       "email"                
                                       );                             
                            ?>
                        </div>
                    </div><br>
                        
                    <div class="input-container">                        
                        <input class="custom-input"
                               type="text" name="newUser"
                               placeholder="Create Username">
                      
                        <div class="error-container">
                            <?php
                                $formElements["newUser"] = strtolower($_POST["newUser"]);
                                $valid[] = checkUserExist(                
                                        $conn,                 
                                        $formElements["newUser"],                
                                        "profile",                
                                        "username"                
                                        );        
                            ?>
                        </div>
                    </div><br>

                    <div class="input-container">                        
                        <input class="custom-input"
                               type="password" name="newPass"
                               placeholder="Enter Password">
                        
                        <div class="error-container">
                            <?php
                                $formElements["newPass"] = $_POST["newPass"];
                                $valid[] = checkNewPass($formElements["newPass"]);
                                
                            ?>
                        </div>
                        
                    </div>
                    
                    <div class="input-container">                        
                        <input class="custom-input"
                               type="password" name="reEnterPass"
                               placeholder="Re-enter Password">
                        
                        <div class="error-container">
                            <?php
                                $formElements["reEnterPass"] = $_POST["reEnterPass"];
                                $valid[] = checkReEnterPassword(                
                                        $formElements["newPass"],                
                                        $formElements["reEnterPass"]                
                                        );
                            ?>
                        </div>
                    </div>
                    

                    <div class="submit-container">
                        <input class="custom-submit"
                               id="submit-font" 
                        type="submit" value="sign up">
                        <div id="submit-anchor">
                        </div>
                    </div>
                    
                </form>               
               
            </div>
            </div>
            <br>
            <div class="alignment-container">
                <p>
                    <body>
                    <?php            
                        checkLength($formElements); 
                        $isValid = formValidation($valid);
                        if($isValid){
                            insertNewAccount($conn, $formElements);
                        }
                    ?>
                    </body>                        
                </p>
            </div>
            <div class="link-custom">
                <a href="login.php">login</a>            
            </div> 
        </div>
    </div>
    <div id="footer-container">
        <?php include 'footer.php';?>
    </div>
           
</html>
