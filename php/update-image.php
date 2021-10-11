<?php 

include "config.php";

if(isset($_POST["name"]) || isset($_POST["new_file"])){
    $id=$_POST["id"];
    $name=$_POST["name"];
    $old_file=$_POST["old_file"];
    $file=$_FILES["new_file"]["name"];
    $tmp_file=$_FILES["new_file"]["tmp_name"];
    $file_size=$_FILES["new_file"]["size"];

    $new_image = "";
    if($file == ""){
        $new_image=$old_file;
    }else{
        $new_image=rand()."-".$file;
    }

    if($file_size > 5671361){
        echo 2;
    }
    else{
        $sql="UPDATE images SET img_name='{$name}', img='{$new_image}' WHERE id='{$id}'";
        if(mysqli_query($conn,$sql)){
            if($file != ""){
                move_uploaded_file($tmp_file,'../upload/'.$new_image);
                unlink("../upload/".$old_file);
            }
           
            echo 1;
        }else{
            echo 0;
        }
    }
}

?>