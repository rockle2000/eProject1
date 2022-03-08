<?php
// Process delete operation after confirmation
if(isset($_GET["id"]) && !empty($_GET["id"])){
    // Include config file
    require_once "../../../db_connect.php";
    $conn = OpenCon();
    // Prepare a delete statement
    $stmt = $conn->prepare("UPDATE `departments` SET `status` = 1 WHERE id = ?");
    $stmt->bind_param("i",$_GET["id"] );
    $stmt->execute();
    if ($stmt->affected_rows >= 1) {
        session_start();
        $_SESSION['success'] = 'Active department successfully';   
        $stmt->close();
        CloseCon($conn);
        header("location: list.php");
    } else {
        session_start();
        $_SESSION['failed'] = 'Active department failed';   
        $stmt->close();
        CloseCon($conn);
        header("location: list.php");
    }
}
