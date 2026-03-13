 <?php
    include("../../../config/main_function.php");
    $secure = "-%ekla!(m09)%1A7";
    $connection = connectDB($secure);

    $branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
    $MajorId = mysqli_real_escape_string($connection, $_POST['MajorId']);
    $MediumId = mysqli_real_escape_string($connection, $_POST['MediumId']);
    $BreakdownId = mysqli_real_escape_string($connection, $_POST['BreakdownId']);
    $page = intval(mysqli_real_escape_string($connection, $_POST['page'] == '' ? 1 : $_POST['page']));

    $limit = $page - 1;

    $sql = "SELECT a.*,b.medium_name,c.major_name,e.breakdown_name 
    FROM tbl_branch_pl_account_code a 
    LEFT JOIN tbl_pl_medium_df b ON a.pl_medium_id = b.pl_medium_id
    LEFT JOIN tbl_pl_major_df c ON b.pl_major_id = c.pl_major_id
    LEFT JOIN tbl_pl_breakdown_df e ON a.breakdown_id = e.breakdown_id 
    WHERE branchId = '$branchId' ORDER BY a.acc_code ASC LIMIT $limit,9 ;";
    $res = mysqli_query($connection, $sql) or die($connection->error);
    $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

    $num = mysqli_num_rows($res);

    if ($num < 1) {
    ?>
     <!-- <div class="position-relative" style="height: 60vh;">
         <div class="position-middle content-no-config">
             <p><img src="../asset/images/no-config.png" alt="" width="82"></p>
             <div class="fs-26 fw-700 mb-2">No Configurations Yet!</div>
             <p class="text-muted fs-15 fw-300">Create or import a configuration to get started. Once added, you can edit it anytime.</p>
             <button class="btn btn-primary" type="button" onclick="getModalCreate();">Create New Configuration <i class="bi bi-plus-circle"></i></button>
             <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalImport">Import Configuration <i class="bi bi-file-earmark-arrow-up"></i></button>
         </div>
     </div> -->
 <?php
    } else {
    ?>
     <div class="row">
         <?php foreach ($rows as $row) { ?>
             <div class="col-lg-4 mb-3" id="acc_<?php echo $row['account_id']; ?>">
                 <div class="card bg-light">
                     <div class="card-body p-4">
                         <div class="d-flex align-items-center mb-3 justify-content-between">
                             <div class="d-flex align-items-center">
                                 <div>
                                     <div class="fs-24 fw-500"><?php echo $row['acc_code']; ?></div>
                                     <div class="fs-16">
                                         <?php echo $row['major_name']; ?>
                                     </div>
                                 </div>
                             </div>
                             <div class="d-flex">
                                 <button class="btn btn-light btn-sm border d-flex justify-content-center align-items-center p-1 me-2" style="width:30px;height:30px;background: #fff;" onclick="getModalEdit('<?php echo $row['account_id']; ?>');">
                                     <img src="../asset/icon/edit.png" alt="" style="width:17px" class="">
                                 </button>
                                 <button class="btn btn-outline-danger border-danger bd-red-200 btn-sm border d-flex justify-content-center align-items-center p-1" style="width:30px;height:30px;background: #FFE3E3;" onclick="deleteConfigurationAccount('<?php echo $row['account_id']; ?>');">
                                     <img src="../asset/icon/remove.png" alt="" style="width:17px" class="">
                                 </button>

                             </div>
                         </div>

                         <div class="d-flex align-items-center mb-2">
                             <img src="../asset/icon/accountsFlow.png" alt="" class="me-2" style="width:16px;height:16px"> Account Flow
                         </div>
                         <div class="category-accountsFlow">
                             <div class="lv-1">
                                 <div class="title">Category</div>
                                 <span class="cost"><?php echo $row['major_name']; ?></span>
                             </div>
                             <div class="lv-2">
                                 <div class="title">Sub-Category</div>
                                 <span class="cost"><?php echo $row['medium_name']; ?></span>
                             </div>
                             <div class="lv-3">
                                 <div class="title">Breakdown</div>
                                 <span class="cost"><?php echo $row['breakdown_name']; ?></span>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         <?php } ?>
     </div>
 <?php
    }
    ?>