<?php
ob_start();
session_start();
$systemDate = date ("Y-m-d G:i:s");
$currentDate = date('Y-m-d');


function createPassword() {

    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;

    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }

    return $pass;

}


function stopSign($record,$Yes,$No) {
	if($record == $Yes) {
	echo "<img src='/admin/images/Approved.gif' width='12' height='12' />";
  } elseif ($record == $No) { 
	echo "<img src='/admin/images/Denied.gif' width='12' height='12' />";
  } else { echo "<img src='/admin/images/Pending.gif' width='12' height='12' />";}                        
} 

//     Create guid function - this is used to create a unigue id       
function create_guid()

{

    $microTime = microtime();
    list($a_dec, $a_sec) = explode(" ", $microTime);

    $dec_hex = sprintf("%x", $a_dec* 1000000);
    $sec_hex = sprintf("%x", $a_sec);

    ensure_length($dec_hex, 5);
    ensure_length($sec_hex, 6);

    $guid = "";
    $guid .= $dec_hex;
    $guid .= create_guid_section(3);
    $guid .= '-';
    $guid .= create_guid_section(4);
    $guid .= '-';
    $guid .= create_guid_section(4);
    $guid .= '-';
    $guid .= create_guid_section(4);
    $guid .= '-';
    $guid .= $sec_hex;
    $guid .= create_guid_section(6);

    return $guid;
}

 

function create_guid_section($characters)

{

    $return = "";
    for($i=0; $i<$characters; $i++)
    {
    $return .= sprintf("%x", mt_rand(0,15));
    }

    return $return;
}

 

function ensure_length(&$string, $length)

{
    $strlen = strlen($string);
    if($strlen < $length)

    {

    $string = str_pad($string,$length,"0");

    }

    else if($strlen > $length)

    {

    $string = substr($string, 0, $length);

    }

}

 

function microtime_diff($a, $b) {

   list($a_dec, $a_sec) = explode(" ", $a);
   list($b_dec, $b_sec) = explode(" ", $b);
   return $b_sec - $a_sec + $b_dec - $a_dec;

}

?>
