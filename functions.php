<?php
if ( function_exists('register_sidebars') )
    register_sidebars(2);


//if ( !function_exists('get_sessions_cat') )
 //   register_sidebars(2);
include_once("___config.php");



function theme_bcbYPipe($tag)
{

	error_reporting(E_ALL);

	// output=php means that the request will return serialized PHP
	$request =  'http://pipes.yahoo.com/pipes/pipe.run?_id=d83efcace9733ec457913f7291a5c341&_render=php&results_c=4&tag='.$tag;
	//$request =  'http://pipes.yahoo.com/pipes/pipe.run?_id=c07e24b162c5565254bd10b2fbfd646f&_render=php&results_c=4&tag=';
	//$request = $request.urlencode($tag." -sex");
	
	//$request =  'http://pipes.yahoo.com/pipes/pipe.run?_id=d83efcace9733ec457913f7291a5c341&_render=php&results_c=4&tag=';
	//$request = $request.$tag;

	$response = file_get_contents($request);

	if ($response === false) {
	    die('Request failed');
	}
	
	$phpobj = unserialize($response);

//print_r($phpobj);

	if (is_array($phpobj))
	{
	    foreach ($phpobj['value']['items'] AS $key => $val)
	    {
			//printf("<pre>%s</pre>", $val['description']);
			$pos = stripos($val['description'], "<img ", 0);
			if ($pos != FALSE)
			{
				$test = substr($val['description'], $pos + 4, -1);
				$imageTag = sprintf("<img height=75 width=75 %s", $test);
				$firstpart = substr($val['description'], 0, $pos);
//				printf("<li><p><a href=\"%s\">%s</a></p><p>%s%s</p>\n", $val['link'], $val['title'], $firstpart, $imageTag);
                                $firstpart = strip_tags($firstpart,"<img>");
                                $imageTag = strip_tags($imageTag ,"<img>");
				printf("<div> <a rel=\"nofollow\" href=\"%s\"><p>%s %s</p></a></div>\n", $val['link'], $firstpart, $imageTag);
			}
			else
			{
//				printf("<div><p><a href=\"%s\">%s</a></p>\n", $val['link'], $val['title']);
//				printf("<div><p><a href=\"%s\">%s</a></p>text<br/><p>%s</p>\n", $val['link'], $val['title'], $val['description']);
                               $val['description'] = strip_tags($val['description'],"<img>");
				printf("<div><p> %s </p><a rel=\"nofollow\" href=\"%s\">Link</a></div><br/><br/>\n", $val['description'], $val['link']);
			}
	    }
	}  
}


function sesscat()
{
	global $_CURRENT_BCB_CATEGORY;
    return $_CURRENT_BCB_CATEGORY;
}



function dprint_r($arr)
{
	global $DEBUG;

	if($DEBUG) print_r($arr);
}

function get_nicename($id)
{
	global $wpdb;
	  $rsa= $wpdb->get_var("SELECT display_name  FROM $wpdb->users WHERE id = $id");
return $rsa;
}

function t_authlink($author,$hyperlinktext=NULL)
{
	
	if($hyperlinktext==NULL || empty($hyperlinktext) ) $hyperlinktext=$author;
	return "<a href=\"".get_settings('home')."/author/$author\">$hyperlinktext</a>";
}

function author__post_count($post_author ) {
    global $wpdb;
	$q="SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_author = ".$post_author ."  AND post_date_gmt < '" . gmdate("Y-m-d H:i:s",time()) . "' AND post_type = 'post'";

	//echo $q;
	return $wpdb->get_var($q);
}

