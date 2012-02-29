<?php   

$outputPhrase1 = 'Ключевое предложение'; 
$outputPhrase2 = 'Частота встречаемости всех слов предложения'; 
$outputPhrase1 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase1); 
$outputPhrase2 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase2); 

  echo(" <br/> 
 <div align='center'>
 <table border=1 cellpadding=5>
  <tr align='center'>
    <th>$outputPhrase1</th>
    <th>$outputPhrase2</th>
  </tr>
  ");
  for ($i = 0; $i < count($keySentences); $i++)
  {
        echo("<tr align='center'><td>");
        echo ($keySentences[$i]);
        echo("</td><td>");
        echo ($keySentencesNumeric[$i]);
        echo("</td></tr>");
        
  } 
  echo("</table></div>");


    
?>