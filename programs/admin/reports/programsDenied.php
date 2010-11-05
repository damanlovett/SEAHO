<?php require_once('../../../Connections/Programming.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

//if (!function_exists("GetSQLValueString")) {
//function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
//{
//  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
//
//  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
//
//  switch ($theType) {
//    case "text":
//      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
//      break;    
//    case "long":
//    case "int":
//      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
//      break;
//    case "double":
//      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
//      break;
//    case "date":
//      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
//      break;
//    case "defined":
//      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
//      break;
//  }
//  return $theValue;
//}
//}

mysql_select_db($database_Programming, $Programming);
$query_rsPrograms = "SELECT * FROM callforprograms WHERE Status = 'Denied' ORDER BY id ASC";
$rsPrograms = mysql_query($query_rsPrograms, $Programming) or die(mysql_error());
$row_rsPrograms = mysql_fetch_assoc($rsPrograms);
$totalRows_rsPrograms = mysql_num_rows($rsPrograms);


$csv_output = "ProgramID, Program title, Program Number, Session, Location, First Name, Last Name, Middle, title, Institution, Address, City, State, Zip, Phone, Email, Experience, Additional Name 1, Additional Title 1, Additional Instituion 1, Additional Name 2, Additional Title 2, Additional Instituion 2, Additional Name 3, Additional Title 3, Additional Instituion 3, Session Type, Audience, Equipment, Equipment Other, Schedule Request, Request Title 1, Request Presenter 2, Request Title 2, Request Presenter 3, Request Title 3, Request Presenter 3, Best of SEAHO, Topic Area, Objective 1, Objective 2, Objective 3, Description, Outline, Notes, Status, Submission";

$csv_output .="\r\n"; 
do {
$csv_output .= "".str_replace(",", "", $row_rsPrograms['id'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['ProgramTitle'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['ProgramNumber'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['session'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['location'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['FirstName'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['LastName'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['MiddleInitial'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['Title'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['Institution'])."";
//$csv_output .= ",".str_replace(",", "", $row_rsPrograms['Address'])."";

$finalspecial7 = trim($row_rsPrograms['Address']);
$finalspecial7 = str_replace("\r", "", $finalspecial7);
$finalspecial7 = str_replace("\n", "", $finalspecial7);

$csv_output .= ",".str_replace(",", "", $finalspecial7)."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['City'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['State'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['Zip'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['PhoneNumber'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['EmailAddress'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['ExperienceLevel'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['addName1'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['addTitle1'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['addInstitution1'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['addName2'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['addTitle2'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['addInstitution2'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['addName3'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['addTitle3'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['addInstitution3'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['SessionType'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['TargetAudience'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['EquipmentNeeds'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['EquipmentNeedsO'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['SchRequests'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['SchRequestsTitle1'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['SchRequestsPresenter1'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['SchRequestsTitle2'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['SchRequestsPresenter2'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['SchRequestsTitle3'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['SchRequestsPresenter3'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['BestSeaho'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['TopicArea'])."";
//$csv_output .= ",".str_replace(",", "", $row_rsPrograms['LearningObj1'])."";
//$csv_output .= ",".str_replace(",", "", $row_rsPrograms['LearningObj2'])."";
//$csv_output .= ",".str_replace(",", "", $row_rsPrograms['LearningObj3'])."";
//$csv_output .= ",".str_replace(",", "", $row_rsPrograms['ProgramDescription'])."";
//$csv_output .= ",".str_replace(",", "", $row_rsPrograms['OutlineOfPresentation'])."";
//$csv_output .= ",".str_replace(",", "", $row_rsPrograms['Notes'])."";

// String carriage returns from output

$finalspecial = trim($row_rsPrograms['LearningObj1']);
$finalspecial = str_replace("\r", "", $finalspecial);
$finalspecial = str_replace("\n", "", $finalspecial);

$csv_output .= ",".str_replace(",", "", $finalspecial)."";
//$csv_output .="\r\n";

$finalspecial2 = trim($row_rsPrograms['LearningObj2']);
$finalspecial2 = str_replace("\r", "", $finalspecial2);
$finalspecial2 = str_replace("\n", "", $finalspecial2);

$csv_output .= ",".str_replace(",", "", $finalspecial2)."";
//$csv_output .="\r\n";

$finalspecial3 = trim($row_rsPrograms['LearningObj3']);
$finalspecial3 = str_replace("\r", "", $finalspecial3);
$finalspecial3 = str_replace("\n", "", $finalspecial3);

$csv_output .= ",".str_replace(",", "", $finalspecial3)."";
//$csv_output .="\r\n";

$finalspecial4 = trim($row_rsPrograms['ProgramDescription']);
$finalspecial4 = str_replace("\r", "", $finalspecial4);
$finalspecial4 = str_replace("\n", "", $finalspecial4);

$csv_output .= ",".str_replace(",", "", $finalspecial4)."";
//$csv_output .="\r\n";

$finalspecial5 = trim($row_rsPrograms['OutlineOfPresentation']);
$finalspecial5 = str_replace("\r", "", $finalspecial5);
$finalspecial5 = str_replace("\n", "", $finalspecial5);

$csv_output .= ",".str_replace(",", "", $finalspecial5)."";
//$csv_output .="\r\n";

$finalspecial6 = trim($row_rsPrograms['Notes']);
$finalspecial6 = str_replace("\r", "", $finalspecial6);
$finalspecial6 = str_replace("\n", "", $finalspecial6);

$csv_output .= ",".str_replace(",", "", $finalspecial6)."";
//$csv_output .="\r\n";

$csv_output .= ",".str_replace(",", "", $row_rsPrograms['Status'])."";
$csv_output .= ",".str_replace(",", "", $row_rsPrograms['submission'])."";
$csv_output .="\r\n";

} while($row_rsPrograms = mysql_fetch_array($rsPrograms)); 

header("Content-type: application/vnd.ms-excel");
header("Content-disposition:  attachment; filename=ProgramsNotAccepted.csv");
echo $csv_output;

mysql_free_result($rsPrograms);
?>