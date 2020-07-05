<?php
include '../initial.php';
include '../components/Db.php';
$id = $_POST['id'];
$json_content = $_POST['jsonContent'];
$result = 'true';

$db = Db::getConnection();
$sql = "UPDATE settings SET json_content=? WHERE id=?";
$result = $db->prepare($sql);
$result->execute([$json_content, $id]);
if ($result->errorCode() == "00000") {
    $db = Db::getConnectionFront();
    $sql = "UPDATE settings SET json_content=? WHERE id=?";
    $result = $db->prepare($sql);
    $result->execute([$json_content, $id]);
    if ($result->errorCode() == "00000") {
        $result = true;
    } else {
        $result = false;
    }
} else {
    $result = false;
}

echo json_encode($result);
