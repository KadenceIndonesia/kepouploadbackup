<?php
$arrayFolder = $_POST['arrfolder'];
$arrExplode = explode(",",$arrayFolder);
function GetDirectorySize($path){
    $bytestotal = 0;
    foreach ($path as $value) {
        $path = realpath('../files/'.$value);
        if($value!==false && $value!='' && file_exists('../files/'.$value)){
            foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator('../files/'.$value, FilesystemIterator::SKIP_DOTS)) as $object){
                $bytestotal += $object->getSize();
            }
        }   
    }
    return $bytestotal;
}
$totalSize = GetDirectorySize($arrExplode);
echo $totalSize/1000000;
?>