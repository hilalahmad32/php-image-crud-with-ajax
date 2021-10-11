<?php 

include "config.php";

$sql="SELECT * FROM images ORDER BY id DESC";
$run_sql=mysqli_query($conn,$sql);
$output="";
if(mysqli_num_rows($run_sql) > 0){
    $output .="<div class='modal-body'>";
    while($row=mysqli_fetch_assoc($run_sql)){
        $output .="<tr>
        <td>{$row["id"]}</td>
        <td>{$row["img_name"]}</td>
        <td><img src='../upload/{$row["img"]}' style='width:70px;height:70px;' /></td>
        <td><button data-id='{$row["id"]}' id='edit-images' class='btn btn-success' data-toggle='modal' data-target='#updateImage'>Edit</button></td>
        <td><button data-id='{$row["id"]}' id='delete-image' class='btn btn-danger'>Delete</button></td>
    </tr>";
    }
    $output .="</div>";
    echo $output;
}else{
    echo "<h1>Record Not Found</h1>";
}
 ?>