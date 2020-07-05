<?php
include '../initial.php';
include '../components/Db.php';
error_reporting(0);
$id = $_POST['id'];
$json_content = $_POST['jsonContent'];
$post_title = $_POST['postTitle'];
$direction_id = $_POST['directionId'];
$services_id = $_POST['servicesId'];
$result = 'true';

$db = Db::getConnection();
$sql = "UPDATE price SET json_content=?, post_title=?, direction_id=?, services_id=? WHERE id=?";
$result = $db->prepare($sql);
$result->execute([$json_content, $post_title, $direction_id, $services_id, $id]);
if ($result->errorCode() == "00000") {
    $db = Db::getConnectionFront();
    $sql = "UPDATE price SET json_content=?, post_title=?, direction_id=?, services_id=? WHERE id=?";
    $result = $db->prepare($sql);
    $result->execute([$json_content, $post_title, $direction_id, $services_id, $id]);
    if ($result->errorCode() == "00000") {
        $result = true;
    } else {
        $result = false;
    }
} else {
    $result = false;
}
$result['data'] = $json_content;
echo json_encode($result);
