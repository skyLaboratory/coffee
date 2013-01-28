<?php
$action	= $_GET['action'];
switch($action)
{
	case "myPlan":
		$array['title'] 					= "This is demo content";
		$array['content'][1]['title'] 		= "In know this is silly but it ia the best way to test an layout.";
		$array['content'][1]['content']		= "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.";
		$array['content'][1]['footer']		= "";
		$array['content'][1]['className']	= "text";
		$array['content'][1]['id']			= "first";
		$array['content'][1]['name']		= "first";
		$array['footer']					= "This is the dome content from our coffee project.";
		break;
	
	case "mySettings":
		$array['title']						= "This is the Settings Site";
		$array['content'][1]['title'] 		= "In know this is silly but it the best way to test a layout.";
		$array['content'][1]['content']		= "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.";
		$array['content'][1]['footer']		= "";
		$array['content'][1]['className']	= "text";
		$array['content'][1]['id']			= "first";
		$array['content'][1]['name']		= "first";
		
		$array['content'][2]['title'] 		= "This is fucking silly";
		$array['content'][2]['content']		= "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.";
		$array['content'][2]['footer']		= "";
		$array['content'][2]['className']	= "text";
		$array['content'][2]['id']			= "second";
		$array['content'][2]['name']		= "second";
		$array['footer']					= "This is the dome content from our coffee project.";
		break;
	
	case "mySocial":
		$array['title']	= "mySocial World";
		break;
}
echo json_encode($array);
?>