function show_attending_button($post)
{
global $wpdb;
global $current_user;
get_currentuserinfo();
$post_ID = $post->ID;
$post_Auth = $post->post_author;
$curr_user_id = $current_user->user_login;


$_catid=wp_get_post_categories($post_ID);

//if($_catid[0] == sesscat()){ 
$rs= $wpdb->get_var("SELECT count(*) FROM $wpdb->postmeta WHERE post_id = $post_ID
	AND meta_key = 'user_attending' AND meta_value = '$curr_user_id'");
	echo "<form method=\"GET\">";

	if(isset($_GET['natt']) && strlen($curr_user_id)>0)
		{
			 $rsxy= $wpdb->query("DELETE FROM $wpdb->postmeta WHERE post_id=$post_ID AND meta_key='user_attending' AND meta_value = '$curr_user_id'");
			 delete_post_meta($post_ID, 'user_attending', '$curr_user_id');
			//echo "natt";
			$rs=0;
		}
	else if(isset($_GET['att']) && $rs==0 && strlen($curr_user_id)>0)
		{
			$rsx= $wpdb->get_results("INSERT IGNORE INTO $wpdb->postmeta(post_id, meta_key, meta_value) VALUES($post_ID,'user_attending','$curr_user_id')");
			//echo "att";
			$rs++;
		}



//print_r($wpdb);
	//echo $rs;
	echo "<br />";
	if($rs==0){// not attending yet

	    if(is_user_logged_in())
            {
		
		echo "
		<input type=\"hidden\" name=\"att\" value=\"$post_ID\" />
		<input type=\"image\" value=\"I want to attend\" src=\"http://www.barcampbangalore.org/bcb/wp-content/themes/barcampbangalore/images/iattend.gif\" style=\"padding-top:3px\" />
		<!---  type=\"submit\" value=\"I want to attend\" --->";		
		}
   		else
        {
              echo "
		<input type=\"hidden\" name=\"att\" value=\"$post_ID\" />
		<input type=\"image\" value=\"I want to attend\" src=\"http://www.barcampbangalore.org/bcb/wp-content/themes/barcampbangalore/images/iattend.gif\" style=\"padding-top:3px\" DISABLED />

                Kindly login to register for a session.
		<!---  type=\"submit\" value=\"I want to attend\" --->";  

        }
	}
	else //attending already
	{
			
		
		echo "<span style='font-weight: bold;'>You are attending this session</span>
		<input type=\"hidden\" name=\"natt\" value=\"$post_ID\" /><br />
		<!-- input type=\"submit\" value=\"No. I am not\"  -->
		<small><a href=\"?natt=$post_ID\">(No I am not)</a></small>";
	}
	echo "</form>";



$allusers = $wpdb->get_results("SELECT * FROM $wpdb->postmeta
	WHERE post_id=$post_ID AND meta_key='user_attending' order by meta_id DESC");
$comm="";
echo "<h2><strong>".$wpdb->get_var("SELECT count(*) FROM $wpdb->postmeta WHERE post_id = $post_ID
	AND meta_key = 'user_attending'")."</strong> people attending:</h2>";
foreach ($allusers as $attendee) {

	echo $comm.t_authlink($attendee->meta_value);
		
	//"<a href=\"\" >".$attendee->meta_value."</a>";
	$comm=", ";
	}
$_catid=wp_get_post_categories($post_ID);
//echo $_catid;
foreach($_catid as $c){
	$cat =  get_category($c);
	if(strcasecmp($cat->name,"bcb8") == 0)
	{
		echo "<br /><br />tag your media with :<h3>BCB8-s$post_ID</h3>";
	}
	else if(strcasecmp($cat->name,"bcb9") == 0)
	{
		echo "<br /><br />tag your media with :<h3>BCB9-s$post_ID</h3>";
	}
// echo $c;

}

}



function print_login_links()
{global $current_user;
get_currentuserinfo();
	if($current_user->ID>0)
	{
		?><span style="color:#fff;font-size:11px;"><a href="<?php echo get_settings('siteurl'); ?>/wp-admin/profile.php?z_redirect=<?php the_permalink(); ?>">Hi, <?php echo $current_user->user_login;?></a> | <?php echo t_authlink($current_user->user_login,"My Sessions");?> | <a href="<?php echo get_settings('siteurl'); ?>/wp-login.php?action=logout">LogOut</a></span><?php

	}
	else
	{
		?><span style="font-size:11px;">You can <a href="<?php echo get_settings('siteurl'); ?>/wp-login.php?redirect=<?php the_permalink(); ?>">Login</a> -or- <a href="<?php echo get_settings('siteurl'); ?>/wp-register.php">Sign Up</a></span><?php
	}
		
}


function get_ucount_bcb()
{ global $wpdb;
	return $wpdb->get_var("SELECT count(*) FROM $wpdb->users");
	
}

function get_ucount_bcb_link()
{
	echo "<a href=\"".get_settings('siteurl')."/wp-allauthors.php\">".get_ucount_bcb()."</a>";
}

function _bcb9_all_participants()
{
 global $wpdb;
//	$allusers = $wpdb->get_results("SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE post_id >= 262 AND meta_key='user_attending'");
//	$totalCount = count($allusers);
//	print "<h2>Total number of Registered BCB9 participants is $totalCount</h2><br/>";
//	foreach ($allusers as $attendee) {
//		echo $comm.t_authlink($attendee->meta_value);
//		$comm=", ";
//	}
$allusers = $wpdb->get_results("SELECT DISTINCT meta_value FROM $wpdb->postmeta 
				WHERE post_id >= 262 AND meta_key='user_attending'");
		$totalCount = count($allusers);
		print "<h2>Total number of Registered BCB9 participants is $totalCount</h2><br/>";
		
		$allAttendees = "abc'";
		foreach ($allusers as $attendee) {			
			$allAttendees = $attendee->meta_value."','".$allAttendees;
			//$allAttendees = $newAllAttendees;
			//echo $comm.t_authlink($attendee->meta_value);
			//$comm=", ";
		}		
		$allAttendees = "'".$allAttendees;
		//echo $allAttendees;
		$allUserDetails = $wpdb->get_results("SELECT * FROM $wpdb->users WHERE user_login IN ($allAttendees) order by display_name");
		//echo $wpdb->last_query;
print "<style>body,td{font-family:tahoma,verdana;font-size:12px;}</style><table border='1'>"		;

$xyz=0;
		foreach ($allUserDetails as $users) {
			$fname = get_usermeta($users->ID, 'first_name');
			$lname = get_usermeta($users->ID, 'last_name');
			print "<tr><td>". ++$xyz ;
			print " </td><td> ".t_authlink($users->user_login, $users->display_name);
			print "</td><td>".$fname." ".$lname;
			
			print " </td><td> ".$users->user_email;
print " </td><td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

			print "</td></tr>";
			}			
		print "</table>";
		//print count($allUserDetails );
}

function _bcb9_all_participantsARUN()
{
 global $wpdb;
//	$allusers = $wpdb->get_results("SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE post_id >= 262 AND meta_key='user_attending'");
//	$totalCount = count($allusers);
//	print "<h2>Total number of Registered BCB9 participants is $totalCount</h2><br/>";
//	foreach ($allusers as $attendee) {
//		echo $comm.t_authlink($attendee->meta_value);
//		$comm=", ";
//	}
$allusers = $wpdb->get_results("SELECT DISTINCT meta_value FROM $wpdb->postmeta 
				WHERE post_id >= 262 AND meta_key='user_attending'");
		$totalCount = count($allusers);
		print "<h2>Total number of Registered BCB9 participants is $totalCount</h2><br/>";
		
		$allAttendees = "abc'";
		foreach ($allusers as $attendee) {			
			$allAttendees = $attendee->meta_value."','".$allAttendees;
			//$allAttendees = $newAllAttendees;
			//echo $comm.t_authlink($attendee->meta_value);
			//$comm=", ";
		}		
		$allAttendees = "'".$allAttendees;
		//echo $allAttendees;
		$allUserDetails = $wpdb->get_results("SELECT * FROM $wpdb->users WHERE user_login IN ($allAttendees)");
		//echo $wpdb->last_query;		
		foreach ($allUserDetails as $users) {
			$fname = get_usermeta($users->ID, 'first_name');
			$lname = get_usermeta($users->ID, 'last_name');
			print "Name:".$fname." ".$lname;
			print " &nbsp;;ID: ".t_authlink($users->user_login, $users->display_name);
			print " &nbsp;;&nbsp;&nbsp;&nbsp;Email ID: ".$users->user_email;
			print "<br/>";
			}			
		
		//print count($allUserDetails );
}



?>