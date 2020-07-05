<?php
include '../initial.php';
include '../components/Db.php';
$id = $_POST['id'];
$json_content = $_POST['jsonContent'];
$post_title = $_POST['postTitle'];
$title = $_POST['title'];
$description = $_POST['description'];
$result = 'true';

$db = Db::getConnection();
$sql = "UPDATE static_page SET json_content=?, post_title=?, title=?, description=? WHERE id=?";
$result = $db->prepare($sql);
$result->execute([$json_content, $post_title, $title, $description, $id]);
if ($result->errorCode() == "00000") {
    $db = Db::getConnectionFront();
    $sql = "UPDATE static_page SET json_content=?, post_title=?, title=?, description=? WHERE id=?";
    $result = $db->prepare($sql);
    $result->execute([$json_content, $post_title, $title, $description, $id]);
    if ($result->errorCode() == "00000") {
        $result = true;
    } else {
        $result = false;
    }
} else {
    $result = false;
}

echo json_encode($result);
