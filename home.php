<!DOCTYPE html>
<?php
    include 'session_check.php';
    include 'form_handling.php';
    include 'internal_header.php';
    $isFilter = false;
?>
<html>
    <head>
    <link href="https://fonts.googleapis.com/css2?family=Pattaya&family=Poppins:ital,wght@0,500;0,600;0,700;0,800;1,500;1,600&display=swap" 
    rel="stylesheet">
        <link rel="stylesheet" type="text/css"
              href="internal_styles.css">
        <link rel="stylesheet" type="text/css"
              href="custom-inputs.css">
        <meta charset="UTF-8">
        <title>Home</title>
    </head>
    
    <div class="parent-content-container">
        
<!--        Filter Section-->
        <div class="filter-box">
            
            <form method="post" action="home.php">
                    <div class="form-container">
                          
                        <input class="custom-input"
                               type="text" name="make-filter"
                               placeholder="make">                   
                       
                        <input class="custom-input"
                               type="text" name="model-filter"
                               placeholder="model">                       
                        
                    <div class="filter-button-container">                     
                        
                        <input id="clear-submit"
                               type="submit"
                               name="clear"
                               value="clear"> 
                                    
                        
                        <div id="filter-separater"></div>                        
                            
                        <input id="filter-submit"                                   
                               type="submit" 
                               name="filter"
                               value="filter">               
                     
                        
                    </div>
                    </div>                   
                </form>            
        </div>
        
<!--        Vehicle preview section-->
        <div class="car-box">
            
<!--            <div class="preview-binder">
                <div class="preview-image">
                    <h3>TEST</h3>
                </div>
                <div class="info-box">
                    2017 Lotus Exige <br> $60000
                </div>
            </div>-->
            <body>
                <?php
                if((isset($_POST["filter"]) && 
                        !empty($_POST["filter"]))){
                    
                    $makeFilter  = $_POST["make-filter"];
                    $modelFilter = $_POST["model-filter"];
                    $isFilter = true;                   
                }
                
                if(isset($_POST["clear"]) && 
                        !empty($_POST["clear"])){
                    $_POST = array();
                    $isFilter = false;
                }
                
                if($isFilter){
                    filterCars($conn, $makeFilter, $modelFilter);
                }
                
                else{
                    loadHomePage($conn, $userId);
                }               
             
                
                ?>
            </body>
            
        </div>
        
    </div>
    <?php include 'footer.php';?>
</html>
