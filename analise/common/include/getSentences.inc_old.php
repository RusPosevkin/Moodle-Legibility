<?php


// ф-ция удаления спец. символов, тегов и пр.               
 function html_content_word(&$content)
 { 
  //удаление style
  $content = preg_replace ('/<style.*?>[^<>]*?<\/style.*?>/mi',' ',$content);
   
  //удаление javascript
  $content = preg_replace ("'<script[^>]*?>.*?</script>'si", " ", $content);

  //удаление html-тегов
  $content = preg_replace ("'<[\/\!]*?[^<>]*?>'si", "", $content);
  
  // замещение html-элементов
  $content = preg_replace("'&(quot|#34);'i", "\"", $content);
  $content = preg_replace ("'&(amp|#38);'i", " ", $content);
  $content = preg_replace ("'&(lt|#60);'i", "<", $content);
  $content = preg_replace ("'&(gt|#62);'i", ">", $content);
  
  $content = preg_replace ("'&(ndash|#150);'i", " ", $content);  
  $content = preg_replace ("'&(mdash|#151);'i", " ", $content);
  
  $content = preg_replace ("'&(nbsp|#160);'i", " ", $content);
  $content = preg_replace ("'&(iexcl|#161);'i", " ", $content);
  $content = preg_replace ("'&(cent|#162);'i", " ", $content);
  $content = preg_replace ("'&(pound|#163);'i", " ", $content);
  $content = preg_replace ("'&(curren|#164);'i", " ", $content); 
  $content = preg_replace ("'&(yen|#165);'i", " ", $content); 
  $content = preg_replace ("'&(brvbar|#166);'i", " ", $content); 
  $content = preg_replace ("'&(sect|#167);'i", " ", $content); 
  $content = preg_replace ("'&(uml|#168);'i", " ", $content); 
  $content = preg_replace ("'&(copy|#169);'i", " ", $content);
  $content = preg_replace ("'&(ordf|#170);'i", " ", $content);
  $content = preg_replace ("'&(laquo|#171);'i", " ", $content);
  $content = preg_replace ("'&(not|#172);'i", " ", $content);
  $content = preg_replace ("'&(shy|#173);'i", " ", $content);
  $content = preg_replace ("'&(reg|#174);'i", " ", $content);  
  $content = preg_replace ("'&(macr|#175);'i", " ", $content);  
  $content = preg_replace ("'&(deg|#176);'i", " ", $content);  
  $content = preg_replace ("'&(plusmn|#177);'i", " ", $content);
  $content = preg_replace ("'&(sup2|#178);'i", " ", $content);
  $content = preg_replace ("'&(sup3|#179);'i", " ", $content);      
  $content = preg_replace ("'&(acute|#180);'i", " ", $content);  
  $content = preg_replace ("'&(micro|#181);'i", " ", $content); 
  $content = preg_replace ("'&(para|#182);'i", " ", $content);  
  $content = preg_replace ("'&(middot|#183);'i", ".", $content); 
  $content = preg_replace ("'&(cedil|#184);'i", " ", $content); 
  $content = preg_replace ("'&(sup1|#185);'i", " ", $content); 
  $content = preg_replace ("'&(ordm|#186);'i", " ", $content); 
  $content = preg_replace ("'&(raquo|#187);'i", " ", $content);
  $content = preg_replace ("'&(frac14|#188);'i", "1/4", $content); 
  $content = preg_replace ("'&(frac12|#189);'i", "1/2", $content); 
  $content = preg_replace ("'&(frac34|#190);'i", "3/4", $content); 
  $content = preg_replace ("'&(iquest|#191);'i", " ", $content); 
  $content = preg_replace ("'&(Agrave|#192);'i", " ", $content);
  $content = preg_replace ("'&(Aacute|#193);'i", " ", $content);
  $content = preg_replace ("'&(Acirc|#194);'i", " ", $content);
  $content = preg_replace ("'&(Atilde|#195);'i", " ", $content);
  $content = preg_replace ("'&(Auml|#196);'i", " ", $content);
  $content = preg_replace ("'&(Aring|#197);'i", " ", $content);
  $content = preg_replace ("'&(AElig|#198);'i", " ", $content);
  $content = preg_replace ("'&(Ccedil|#199);'i", " ", $content);
  $content = preg_replace ("'&(Egrave|#200);'i", " ", $content);
  $content = preg_replace ("'&(Eacute|#201);'i", " ", $content);
  $content = preg_replace ("'&(Ecirc|#202);'i", " ", $content);
  $content = preg_replace ("'&(Euml|#203);'i", " ", $content);
  $content = preg_replace ("'&(Igrave|#204);'i", " ", $content);
  $content = preg_replace ("'&(Iacute|#205);'i", " ", $content);
  $content = preg_replace ("'&(Icirc|#206);'i", " ", $content);
  $content = preg_replace ("'&(Iuml|#207);'i", " ", $content);
  $content = preg_replace ("'&(ETH|#208);'i", " ", $content);
  $content = preg_replace ("'&(Ntilde|#209);'i", " ", $content);
  $content = preg_replace ("'&(Ograve|#210);'i", " ", $content);
  $content = preg_replace ("'&(Oacute|#211);'i", " ", $content);
  $content = preg_replace ("'&(Ocirc|#212);'i", " ", $content);
  $content = preg_replace ("'&(Otilde|#213);'i", " ", $content);
  $content = preg_replace ("'&(Ouml|#214);'i", " ", $content);
  $content = preg_replace ("'&(times|#215);'i", " ", $content);
  $content = preg_replace ("'&(Oslash|#216);'i", " ", $content);
  $content = preg_replace ("'&(Ugrave|#217);'i", " ", $content);
  $content = preg_replace ("'&(Uacute|#218);'i", " ", $content);
  $content = preg_replace ("'&(Ucirc|#219);'i", " ", $content);
  $content = preg_replace ("'&(Uuml|#220);'i", " ", $content);
  $content = preg_replace ("'&(Yacute|#221);'i", " ", $content);
  $content = preg_replace ("'&(THORN|#222);'i", " ", $content);
  $content = preg_replace ("'&(agrave|#224);'i", " ", $content);
  $content = preg_replace ("'&(aacute|#225);'i", " ", $content);
  $content = preg_replace ("'&(acirc|#226);'i", " ", $content);  
  $content = preg_replace ("'&(atilde|#227);'i", " ", $content);
  $content = preg_replace ("'&(auml|#228);'i", " ", $content);
  $content = preg_replace ("'&(aring|#229);'i", " ", $content);
  $content = preg_replace ("'&(aelig|#230);'i", " ", $content);
  $content = preg_replace ("'&(ccedil|#231);'i", " ", $content);
  $content = preg_replace ("'&(egrave|#232);'i", " ", $content);
  $content = preg_replace ("'&(eacute|#233);'i", " ", $content);
  $content = preg_replace ("'&(ecirc|#234);'i", " ", $content);
  $content = preg_replace ("'&(euml|#235);'i", " ", $content);
  $content = preg_replace ("'&(igrave|#236);'i", " ", $content);
  $content = preg_replace ("'&(iacute|#237);'i", " ", $content);
  $content = preg_replace ("'&(icirc|#238);'i", " ", $content);
  $content = preg_replace ("'&(iuml|#239);'i", " ", $content);
  $content = preg_replace ("'&(eth|#240);'i", " ", $content);
  $content = preg_replace ("'&(ntilde|#241);'i", " ", $content);
  $content = preg_replace ("'&(ograve|#242);'i", " ", $content);
  $content = preg_replace ("'&(oacute|#243);'i", " ", $content);
  $content = preg_replace ("'&(ocirc|#244);'i", " ", $content);
  $content = preg_replace ("'&(otilde|#245);'i", " ", $content);
  $content = preg_replace ("'&(ouml|#246);'i", " ", $content);
  $content = preg_replace ("'&(divide|#247);'i", " ", $content);
  $content = preg_replace ("'&(oslash|#248);'i", " ", $content);
  $content = preg_replace ("'&(ugrave|#249);'i", " ", $content);
  $content = preg_replace ("'&(uacute|#250);'i", " ", $content);
  $content = preg_replace ("'&(ucirc|#251);'i", " ", $content);
  $content = preg_replace ("'&(uuml|#252);'i", " ", $content);  
  $content = preg_replace ("'&(yacute|#253);'i", " ", $content);  
  $content = preg_replace ("'&(thorn|#254);'i", " ", $content);  
  $content = preg_replace ("'&(yuml|#255);'i", " ", $content);
    
  $content = preg_replace ("'&(fnof|#402);'i", "f", $content);  
  
  $content = preg_replace ("'&(circ|#710);'i", " ", $content);  
  $content = preg_replace ("'&(tilde|#732);'i", " ", $content);  
  
  $content = preg_replace ("'&(Alpha|#913);'i", " ", $content);  
  $content = preg_replace ("'&(Beta|#914);'i", " ", $content);  
  $content = preg_replace ("'&(Gamma|#915);'i", " ", $content);  
  $content = preg_replace ("'&(Delta|#916);'i", " ", $content);  
  $content = preg_replace ("'&(Epsilon|#917);'i", " ", $content);  
  $content = preg_replace ("'&(Zeta|#918);'i", " ", $content);  
  $content = preg_replace ("'&(Eta|#919);'i", " ", $content);  
  $content = preg_replace ("'&(Theta|#920);'i", " ", $content);  
  $content = preg_replace ("'&(Iota|#921);'i", " ", $content);
  $content = preg_replace ("'&(Kappa|#922);'i", " ", $content);
  $content = preg_replace ("'&(Lambda|#923);'i", " ", $content);
  $content = preg_replace ("'&(Mu|#924);'i", " ", $content);
  $content = preg_replace ("'&(Nu|#925);'i", " ", $content);
  $content = preg_replace ("'&(Xi|#926);'i", " ", $content);
  $content = preg_replace ("'&(Omicron|#927);'i", " ", $content);
  $content = preg_replace ("'&(Pi|#928);'i", " ", $content);
  $content = preg_replace ("'&(Rho|#929);'i", " ", $content);
  $content = preg_replace ("'&(Sigma|#931);'i", " ", $content);
  $content = preg_replace ("'&(Tau|#932);'i", " ", $content);
  $content = preg_replace ("'&(Upsilon|#933);'i", " ", $content);
  $content = preg_replace ("'&(Phi|#934);'i", " ", $content);
  $content = preg_replace ("'&(Chi|#935);'i", " ", $content);
  $content = preg_replace ("'&(Psi|#936);'i", " ", $content);
  $content = preg_replace ("'&(Omega|#937);'i", " ", $content);
  
   $content = preg_replace ("'&(alpha|#945);'i", " ", $content);  
  $content = preg_replace ("'&(beta|#946);'i", " ", $content);  
  $content = preg_replace ("'&(gamma|#947);'i", " ", $content);  
  $content = preg_replace ("'&(delta|#948);'i", " ", $content);  
  $content = preg_replace ("'&(epsilon|#949);'i", " ", $content);  
  $content = preg_replace ("'&(zeta|#950);'i", " ", $content);  
  $content = preg_replace ("'&(eta|#951);'i", " ", $content);  
  $content = preg_replace ("'&(theta|#952);'i", " ", $content);  
  $content = preg_replace ("'&(iota|#953);'i", " ", $content);
  $content = preg_replace ("'&(kappa|#954);'i", " ", $content);
  $content = preg_replace ("'&(lambda|#955);'i", " ", $content);
  $content = preg_replace ("'&(mu|#956);'i", " ", $content);
  $content = preg_replace ("'&(nu|#957);'i", " ", $content);
  $content = preg_replace ("'&(xi|#958);'i", " ", $content);
  $content = preg_replace ("'&(omicron|#959);'i", " ", $content);
  $content = preg_replace ("'&(pi|#960);'i", " ", $content);
  $content = preg_replace ("'&(rho|#961);'i", " ", $content);
  $content = preg_replace ("'&(sigmaf|#962);'i", " ", $content);
  $content = preg_replace ("'&(sigma|#963);'i", " ", $content);
  $content = preg_replace ("'&(tau|#964);'i", " ", $content);
  $content = preg_replace ("'&(upsilon|#965);'i", " ", $content);
  
  $content = preg_replace ("'&(chi|#967);'i", " ", $content);
  $content = preg_replace ("'&(psi|#968);'i", " ", $content);
  $content = preg_replace ("'&(omega|#969);'i", " ", $content);
 
  $content = preg_replace ("'&(ndash|#8211);'i", " ", $content);  
  $content = preg_replace ("'&(mdash|#8212);'i", " ", $content);
 
  $content = preg_replace ("'&(lsquo|#8216);'i", " ", $content); 
  $content = preg_replace ("'&(rsquo|#8217);'i", " ", $content); 
  $content = preg_replace ("'&(sbquo|#8218);'i", " ", $content); 
  $content = preg_replace ("'&(ldquo|#8220);'i", " ", $content); 
  $content = preg_replace ("'&(rdquo|#8221);'i", " ", $content); 
  $content = preg_replace ("'&(bdquo|#8222);'i", " ", $content); 
  
  $content = preg_replace ("'&(bull|#8226);'i", " ", $content);  
  $content = preg_replace ("'&(hellip|#8230);'i", " ", $content);  
  $content = preg_replace ("'&(oline|#8254);'i", " ", $content);  
  $content = preg_replace ("'&(frasl|#8260);'i", " ", $content);  
  
  $content = preg_replace ("'&(trade|#8482);'i", " ", $content);  
                                                                  
  $content = preg_replace ("'&(larr|#8592);'i", " ", $content);      
  $content = preg_replace ("'&(uarr|#8593);'i", " ", $content);      
  $content = preg_replace ("'&(rarr|#8594);'i", " ", $content);      
  $content = preg_replace ("'&(darr|#8595);'i", " ", $content);      
  $content = preg_replace ("'&(harr|#8596);'i", " ", $content);    
  
  $content = preg_replace ("'&(spades|#9824);'i", " ", $content);  
  $content = preg_replace ("'&(clubs|#9827);'i", " ", $content);  
  $content = preg_replace ("'&(hearts|#9829);'i", " ", $content); 
  $content = preg_replace ("'&(diams|#9830);'i", " ", $content); 
  
  
  
//////////!!!!!!!!!!!!!!!!/////////
 //если впереди слова стоит символ !
  $content = preg_replace ("'\!+[А-Я]+'i", " ", $content);
  $content = preg_replace ("'\!+[а-я]+'i", " ", $content);
//если впереди слова стоит символ ~ 
  $content = preg_replace ("'\~+[А-Я]+'i", " ", $content);
  $content = preg_replace ("'\~+[а-я]+'i", " ", $content);
  
 //удаление чисел 
 //с десятичной запятой 
  $content = preg_replace ("'\-?([0-9])+\.([0-9])+\.'i", " ", $content);
  //целое число
  $content = preg_replace ("'\-?([0-9])'i", " ", $content);

  // заменим " - " на " "
  $content = preg_replace ("'([\s]+)-([\s]+)|([\s]+)–([\s]+)'i", " ", $content);  
  
  //удаляем гиперссылки
    $content = preg_replace ("'(http\:\/\/).+[:space]'i", " ", $content); 
    $content = preg_replace ("'(www\.).+[:space]'i", " ", $content); 

   
   //замена буквы Ё на Е
  $content = preg_replace ("'ё'i","е", $content);

  //   // удалим символы :  ,  ( ) + * « »
  $content = preg_replace ("'[,\:()\"+*«»]'i", " ", $content); 

}



    function delete_punctuation(&$content)
    {
        //заменяем "." на " " только если точка не идет после цифры    
        $content = preg_replace("'([^0-9])\.'i",'$1 ',$content);

        //   // удалим символы : ; , ? ( ) + * « »
        $content = preg_replace ("'[,;:?()\"+*«»]'i", " ", $content); 

} 



