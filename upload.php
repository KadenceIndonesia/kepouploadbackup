<?php
session_start();
include 'dbsbackup.php';
$id = $_SESSION['id'];
$code = $_SESSION['code'];
$task = $_SESSION['task'];
$folderUpload = "../files/";
$date = new DateTime();
$timestamp = $date->getTimestamp();
$formatDate = date_format($date,"Ymd");
$formatTime = date_format($date,"His");
$fulldatetime = date_format($date,"Y-m-d H:i:s");
if(!is_dir("../files/".$id)){
    mkdir("../files/".$id, 0777);
    mkdir("../files/".$id."/archive", 0777);
}
$files = $_FILES;
$jumlahFile = count($files['file']['name']);
$no = 0;
$success = 0;
$failed = 0;
$alertmessage = "";
global $mysqli;
for ($i = 0; $i < $jumlahFile; $i++) {
    $no++;
    $namaFile = $files['file']['name'][$i];
    $lokasiTmp = $files['file']['tmp_name'][$i];
    $ext = pathinfo($namaFile, PATHINFO_EXTENSION);
    $namaBaru = $timestamp."_".$no."_".$id.'_'.$formatDate."-".$formatTime."__".$code."_".$task.".". $ext;
    $checktaskstatus = $mysqli->query("SELECT * FROM taskstatus WHERE task=$id");
    $count = mysqli_num_rows($checktaskstatus);
    if($count == 0){
        if($i == 0){
            $lokasiBaru = "{$folderUpload}/{$id}/{$namaBaru}";
        }else{
            $lokasiBaru = "{$folderUpload}/{$id}/archive/{$namaBaru}";
        }
        $prosesUpload = copy($lokasiTmp, $lokasiBaru);
        if($prosesUpload){
            if($i == 0){
                $update = $mysqli->query("UPDATE task SET state=100, filename='$namaBaru', uploadtime='$fulldatetime', open=null WHERE id=$id");
                $save = $mysqli->query("INSERT INTO taskstatus(task, filename) VALUES($id, '$namaBaru')");
                if($save && $update){
                    $success++;
                }else{
                    echo ($mysqli->error);
                    $failed++;
                    $alertmessage = 'Terjadi kesalahan dalam menyimpan data';
                }
            }
        }else{
            $alertmessage = 'Gagal mengupload video '.$namaFile;
        }
    }else{
        $lokasiBaru = "{$folderUpload}/{$id}/archive/{$namaBaru}";
        $prosesUpload = copy($lokasiTmp, $lokasiBaru);
        if($prosesUpload){
            $success++;
        }
    }
}
if($failed == 0){
    header('Location: ./index.php?status=success&count='.$success);
}else{
    header('Location: ./index.php?status=error');
}