<?php
require_once('../../config.php');                             
require_once($CFG->dirroot .'/lib/dmllib.php');
// получаем идентификатор того, что загружена страница анализа
$yes = isset($_POST['analise']) ? $_POST['analise'] : false;
// получаем ID ресурса, анализ которого будем производить 
$resourceID = isset($_POST['resourceID']) ? $_POST['resourceID'] : false;

// если перешли на страницу со страницы с контентом и получили ID ресурса
// генерируем разметку
$phrase1 = 'Показать ключевые слова';
//cp-866
$phrase1 = iconv("CP1251", "UTF-8//IGNORE", $phrase1);
$phrase2 = 'левая граница интервала (%)';
$phrase2 = iconv("CP1251", "UTF-8//IGNORE", $phrase2);
$phrase3 = 'правая граница интервала (%)';
$phrase3 = iconv("CP1251", "UTF-8//IGNORE", $phrase3);


$header_meta_post = htmlspecialchars($header_meta);
$header_title_post = htmlspecialchars($header_title);
$header_bodytags_post = htmlspecialchars($header_bodytags);
$header_focus_post = htmlspecialchars($header_focus);
$header_home_post = htmlspecialchars($header_home);
$header_menu_post = htmlspecialchars($header_menu);
$header_heading_post = htmlspecialchars($header_heading);
$header_navigation_post = htmlspecialchars($header_navigation);
$lectionlink = htmlspecialchars($lectionlink);


if ( ($yes) && ($resourceID) )
{ 
    //подключаем css
    require_once($CFG->dirroot .'/analise/common/include/styles.inc.php');
    echo("
    <div align=\"center\"><img src=\"buildGraph.php?ID=$resourceID\" ></img>
    <table>
    <tr>
        <td width=\"300\" align=\"center\">$phrase2</td>
        <td width=\"300\" align=\"center\">$phrase3</td>
        <td width=\"300\"></td>
    </tr>
    <tr>
    <form action=\"keyWords_main.php\" method=\"post\">
    <td width=\"400\" align=\"center\"><input type=\"text\" size=\"1\" maxlength=\"3\" value=\"0\" name=\"first\"></td>
    <td width=\"400\" align=\"center\"><input type=\"text\" size=\"1\" maxlength=\"3\" value=\"30\" name=\"last\"></td>
    <td width=\"400\">
    <input name=\"analise\" value=\"yes\" type=\"hidden\">
    <input type=\"hidden\" name=\"resourceID\" value=\"$resourceID\"> 
    <input name=\"lectionlink\" value=\"$lectionlink\" type=\"hidden\">
    <input name=\"header_direction\" value=\"$header_direction_post\" type=\"hidden\">
    <input name=\"header_meta\" value=\"$header_meta_post\" type=\"hidden\">
    <input name=\"header_title\" value=\"$header_title_post\" type=\"hidden\">
    <input name=\"header_bodytags\" value=\"$header_bodytags_post\" type=\"hidden\">
    <input name=\"header_focus\" value=\"$header_focus_post\" type=\"hidden\">
    <input name=\"header_home\" value=\"$header_home_post\" type=\"hidden\">
    <input name=\"header_menu\" value=\"$header_menu_post\" type=\"hidden\">
    <input name=\"header_heading\" value=\"$header_heading_post\" type=\"hidden\">
    <input name=\"header_navigation\" value=\"$header_navigation_post\" type=\"hidden\">
    <input type=\"submit\" value=\"$phrase1\">
    </td>
    </form>


    </tr>
    </table></div>
    ");
}
else 
{
    require_once($CFG->dirroot .'/analise/common/include/styles.inc.php');  
    echo(iconv('windows-1251', "UTF-8", "При выполнении запроса произошла ошибка."));  
    
}    
?>