html_content_word( $content );
// преобразуем текст в кодировку utf-8 

$content = iconv('windows-1251', "UTF-8", $content);
$content = divide_to_sentence($content);
// в $content возвратился массив следующего вида:
// [i] - порядковый номер (внутри-array(4))
//      [0] - предложение в нижнем регистре через пробел
//            и без пунктуации (string)
//      [1] - кол-во слов в предложении (int)
//      [2] - массив (array) слов предложения (string) в 
//            верхнем регистре 
//      [3] - массив (array) той же размерности, что и [2] 
//            содержащий кол-во слогов (int) в соответствующем
//            слове из  массива [2] 
//            слову из [i][2][j] соответствует кол-во слогов в [i][3][j]

//подключаем алгоритм выделения ключевых слов
require($CFG->dirroot .'/analise/common/include/keyWordsAnaliseAlghoritm11.inc.php');

//////////////////////////////////////////////////////////////////////////////   
   // Создаем экземпляр phpMorphy 

try 
{
    $morphyNew = new phpMorphy($dir, $lang, $opts);
} 
catch(phpMorphy_Exception $e) 
{
    die('Ошибка при создании экзмпляра phpMorphy : ' . PHP_EOL . $e);
}


try 
{
    for ($i = 0; $i < count($content);$i++)
    {
        for ($j = 0; $j < count($content[$i][2]); $j++)
        {
            $content[$i][2][$j] = $morphyNew->lemmatize($content[$i][2][$j],phpMorphy::NORMAL);
        }                                                                           
    }
} 
catch(phpMorphy_Exception $e) 
{
    die('Error occured while text processing: ' . $e->getMessage());
}

