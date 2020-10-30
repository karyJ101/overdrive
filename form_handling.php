<?php
//ini_set("display_errors", 1);
include 'overdrive_database.php';

function goToPage($page){
    print <<<HERE
   
    <script type='text/javascript'>
        document.location='$page';
    </script>
HERE;
    
}

// ********** Account Page Functions*******//

function displayAccountInfo($rows){
    $username = $rows["username"];
    $email    = $rows["email"];
    $first    = $rows["first_name"];
    $last     = $rows["last_name"];
    
    print <<<HERE
        <p class="text-custom">$username</p>
        <p class="text-custom">$email</p>
        <p class="text-custom">$first</p>
        <p class="text-custom">$last</p>
    
HERE;
    
}

// ************ Vehicle Display **********//

function fullViewDisplay($vehicleRows){
    $vehicle_id = $vehicleRows["vehicle_id"];
    $user_id    = $vehicleRows["user_id"];
    $make       = $vehicleRows["make"];
    $model      = $vehicleRows["model"];
    $price      = $vehicleRows["price"];
    $details    = $vehicleRows["details"];
    $username   = $vehicleRows["username"];
    $email      = $vehicleRows["email"];
   

    print <<<HERE
 <div class="parent-content-container">
        <div class="image-container">
HERE;
    
    for($i = 1; $i < 4; $i++){
        print <<<HERE
       <div class="center-car-image">
        <img class="full-vehicle-view" 
            src = uploads/$vehicle_id-$user_id-$i>        
       </div>
HERE;
        
    }
    
    print <<<HERE
    </div>
    </div>
    
    <div class="parent-content-container">
        <div class="vehicle-descr">
            <h3 class="full-view-heading">
                Seller
            </h3>
            <hr class="underline"><br>
            <div class="text-box">
                <p class="text-custom">$username</p>
                <p class="text-custom">$email</p>
            </div>
            
             <h3 class="full-view-heading">
                Vehicle
            </h3>
            <hr class="underline"><br>
            <div class="text-box">
                <p class="text-custom">$make</p>
                <p class="text-custom">$model</p>
                <p class="text-custom">$price</p>
            </div>
            
            <h3 class="full-view-heading">
                Description
            </h3>
            <hr class="underline"><br>
            <div class="text-box">
                <p class="text-custom">$details</p>
            </div>
        </div>     
    </div>
HERE;
}

function vehiclePreviewGrid($result){
    while($rows = mysqli_fetch_assoc($result)){
        $vehicleId = $rows["vehicle_id"];
        $userId = $rows["user_id"];
        $make   = $rows["make"];
        $model  = $rows["model"];
        $price  = $rows["price"]; 
    print <<< HERE
                   
            <div class="preview-binder">
                    
                        <img class="preview-image"
                            src="uploads/$vehicleId-$userId-1">
                    
                    <div class="info-box">
                        <a class="info-link" 
                            href="view_vehicle.php?vehicleId=$vehicleId">
                            $make  $model <br> $price
                        </a>
                    </div>
            </div>
                
HERE;
    }
}

// ************ Image Validation *************//


function imageValidate($image){ // Checks if image is real
    if(strlen($image["name"]) > 0){        
        checkRealImage($image);
        return true;
    } 
    else{
        echo"*";
        return false;
    }
}

function checkRealImage($image){
    $isReal = getimagesize($image["tmp_name"]);
    
    if($isReal){
        checkImageSize($image);
        return true;
    }
    else{
        displayError(7);
        return false;
    }
}

function checkImageSize($image){
    if($image["size"] <= 500000){
        checkImageType($image);
        return true;
    } 
    else{
        displayError(8);
        return false;    
    }
    
}

function checkImageType($image){
    $type = "image/";
    if($image["type"] === $type."jpeg" 
            || $image["type"] === $type."png"
            || $image["type"] === $type."jpg"){
        
        return true;
    }
    else{
        displayError(9);
        return false;
    }
}

