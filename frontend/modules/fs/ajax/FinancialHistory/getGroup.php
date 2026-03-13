 <?php
    @session_start();
    include("../../../config/main_function.php");
    $secure = "-%ekla!(m09)%1A7";
    $connection = connectDB($secure);

    $companyId = mysqli_real_escape_string($connection, $_POST['companyId']);

    $sqlGroup = "SELECT g.* ,b.countryName,b.flag,c.city
    FROM `company` c 
    LEFT JOIN `group` g ON g.groupId = c.groupId 
    LEFT JOIN `country` b ON c.countryId = b.countryId
    WHERE c.companyId = '$companyId';";
    $resGroup = mysqli_query($connection, $sqlGroup) or die($connection->error);
    $rowGroup =  mysqli_fetch_assoc($resGroup);
    ?>

 <div>
     <div class="fs-16 fw-500"><?php echo $rowGroup['groupName']; ?></div>
     <div class="d-flex align-items-center">
         <img src="https://tcg-hrvc-system.com/<?php echo $rowGroup['flag']; ?>" alt="" class="dd-flag me-1">
         <div class="fw-400 fs-12"><?php echo $rowGroup['countryName']; ?>,<?php echo $rowGroup['city']; ?></div>
     </div>
 </div>
 <div class="ms-2"><img src="https://tcg-hrvc-system.com/<?php echo $rowGroup['picture']; ?>" alt="" class="dd-circle"></div>