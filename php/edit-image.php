<?php 

include "config.php";

if(isset($_POST["id"])){
    $id=$_POST["id"];
    $sql="SELECT * FROM images WHERE id='{$id}'";
    $run_sql=mysqli_query($conn,$sql);
    $output="";
    if(mysqli_num_rows($run_sql) > 0){
        $output.="<div class='modal-body'>";
        while($row=mysqli_fetch_assoc($run_sql)){
            $output .="<div class='form-group'>
            <label for=''>Name</label>
            <input type='text' value='{$row["img_name"]}' name='name' id='edit_name' class='form-control form-control-lg'>
            <input type='hidden' value='{$row["id"]}' name='id' id='' class='form-control form-control-lg'>
        </div>
        <div class='form-group'>
            <label for=''>Image</label>
            <input type='file' name='new_file' id='' class='form-control form-control-lg'>
            <img src='../upload/{$row["img"]}' style='width:70px;height:70px' />
            <input type='hidden' value='{$row["img"]}' name='old_file' id='' class='form-control form-control-lg'>
        </div>";
        }
        $output .="</div>";
        echo $output;
    }
}

?>