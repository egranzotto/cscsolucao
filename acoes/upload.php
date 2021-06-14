<?php
    require("../../config/config.php");

    if(isset($_FILES['upload']['name'])) {
        $file = $_FILES['upload']['tmp_name'];
        $file_name = $_FILES['upload']['name'];
        $file_name_array = explode(".", $file_name);
        
        $new_image_name = str_replace(" ","_",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($file_name_array[0]))));
        $new_image_name = strtolower($new_image_name);
        
        $extension = end($file_name_array);
        $new_image_name = $new_image_name."_".rand() . '.' . $extension;

        //chmod('upload', 0777);
        $allowed_extension_images = array("jpg", "gif", "png");
        $allowed_extension_files = array("doc", "docx", "xls", "pps", "pdf", "zip", "rar");
        
        $function_number = $_GET['CKEditorFuncNum'];
        
        if (in_array($extension, $allowed_extension_images)) {
            move_uploaded_file($file, '../../html/_uploads/imagens/' . $new_image_name);
            
            $url = $config_pasta_raiz.'html/_uploads/imagens/' . $new_image_name;
            
            $message = '';

            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
            
        } else if (in_array($extension,$allowed_extension_files)) {
            move_uploaded_file($file, '../../html/_uploads/arquivos/' . $new_image_name);
            
            $url = $config_pasta_raiz.'html/_uploads/arquivos/' . $new_image_name;
            
            $message = '';

            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
        } else {
            $message = "Arquivo de formato inválido. Extensões válidas: .jpg, .gif, .png, .doc, .docx, .xls, .pps, .pdf, .zip, .rar";
            
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '', '$message');</script>";
        }
    }

?>