function uploadImage($conn, $userId, $image, $imageNumber){
  
    $query = "Select * From vehicle
              Order by vehicle_id Desc
              Limit 1;";
    $result = mysqli_query($conn, $query);
    
    if($result){ 
        $carId = mysqli_fetch_assoc($result);// Get Vehicle id for unique posting
        $imageName = $carId["vehicle_id"]."-".$userId."-".$imageNumber;
        $destination = "uploads/". basename($imageName);

        if(file_exists($destination)){ // Replace image if already exist
            unlink($destination);
            if(move_uploaded_file($image["tmp_name"],$destination)){
                echo "";                  
            } 
            else{
                echo "Image Upload Error";
            }
        }

        else{
            if(move_uploaded_file($image["tmp_name"],$destination)){
                //echo "Image Success";                  
            } 
            else{
                echo "Image Upload Error";
            }
        }
    }
//    if(move_uploaded_file($image["tmp_name"], $destination)){
//        echo "Image Success";
//    }
//    else{
//        echo "Image Fail";
//    }
}

//************** DATABASE FUNCTIONS *************//

function updateProfile($conn, $form, $userId){
    $email = $form["emailUpdate"];
    $first = $form["firstUpdate"];
    $last  = $form["lastUpdate"];
    
    $query = "Update personal_info
              Set email  = '$email', 
              first_name = '$first',
              last_name  = '$last' 
              Where user_id = '$userId'";
    
    if(mysqli_query($conn, $query)){
        echo "Update Success";
    }
    else{
        //echo"Update Fail: ". mysqli_error($conn);
    }
}

function accountPageQuery($conn, $userId){
    $query = "Select              
              username,
              email,
              first_name,
              last_name
              From profile
              Inner Join personal_info
              On personal_info.user_id = profile.user_id
              Where profile.user_id = $userId";
    $result = mysqli_query($conn, $query);
    $rows   = mysqli_fetch_assoc($result);
    
    displayAccountInfo($rows);
}

function fullViewQuery($conn, $vehicleId){
    //$query  = "Select * From vehicle Where vehicle_id = $vehicleId";
    $query = "Select 
              vehicle_id,
              vehicle.user_id,
              make,
              model,
              price,
              details,
              username,
              email
              From vehicle
              Inner Join profile 
              On profile.user_id = vehicle.user_id
              Inner Join personal_info
              On personal_info.user_id = vehicle.user_id
              Where vehicle_id = $vehicleId";
    
    $result = mysqli_query($conn, $query);
    $row    = mysqli_fetch_assoc($result);   
    
    fullViewDisplay($row);
   
}

function filterCars($conn, $make, $model){
    $query = "Select * From vehicle 
              Where make Like '%$make%' and model Like '%$model%'";
            
            
            
    $result = mysqli_query($conn, $query);
    if($result){
       vehiclePreviewGrid($result);    
    }
    else{
        echo " Filter Error: " . mysqli_error($conn);
    }
     
}

function loadHomePage($conn){
    $query = "Select * From vehicle";
    $result = mysqli_query($conn, $query);
    
    vehiclePreviewGrid($result);
}

function insertVehicle($conn,$userId,$formElements){ //Insert into Vehicle table
    $make = $formElements["make"];
    $model = $formElements["model"];
    $price = $formElements["price"];
    $details = $formElements["details"];
    $details = str_replace("'","\'",$details);
    $query = "Insert Into vehicle(user_id,make,model,price,details)"
            . "Values('$userId','$make','$model','$price','$details')";
    
    if(mysqli_query($conn, $query)){
        header("Location: home.php");
    }
    
    else{
        echo "Vehicle Error: " . mysqli_error($conn);
    }
    
}

function findAccount($conn, $user, $pass){ // CHecks for user account
    $query = "Select * From profile";
    $result = mysqli_query($conn, $query);
    
    while($rows = mysqli_fetch_assoc($result)){
        if($user === $rows["username"] 
                && password_verify($pass, $rows["password"])){           
            
            startSession($rows["user_id"]); // Logs user in if found
            //break;
        }
    }
    echo displayError(6);    
}

function insertNewAccount($conn, $formElements){
    $user  = $formElements["newUser"];
    $pass  = password_hash($formElements["newPass"], PASSWORD_DEFAULT);
    
    $profileInsert = "Insert Into profile(username, password)"
            . "Values('$user', '$pass')";
    
    if(mysqli_query($conn, $profileInsert)){
        $userId = mysqli_insert_id($conn);
        personalInfoTable($conn, $userId, $formElements);
        goToPage("login.php");
    }
    else{
        echo "Profile error: " . mysqli_error($conn);
    } 
}

