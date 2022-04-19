<?php
session_start();
$folderUpload = "./files";
// mkdir("../files/12345", 0777);
$files = $_FILES;
$jumlahFile = count($files['file']['name']);
for ($i = 0; $i < $jumlahFile; $i++) {
    $namaFile = $files['file']['name'][$i];
    $lokasiTmp = $files['file']['tmp_name'][$i];
    $namaBaru = uniqid() . '-' . $namaFile;
    $lokasiBaru = "{$folderUpload}/{$namaBaru}";
    $prosesUpload = copy($lokasiTmp, $lokasiBaru);

    echo "nama: $namaFile, tmp: {$lokasiTmp} <br>";
}

// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   if($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }