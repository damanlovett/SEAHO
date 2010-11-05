<?php

//--------------------------------------------------------------------------
// This is where you specify your Database connection stuff
//
// mysql_connect -- Open a connection to a MySQL Server /  die -- Alias of exit()
//
//--------------------------------------------------------------------------
$db_name = "db169066589"; //This is your database Name
$link = mysql_connect("db413.perfora.net", "dbo169066589", "cromag65") or die("Could not connect to server!");
//This is your table name. This is a one table config to do more table you will need to rework the code.
$table_name = 'team_positions';

$select_db = mysql_select_db($db_name, $link); // mysql_select_db -- Select a MySQL database
$query = "SELECT * FROM " . $table_name;
$result = mysql_query($query, $link) or die("Could not complete database query"); //mysql_query -- Send a MySQL query
$num = mysql_num_rows($result); //mysql_num_rows -- Get number of rows in result

if ($num != 0) {

//--------------------------------------------------------------------------
// If you would like to save a copy of the XML Doc being created uncomment this
// line and the two lines at the bottom containing fwrite and fclose.
//
//
//--------------------------------------------------------------------------
  $file= fopen("results.xml" , "w"); //fopen -- Opens file or URL

//--------------------------------------------------------------------------
// XML Header Tag Goes Here
//
//
//
//--------------------------------------------------------------------------
  $_xml ="<?xml version=1.0 encoding=UTF-8 ?>rn";
  $_xml .="<results>rn";

//--------------------------------------------------------------------------
// This while loop loops throught the data found from the above query and
// generates the XML Doc.
//
//
//--------------------------------------------------------------------------
  while ($row = mysql_fetch_array($result)) { //mysql_fetch_array --  Fetch a result row as an associative array, a numeric array, or both.
    $_xml .=" <item>rn";
    $_xml .="   <id>" . $row[id] . "</id>rn";
    $_xml .="   <position_id>" . $row[position_id] . "</position_id>rn";
    $_xml .="   <user_id>" . $row[user_id] . "</user_id>rn";
    $_xml .="   <position>" . $row[position] . "</position>rn";
    $_xml .="   <group>" . $row[group] . "</group>rn";
    $_xml .="   <vote>" . $row[vote] . "</vote>rn";
    //$_xml .="   <phonenumber>" . $row[phonenumber] . "</phonenumber>rn";
    //$_xml .="   <email>" . $row[email] . "</email>rn";

    //You can use if statements to check if the returned value is null.
    //If it is just place a default value in the tags like below.
    //if ($row[website]) {
    //  $_xml .="   <website>http://" . $row[website] . "</website>rn";
    //} else {
    //  $_xml .="   <website>http://www.ipdg3.com</website>rn";
    //}

    //$_xml .="   <deleted>" . $row[deleted] . "</deleted>rn";
    //$_xml .=" </item>rn";
  }

  $_xml .="</results>";

//--------------------------------------------------------------------------
// If you would like to save a copy of the XML Doc being created uncomment this
// line and the two lines at the bottom containing fwrite and fclose.
//
//
//--------------------------------------------------------------------------
  fwrite($file, $_xml); //fwrite -- Binary-safe file write
  fclose($file); //fclose -- Closes an open file pointer

//--------------------------------------------------------------------------
// This will echo the XML file out to the screen so you can view it.
//
//
//
//--------------------------------------------------------------------------
  echo $_xml;

} else {
  echo "No Records found";
}

?>