<?php
include __DIR__ . '/../config.php'; // Load base path
include $basePath . 'includes/connection.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD']=='POST')

    // Collect fields
    $prod_name       =  $_POST['prod_name'];
    $slug            =  $_POST['slug'];
    $vnd_id          =  $_POST['vnd_id'];
    $vnd_group_id    = $_POST['vnd_group_id'] ;
    $prod_owner      = $_POST['prod_owner'] ;
    $prod_p_mgr      = $_POST['prod_p_mgr'] ;
    $sort_order      = $_POST['sort_order'] ;
    $web_publish     = $_POST['web_publish'];
    $publish_tiles   = $_POST['publish_tiles'] ;
    $alt_tag         =  $_POST['alt_tag'];
    $meta_description=  $_POST['meta_description'];
    $txt_url_product =  $_POST['txt_url_product'];
    $txt_url_competency =  $_POST['txt_url_competency'];
    $txt_url_roadmap =  $_POST['txt_url_roadmap'];

    // Handle file upload (Product Logo)
    $prod_logo = NULL;
    if (isset($_FILES['prod_logo']) && $_FILES['prod_logo']['error'] == 0) {
        $uploadDir  = __DIR__ . "/../assets/uploads/emp_docs/"; // Ensure this folder exists & writable
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName   = time() . "_" . basename($_FILES['prod_logo']['name']);
        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['prod_logo']['tmp_name'], $uploadFile)) {
            $prod_logo = $fileName;
        }
    }

    // Insert query
    $sql = "INSERT INTO product_management 
        (vnd_id, vnd_group_id, prod_name, prod_owner, slug, prod_p_mgr, web_publish, publish_tiles, prod_logo, meta_description, alt_tag, txt_url_product, txt_url_competency, txt_url_roadmap, added_by, added_on)
        VALUES ('$vnd_id', '$vnd_group_id','$prod_name','$prod_owner','$slug','$prod_p_mgr','$web_publish','$publish_tiles','$prod_logo','$meta_description','$alt_tag','$txt_url_product','$txt_url_competency','$txt_url_roadmap','$prod_owner',NOW())";
if($conn->query($sql) === TRUE) {
header("Location: employee_dashboard.php")  ;
}
   else{
    echo "Error: " . $sql . "<br>" . $conn->error;
   }
?>
