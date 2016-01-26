<?php
if($_POST['atc'] == 'up') {
    header("Content-Type: text/html; charset=UTF-8");
    require_once 'sample_base.php';
    //初始化
    //$bucket = SampleUtil::get_bucket_name();
    $bucket = 'fangpinhui-api';
    $oss = SampleUtil::get_oss_client();
    //SampleUtil::create_bucket();

    /*%**************************************************************************************************************%*/
    /**
     *简单上传
     *上传指定的本地文件内容
     */
    $format    = explode('.',$_FILES["img"]['name']);
    $file_tmp  = $_FILES["img"]['tmp_name'];
    $real_name = $_FILES["img"]['name'];
    $file_name = dirname($file_tmp)."/".$real_name;
    rename($file_tmp, $file_name);

    $object = $real_name;
    $file_path = $file_name;
    $options = array();
    $res = $oss->upload_file_by_file($bucket, $object, $file_path, $options);
    $aa = (array)$res;
    //echo $aa['status'];


    $msg = "上传本地文件 :" . $file_path . " 到 /" . $bucket . "/" . $object;
    OSSUtil::print_res($res, $msg);
}
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form action="index.php" method="post" enctype="multipart/form-data">
    <input name="atc" type="hidden" value="up" />
    <input name="img" type="file"/>
    <input name="but" type="submit" value="上传" />
</form>