//просмотр по общему массиву $content
for ($i = 0; $i < count($content);$i++)
{
    // просмотр по всем словам данного предложения
    // $localCountKey - счетчик ключевых слов в текущем предложении 
    for ($j = 0, $localCountKey=0; $j < count($content[$i][2]); $j++)
    {
        //просмотр по всем выделенным ключевым словам
        for ($k = 0; $k < count($keyWordsList); $k++)
        {
            //исключаем из сравнений слова, которые
            //PhpMorphy не смог найти в словаре (например на латинице)
            if ( $content[$i][2][$j] !== false)
            {
                //если при работе PhpMorphy было выделено несколько слов
                //то просматриваем их все
                if(is_array($content[$i][2][$j]))
                {
                    for ($l = 0; $l < count($content[$i][2][$j]); $l++)
                    {
                        
                        //если слово в предложении совпало с ключевым
                        if ($content[$i][2][$j][$l] == $keyWordsList[$k])
                        {
                            //увеличиваем счетчик 
                            $localCountKey++;
                        }
                    }
                }
                else
                {
                    //если слово в предложении совпало с ключевым
                    if ($content[$i][2][$j] == $keyWordsList[$k])
                    {
                        //увеличиваем счетчик 
                        $localCountKey++;
                    }
                }
            }
                        
        }
    //$content[4] - кол-во ключевых слов в предложении
    $content[$i][4] = $localCountKey;
    }
}

