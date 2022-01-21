<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Images Verify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body{
            padding: 0;
            margin: 0;
            background-color: #097d94 ;
        }
        #car{
            color:red;
            font-size: 50px;
        }
        .centerDiv
        {
            width: 60%;
            height:30em;
            margin: 25px auto;
            padding: 25px;
            text-align: center;
            justify-content: center;
            
            background-color:#77d9ed ;
        }
        label{
            font-weight: bold;
        }
        .crudio{
            border-radius: 100px;
        }
        p{
            text-align: center;
            width: 92%; 
            margin: 0px auto; 
            padding: 10px; 
            border: 1px solid #a94442; 
            color: #a94442; 
            background: #f2dede; 
            border-radius: 5px; 
           
        }
        .error {
            width: 92%; 
            margin: 0px auto; 
            padding: 10px; 
            border: 1px solid #a94442; 
            color: #a94442; 
            background: #f2dede; 
            border-radius: 5px; 
            text-align: left;
        }
        img{
            width: 50px;
            height: 50px;
        }
        #btnme:hover{
            background-color: #f72323;
            color:black;
        }
        a{
            float: left;
        }
        #logout{
            background-color: #0d55fc;
            color: white;
        }
        #logout:hover{
            background-color:#f72323;
            color:black;
        }
    </style>
</head>
<body>

<?php
// initializing variables
$username = "";
$email    = "";
$errors = array(); 

if(isset($_POST['send'])){
    $username = $_POST['name'];
    $image_ver = $_FILES['img']['name'];
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($image_ver)) { array_push($errors, "Add image is required"); }

    if (count($errors) == 0) {
        $name_text = $_POST['name'];

        move_uploaded_file($_FILES['img']['tmp_name'],$_FILES['img']['name']);

        $image_name= $_FILES['img']['name'];


        $send_link_api="http://localhost/A1_code/car_detection/car_image_name.py?name=".$name_text."&image_name=".$image_name;
        $send_data = file_get_contents($send_link_api);
        
        echo $send_data;

        if(file_exists("".$image_name."")===true){    
            unlink("".$image_name."");
        }
    }
    
}
?>
<div class="centerDiv" class="mb-3">
    <a class="btn btn-outline-danger" id="logout" href="#">Logout</a>
    <form method="POST" enctype="multipart/form-data" class="form-group ">
        
        <img src="Car.png" alt="Not found image website">
        <hr>
        <label for="formFileDisabled" class="form-label">Enter your name</label>
        <div class="input-group">
        <div class="input-group-addon">
        <span class="glyphicon glyphicon-user"></span>
        </div>
        <input class="form-control crudio" type="text" name="name" value="<?php echo $username; ?>"/>
        </div>
        
        <br><hr>
        <label for="formFileDisabled" class="form-label">Choose your image to verify </label>
        <input class="form-control crudio" id="formFileDisabled" type="file" name="img"accept="image/png, image/gif, image/jpeg"  ><br>
        <br><hr>
        <button type="submit" name="send" class="btn btn-primary" id="btnme"> detected </button>
        
    </form>
</div>

<?php  if (count($errors) > 0) : ?>
        <div class="error">
            <?php foreach ($errors as $error) : ?>
            <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
<?php  endif ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>


