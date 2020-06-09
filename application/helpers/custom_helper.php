<?php 
function session_exists($name)
{
	$state = isset($_SESSION["$name"])? true: false;
	return $state;
}

function cookie_exists($name)
{
	$state = isset($_COOKIE[$name])? true: false;
	return $state;
}

function get_details($detail)
{
	$the_detail;
	if(session_exists($detail))
	{
		$the_detail= $_SESSION[$detail];
	}
	elseif (cookie_exists($detail)) {
		$the_detail = $_COOKIE[$detail];
	}
	else
	{
		$the_detail = false;
	}
	return $the_detail;
}

//time in seconds
function passed_time($your_time)
{
	$current_time= time();
	$time =($current_time - $your_time);
	if($time < 60 && $time >= 0)
	{
		$posted = "just now";
	}
	
	elseif($time>=60 && $time < 3600)
	{
		$passed_time =(int)($time/60);
		$posted = $passed_time > 1 ? $passed_time."minutes ago" : $passed_time." minute ago";
	}

	elseif($time>=3600 && $time < 86400)
	{
		$passed_time =(int)($time/3600);
		$posted = $passed_time >1 ? $passed_time."hours ago" : $passed_time." hour ago";
	}
	
	elseif($time>= 86400 && $time < 604800)
	{
		$passed_time =(int)($time/86400);
		$posted = $passed_time >1 ? $passed_time."days ago" : " Yesterday";
	}

	elseif($time>= 86400 && $time < 604800)
	{
		$passed_time =(int)($time/604800);
		$posted = $passed_time >1 ? $passed_time."weeks ago" : $passed_time." week ago";
	}
	else{
		$posted = "-";
	}
	return $posted;
}

function create_array($string,$delimeter,$return = '*')
{
	$array = explode($delimeter,$string);
	if($return = 'first')
	{
		return reset($array);
	}
	elseif($return='last')
	{
		return end($array);
	}
	else
	{
		return $array;
	}
}

function show_words($array,$count)
{
	$length = count($array);
	$show = $length > $count ? $count : $length;

	for($i=0; $i<$show;$i++)
  {
	  echo $array[$i]." ";
	}
}
function show_rating($stars)
{
	$i;
	$k;
	$rating="";
	for($i=0;$i<$stars;$i++)
	{
		$rating=$rating."<span>&#9733</span>";
	}
	for($k=0;$k<5-$stars;$k++)
	{
		$rating = $rating."<span>&#9734</span>";
	}
	return $rating;
}
function create_lists($array,$attributes,$field)
{
	$elements ="";
foreach ($array as $element ) {
	$elements = $elements. "
	<li $attributes>
		$element[$field]
	</li>";
}
	return $elements;
}
?>