//находим максимальное значение  $maxCountKeyWords
//среди  колличеств ключевых слов в каждом 
//предложении ($content[$i][4])
$maxCountKeyWords = $content[0][4];
for ($i = 1; $i < count($content); $i++)
{
    if ($content[$i][4] > $maxCountKeyWords)
    {
        $maxCountKeyWords = $content[$i][4];
    }
}



 //определяем общее кол-во слов в тексте
 for ($i = 0, $countWordsAll = 0;$i < count($content); $i++)
 {
     $countWordsAll += $content[$i][1];
 }

 //определяем общее кол-во предложений в тексте
 
  $countSentencesAll = count($content); 

  //определяем общее кол-во слогов в тексте
 for ($i = 0, $countSyllablesAll = 0;$i < count($content); $i++)
 {
     
     for ($j = 0;$j < count($content[$i][3]); $j++) 
     {
         $countSyllablesAll += $content[$i][3][$j];
     }
 }

  //определяем среднюю длину предложения
  $averageSentenceLength = $countWordsAll / $countSentencesAll;
  //определяем среднюю длину слова в слогах      
  $averageWordLength = $countSyllablesAll / $countWordsAll;
  
  //формула Флеша
  $Flesch = 206.835 - ($averageSentenceLength * 1.3 + $averageWordLength * 60.1); 
  //округляем до сотых
  $Flesch = round($Flesch,2);
  
  //уровень образования 
  $educationLevel = (0.39 * $averageSentenceLength) + (11.8 * $averageWordLength) - 15.59;
  //округляем до сотых
  $educationLevel = round($educationLevel,2);

  //формируем список ключевых предложений для внесения в БД
  //предложения разделяются комбинацией " | "
  $toDataBaseSentenceList = "";
  for ($i = 0; $i < count($content); $i++)
{
    if ($content[$i][4] === $maxCountKeyWords)
    {
        $toDataBaseSentenceList .= $content[$i][0];
        $toDataBaseSentenceList .= " | ";

    }
}
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

