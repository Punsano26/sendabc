<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form address</title>
</head>
<body>
    <h2>Add Name and Address</h2>
    <form action="form.php" method = "POST" enctype="multipart/form-data">
        <input type="text"placeholder='Enter your name' name ="C_Name">
        <br><br>
        
        ประเภทของมนุษย์ 
        <br>
        <select name="Tid" require>
            <option value="">-please select-</option>
            <?php foreach($result as $row){?>
            <option value="<?php echo $row["Tid"];?>">
        <?php echo $row["describ"]; ?>
        </option>
        <?php}?>
            <!-- <option value="1">-คนปกติ-</option>
            <option value="2">-คนบ้า-</option> -->
        </select>

        <br><br>
        <input type="text" placeholder='Enter your phone number' name = "PhoneNumber">
        <br>
        <H3>กรอกที่อยู่ของคุณ</H3>
        <br>
        <textarea id="address" name="address"
          rows="5" cols="33"></textarea>
          <br>
          <h3>แนบรูปภาพ</h3>
          <br>
          <input type="file" name="sleeper" id="sleeper">
          <br><br>
          <input type="submit" name="btn_insert">
    </form>
</body>
</html>

<?php 
    // if (!empty($_POST['C_Name'])&& !empty($_POST['PhoneNumber'])&& !empty($_POST['address'])&& !empty($_POST['sleeper'])):
        if(isset($_REQUEST['btn_insert']))
        {
        require'connect.php';
        $uploadFile = $_FILES['sleeper']['name'];
        $tmpFile = $_FILES['sleeper']['tmp_name'];
        echo " upload file =".$uploadFile;

            $sql_insert="insert into customer,type values (:C_Name,:Tid,:PhoneNumber,:address,:sleeper)";

            $stmt = $conn->prepare($sql_insert);
            $stmt->bindParam(':C_Name',$_POST['C_Name']);
            $stmt->bindParam(':PhoneNumber',$_POST['PhoneNumber']);
            $stmt->bindParam(':address',$_POST['address']);
            $stmt->bindParam(':sleeper',$uploadFile);
            
                $fullpath = "images/".$uploadFile;
                echo "fullpath =".$fullpath;
                move_uploaded_file($tmpFile,$fullpath);


            if($stmt->execute()):
                $message = 'Sucessfully add new country';

                 header("Location:/sendabc/alertimg.php");

            else:
                    $message='Fail to add new country';
            endif;
            echo $message;
            $conn=null; 
        }
        // endif; 
        ?>