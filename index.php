<?php
    if(session_status() === PHP_SESSION_NONE){session_start();}
    $totalfiles = 0;
    $arrayfiles = array("");
    if(is_dir("../files/".$_SESSION['id'])){
        $path = "../files/".$_SESSION['id'];
        $files = scandir($path);
        $countfiles = count($files);
        for ($i=0; $i < $countfiles ; $i++) { 
            if($files[$i]!='.' && $files[$i]!='..' && $files[$i]!='archive'){
                $totalfiles++;
                array_push($arrayfiles, $files[$i]);
            }
        }

        $filesarchive = scandir($path."/archive/");
        $countfilesarchive = count($filesarchive);
        for ($i=0; $i < $countfilesarchive ; $i++) { 
            if($filesarchive[$i]!='.' && $filesarchive[$i]!='..'){
                $totalfiles++;
                array_push($arrayfiles, 'archive/'.$filesarchive[$i]);
            }
        }
    }
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
    <link rel="stylesheet" type="text/css" href="plugin/fileinput/component.css" />
</head>
<style>
.boxfileupload{
		font-size: 1.25rem;
	    background-color: #c8dadf;
	    position: relative;
	    padding: 70px 20px;
	}
	.box__dragndrop,
	.box__uploading,
	.box__success,
	.box__error {
	  display: none;
	}

	.boxfileupload.has-advanced-upload {
		outline: 4px dashed #92b0b3;
		outline-offset: -10px;
		-webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
		transition: outline-offset .15s ease-in-out, background-color .15s linear;
	}
	.boxfileupload.has-advanced-upload .box__dragndrop {
		display: inline;
		float: none;
	}
	.boxfileupload.is-dragover {
		background-color: grey;
	}
	.boxfileupload.has-advanced-upload .box__icon{
		width: 100%;
	    height: 60px;
	    fill: #92b0b3;
	    display: block;
	    margin-bottom: 20px;
	}
	svg:not(:root){
		overflow: hidden;
	}
	.box__input{float: none !important;}
	.box__file{
		width: 0.1px;
	    height: 0.1px;
	    opacity: 0;
	    overflow: hidden;
	    position: absolute;
	    z-index: -1;
	}
	.box__file + label:hover strong, .box__file:focus + label strong, .box__file.has-focus + label strong{
		    color: #39bfd3;
	}
	.box__button{
		font-weight: 700;
	    color: #e5edf1;
	    background-color: #39bfd3;
	    display: none;
	    padding: 8px 16px;
	    margin: 40px auto 0;
	}
	.box__progress{
		position: absolute;
		left: 0;
		right: 0;
		margin: auto;
		width: 40%;
		height: 10px;
		border: 1px solid #999999;
		border-radius: 10px;
	}
	.prgoress_bar{
		position: relative;
		height: 100%;
		width: 0%;
		background: blue;
		border-radius: 10px;
	}
	.alertbox{
		position: relative;
		width: 80%;
		left: 0;		
		margin: auto;		
	}
    #previewWrapper{
        width: 100%; max-width: 400px; margin: auto; padding: 10px; font-size: 13px;
    }
    .previewFile{
        width: 100%; border: 1px solid #171717; border-radius: 5px;
        margin: 5px 0;
    }
    .previewFile object{
        vertical-align: middle;
        width: 50px;
        height: 50px;
    }
    .listvideo{
        width: 100%;
        max-width: 400px; margin: auto;
        padding: 10px;
        border: 1px solid red;
    }
</style>
<body>
    <?php if(!isset($_SESSION['id'])){ ?>
        <script type="text/javascript">
            window.location='login.php'
        </script>
    <?php } ?>
<div class="wrapper">
    <div class="login-wrap">
        <div class="fixMiddle loginBoxsize" style="width: 50%; height: auto;">
            <div class="headLogin">
                <?php 
                    if(isset($_GET['status'])){
                        $status = $_GET['status'];
                        if($status == 'success'){
                            $message = $_GET['count'].' video berhasil diupload';
                        }else{
                            $message = $_GET['message'];
                        }
                ?>
                <div class="alert <?php echo $status; ?> left">
                    <?php echo $message; ?>
                </div>
                <?php
                    }
                ?>
            </div>
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <div class="box__input" style="text-align: center;">
                    <input type="file" name="file[]" id="img_upload" class="box__file inputfile inputfile-3" data-multiple-caption="{count} files selected" multiple required accept="video/mp4,video/x-m4v,video/*">
                    <label for="img_upload">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> 
                        <span>Pilih file…</span>
                    </label>
                </div>
                <div class="box__uploading">Uploading&hellip;</div>
                <div class="box__success">Done!</div>
                <div class="box__error">Error! <span></span>.</div>
                <div id="previewWrapper">
                </div>
                <p style="text-align: center"><input type="submit" value="Upload" class="myButton-green"></p>
            </form>
            <div id="previewWrapper" style="overflow: auto; max-height: 350px;">
                <?php if($totalfiles == 0) {echo 'Belum ada video yang diupload';}else{ ?>
                    <p style="text-align: center">List video yang sudah diupload</p>
                <?php 
                    for ($x=0; $x < $totalfiles; $x++) {
                        $linkvideo = $path."/".$arrayfiles[$x+1];
                        ?>
                        <div class="previewFile increase" style="position: relative; cursor: pointer;" onClick="window.open('<?php echo $linkvideo ?>')">
                            <object data="https://www.svgrepo.com/show/76665/video.svg"></object>
                            <?php echo substr($arrayfiles[$x+1], 0, 35); ?>
                        </div>
                    <?php }
                } 
                ?>
            </div>
        </div>
        <p class="size-std" style="position: absolute; bottom: 10px; left: 0; right: 0; height: 50px; text-align:center">
            <a href="logout.php" style="font-size:14px;">Logout</a><br /><br />
            &copy;Copyright by Kadence Indonesia All right reserved
        </p>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$("input[id=img_upload]").change(function() {
    var html = [];
    for (var i = 0; i < $(this).get(0).files.length; ++i) {
        const files = $(this).get(0).files[i];
        let formData = new FormData();
        formData.append("file", files);
        console.log(formData);
        html.push(`<div class="previewFile"><object data="https://www.svgrepo.com/show/76665/video.svg"></object>${$(this).get(0).files[i].name}</div>`);
    }
    $("#previewWrapper").append(html);
    
});
</script>
<script src="plugin/fileinput/custom-file-input.js"></script>
</body>
</html>