function personalInfoTable($conn, $userId, $formElements){
    $first = $formElements["first"];
    $last  = $formElements["last"];
    $email = $formElements["newEmail"];
    
    $personalInsert = "Insert Into personal_info("
            . "user_id,"
            . "first_name,"
            . "last_name,"
            . "email)"
            . "Values("
            . "'$userId',"
            . " '$first',"
            . "'$last',"
            . "'$email'"
            . ")";
    
    if(mysqli_query($conn, $personalInsert)){
        echo "New Account Success";
    } 
    else{
        echo "New Account Error: " . mysqli_error($conn);
    }
    
}



//************* Login Accunt Handling ****************//

function checkUserPass($conn, $user, $pass){
    if(strlen($user) > 0 && strlen($pass) > 0){
        findAccount($conn, $user, $pass);
        
    }
    else{
        echo displayError(4);
    }
}

function startSession($userId){ // starts new session
    session_start();
    $_SESSION["user_id"] = $userId;
    //header("Location: home.php");
    goToPage("home.php");
}


//************* Form Validation ****************//

function entryRequired($formElement){
    if(strlen($formElement) > 0){
        return true;
    }
    else{
        echo"*";
        return false;
    }
}
           
function checkIfNumeric($price){
    
    if(strlen($price) > 0){
        if(is_numeric($price)){
            return true;
        }
        else{
            displayError(1);
            return false;
        }
    }
    else{
        echo "*";
        return false;
    }
}

function formValidation($validFields){
    
    foreach ($validFields as $valid){
        if(!$valid){
            return false;            
        }
    }
    return true;    
}

function checkNewPass($newPass){
    if(strlen($newPass) > 0){
        return true;
    }
    else{
        echo "*";
        return false;
    }
}

function checkReEnterPassword($newPass, $reEnteredPass){
    if(strlen($reEnteredPass) > 0){
        if($newPass === $reEnteredPass){
            return true;
        }

        else{
            displayError(5);
            return false;
        }
    }
    
    else{
        echo "*";
        return false;
    }
}

function checkUserExist($conn, $newUser,$table,$column){
    $query = "Select * From $table";
    $result = mysqli_query($conn, $query);
    
    if(strlen($newUser) > 0){
        while($rows = mysqli_fetch_assoc($result)){
            if($newUser === $rows[$column]){
                displayError(3);
                return false;
            }  
        }
        return true;
    }
    else {
        echo"*";
        return false;
    }
}

function checkValidChars($input){
    $invalid = '$!@%^&*()_+-={}:;\'\"\\|<>,.'.
            '1234567890';
    
    if(strlen($input) > 0){
        for($i = 0; $i < strlen($input); $i++){
            for($j = 0; $j < strlen($invalid); $j++){
               if($input[$i] === $invalid[$j]){
                   displayError(1);
                   return false;
               } 
            }
        }
        return true;
    }
    else {
        echo"*";
        return false;
    }
}

function checkLength($formElements){
    foreach($formElements as $element){
        if(strlen($element) <= 0){
            displayError(4);
            break;
        }
    }   
    
}


//****************** Message Functions **************//


function displayError($errorNum){
    switch($errorNum){
        
        //General Form Errors//
        case 1: 
            echo"Invalid Entry";
            break;
        
        case 2: 
            echo "All entries must be greater "
                . "than 0 or less than "
                . "50 characters in length";
            break;
        
        case 3:
            echo "Account Exists";
            break;
        
        case 4:
            echo "Fill All Fields";
            break;
        
        case 5:
            echo "Passwords Must Match";
            break;
        
        case 6:
            echo "Username Or Password Incorrect";
            break;
        //Image Errors//
        case 7:
            echo "Please upload an Image";
            break;
        
        case 8:
            echo "Image too large";
            break;
        
        case 9:
            echo " Image type must be jpeg, png, or jpg";
            break;
        
        default:
            break;
    }
}