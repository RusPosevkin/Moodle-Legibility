<?php
require_once('../../config.php');
// подключаем файл для print_header(), print_footer()                            
require_once($CFG->dirroot .'/lib/weblib.php'); 

// получаем ID ресурса, анализ которого будем производить 
$resourceID = isset($_POST['resourceID']) ? $_POST['resourceID'] : false;
//получаем количественные характеристики текста
$Flesch = isset($_POST['flesch']) ? $_POST['flesch'] : false;
$educationLevel = isset($_POST['educationlevel']) ? $_POST['educationlevel'] : false;

// получаем параметры из header.html
$header_direction_post = isset($_POST['header_direction']) ? $_POST['header_direction'] : false;  
$header_meta_post = isset($_POST['header_meta']) ? $_POST['header_meta'] : false;  
$header_title_post = isset($_POST['header_title']) ? $_POST['header_title'] : false;  
$header_bodytags_post = isset($_POST['header_bodytags']) ? $_POST['header_bodytags'] : false;  
$header_focus_post = isset($_POST['header_focus']) ? $_POST['header_focus'] : false;  
$header_home_post = isset($_POST['header_home']) ? $_POST['header_home'] : false;  
$header_menu_post = isset($_POST['header_menu']) ? $_POST['header_menu'] : false;  
$header_heading_post = isset($_POST['header_heading']) ? $_POST['header_heading'] : false;    
$header_navigation_post = isset($_POST['header_navigation']) ? $_POST['header_navigation'] : false;  

$lectionlink = isset($_POST['lectionlink']) ? $_POST['lectionlink'] : false;

$keySentencesList = isset($_POST['keysentenceslist']) ? $_POST['keysentenceslist'] : false; 

// преобразуем в нормальный вид
$header_direction = stripslashes(htmlspecialchars_decode($header_direction_post));
$header_meta = stripslashes(htmlspecialchars_decode($header_meta_post));
$header_title = stripslashes(htmlspecialchars_decode($header_title_post));
$header_bodytags = stripslashes(htmlspecialchars_decode($header_bodytags_post));
$header_focus = stripslashes(htmlspecialchars_decode($header_focus_post));
$header_home = stripslashes(htmlspecialchars_decode($header_home_post));
$header_menu = stripslashes(htmlspecialchars_decode($header_menu_post));
$header_heading = stripslashes(htmlspecialchars_decode($header_heading_post));
$header_navigation = stripslashes(htmlspecialchars_decode($header_navigation_post));


$lectionlink = stripslashes(htmlspecialchars_decode($lectionlink));


$header_direction = stripcslashes($header_direction);
$header_meta = stripcslashes($header_meta);
$header_title = stripcslashes($header_title);
$header_bodytags = stripcslashes($header_bodytags);
$header_focus = stripcslashes($header_focus);
$header_home = stripcslashes($header_home);
$header_menu = stripcslashes($header_menu);
$header_heading = stripcslashes($header_heading);
$header_navigation = stripcslashes($header_navigation);

$lectionlink = stripcslashes($lectionlink);



$header_navigation_array['navlinks'] = $header_navigation;
$header_navigation_array['newnav'] = 1;


$cache = true;
$button='&nbsp;';
$usexml=false;
$return=false;

$header_meta2=' ';


print_header($header_title, $header_heading, $header_navigation_array, $header_focus, $header_meta2, $cache, $button, $header_menu, $usexml, $header_bodytags, $return );
//подключаем css
require_once($CFG->dirroot .'/analise/common/include/styles.inc.php');

require_once($CFG->dirroot .'/analise/common/include/all_info.inc.php');
print_footer();

?>
