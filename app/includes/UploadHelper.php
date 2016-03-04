<?php

/**
 * Created by PhpStorm.
 * User: Rami Jemli
 * Date: 26/02/2015
 * Time: 16:31
 */
class UploadHelper
{
 
    public static function upload($param)
    {
        $target_dir = "imgs/";
        //$target_path = $target_path . basename($_FILES['image']['name']);
        $name = md5(uniqid(rand(), 'true'));
        $extension = substr(basename($_FILES['image']['name']), strpos(basename($_FILES['image']['name']), "."));
        $target_path = $target_dir . $name . $extension;
        $imageFileType = pathinfo($target_path, PATHINFO_EXTENSION);
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {

            return false;
        }
        try {
            // Throws exception incase file is not being moved
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                // make error flag true
                return false;
            }else{
                return $target_path;
            }

        } catch (Exception $e) {
            // Exception occurred. Make error flag true
           echo $e->getMessage();
        }

    }
}