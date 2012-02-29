<?php   

$outputPhrase1 = 'Ключевое слово'; 
$outputPhrase2 = 'Частота встречаемости'; 
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
  for ($i = 0; $i < count($keyWords); $i++)
  {
        echo("<tr align='center'><td>");
        echo ($keyWords[$i]);
        echo("</td><td>");
        echo ($keyWordsNumeric[$i]);
        echo("</td></tr>");
        
  } 
  echo("</table></div>");


    
?>