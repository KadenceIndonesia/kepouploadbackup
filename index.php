<?php
    if(session_status() === PHP_SESSION_NONE){session_start();}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/mystyle.css">
    <link rel="stylesheet" href="./styles/style_button.css">
    <link rel="stylesheet" href="./styles/component.css">
    <link type="text/css" rel="stylesheet" href="plugin/dist/aksFileUpload.min.css">
</head>
<body>
    <?php if(!isset($_SESSION['id'])){ ?>
        <script type="text/javascript">
            window.location='login.php'
        </script>
    <?php } ?>
    <a href="logout.php">Logout</a>
<div class="wrapper">
    <div class="login-wrap">
        <div class="fixMiddle loginBoxsize" style="width: 50%; height: 75%;">
            <div class="headLogin">
            </div>
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <!-- <div class="bodyLogin">
                    <form method="post" action="prd/create/images/save" enctype="multipart/form-data" class="boxfileupload has-advanced-upload">
                        <aks-file-upload></aks-file-upload>
                        <p id="uploadfile" type="json"></p>
                    </form>
                </div> -->
                <input type="file" name="file[]" id="fileupload" multiple>
                <button type="submit">Upload</button>
            </form>
            <div class="bottomLogin">
                <p class="size-std" style="position: absolute; bottom: 10px; left: 0; right: 0; height: 20px;">&copy;Copyright by Kadence Indonesia All right reserved</p>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="plugin/dist/aksFileUpload.min.js"></script>
<script>
// $("input[name=file]").change(function() {
//     var names = [];
//     for (var i = 0; i < $(this).get(0).files.length; ++i) {
//         const files = $(this).get(0).files[i];
//         // names.push($(this).get(0).files[i].name);
//         let formData = new FormData();
//         formData.append("file", files);
//         console.log(URL.createObjectURL(files))
//     }
    
// });
$(function () {
  $("aks-file-upload").aksFileUpload({
    fileUpload: "#uploadfile",
    dragDrop: true,
    maxSize: "90 GB",
    multiple: true,
    maxFile: 50,
    ajaxUpload: false,
    ajax: {
        directlyLoad: false,
        url: "upload.php",
        type: "POST",
        data: "formData",
        contentType: false,
        processData: false,
        cache: false,
        async: true,
        enctype: "multipart/form-data"
    },
  });
});
</script>
</body>
</html>