<?php   
require_once('../../config.php');


//подключаем дл€ доступа к функци€м работы с SQL-запросами
require_once($CFG->dirroot .'/lib/ddllib.php');


//задаем общие данные, дл€ дальнейшего 
//включени€ в SQL-запрос
//префикс таблицы
$prefix = $CFG->prefix;
//название таблицы
$tablename = 'keywords';
//название пол€ таблицы - идентификатор
$idfield = 'id';
//название пол€ таблицы - ключевые слова
$wordsfield = 'words';
//название пол€ таблицы - ключевые предложени€
$sentencesfield = 'sentences';
//название пол€ таблицы - показатель удобочитемости (индекс ‘леша)
$fleschfield = 'flesch';
//название пол€ таблицы - уровень образовани€ 
$edulevelfield = 'edulevel';

//здесь задаем id ресурса, с которым работаем
$idstring = $resourceID;


//если таблица KEYWORDS еще не создана, создаем ее

//SQL-запрос на создание таблицы
//создание таблицы осуществл€етс€ в том случае, если он не была создана ранее
$sqlstring = "CREATE TABLE IF NOT EXISTS ".$prefix."$tablename ($idfield INT NOT NULL,$wordsfield LONGTEXT,$sentencesfield LONGTEXT,$fleschfield FLOAT,$edulevelfield FLOAT)";
execute_sql($sqlstring,false);


//составл€ем SQL-запрос дл€ выборки всех данных 
//дл€ ресурса с идентификатором $idstring
$sqlStringSelect = "SELECT words from $prefix".$tablename." WHERE $idfield=$idstring";

//формируем запись дл€ добавлени€ в таблицу
//тестова€ строка - ключевые слова
$valuestringBefore = $keyWordsList;
//если есть какие-то спецсимволы, обфусцируем их
//$valuestring = htmlspecialchars($valuestring);

//¬ Ѕƒ занос€тс€ только буквы, цифры и символы "-", "/", ",","&" и пробел
//остальные символы обрезаютс€
$pattern  = 'абвгдеЄжзийклмнопрстуфхцчшщъыьэю€';
$pattern .= 'јЅ¬√ƒ≈®∆«»… ЋћЌќѕ–—“”‘’÷„ЎўЏџ№Ёёя';
$pattern .= '0123456789';
$pattern .= '/, -';
$pattern = iconv("CP1251", "UTF-8//IGNORE", $pattern);
$valuestring = ' ';

for( $i=0; $i < strlen($valuestringBefore); $i++ )
{
    
    //если символ входит в список разрешенных
    if ( strrpos( $pattern, $valuestringBefore[ $i ] )!== false )
    {
        $valuestring .= $valuestringBefore[ $i ];
    }
}
//$valuestring = iconv("UTF-8", "CP1251//IGNORE", $valuestring);
//echo($valuestring);


//в переменной хранитс€ статус, существует ли
//запись с идентификатором $idstring
$isExistWords = record_exists_sql($sqlStringSelect);

//если записей c данным идентификатором нет, 
//то добавл€ем запись
if( $isExistWords === false  )
{
    //SQL-запрос на добавление информации в таблицу
    $sqlstring2 = "INSERT INTO ".$prefix."$tablename ($idfield, $wordsfield) VALUES ('".$idstring."', '".$valuestring."')";
    execute_sql($sqlstring2,false);
}
//если есть, то обновл€ем запись
else
{
    //SQL-запрос на добавление информации в таблицу
    $sqlstring2 = "UPDATE ".$prefix."$tablename SET $wordsfield='$valuestring' WHERE $idfield=$idstring";
    execute_sql($sqlstring2,false);
}



?>