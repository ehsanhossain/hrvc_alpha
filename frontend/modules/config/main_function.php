<?php
@session_start();

function connectDB($secure)
{

	if ($secure == "-%ekla!(m09)%1A7") {

		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "root";
		$dbname = "hrvc_alpha";

		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		mysqli_set_charset($connection, "utf8");
		if (!$connection) {
			die("Connection failed: " . mysqli_connect_error());
		} else {

			return $connection;
		}
	} else {

		return false;
	}
}

function url()
{
	if (isset($_SERVER['HTTPS'])) {
		$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	} else {
		$protocol = 'http';
	}
	return $protocol . "://" . $_SERVER['HTTP_HOST'] . "/demo";
}

function checkUser($userId)
{

	$secure = "-%ekla!(m09)%1A7";
	$connection = connectDB($secure);

	if ($connection) {

		$sql = "SELECT count(*) AS count FROM user a 
        WHERE a.userId = '$userId';";
		$rs = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($rs);

		if ($row['count'] > 0) {

			return 1;
		} else {

			return 0;
		}
	} else {

		return 9;
	}
}

function checkBranch($branch, $userId)
{

	$secure = "-%ekla!(m09)%1A7";
	$connection = connectDB($secure);

	if ($connection) {

		$sql = "SELECT count(*) AS count FROM user a 
        LEFT JOIN employee b ON a.employeeId = b.employeeId
        LEFT JOIN company c ON b.companyId = c.companyId
        LEFT JOIN branch d ON c.companyId = d.companyId
        WHERE a.userId = '$userId' AND d.branchId = '$branch';";
		$rs = mysqli_query($connection, $sql);
		$row = mysqli_fetch_array($rs);

		if ($row['count'] > 0) {

			return 1;
		} else {

			return 0;
		}
	} else {

		return 0;
	}
}

function checkAdmin($admin_id)
{

	$secure = "-%ekla!(m09)%1A7";
	$connection = connectDB($secure);

	if ($connection) {

		$sql = "SELECT active_status FROM tbl_admin WHERE admin_id = '$admin_id';";
		$rs = mysqli_query($connection, $sql);
		$row = mysqli_fetch_array($rs);

		$sql2 = "SELECT count(*) as count_check FROM tbl_admin WHERE active_status = '" . $row['active_status'] . "';";
		$rs2 = mysqli_query($connection, $sql2);
		$row2 = mysqli_fetch_array($rs2);

		if ($row2['count_check'] > 0) {

			return 1;
		} else {

			return 0;
		}
	} else {

		return 0;
	}
}


function stringInsert($str, $insertstr, $pos)
{
	$str = substr($str, 0, $pos) . $insertstr . substr($str, $pos);
	return $str;
}


function recheck_query($r)
{
	$search_array = array(";", "'", chr(34));
	$new_string = str_replace($search_array, "", $r);

	$new_string = str_ireplace("SELECT", "", $new_string);
	$new_string = str_ireplace("INSERT", "", $new_string);
	$new_string = str_ireplace("UPDATE", "", $new_string);
	$new_string = str_ireplace("DELETE", "", $new_string);
	$new_string = str_ireplace("DROP", "", $new_string);
	$new_string = str_ireplace("CREATE", "", $new_string);
	$new_string = str_ireplace("TRUNCATE", "", $new_string);
	$new_string = str_ireplace("TABLE", "", $new_string);

	return $new_string;
}


function check_access($user_id, $access_id)
{
	$secure = "-%ekla!(m09)%1A7";
	$connection = connectDB($secure);

	$sql = "SELECT access_level FROM tbl_user WHERE user_id = '$user_id';";
	$rs = mysqli_query($connection, $sql) or die(mysqli_error());
	$row = mysqli_fetch_array($rs);

	$page_id = $access_id;
	$level = $row['access_level'];

	$access_code = strrev(decbin($level));
	$accessible = substr($access_code, $page_id - 1, 1);


	if ($accessible) {
		return 1;
	} else {
		return 0;
	}

	mysqli_close($connection);
}


function getRandomID($size, $table, $column_name)
{

	$check_status = 0;
	$secure = "-%ekla!(m09)%1A7";
	$connection = connectDB($secure);

	while ($check_status == 0) {
		$random_id = randomCode($size);


		$sql = "SELECT count(*) as count FROM $table WHERE $column_name = '$random_id';";
		$rs_check = mysqli_query($connection, $sql) or die(mysqli_error());
		$row_check = mysqli_fetch_assoc($rs_check);
		$check_repeat = $row_check['count'];

		if ($check_repeat == 0) {

			$check_status = 1;
		}
	}

	return $random_id;
}

