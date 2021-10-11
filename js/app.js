$(document).ready(function () {


    // load image
    const loadImage = () => {
        $.ajax({
            url: "php/select-image.php",
            type: "GET",
            success: (data) => {
                $("#image-data").html(data);
            }
        })
    }
    setTimeout(() => {
        loadImage();
    }, 1000);

    const count = () => {
        $.ajax({
            url: "php/total-count.php",
            type: "GET",
            success: (data) => {
                $("#count").html(data);
            }
        })
    }
    setTimeout(() => {
        count();
    }, 1000);
    // save image in database;
    $("#save").on("submit", function (e) {
        e.preventDefault();

        const name = $("#name").val();
        const file = $("#file").val();

        const formData = new FormData(this);

        if (name == "" || file == "") {
            alert("Please fill the field");
        } else {
            $.ajax({
                url: "php/insert-image.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: (data) => {
                    console.log(data);
                    if (data == 1) {
                        alert("Image save successfully");
                        $("#save").trigger("reset");
                        $("#addImage").modal("hide");
                        loadImage();
                        count();
                    } else if (data == 2) {
                        alert("Image Size is so large");
                    } else if (data == 3) {
                        alert("invalid image extention");
                    } else {
                        alert("Something woring");
                    }
                }
            })
        }

    });

    $(document).on("click", '#edit-images', function () {
        const id = $(this).data("id");

        $.ajax({
            url: "php/edit-image.php",
            type: "POST",
            data: { id: id },
            success: (data) => {
                $("#edit-image").html(data);
            }
        })
    });

    $("#update").on("submit", function (e) {
        e.preventDefault();
        const name = $("#edit_name").val();
        const formData = new FormData(this);

        if (name == "") {
            alert("please fill the field");
        } else {
            $.ajax({
                url: "php/update-image.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: (data) => {
                    move_uploaded_file($tmp_file, '../upload/'.$new_image);
                    unlink("../upload/".$old_file);
                    if (data == 1) {
                        alert("image update successfully");
                        $("#updateImage").modal("hide");
                        $("#update").trigger("reset");
                        loadImage();
                    } else if (data == 2) {
                        alert("File is so large");
                    } else {
                        alert("Something woring");
                    }
                }
            })
        }
    })

    $(document).on("click", "#delete-image", function () {
        const id = $(this).data("id");
        $.ajax({
            url: "php/delete-image.php",
            type: "POST",
            data: { id: id },
            success: (data) => {
                if (data == 1) {
                    alert("delete successfully");
                    loadImage();
                    count();
                } else {
                    alert("something woring");
                }
            }
        })
    })
})