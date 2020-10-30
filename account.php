<!DOCTYPE html>
<?php
    include 'session_check.php';
    include 'form_handling.php';
    include 'internal_header.php';
    
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css"
              href="internal_styles.css">
        <link rel="stylesheet" type="text/css"
              href="custom-inputs.css">
        <meta charset="UTF-8">
        <meta charset="UTF-8">
        <title>Account</title>
    </head>
    
    <div class="parent-content-container">
        <div class="vehicle-descr">
            <h3 class="full-view-heading">
                Account
            </h3>
            <hr class="underline"><br>
            <div class="text-box">
<!--                <p class="text-custom">username</p>
                <p class="text-custom">contact</p>
                <p class="text-custom">first</p>
                <p class="text-custom">last</p>-->
                <?php
                    accountPageQuery($conn, $userId);
                ?>
            </div>
            
            <h3 class="full-view-heading">
                Update
            </h3>
            <hr class="underline"><br>
            <div class="form-container">
                <form class="form-binder"
                      action="account.php"
                      method="post">                    
                    
                    <div class="input-error-box">                    
                        <input type="email"
                               class="custom-input"
                               placeholder="update email"
                               name="emailUpdate">
                        <div class="error-container">
                           <?php
                              $form["emailUpdate"] = $_POST["emailUpdate"];
                              $valid[] = checkUserExist(
                                      $conn,
                                      $form["emailUpdate"],
                                      "personal_info", 
                                      "email"
                                      );
                           ?>
                        </div>
                    </div><br>
                           
                    <div class="input-error-box">                    
                        <input type="text"
                               class="custom-input"
                               placeholder="update first name"
                               name="firstUpdate">
                        <div class="error-container">
                           <?php
                              $form["firstUpdate"] = $_POST["firstUpdate"];
                              $valid[] = checkValidChars(
                                      $form["firstUpdate"]
                                      );
                           ?>
                        </div>
                    </div><br>
                    
                    <div class="input-error-box">                    
                        <input type="text"
                               class="custom-input"
                               placeholder="update last name"
                               name="lastUpdate">
                        <div class="error-container">
                           <?php
                              $form["lastUpdate"] = $_POST["lastUpdate"];
                              $valid[] = checkValidChars(
                                      $form["lastUpdate"]
                                      );
                           ?>
                        </div>
                    </div><br>                  
                    
                    <input id="update-submit"
                           type="submit"
                           name="update"
                           value="update"><br>
                </form>

            </div>       
        </div>
    </div>
    <body>
        <?php        
            $isValid = formValidation($valid);
            if($isValid){
                updateProfile($conn, $form, $userId);
                goToPage("account.php");
            }
        ?>
    </body>
    <?php include 'footer.php';?>
</html>
