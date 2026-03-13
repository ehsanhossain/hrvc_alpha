 <?php
    include("../../../config/main_function.php");
    $secure = "-%ekla!(m09)%1A7";
    $connection = connectDB($secure);

    $current_page = intval(mysqli_real_escape_string($connection, $_POST['page'] == '' ? 1 : $_POST['page']));
    $limit = (intval($current_page) - 1) * 9;

    $branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
    $MajorId = mysqli_real_escape_string($connection, $_POST['MajorId']);
    $MediumId = mysqli_real_escape_string($connection, $_POST['MediumId']);
    $BreakdownId = mysqli_real_escape_string($connection, $_POST['BreakdownId']);

    $conditions = [];

    if ($MajorId) {
        $conditions[] = "b.pl_major_id = '$MajorId'";
    }
    if ($MediumId) {
        $conditions[] = "a.pl_medium_id = '$MediumId'";
    }
    if ($BreakdownId) {
        $conditions[] = "a.breakdown_id = '$BreakdownId'";
    }

    $conditions[] = "branchId = '$branchId'";

    $where = implode(' AND ', $conditions);

    $sql = "SELECT a.*,b.medium_name,c.major_name,e.breakdown_name 
    FROM tbl_branch_pl_account_code a 
    LEFT JOIN tbl_pl_medium_df b ON a.pl_medium_id = b.pl_medium_id
    LEFT JOIN tbl_pl_major_df c ON b.pl_major_id = c.pl_major_id
    LEFT JOIN tbl_pl_breakdown_df e ON a.breakdown_id = e.breakdown_id 
    WHERE $where ORDER BY a.acc_code ASC";
    $res = mysqli_query($connection, $sql) or die($connection->error);
    $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

    $num_row = count($rows);

    $total_page = ceil($num_row / 9);

    $limit = (intval($current_page) - 1) * 9;

    if ($num_row < 1) {
    ?>
     <input type="hidden" id="countConfig" name="countConfig" value="0">
     <div class="position-relative" style="height: 60vh;">
         <div class="position-middle content-no-config">
             <p><img src="../asset/images/no-config.png" alt="" width="82"></p>
             <div class="fs-26 fw-700 mb-2">No Configurations Yet!</div>
             <p class="text-muted fs-15 fw-300">Create or import a configuration to get started. Once added, you can edit it anytime.</p>
             <button class="btn btn-primary" type="button" onclick="getModalCreate();">Create New Configuration <i class="bi bi-plus-circle"></i></button>
             <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalImport">Import Configuration <i class="bi bi-file-earmark-arrow-up"></i></button>
         </div>
     </div>
 <?php
    } else {
    ?>
     <input type="hidden" id="countConfig" name="countConfig" value="<?php echo $num_row; ?>">
     <div class="row">
         <?php
            foreach ($rows as $key => $row) {
                if (($key >= $limit) && ($key <= ($limit + 8))) {
            ?>
                 <div class="col-lg-4 mb-3" id="acc_<?php echo $row['account_id']; ?>">
                     <div class="card bg-light">
                         <div class="card-body p-4">
                             <div class="d-flex align-items-center mb-3 justify-content-between">
                                 <div class="d-flex align-items-center">
                                     <div>
                                         <div class="fs-24 fw-500"><?php echo $row['acc_code']; ?></div>
                                         <div class="fs-16">
                                             <?php echo $row['acc_name']; ?>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="d-flex">
                                     <button class="btn btn-light btn-sm border d-flex justify-content-center align-items-center p-1 me-2" style="width:30px;height:30px;background: #fff;" onclick="getModalEdit('<?php echo $row['account_id']; ?>');">
                                         <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M18.2252 14.3194V18.1375C18.2252 18.6438 18.0241 19.1294 17.6661 19.4874C17.3081 19.8454 16.8225 20.0465 16.3162 20.0465H2.95298C2.44667 20.0465 1.9611 19.8454 1.60309 19.4874C1.24507 19.1294 1.04395 18.6438 1.04395 18.1375V4.77427C1.04395 4.26796 1.24507 3.78239 1.60309 3.42438C1.9611 3.06636 2.44667 2.86523 2.95298 2.86523H6.77105" stroke="#30313D" stroke-width="1.63636" stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M11.0658 14.1274L20.1337 4.96405L16.1248 0.955078L7.05686 10.023L6.77051 14.3183L11.0658 14.1274Z" stroke="#30313D" stroke-width="1.63636" stroke-linecap="round" stroke-linejoin="round" />
                                         </svg>
                                     </button>
                                     <button class="btn btn-outline-danger border-danger bd-red-200 btn-sm border d-flex justify-content-center align-items-center p-1" style="width:30px;height:30px;background: #FFE3E3;" onclick="deleteConfigurationAccount('<?php echo $row['account_id']; ?>');">
                                         <img src="../asset/icon/remove.png" alt="" style="width:17px" class="">
                                     </button>

                                 </div>
                             </div>

                             <div class="d-flex align-items-center mb-2">
                                 <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M7.40733 3.76097C7.40183 2.70408 6.75158 1.86334 5.73682 1.64353C5.43459 1.57759 5.11221 1.59774 4.79899 1.58858C4.70741 1.58675 4.66528 1.56111 4.63597 1.47135C4.59567 1.34313 4.54072 1.21858 4.47295 1.10135C4.05349 0.375997 3.42156 -0.0159857 2.58264 0.000499612C1.7309 0.0188166 1.1008 0.436443 0.719804 1.19477C0.613565 1.40541 0.571436 1.64903 0.5 1.87799V2.34141C0.562278 2.55388 0.595248 2.77918 0.690496 2.97518C1.07882 3.78295 1.72907 4.22806 2.63209 4.22439C3.53146 4.22256 4.18721 3.77196 4.54622 2.96418C4.67261 2.68027 4.81181 2.59968 5.08107 2.64364C5.29905 2.67844 5.5335 2.67111 5.72949 2.7572C6.16177 2.9477 6.34311 3.31587 6.34311 3.78479C6.34311 4.3288 6.34311 4.87281 6.34311 5.41683L7.40916 4.35078C7.40916 4.15479 7.40916 3.95696 7.40916 3.76097H7.40733ZM2.62477 3.17483C2.04229 3.17483 1.56422 2.69126 1.56605 2.11061C1.56971 1.52264 2.04778 1.05189 2.63209 1.05739C3.21091 1.06288 3.68166 1.5318 3.68715 2.11061C3.69265 2.68394 3.20175 3.17483 2.62477 3.17483Z" fill="black" />
                                     <path d="M13.6771 9.79993C12.6276 9.58563 11.5762 10.1956 11.2391 11.2213C11.2062 11.3239 11.1567 11.3514 11.0541 11.3495C10.2226 11.3459 9.38913 11.3495 8.55754 11.3459C8.44214 11.3459 8.32308 11.3367 8.21318 11.3093C7.70214 11.1737 7.40907 10.7817 7.40723 10.2285C7.4054 9.2376 7.40723 8.24849 7.40723 7.25754C7.40723 7.21175 7.4109 7.16412 7.41456 7.111C7.45852 7.10734 7.49149 7.10368 7.52446 7.10368C8.70957 7.10368 9.89651 7.10368 11.0816 7.10001C11.1824 7.10001 11.2098 7.14397 11.2373 7.2264C11.4754 7.90962 11.937 8.38037 12.6257 8.59834C14.1021 9.06725 15.5638 7.81254 15.3458 6.27941C15.2084 5.30678 14.4153 4.55029 13.4408 4.4642C12.47 4.37811 11.545 4.98257 11.2428 5.91307C11.208 6.01931 11.1622 6.05228 11.0505 6.05228C9.88918 6.04862 8.72789 6.04862 7.56476 6.04862C7.51714 6.04862 7.46951 6.04495 7.4054 6.04129V5.86362C7.4054 5.07965 7.4054 4.29568 7.4054 3.51172L6.33936 4.57777C6.33936 6.44426 6.33936 8.30893 6.33936 10.1754C6.33936 10.3531 6.35035 10.5344 6.38515 10.7085C6.59213 11.7141 7.43837 12.3991 8.48061 12.4064C9.34151 12.4119 10.2024 12.4083 11.0651 12.4064C11.1531 12.4064 11.1988 12.4248 11.23 12.5182C11.4333 13.119 11.8198 13.5659 12.4096 13.8168C12.6019 13.8993 12.8126 13.9396 13.0159 14H13.4793C13.5068 13.9909 13.5324 13.978 13.5599 13.9725C14.5362 13.8242 15.2927 13.0146 15.3623 12.0383C15.4374 10.9777 14.7102 10.0124 13.6735 9.80176L13.6771 9.79993ZM13.2394 5.51926C13.82 5.5101 14.3017 5.98634 14.3054 6.57248C14.3091 7.15496 13.8347 7.63304 13.2485 7.63487C12.6679 7.6367 12.1806 7.1513 12.1843 6.57432C12.188 5.99916 12.6587 5.52842 13.2394 5.51926ZM13.2412 12.934C12.6624 12.9285 12.1916 12.4596 12.1861 11.8807C12.1806 11.3074 12.6715 10.8165 13.2485 10.8165C13.8255 10.8165 14.3091 11.2983 14.3072 11.8807C14.3036 12.4687 13.8273 12.9395 13.243 12.934H13.2412Z" fill="black" />
                                 </svg>
                                 &nbsp;Account Flow
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
         <?php
                }
            }
            ?>
     </div>

     <div class="btn-toolbar justify-content-center" role="toolbar" aria-label="Toolbar with button groups" id="showButtonFooter">
         <div class="pagination">
             <a onclick="getData(<?php echo $current_page - 1; ?>)" class="previous <?php echo $current_page > 1 ? '' : 'disabled'; ?>"><i class="bi bi-chevron-left"></i> Previous</a>

             <?php if ($total_page <= 7) { ?>
                 <?php for ($item = 1; $item <= $total_page; $item++) { ?>
                     <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getData(<?php echo $item; ?>)"><?php echo $item; ?></a>
                 <?php } ?>
             <?php } else if ($total_page == 8) { ?>
                 <?php if ($current_page <= 4) { ?>
                     <?php for ($item = 1; $item <= 4; $item++) { ?>
                         <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getData(<?php echo $item; ?>)"><?php echo $item; ?></a>
                     <?php } ?>
                     <span class="mx-2">...</span>
                     <a class="" onclick="getData(<?php echo $total_page; ?>)"><?php echo $total_page; ?></a>
                 <?php } else { ?>
                     <a class="" onclick="getData(1)">1</a>
                     <span class="mx-2">...</span>
                     <?php for ($item = 5; $item <= $total_page; $item++) { ?>
                         <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getData(<?php echo $item; ?>)"><?php echo $item; ?></a>
                     <?php } ?>
                 <?php } ?>
             <?php } else { ?>
                 <?php if ($current_page <= 4) { ?>
                     <?php for ($item = 1; $item <= 4; $item++) { ?>
                         <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getData(<?php echo $item; ?>)"><?php echo $item; ?></a>
                     <?php } ?>
                     <span class="mx-2">...</span>
                     <a class="" onclick="getData(<?php echo $total_page; ?>)"><?php echo $total_page; ?></a>
                 <?php } else if ($current_page == 5) { ?>
                     <a class="" onclick="getData(1)">1</a>
                     <span class="mx-2">...</span>
                     <?php for ($item = 4; $item <= 6; $item++) { ?>
                         <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getData(<?php echo $item; ?>)"><?php echo $item; ?></a>
                     <?php } ?>
                     <span class="mx-2">...</span>
                     <a class="" onclick="getData(<?php echo $total_page; ?>)"><?php echo $total_page; ?></a>
                 <?php } else if ($current_page > 5 && $current_page < ($total_page - 3)) { ?>
                     <a class="" onclick="getData(1)">1</a>
                     <span class="mx-2">...</span>

                     <a class="" onclick="getData(<?php echo ($current_page - 1); ?>)"><?php echo ($current_page - 1); ?></a>
                     <a class="active" onclick="getData(<?php echo $current_page; ?>)"><?php echo $current_page; ?></a>
                     <a class="" onclick="getData(<?php echo ($current_page + 1); ?>)"><?php echo ($current_page + 1); ?></a>

                     <span class="mx-2">...</span>
                     <a class="" onclick="getData(<?php echo $total_page; ?>)"><?php echo $total_page; ?></a>
                 <?php } else { ?>
                     <a class="" onclick="getData(1)">1</a>
                     <span class="mx-2">...</span>
                     <?php for ($item = ($total_page - 3); $item <= $total_page; $item++) { ?>
                         <a class="<?php echo $current_page == $item ? 'active' : ''; ?>" onclick="getData(<?php echo $item; ?>)"><?php echo $item; ?></a>
                     <?php } ?>
                 <?php } ?>
             <?php } ?>

             <a onclick="getData(<?php echo $current_page + 1; ?>)" class="next <?php echo $current_page < $total_page ? '' : 'disabled'; ?>">Next <i class="bi bi-chevron-right"></i></a>
         </div>
     </div>
 <?php
    }
    ?>