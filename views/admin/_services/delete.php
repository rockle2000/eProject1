<?php
// Process delete operation after confirmation
if(isset($_GET["id"]) && !empty($_GET["id"])){
    // Include config file
    require_once "../../../db_connect.php";
    $conn = OpenCon();
    // Prepare a delete statement
    $stmt = $conn->prepare("UPDATE `services` SET `status` = 0 WHERE id = ?");
    $stmt->bind_param("i",$_GET["id"] );
    $stmt->execute();
    if ($stmt->affected_rows >= 1) {
        session_start();
        $_SESSION['success'] = 'Disable service successfully';   
        $stmt->close();
        CloseCon($conn);
        header("location: list.php");
    } else {
        session_start();
        $_SESSION['failed'] = 'Delete service failed';   
        $stmt->close();
        CloseCon($conn);
        header("location: list.php");
    }
}
?>