//удаление не string результатов в массиве 
for ($i = 0; $i < count($keyWordsList); $i++)
{
    if (is_string($keyWordsList[$i]) === false)
    {
        unset($keyWordsList[$i]);
    }  
}


//Выводим ключевые слова на страницу
echo(iconv('windows-1251', "UTF-8", "<h2>Ключевые слова:</h2>"));
echo (implode(" ", $keyWordsList));


//Выводим ключевые предложения на страницу
echo(iconv('windows-1251', "UTF-8", " <br /><br /><h2>Ключевые предложения:</h2>"));
for ($i = 0; $i < count($content); $i++)
{
    if ($content[$i][4] === $maxCountKeyWords)
    {
        echo ($content[$i][0]);
        echo("<br /><br />");
    }
}

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

function divide_to_sentence(&$insideContent)
{
    //Разбиваем по пробельному символу 
    //на массив слов
    $PatternForList = '[\s]';      //паттерн для разбития  
    $insideContent .= ' ';           
    $insideList = preg_split( $PatternForList, $insideContent, -1, PREG_SPLIT_NO_EMPTY ); 
    $upCaseList = 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $endSymbList = '.?!;';
    //пополняемый в дальнейшем список позиций слов, с которых начинается новое предложение
    $firstWordList[0] = 0;
    //и счетчик для этого списка
    $firstWordListCounter = 1;
    //просматриваем все выделенные из текста слова
    for ( $i = 0; $i < count( $insideList ); $i++ )
    {
        //является ли первый символ следующего слова буквой в верхнем регистре   
        if( (strrpos( $upCaseList,$insideList[ $i+1 ][0] )) !== false)
        {
            // позиция последнего символа текущего слова
            $lengthPrevWord = strlen( $insideList[ $i ] ) - 1;
            //если последний символ текущего предыдущего слова является одним из "?!.;"
            if ( (strrpos( $endSymbList,$insideList[ $i ][ $lengthPrevWord ] )) !== false )
            {
                //вносим номер текущего слова в список первых слов предложений
                $firstWordList[ $firstWordListCounter ] = $i;
                $firstWordListCounter++;
            }
        }
       
    }
    //"склеиваем" предложения из отдельных слов.   
    //return $testVariable = create_sentences_from_words ( $firstWordList, $insideList ); 
    $testVariable = create_sentences_from_words ( $firstWordList, $insideList ); 
   
//счетчик предложений
   $i=0; 
   
   foreach ( $testVariable as $elem )
   {
       /*echo ( "<br />" );
       echo(iconv('windows-1251', "UTF-8", "Предложение № "));
       echo ("$i<br />");
       echo ( "\"" );
       echo $elem[ 0 ];
       echo ( "\"" );
       echo ( "<br />" );
       echo(iconv('windows-1251', "UTF-8", "Всего слов: "));
       echo $elem[ 1 ];
       echo ( "<br />" );*/
       //$testVariable[$i][2] - список слов предложения
       //разбиваем предложение на отдельные слова
       $testVariable[$i][2] = preg_split("/[\s]+/",$elem[0]);
      // $testVariable[$i][2] = explode(" ",$elem[0]);
          //счетчик слов в предложении
          $j=0;
          //подсчет кол-ва гласных букв в слове 
          //(совпадает с кол-вом слогов) 
          //просмотр каждого слова текущего предложения
          foreach ($testVariable[$i][2] as $insideElem)
          {
              //счетчик гласных
              //пополняется через поиск каждой из гласных букв
              //в каждом из слов
                  $countChar = 0;
                  $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "а"),"UTF-8");
                  $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "е"),"UTF-8");
                  $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "и"),"UTF-8");
                  $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "о"),"UTF-8");
                  $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "у"),"UTF-8");
                  $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "ы"),"UTF-8");
                  $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "э"),"UTF-8");
                  $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "ю"),"UTF-8");
                  $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "я"),"UTF-8");

                  //заносим кол-во слогов в соответствующую переменную
                  //$testVariable[$i][3] - список колличеств
                  //слогов (глас. букв) в каждом слове предложения
                  $testVariable[$i][3][$j] = $countChar;
                  
             /* echo($testVariable[$i][2][$j]);
              echo(" ---> ");
              echo ($testVariable[$i][3][$j]);
              echo(iconv('windows-1251', "UTF-8", " (слогов)"));*/
              
              
             //переводим слово в верхний регистр
             $testVariable[$i][2][$j] = mb_convert_case($testVariable[$i][2][$j],MB_CASE_UPPER,"UTF-8");
             /*echo(" ---> "); 
             echo($testVariable[$i][2][$j]);
             echo ( "<br />" );*/
             $j++;
          }  
       //echo ( "<br />" );
       $i++;
       
   }
