<!DOCTYPE html>
<?php
    include 'session_check.php';
    include 'internal_header.php';
    include 'form_handling.php';
    $formElements = array();
    $valid = array();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css"
              href="internal_styles.css">
        <link rel="stylesheet" type="text/css"
              href="custom-inputs.css">
        <meta charset="UTF-8">
        <title>Sell Your Car</title>
    </head>
    
    <div class="parent-content-container">
        <div class="form-binder">
            
            <h2>Enter Vehicle Details</h2>
            <form method="post" action="sell.php"
                  enctype="multipart/form-data">
                
                <div class="input-error-box">
                    <input class="custom-input"
                           id="image-input"
                           type="file"
                           name="img-1"
                           placeholder="upload image">
                    <div class="error-container">
                        <?php                            
                           $formImage["img-1"] = $_FILES["img-1"];
                           $valid[] = imageValidate($formImage["img-1"]);                        
                        ?>
                    </div>
                </div>
                
                <div class="input-error-box">
                    <input class="custom-input"
                           id="image-input"
                           type="file"
                           name="img-2"
                           placeholder="upload image">
                    <div class="error-container">
                        <?php
                           $formImage["img-2"] = $_FILES["img-2"];
                           $valid[] = imageValidate($formImage["img-2"]); 
                        ?>
                    </div>
                </div>
                
                <div class="input-error-box">
                <input class="custom-input"
                       id="image-input"
                       type="file"
                       name="img-3"
                       placeholder="upload image">
                <div class="error-container">
                        <?php
                           $formImage["img-3"] = $_FILES["img-3"];
                           $valid[] = imageValidate($formImage["img-3"]); 
                        ?>
                    </div>
                </div>
                
                <div class="input-error-box">                   
                    <input class="custom-input"
                           type="text"
                           name="make"
                           placeholder="make">
                    <div class="error-container">
                        <?php
                            $formElements["make"] = $_POST["make"];
                            $valid[] = entryRequired(
                                    $formElements["make"]
                                    );
                        ?>
                    </div>
                </div>
                
                <div class="input-error-box">    
                    <input class="custom-input"
                           type="text"
                           name="model"
                           placeholder="model">
                    <div class="error-container">
                        <?php
                            $formElements["model"] = $_POST["model"];
                            $valid[] = entryRequired(
                                    $formElements["model"]
                                    );
                        ?>
                    </div>
                </div>
                
                <div class="input-error-box">    
                    <input class="custom-input"
                           type="text"
                           name="price"
                           placeholder="price">
                    <div class="error-container">
                        <?php
                            $formElements["price"] = $_POST["price"];
                            $valid[] = checkIfNumeric(
                                    $formElements["price"]
                                    );
                        ?>
                    </div>
                </div>
                
                <div class="input-error-box">   
                    <input class="custom-input"
                           id="desc-box"
                           type="text"
                           name="details"
                           placeholder="description">
                    <div class="error-container">
                        <?php
                            $formElements["details"] = $_POST["details"];
                            $valid[] = entryRequired(
                                    $formElements["details"]
                                    );
                        ?>
                    </div>
                </div><br>
                
                <input id="sell-submit"
                       type="submit"
                       name="sell_submit"
                       value="submit"> <br>
                               
            </form>  
            <div class="error-container2">                     
                <body>
                    <?php
                        checkLength($formElements); 
                        $isValid = formValidation($valid);                        
                        if($isValid){                               
                            insertVehicle($conn, $userId, $formElements);
                            uploadImage($conn,$userId, $formImage["img-1"],1);
                            uploadImage($conn,$userId, $formImage["img-2"],2);
                            uploadImage($conn,$userId, $formImage["img-3"],3);
                            goToPage("home.php");
                        }
                        
                    ?>
                </body>
            </div>
        </div>
        
    </div>
  <?php include 'footer.php';?>
</html>