function getRandomID2($size, $table, $column_name)
{
	$check_status = 0;
	$secure = "-%ekla!(m09)%1A7";
	$connection = connectDB($secure);

	while ($check_status == 0) {
		$random_id = randomCode2($size);


		$sql = "SELECT count(*) as count FROM $table WHERE $column_name = '$random_id';";
		$rs_check = mysqli_query($connection, $sql) or die(mysqli_error());
		$row_check = mysqli_fetch_assoc($rs_check);
		$check_repeat = $row_check['count'];

		if ($check_repeat == 0) {

			$check_status = 1;
		}
	}


	return $random_id;
}


function randomCode($length)
{
	$possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghigklmnopqrstuvwxyz"; //ตัวอักษรที่ต้องการสุ่ม
	$str = "";
	while (strlen($str) < $length) {
		$str .= substr($possible, (rand() % strlen($possible)), 1);
	}
	return $str;
}


function randomCode2($length)
{
	$possible = "0123456789"; //ตัวอักษรที่ต้องการสุ่ม
	$str = "";
	while (strlen($str) < $length) {
		$str .= substr($possible, (rand() % strlen($possible)), 1);
	}
	return $str;
}


function getBaseUrl()
{
	if (isset($_SERVER['HTTPS'])) {
		$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	} else {
		$protocol = 'http';
	}
	return $protocol . "://" . $_SERVER['HTTP_HOST'];
}

function dateEng($date)
{
	$strYear = date("Y", strtotime($date)) + 543;
	$strMonth = date("m", strtotime($date));
	$strDay = date("d", strtotime($date));
	$strHour = date("H", strtotime($date));
	$strMinute = date("i", strtotime($date));
	$strSeconds = date("s", strtotime($date));
	$thaimonth = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
	$strthaimounth = $thaimonth[$strMonth - 1];
	return $strDay . " " . $strthaimounth . " " . $strYear;
}

// function getData($tbl, $field, $id)
// {
// 	$conn = connectDB('-%ekla!(m09)%1A7');
// 	$sql = "SELECT * FROM $tbl WHERE $field = '$id'";
// 	$rs = $conn->query($sql);
// 	$row = $rs->fetch_assoc();
// 	return $row;
// }

function currencyExchange($FirstExchange, $FirstDivide, $SecondExchange, $SecondDivide, $value)
{
	$thb_value = ($FirstExchange / $FirstDivide) * $value;
	$result = ($SecondDivide * $thb_value) / $SecondExchange;
	return $result == 0 ? 0 : round($result, 2);
}

