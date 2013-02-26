<?php
//���������� ����� ���-�� ����������� � ������ 
$countSentencesAll = count($content);

//������������ ���-�� �����������, ������� ����������
//�������� ��� ��������
$SentencePercentsGet = $SentencePercents; 
$SentencePercents = $SentencePercents / 100;
$SentencePercents = $SentencePercents * $countSentencesAll;
$SentencePercents = round($SentencePercents);        


 //���������� ����� ���-�� ���� � ������
 for ($i = 0, $countWordsAll = 0;$i < count($content); $i++)
 {
     $countWordsAll += $content[$i][1];
 }

 

  //���������� ����� ���-�� ������ � ������
 for ($i = 0, $countSyllablesAll = 0;$i < count($content); $i++)
 {
     
     for ($j = 0;$j < count($content[$i][3]); $j++) 
     {
         $countSyllablesAll += $content[$i][3][$j];
     }
 }

  //���������� ������� ����� �����������
  $averageSentenceLength = $countWordsAll / $countSentencesAll;
  //���������� ������� ����� ����� � ������      
  $averageWordLength = $countSyllablesAll / $countWordsAll;
  
  //������� �����
  $Flesch = 206.835 - ($averageSentenceLength * 1.3 + $averageWordLength * 60.1); 
  
  
  //������� ����������� 
  $educationLevel = (0.39 * $averageSentenceLength) + (11.8 * $averageWordLength) - 15.59;

  
  
  require_once('cor.inc.php');
  
  //��������� �� �����
  $Flesch = round($Flesch,2);  
  //��������� �� �����
  $educationLevel = round($educationLevel,2);
  
  require_once('mamdani.inc.php');

?>
