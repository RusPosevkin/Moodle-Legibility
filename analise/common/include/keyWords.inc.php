<?php
require_once('../../config.php');                               
require_once($CFG->dirroot .'/lib/dmllib.php');

//подключаем алгоритм выделения ключевых слов - часть 1
require_once($CFG->dirroot .'/analise/common/include/keyWordsAnaliseAlghoritm1.inc.php');
// получаем ID ресурса, анализ которого будем производить 
$resourceID = isset($_POST['resourceID']) ? $_POST['resourceID'] : false; 
$resource = get_record("resource", "id", $resourceID);
// получаем исходный текст курса с данным ID из mdl_resources
$content = $resource->alltext;
// преобразуем текст из кодировки utf-8 в win1251(cp1251)
$content = iconv("UTF-8", "CP1251//IGNORE", $content);
//подключаем алгоритм выделения ключевых слов - часть 2
require_once($CFG->dirroot .'/analise/common/include/keyWordsAnaliseAlghoritm2.inc.php');

//получаем данные из формы (промежуток ключевых слов)
$firstPercent = isset( $_POST[ "first" ] ) ? $_POST[ "first" ] : false;
$lastPercent = isset( $_POST[ "last" ] ) ? $_POST[ "last" ] : false;



//создаем массив размерностью совпадающий с размерностью массива рангов
//$massiv_percents = array[ count( $massiv_chastota_sort ) ];
//делим 100% на кол-во рангов -1, чтобы определить сколько процентов приходится на один ранг
$rang_percent = 100 / ( count( $massiv_chastota_sort )-1  );
$massiv_percents[ 1 ] =  0;
$massiv_percents[ count( $massiv_chastota_sort ) ] =  100;
for( $i = 2; $i < count( $massiv_chastota_sort ); $i++)
{
    $massiv_percents[ $i ] = ($i-1) * $rang_percent;
}
//проверяем чтобы значение правой границы было больше левой
if (( $firstPercent > $lastPercent ) || ( $lastPercent > 100 ) || ( $firstPercent < 0 ) || (preg_match('([^0-9])',$lastPercent)) || preg_match('([^0-9])',$firstPercent) || ($firstPercent === false) || ($lastPercent === false)) 
{
        $outputPhrase100 = 'Неверно заданы границы';  
        $outputPhrase100 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase100);  
        echo( $outputPhrase100 );
        echo('<meta http-equiv="Refresh" content=" 1; url=error.php">');    
}
else
{
//ищем совпадения введнных границ с массивом процентов
//если строго не равны, то
//левая граница - округляем до меньшего
//правая граница - округляем до большего
for( $i = 1, $flag1 = true, $flag2 = true ; $i <= count( $massiv_percents ); $i++)
{
    //значение уже было найдено?
    if( $flag1 )
    {
        //если нашли точно такое же значение левой границы как в форме
        if ($massiv_percents[ $i ] == $firstPercent) 
        {
                //запоминаем и выставляем флаг в false, чтобы больше не работать с левой границей
            $masBorder[ 0 ] = $i;
            $flag1 = false;
        }
        //если нашли точно значение  левой границы большее, чем указано в форме
        if ($massiv_percents[ $i ] > $firstPercent) 
        {
            //запоминаем предыдущее и выставляем флаг в false, чтобы больше не работать с левой границей
            $masBorder[ 0 ] = $i-1;
            $flag1 = false;
        }
    }
    //значение уже было найдено?
    if( $flag2 )
    {
        //если нашли точно такое же значение правой границы как в форме
        if ($massiv_percents[ $i ] == $lastPercent) 
        {
            //запоминаем и выставляем флаг в false, чтобы больше не работать с правой границей
            $masBorder[ 1 ] = $i;
            $flag2 = false;
        }
        //если нашли точно значение  левой границы большее, чем указано в форме
        if ($massiv_percents[ $i ] > $lastPercent) 
        {
            //запоминаем и выставляем флаг в false, чтобы больше не работать с правой границей
            $masBorder[ 1 ] = $i;
            $flag2 = false;
        }
    }
}
unset($elem);
//записываем ключевые слова из пользовательского диапазона
$k = 0;     //счетчик массива ключевых слов пользовательского диапазона
//задаем интервал рангов 
for ($i = $masBorder[ 0 ]; $i <= $masBorder[ 1 ]; $i++)
{
    //перебираем все элементы массива $massiv_chastota_sort 
    for($j = ( count( $massiv_chastota_sort ) ) - 1; $j > 0;$j--)
    {
        //нашли записи с данным рангом
        if ( $massiv_chastota_sort[ $j ][ 2 ] === $i )
        {
            //записываем весь массив слов, связанный с данным рангом 
            // в массив пользовательских ключевых слов
            foreach ($massiv_chastota_sort[ $j ][ 1 ] as $elem)
            {
                $UserKeyWords[ $k ] = $elem;
                $k++;
            }            
        }
    }
}
//производим сортировку массива
 asort( $UserKeyWords, SORT_STRING ); 
//нормализуем ключи массива слов
 $biglist = array_values( $UserKeyWords );

//выводим на экран


// получаем идентификатор того, что загружена страница анализа
$yes = isset($_POST['analise']) ? $_POST['analise'] : false;
// получаем ID ресурса, анализ которого будем производить 
$resourceID = isset($_POST['resourceID']) ? $_POST['resourceID'] : false;

//для элемента TEXTAREA 
//количество столбцов (размер формы по ширине)
$textareaCountCol = 100;
//количество строк (размер формы по высоте)
$textareaCountRow = 8;

$outputPhrase1 = 'Список ключевых слов для выбранного Вами диапазона (от <strong>';
$outputPhrase2 = '</strong> % до <strong>';
$outputPhrase3 = '</strong> %):';
$outputPhrase4 = 'Вернуться к выбору диапазона значений';
$outputPhrase5 = 'Продолжить';
$outputPhrase6 = 'Слова необходимо записать подряд через запятую';
$outputPhrase7 = 'Список ключевых слов, сохраненных ранее:';
$outputPhrase8 = 'Сохранить ключевые слова и отобразить ключевые предложения в диапазоне';
$outputPhrase9 = 'Просмотр численных характеристик выделенных ключевых слов';



$outputPhrase1 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase1);
$outputPhrase2 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase2);
$outputPhrase3 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase3);
$outputPhrase4 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase4);
$outputPhrase5 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase5);
$outputPhrase6 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase6);
$outputPhrase7 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase7);
$outputPhrase8 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase8);
$outputPhrase9 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase9);


