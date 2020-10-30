<!DOCTYPE html>
<?php
    include 'session_check.php';
    include 'form_handling.php';
    include 'internal_header.php';
    $vehicleId = $_GET["vehicleId"];
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css"
              href="internal_styles.css">
        <meta charset="UTF-8">
        <title>View Vehicle</title>
    </head>
<!--    <div class="parent-content-container">
        <div class="image-container">
            <div class="full-vehicle-view">
                <h1>Test</h1>
            </div>
            
            <div class="full-vehicle-view">
                <h1>Test</h1><br>
            </div>
            
            <div class="full-vehicle-view">
                <h1>Test</h1><br>
            </div>
        </div> 
    </div>-->

<!--    <div class="parent-content-container">
        <div class="image-container">-->
 
<!--        </div>
    </div>
    
    <div class="parent-content-container">
        <div class="vehicle-descr">
            <h3 class="full-view-heading">
                Seller
            </h3>
            <hr class="underline"><br>
            <div class="text-box">
                <p class="text-custom">username</p>
                <p class="text-custom">contact</p>
            </div>
            
             <h3 class="full-view-heading">
                Vehicle
            </h3>
            <hr class="underline"><br>
            <div class="text-box">
                <p class="text-custom">make</p>
                <p class="text-custom">model</p>
                <p class="text-custom">price</p>
            </div>
            
            <h3 class="full-view-heading">
                Description
            </h3>
            <hr class="underline"><br>
            <div class="text-box">
                <p class="text-custom">full description</p>
            </div>
        </div>     
    </div>-->
    
    
        
  
    
    <body>
        <?php
            fullViewQuery($conn, $vehicleId);
        ?>
    </body>
</html>
