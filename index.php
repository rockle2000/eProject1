<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
		require_once "db_connect.php";

		$conn = OpenCon();
		$sql = "SELECT * FROM departments";


	    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $row['dept_name']; ?></td>
                    <!-- <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['email']; ?></td> -->
                </tr>
                <?php
            }
            // Giải phóng bộ nhớ của biến
            mysqli_free_result($result);
        } else {
            ?>
            <tr>
                <td colspan="4">No Records.</td>
            </tr>
            <?php
        }
    } else {
        echo "ERROR: Không thể thực thi câu lệnh $sql. " . mysqli_error($conn);
    }
    // Đóng kết nối
	CloseCon($conn);
	?>
</body>
</html>