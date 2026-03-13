 <?php
    include("../../../config/main_function.php");
    $secure = "-%ekla!(m09)%1A7";
    $connection = connectDB($secure);

    $branchId = mysqli_real_escape_string($connection, $_POST['branchId']);

    $sql = "SELECT a.branchName,a.branchImage,b.city,c.countryName,c.flag
    FROM branch a 
    LEFT JOIN company b ON a.companyId = b.companyId
    LEFT JOIN country c ON b.countryId = c.countryId
    WHERE branchId = '$branchId' ;";
    $res = mysqli_query($connection, $sql) or die($connection->error);
    $row = mysqli_fetch_assoc($res);

    ?>

 <li class="px-3"><img src="https://tcg-hrvc-system.com/<?php echo $row['branchImage']; ?>" style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover;"> <?php echo $row['branchName']; ?></li>
 <li class="px-3 fs-12 fw-300"><img src="https://tcg-hrvc-system.com/<?php echo $row['flag']; ?>" style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover;"> <?php echo $row['city']; ?> , <?php echo $row['countryName']; ?></li>