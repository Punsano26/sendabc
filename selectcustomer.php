<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search name customer</title>
</head>
<body>
    <h1>search name Customer</h1>
    <form action="selectcustomer.php">
    <input type="text" placehoder="Enter Customer Name">

    <br><br>

    <input type="submit"></form>
</body>
</html>

<?php
$count=0;
if (isset($_GET['C_Name']))
{
    echo "<br> get value =".$_GET['C_Name'];
    require  'connect.php';

    $sql="SELECT * FROM customer where C_Name like CONCAT('%',:C_Name,'%')";

    echo"<br>sql=".$sql;
    $stmt = $conn->prepare($sql);
    $stmt ->bindParam(':C_Name',$_GET['C_Name']);
    $stmt->execute();
    ?>
    <table width="300" border="1">
  <tr>
    <th width="325">ชื่อ</th>
    <th width="130">เบอร์โทร</th>
    <th width="130">ที่อยู่</th>
    <th width="130">หลักฐาน</th>
  </tr>
  <?php
         while ($result = $stmt->fetch(PDO::FETCH_NUM)) {
    ?>
    <tr>
    <td><?php echo $result[0]; ?></div></td>
    <td><?php echo $result[1]; ?></div></td>
    <td><?php echo $result[2]; ?></div></td>
    <td><?php echo $result[3]; ?></div></td>
  </tr>

<?php
        
    }
    $count++;
    //echo "count ... ".$count;
    if($count==0)
    echo "<br> No data ... <br>";
}

?>


 
  </table>
<?php
$conn = null;
?>