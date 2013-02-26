<?php
//определяем общее кол-во предложений в тексте 
$countSentencesAll = count($content);

//рассчитываем кол-во предложений, которое необходимо
//выделить как ключевые
$SentencePercentsGet = $SentencePercents; 
$SentencePercents = $SentencePercents / 100;
$SentencePercents = $SentencePercents * $countSentencesAll;
$SentencePercents = round($SentencePercents);        


 //определяем общее кол-во слов в тексте
 for ($i = 0, $countWordsAll = 0;$i < count($content); $i++)
 {
     $countWordsAll += $content[$i][1];
 }

 

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
  
  
  //уровень образования 
  $educationLevel = (0.39 * $averageSentenceLength) + (11.8 * $averageWordLength) - 15.59;

  
  
  require_once('cor.inc.php');
  
  //округляем до сотых
  $Flesch = round($Flesch,2);  
  //округляем до сотых
  $educationLevel = round($educationLevel,2);
  
  require_once('mamdani.inc.php');

?>