function getStatusBadge($status)
{
	if ($status === 2) {
		return '
        <span class="badge rounded-pill dd-bg-green">
            <svg fill="none" stroke="currentColor" viewBox="0 0 12 13" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M1.202 6.14868C1.202 8.79517 3.35489 10.9485 6.00219 10.9485C7.30545 10.9485 8.50789 10.4253 9.39173 9.53794L7.80227 7.9486H11.4024V11.5485L10.2396 10.3851C9.13432 11.4951 7.63125 12.1484 6.00219 12.1484C2.69306 12.1484 0.00195312 9.45694 0.00195312 6.14868H1.202ZM6.00171 0.148438C9.31085 0.148438 12.002 2.83993 12.002 6.1482H10.8019C10.8019 3.5017 8.64902 1.34839 6.00171 1.34839C4.69846 1.34839 3.49602 1.87157 2.61218 2.75893L4.20164 4.34827H0.601503V0.748415L1.76434 1.91116C2.86959 0.801815 4.37265 0.148438 6.00171 0.148438Z" />
            </svg>
            In Progress
        </span>';
	} elseif ($status === 1) {
		return '
        <span class="badge rounded-pill dd-bg-blue">
            <svg fill="none" stroke="currentColor" viewBox="0 0 12 13" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.15095 4.29244L8.85295 5.00494L5.95645 7.85844C5.76295 8.05194 5.50845 8.14844 5.25295 8.14844C4.99745 8.14844 4.74045 8.05094 4.54495 7.85594L3.15395 6.50794L3.85045 5.78944L5.24695 7.14294L8.15095 4.29244ZM12.002 6.14844C12.002 9.45694 9.31045 12.1484 6.00195 12.1484C2.69345 12.1484 0.00195312 9.45694 0.00195312 6.14844C0.00195312 2.83994 2.69345 0.148438 6.00195 0.148438C9.31045 0.148438 12.002 2.83994 12.002 6.14844ZM11.002 6.14844C11.002 3.39144 8.75895 1.14844 6.00195 1.14844C3.24495 1.14844 1.00195 3.39144 1.00195 6.14844C1.00195 8.90544 3.24495 11.1484 6.00195 11.1484C8.75895 11.1484 11.002 8.90544 11.002 6.14844Z" />
            </svg>
            Done
        </span>';
	} elseif ($status === 0) {
		return '
        <span class="badge rounded-pill dd-bg-yellow">
            <svg fill="none" stroke="currentColor" viewBox="0 0 12 13" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0)">
                    <path d="M5.50166 6.64844V3.64844C5.50166 3.37344 5.72666 3.14844 6.00166 3.14844C6.27666 3.14844 6.50166 3.37344 6.50166 3.64844V6.64844C6.50166 6.92344 6.27666 7.14844 6.00166 7.14844C5.72666 7.14844 5.50166 6.92344 5.50166 6.64844ZM6.00166 7.64844C5.58666 7.64844 5.25166 7.98344 5.25166 8.39844C5.25166 8.81344 5.58666 9.14844 6.00166 9.14844C6.41666 9.14844 6.75166 8.81344 6.75166 8.39844C6.75166 7.98344 6.41666 7.64844 6.00166 7.64844ZM11.7917 10.0884C11.4417 10.7634 10.7067 11.1484 9.78666 11.1484H2.22166C1.29666 11.1484 0.566661 10.7634 0.216661 10.0884C-0.138339 9.40844 -0.0383389 8.53844 0.466661 7.80844L4.48666 1.44844C4.84166 0.938437 5.40166 0.648438 6.00166 0.648438C6.60166 0.648438 7.16166 0.938437 7.50166 1.43344L11.5417 7.81844C12.0467 8.54844 12.1417 9.41344 11.7867 10.0884H11.7917Z" />
                </g>
            </svg>
            Not Yet
        </span>';
	}
	return '';
}

function truncateText($text, $num)
{
	if (strlen($text) > $num) {
		return substr($text, 0, $num) . ' ...';
	} else {
		return $text;
	}
}

function changeCurrencyValue($currencyDefaul, $currencyFocus, $value)
{
	$secure = "-%ekla!(m09)%1A7";
	$connection = connectDB($secure);

	if ($connection) {

		//convert to USD
		$sql_defaul = "SELECT a.exchangeRate FROM tbl_currency a WHERE a.currencyId = '$currencyDefaul' ";
		$rs_defaul = mysqli_query($connection, $sql_defaul);
		$row_defaul = mysqli_fetch_assoc($rs_defaul);
		$exchangeRateDefaul = $row_defaul['exchangeRate'];
		$valueUSD = $value * $exchangeRateDefaul;

		//find focus currency
		$sql_focus = "SELECT a.exchangeRate FROM tbl_currency a WHERE a.currencyId = '$currencyFocus' ";
		$rs_focus = mysqli_query($connection, $sql_focus);
		$row_focus = mysqli_fetch_assoc($rs_focus);
		$exchangeRateFocus = $row_focus['exchangeRate'];
		$valueFocus = $valueUSD * $exchangeRateFocus;

		return $valueFocus;
	} else {
		return "Cann't connectDB";
	}
}

function formatNumber($number)
{
	if ($number >= 1000000000) {
		return round($number / 1000000000, 1) . 'B';
	} elseif ($number >= 1000000) {
		return round($number / 1000000, 1) . 'M';
	} elseif ($number >= 1000) {
		return round($number / 1000, 1) . 'K';
	} else {
		return $number;
	}
}

function formatRateNumber($rate, $number)
{
	if ($number == 0 || $number === '') {
		return 0;
	} else {
		switch ($rate) {
			case 1:
				return number_format($number, 2);
			case 2:
				return number_format($number / 1000, 2) . 'k';
			case 3:
				return number_format($number / 1000000, 2) . 'm';
			case 4:
				return number_format($number / 1000000000, 2) . 'b';
			default:
				return number_format($number, 2);
		}
	}
}
