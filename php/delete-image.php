<?php 

include "config.php";
if(isset($_POST["id"])){
    $id=$_POST["id"];
    $sql="SELECT * FROM images WHERE id='{$id}'";
    $run_sql=mysqli_query($conn,$sql);
    $result=mysqli_fetch_assoc($run_sql);

    unlink("../upload/".$result["img"]);
    $sql1="DELETE FROM images WHERE id='{$id}'";
    $run_sql1=mysqli_query($conn,$sql1);
    if($run_sql1){
        echo 1;
    }else{
        echo 0;
    }

}

?>