$header_meta_post = htmlspecialchars($header_meta);
$header_title_post = htmlspecialchars($header_title);
$header_bodytags_post = htmlspecialchars($header_bodytags);
$header_focus_post = htmlspecialchars($header_focus);
$header_home_post = htmlspecialchars($header_home);
$header_menu_post = htmlspecialchars($header_menu);
$header_heading_post = htmlspecialchars($header_heading);
$header_navigation_post = htmlspecialchars($header_navigation);

// если перешли на страницу со страницы с контентом и получили ID ресурса
// генерируем разметку
if ( ($yes) && ($resourceID) )
{
    //подключаем css
    require_once($CFG->dirroot .'/analise/common/include/styles.inc.php');
    
    echo("<form action=\"saveKeyWords.php\" method=\"post\">");
    echo("<table align='center'><tr><td align='center'><h3>$outputPhrase1 $firstPercent$outputPhrase2$lastPercent $outputPhrase3 </h3></td></tr><br />");
           
     //в эту переменную собираются все выделенные ключевые слова
    $fullText = '';
    //преобразовываем в нужную кодировку и 
    //собираем в строку через запятую
     foreach($UserKeyWords as $elem)
    {
        $fullListKeyWords .= $elem;
        $fullListKeyWords .= ', ';
    } 
       echo("<tr><td align=\"center\"><TEXTAREA name=keywordslist rows=$textareaCountRow cols=$textareaCountCol value='$fullListKeyWords' >");
        echo($fullListKeyWords);
        echo('</TEXTAREA></td></tr></table><br />'); 
        echo("<div align='right'><b>($outputPhrase6)</b></div>"); 
        
        
        
        
        
        
        
        
         

        
        
        ///////////////////////////////////////////////////////////////
        //    Выводятся ключевые слова, если были сохранены ранее    //
        ///////////////////////////////////////////////////////////////
         
        
        //подключаем для доступа к функциям работы с SQL-запросами
        require_once($CFG->dirroot .'/lib/ddllib.php');


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
        
        //в переменной хранится статус, существует ли
        //запись с идентификатором $idstring
        $isExistWords = record_exists_sql($sqlStringSelect);

        //если записи c данным идентификатором есть
        if( $isExistWords === true  )
        {
            //получаем наши ключевые слова в виде объекта
            $oldKeyWordsList = get_record_sql($sqlStringSelect,false,false);
            //обращаемся к переменной объекта
            $oldKeyWordsList = $oldKeyWordsList->words;
              
            
            //выводим на экран в элемент TEXTAREA
            //список ключевых слов, сохраненных ранее   
            echo("<table align='center'><tr><td align='center'><h3>$outputPhrase7  </h3></td></tr><br />");
            echo("<tr><td align=\"center\"><TEXTAREA name=keywordslistold rows=$textareaCountRow cols=$textareaCountCol disabled value='$oldKeyWordsList' >");
        echo($oldKeyWordsList);
        echo('</TEXTAREA></td></tr></table><br />');
            
        }
        //кнопка "Продолжить"
        echo("<input type=\"hidden\" name=\"resourceID\" value=\"$resourceID\">
        <input name=\"analise\" value=\"yes\" type=\"hidden\"> 
        <input name=\"first\" value=\"$firstPercent\" type=\"hidden\"> 
        <input name=\"last\" value=\"$lastPercent\" type=\"hidden\"> 
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
         $outputPhrase8     
         <input type=\"text\" size=\"1\" maxlength=\"3\" value=\"10\" name=\"sentpercents\">%
        <input type=\"submit\" value=\"$outputPhrase5\"></form>");
        //кнопка "Вернуться к выбору диапазона значений"
        echo("
        <br />
        <form action=\"main.php\" method=\"post\">   
        <input type=\"hidden\" name=\"resourceID\" value=\"$resourceID\">
        <input name=\"analise\" value=\"yes\" type=\"hidden\">
        <input name=\"first\" value=\"$firstPercent\" type=\"hidden\"> 
        <input name=\"last\" value=\"$lastPercent\" type=\"hidden\">  
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
        <input type=\"submit\" value=\"$outputPhrase4\">
        </form>
         
        ");   
        
       
       //просмотр численных характеристик выделенных ключевых слов
       
       //подготавливаем строку с выделенными ключевыми словами для
       //передачи на страницу с выдачей численных харкатеристик
       $UserKeyWordsOutput = implode("|",$UserKeyWords);
       
       for ($i = 0; $i < count($UserKeyWords); $i++)
       {
               for ($j = 0; $j < count($massiv_chastota_sort); $j++)
               {
                   for ($k = 0; $k < count($massiv_chastota_sort[$j][1]); $k++)
                   {
                       //если ключевое слово найдено в массиве ключевых слов
                       //с определенной частотой встречаемости,
                       //то запоминаем эту частоту
                       if ($UserKeyWords[$i] === $massiv_chastota_sort[$j][1][$k])
                       {
                           $UserKeyWordsNumeric[$i] = $massiv_chastota_sort[$j][0];
                           //var_dump($UserKeyWords[$i]);
                           //var_dump($massiv_chastota_sort[$j][1][$k]);
                           break 2;  
                       }
                   }
               }
       }
       
       //подготавливаем строку с численными хар-ками ключевых слов для
       //передачи на страницу с выдачей численных харкатеристик
       $UserKeyWordsNumericOutput = implode("|",$UserKeyWordsNumeric);
          
       //кнопка "Просмотр численных характеристик выделенных ключевых слов"
        echo("
        <form action=\"numeric_words.php\" method=\"post\" target=\"_blank\">
        <input type=\"hidden\" name=\"resourceID\" value=\"$resourceID\">
        <input name=\"analise\" value=\"yes\" type=\"hidden\"> 
        <input name=\"first\" value=\"$firstPercent\" type=\"hidden\"> 
        <input name=\"last\" value=\"$lastPercent\" type=\"hidden\"> 
        <input name=\"lectionlink\" value=\"$lectionlink\" type=\"hidden\">
        <input name=\"words\" value=\"$UserKeyWordsOutput\" type=\"hidden\">
        <input name=\"numeric\" value=\"$UserKeyWordsNumericOutput\" type=\"hidden\">
        <input name=\"header_direction\" value=\"$header_direction_post\" type=\"hidden\">
        <input name=\"header_meta\" value=\"$header_meta_post\" type=\"hidden\">
        <input name=\"header_title\" value=\"$header_title_post\" type=\"hidden\">
        <input name=\"header_bodytags\" value=\"$header_bodytags_post\" type=\"hidden\">
        <input name=\"header_focus\" value=\"$header_focus_post\" type=\"hidden\">
        <input name=\"header_home\" value=\"$header_home_post\" type=\"hidden\">
        <input name=\"header_menu\" value=\"$header_menu_post\" type=\"hidden\">
        <input name=\"header_heading\" value=\"$header_heading_post\" type=\"hidden\">
        <input name=\"header_navigation\" value=\"$header_navigation_post\" type=\"hidden\">         
        <input type=\"submit\" value=\"$outputPhrase9\"></form>");
        
        ///////////////////////////////// 
        

        
}
}

 

 

			  
?>
