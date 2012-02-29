<?php   
require_once('../../config.php');
// подключаем файл для print_header(), print_footer()                            
require_once($CFG->dirroot .'/lib/weblib.php'); 

// получаем ID ресурса, анализ которого будем производить 
$resourceID = isset($_POST['resourceID']) ? $_POST['resourceID'] : false;

//получение процентных значений диапазона выборки ключевых слов из main.php
$first = isset($_POST['first']) ? $_POST['first'] : false;
$last = isset($_POST['last']) ? $_POST['last'] : false;


$keyWordsList = isset($_POST['keywordslist']) ? $_POST['keywordslist'] : false;
//получаем количественную величину (в процентах) количества выделяемых 
//ключевых предложений от общего кол-ва предложений
$SentencePercents = isset($_POST['sentpercents']) ? $_POST['sentpercents'] : false;



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


//алгоритм сохранения в БД выделенных и отредактированных пользователем
//ключевых слов
require_once($CFG->dirroot .'/analise/common/include/saveKeyWords.inc.php');



/*$phrase1 = 'Вернуться к лекции';
$phrase1 = iconv("CP1251", "UTF-8//IGNORE", $phrase1);
echo("<br /><br /><input type='button' onclick=\"document.location='$lectionlink'\" value=\"$phrase1\">");*/

// Получаем список ключевых слов, сохраненных пользователем

//задаем общие данные, для дальнейшего 
//включения в SQL-запрос
//префикс таблицы
$prefix = $CFG->prefix;
//название таблицы
$tablename = 'keywords';
//название поля таблицы - идентификатор
$idfield = 'id';
//название поля таблицы - ключевые слова
$wordsfield = 'words';

//здесь задаем id ресурса, с которым работаем
$idstring = $resourceID;

//составляем SQL-запрос для выборки всех данных 
//для ресурса с идентификатором $idstring
$sqlStringSelect = "SELECT words from $prefix".$tablename." WHERE $idfield=$idstring";
//получаем наши ключевые слова в виде объекта
$KeyWordsList = get_record_sql($sqlStringSelect,false,false);
//обращаемся к переменной объекта
$KeyWordsList = $KeyWordsList->words;
//разбиваем строку на отдельные слова и удаляем пробелы
$keyWordsList = explode(",",$keyWordsList);

foreach ($keyWordsList as &$element)
{
    $element = trim ($element);
    //if ($element !== "") echo("$element<br />");
}
$resource = get_record("resource", "id", $resourceID);
// получаем исходный текст курса с данным ID из mdl_resources
$content = $resource->alltext;
// преобразуем текст из кодировки utf-8 в win1251(cp1251)
$content = iconv("UTF-8", "CP1251//IGNORE", $content);
//сохраняем контент во временную переменную, для дальнейшего использования
//в алгоритме выделения ключевых предложений
$content1 = $content;

//подключаем алгоритм выделения ключевых слов
require($CFG->dirroot .'/analise/common/include/keyWordsAnaliseAlghoritm11.inc.php');
require($CFG->dirroot .'/analise/common/include/keyWordsAnaliseAlghoritm22.inc.php');

//восстанавливаем контент
$content = $content1;

//подключаем алгоритм выделения предложений
require_once($CFG->dirroot .'/analise/common/include/getSentences.inc.php');


print_footer();
?>