<?php
//$keySentencesList = isset($_POST['keysentenceslist']) ? $_POST['keysentenceslist'] : false; 

//приводим список предложений к виду для занесения в БД
$pattern = chr(10);
$pattern .= chr(13);
$pattern .= chr(10);                                                                            
$toDataBaseSentenceList = str_replace($pattern, "|", $keySentencesList);

/*
//В БД заносятся только буквы, цифры и символы "-", "/", ",","|","&" и пробел
//остальные символы обрезаются
$pattern  = 'абвгдеёжзийклмнопрстуфхцчшщъыьэюя';
$pattern .= 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ';
$pattern .= '0123456789';
$pattern .= '/, -|';
$pattern = iconv("CP1251", "UTF-8//IGNORE", $pattern);
$valuestring = '';

for( $i=0; $i < strlen($toDataBaseSentenceList); $i++ )
{
    
    //если символ входит в список разрешенных
    if ( strrpos( $pattern, $toDataBaseSentenceList[ $i ] )!== false )
    {
        $valuestring .= $toDataBaseSentenceList[ $i ];
    }
}
*/



//сохранение всех данных в БД
  
 //задаем общие данные, для дальнейшего 
//включения в SQL-запрос
//префикс таблицы
$prefix = $CFG->prefix;
//название таблицы
$tablename = 'keywords';
//название поля таблицы - идентификатор
$idfield = 'id';
//название поля таблицы - ключевые предложения
$sentencesfield = 'sentences';
//название поля таблицы - показатель удобочитемости (индекс Флеша)
$fleschfield = 'flesch';
//название поля таблицы - уровень образования 
$edulevelfield = 'edulevel';

//здесь задаем id ресурса, с которым работаем
$idstring = $resourceID;





//составляем SQL-запрос для выборки ключевых слов
//для ресурса с идентификатором $idstring
$sqlStringSelect = "SELECT $sentencesfield from $prefix".$tablename." WHERE $idfield=$idstring";
$sqlStringSelect2 = "SELECT $fleschfield from $prefix".$tablename." WHERE $idfield=$idstring";
$sqlStringSelect3 = "SELECT $edulevelfield from $prefix".$tablename." WHERE $idfield=$idstring";

  
//в переменной хранится статус, существует ли
//запись с идентификатором $idstring
$isExist = record_exists_sql($sqlStringSelect);
$isExist2 = record_exists_sql($sqlStringSelect2);
$isExist3 = record_exists_sql($sqlStringSelect3);

//если записей c данным идентификатором нет, 
//то добавляем запись
if( $isExist === false  )
{
    //SQL-запрос на добавление информации в таблицу - ключевые предложения
    $sqlstring2 = "INSERT INTO ".$prefix."$tablename ($idfield, $sentencesfield) VALUES ('".$idstring."', '".$toDataBaseSentenceList."')";
    execute_sql($sqlstring2,false);
    
}
//если есть, то обновляем запись
else
{
    //SQL-запрос на добавление информации в таблицу - ключевые предложения
    $sqlstring2 = "UPDATE ".$prefix."$tablename SET $sentencesfield='$toDataBaseSentenceList' WHERE $idfield=$idstring";
    execute_sql($sqlstring2,false);
}

//если записей c данным идентификатором нет, 
//то добавляем запись
if( $isExist2 === false  )
{
    //SQL-запрос на добавление информации в таблицу - индекс удобочитаемости Флеша
    $sqlstring2 = "INSERT INTO ".$prefix."$tablename ($idfield, $fleschfield) VALUES ('".$idstring."', '".$Flesch."')";
    execute_sql($sqlstring2,false);
}
//если есть, то обновляем запись
else
{
    //SQL-запрос на добавление информации в таблицу - индекс удобочитаемости Флеша
    $sqlstring2 = "UPDATE ".$prefix."$tablename SET $fleschfield='$Flesch' WHERE $idfield=$idstring";
    execute_sql($sqlstring2,false);
}
  
//если записей c данным идентификатором нет, 
//то добавляем запись
if( $isExist3 === false  )
{
    //SQL-запрос на добавление информации в таблицу - уровень образования
    $sqlstring2 = "INSERT INTO ".$prefix."$tablename ($idfield, $edulevelfield) VALUES ('".$idstring."', '".$educationLevel."')";
    execute_sql($sqlstring2,false);
}
//если есть, то обновляем запись
else
{
    //SQL-запрос на добавление информации в таблицу - уровень образования
    $sqlstring2 = "UPDATE ".$prefix."$tablename SET $edulevelfield='$educationLevel' WHERE $idfield=$idstring";
    execute_sql($sqlstring2,false);
}




///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
 //название поля таблицы - ключевые слова
 $wordsfield = 'words';
       
 //составляем SQL-запрос для выборки всех данных 
 //для ресурса с идентификатором $idstring
 $sqlStringSelect = "SELECT $wordsfield from $prefix".$tablename." WHERE $idfield=$idstring";
        
 //в переменной хранится статус, существует ли
 //запись с идентификатором $idstring
 $isExistWords= record_exists_sql($sqlStringSelect);
 //если записи c данным идентификатором есть
 if( $isExistWords === true  )
 {
    //получаем наши ключевые слова в виде объекта
    $KeyWordsList = get_record_sql($sqlStringSelect,false,false);
    //обращаемся к переменной объекта
    $KeyWordsList = $KeyWordsList->words;                  
 }       




///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////





//Выводим ключевые слова на страницу
echo(iconv('windows-1251', "UTF-8", "<h2>Ключевые слова:</h2>"));
echo($KeyWordsList); 


//Выводим ключевые предложения на страницу
echo(iconv('windows-1251', "UTF-8", " <br /><br /><h2>Ключевые предложения:</h2>"));
 
//добавляем, где были, переносы строк
$pattern = chr(10);
$pattern .= chr(13);
$pattern .= chr(10);                                                                            
$keySentencesList = str_replace($pattern, "<br /><br />", $keySentencesList);

echo ($keySentencesList);

//Выводим индекс удобочитаемости Флеша на страницу
echo(iconv('windows-1251', "UTF-8", " <h2>Индекс удобочитаемости Флеша:</h2>"));
echo("<h1>$Flesch</h1>");

//Выводим уровень образования на страницу
echo(iconv('windows-1251', "UTF-8", " <br /><h2>Уровень образования:</h2>"));
echo("<h1>$educationLevel</h1>");

//кнопка "вернуться к лекции"
$phrase1 = 'Вернуться к лекции';
$phrase1 = iconv("CP1251", "UTF-8//IGNORE", $phrase1);
echo("<br /><br /><input type='button' onclick=\"document.location='$lectionlink'\" value=\"$phrase1\">");



?>
