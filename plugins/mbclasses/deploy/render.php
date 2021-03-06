<?php

/*
$sourcename = "MatthewSmith";
$password = "4HxrfxvOR5FI9bsAEDtDMKyJpdM=";
$siteID = "33339";*/

include "api/classService.php";

// #ref https://api.mindbodyonline.com/Doc

date_default_timezone_set("America/Louisville");

// initialize default credentials
$creds = new SourceCredentials($sourcename, $password, array($siteid));

$classService = new MBClassService();
$classService->SetDefaultCredentials($creds);

$classDescriptionIDs = array();
$classIDs = array();
$staffIDs = array();
$startDate = new DateTime(date('Y-m-d', strtotime('+1 day')));
$endDate = new DateTime(date('Y-m-d', strtotime('+7 day')));

$result = $classService->GetClasses($classDescriptionIDs, $classIDs, $staffIDs, $startDate, $endDate);

$classes = toArray($result->GetClassesResult->Classes->Class);

$list = array();

foreach ($classes as $class) {

	$stamp = strtotime($class->StartDateTime);
	$divider = date("D, M j", strtotime($class->StartDateTime));
	$start = date("M j g:iA", strtotime($class->StartDateTime));
	$startTime = date("g:iA", strtotime($class->StartDateTime));
	$startSignUpDate = date("m/d/Y", strtotime($class->StartDateTime));
	$end = date("M j g:iA", strtotime($class->EndDateTime));
	$endTime = date("g:iA", strtotime($class->EndDateTime));
	
	array_push($list, array(
		'stamp' => $stamp,
		'divider' => $divider,
		'id' => $class->ID,
		'classScheduleID' => $class->ClassScheduleID,
		'classid' => $class->ClassDescription->ID,
		'name' => $class->ClassDescription->Name,
		'start' => $start,
		'startDateTime' => $class->StartDateTime,
		'startTime' => $startTime,
		'startSignUpDate' => $startSignUpDate,
		'end' => $end,
		'endTime' => $endTime,
		'staff' => $class->Staff->Name,
		'isAvailable' => $class->IsAvailable
		));
}

// ref: http://stackoverflow.com/questions/7983822/sort-a-multi-dimensional-associative-array
uasort($list, function ($i, $j) {
    $a=$i['stamp'];
    $b=$j['stamp'];
    if ($a == $b) return 0;
    elseif ($a > $b) return 1;
    else return -1;
});

$curr_divider = '';

$output = '<div class="class-list">';

foreach ($list as $item) {

	if($curr_divider != $item['divider']){
		$curr_divider = $item['divider'];
		$output .= '<h2 class="divider">'.$curr_divider.'</h2>';
	}

	$output .= '<div class="class">';
	$output .= '<span class="start">'.$item['startTime'].'</span>';
	$output .= '<span class="name">'.$item['name'].'</span>';
	$output .= '<span class="time">'.$item['startTime'].'-'.$item['endTime'].'</span>';
	$output .= '<span class="staff">'.$item['staff'].'</span>';
	$output .= '<span class="signup">';

	if($item['isAvailable']==true){
		$output .= '<a data-id="'.$item['classScheduleID'].'" class="sign-up" href="https://clients.mindbodyonline.com/ws.asp?studioid='.$siteid.
						'&sclassid='.$item['classScheduleID'].'&sDate='.$item['startSignUpDate'].'">Sign Up Now</a>';
	}

	$output .= '</span></div>';
}

// open question: https://getsatisfaction.com/mindbody/topics/what_is_the_format_for_creating_a_sign_up_now_link?rfm=1
// format: https://clients.mindbodyonline.com/ws.asp?studioid=1513&sclassid=897&sDate=12/04/2012

$output .= '</div>';

print $output;

?>
<p>
	<a class="call-to-action" href="https://clients.mindbodyonline.com/ASP/home.asp?studioid=<?php print $siteid; ?>">View All Classes</a>
</p>