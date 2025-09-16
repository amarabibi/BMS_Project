<?php
//  Check if file uploaded correctly
function file_uploaded($file) {
    return isset($file) && $file['error'] === UPLOAD_ERR_OK;
}

//  Check file size (max in MB)
function file_size_ok($file, $max_mb = 8) {
    $max_size = $max_mb * 1024 * 1024;
    return $file['size'] <= $max_size;
}

//  Check allowed extensions
function file_extension_ok($file, $allowed = ['pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg']) {
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    return in_array($ext, $allowed);
}

//  Create a safe unique filename (always full path)
function unique_filename($file, $upload_dir) {
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $uniqueName = uniqid("doc_", true) . "." . $ext;

    return rtrim($upload_dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $uniqueName;
}

//  Move uploaded file to destination (full path)
function save_file($file, $destination) {
    return move_uploaded_file($file['tmp_name'], $destination);
}


?>