return $testVariable;

}

//функция вызывается из функции divide_to_sentence
//из отдельных слов составляет предложения.
//параметры: 
//1. Список позиций первых слов предложений
//2. Список всех слов

//возвращает массив $sentenceList,
//каждый элемент этого массива - массив из 2х элементов:
//[ 0 ] - само предложение 
//[ 1 ] - кол-во слов в предложении

    function create_sentences_from_words( $firstWordList, $wordsList )
    {
        //счетчик для списка всех слов
        $wordsListCounter = 0;
        //список полученных предложений
        $sentenceList = array();
        //счетчик для  списка полученных предложений
        $sentenceListCounter = 0;
        //по всем позициям первых слов
        for ( $i=0; $i < count( $firstWordList ); $i++)
        {
            $sentenceList[ $sentenceListCounter ][ 0 ] = '';
            //счетчик кол-ва слов в текущем предложении
            $currentSentenceWordsCounter = 0;
            
            //рассматриваем слова текущего предложения, 
            //вплоть до появления первого слова следующего предложения
            //(номер текущего слова не превосходит номера первого слова следующего предложения)
            
            //если это последнее предложение, то склеиваем все слова до конца
            //массива слов
            if ( $i === (count( $firstWordList )) - 1 )
            {
                $endSentence = (count( $wordsList )) - 1;
            }
            else 
            {
                $endSentence = $firstWordList[ $i+1 ];
            }
            
            
            while ( $wordsListCounter <= $endSentence  )
            {
                //включаем слово в предложение
                $sentenceList[ $sentenceListCounter ][ 0 ] .= $wordsList[ $wordsListCounter ];
                //увеличиваем счетчик слов в данном предложении
                $currentSentenceWordsCounter++;
                
                //если это не последнее слово предложения - добавим пробел
                if ( $wordsListCounter !== ($firstWordList[ $i+1 ]) )
                {              
                    $sentenceList[ $sentenceListCounter ][ 0 ] .= ' ';
                }
                
                //переходим к следующему слову
                $wordsListCounter++;
            }
            //обрезаем знак препинания в конце предложения 
            $sentenceList[ $sentenceListCounter ][ 0 ] = substr( ( $sentenceList[ $sentenceListCounter ][ 0 ] ), 0, strlen( $sentenceList[ $sentenceListCounter ][ 0 ] ) - 1 );
            //если предложение завершалось многоточием 
            //проверяем последние 2 символа 
            $tmpLength = strlen( $sentenceList[ $sentenceListCounter ][ 0 ] );
            if ( (( $sentenceList[ $sentenceListCounter ][ 0 ][$tmpLength - 1] ) === '.') && (( $sentenceList[ $sentenceListCounter ][ 0 ][$tmpLength - 2] ) === '.') )
            {
                //обрезаем еще два символа 
                $sentenceList[ $sentenceListCounter ][ 0 ] = substr( ( $sentenceList[ $sentenceListCounter ][ 0 ] ), 0, strlen( $sentenceList[ $sentenceListCounter ][ 0 ] ) - 2 );
            }
            // приводим предложение в нижний регистр
            $sentenceList[ $sentenceListCounter ][ 0 ] = mb_convert_case( $sentenceList[ $sentenceListCounter ][ 0 ], MB_CASE_LOWER,"UTF-8" );
            //вносим в массив кол-во слов в данном предложении
            $sentenceList[ $sentenceListCounter ][ 1 ] = $currentSentenceWordsCounter;
            
            $sentenceListCounter++;
        }
        return $sentenceList;
    }

?>
