<?php 
include "config.php";

if(isset($_POST["name"]) || isset($_POST["file"])){
    $name=$_POST["name"];
    $file=$_FILES["file"]["name"];
    $temp_file=$_FILES["file"]["tmp_name"];
    $file_size=$_FILES["file"]["size"];
    $extention=array('jpg','JPG','png','PNG','JPEG','jpeg');
    $validation=pathinfo($file,PATHINFO_EXTENSION);


    $new_name=rand()."-".$file;

    if($file_size > 5671361){
        echo 2;
    }elseif(!in_array($validation,$extention)){
        echo 3;
    }else{
        $sql="INSERT INTO images (img_name,img) VALUES ('{$name}','{$new_name}')";
        if(mysqli_query($conn,$sql)){
            move_uploaded_file($temp_file,"../upload/".$new_name);
            echo 1;
        }else{
            echo 0;
        }
    }
}


?>