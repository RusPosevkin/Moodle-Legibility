<?php
$header_meta_post = htmlspecialchars($header_meta);
$header_title_post = htmlspecialchars($header_title);
$header_bodytags_post = htmlspecialchars($header_bodytags);
$header_focus_post = htmlspecialchars($header_focus);
$header_home_post = htmlspecialchars($header_home);
$header_menu_post = htmlspecialchars($header_menu);
$header_heading_post = htmlspecialchars($header_heading);
$header_navigation_post = htmlspecialchars($header_navigation);


//��� �������� TEXTAREA 
//���������� �������� (������ ����� �� ������)
$textareaCountCol = 100;
//���������� ����� (������ ����� �� ������)
$textareaCountRow = 20;


$outputPhrase1 = '������ �������� ����������� (<strong>';
$outputPhrase2 = '%</strong> ):';
$outputPhrase3 = '����������� ���������� ��������, �������� ������ �������'; 
$outputPhrase4 = '������ �������� �����������, ����������� �����'; 
$outputPhrase5 = '��������� �������� ����������� � ����������';
$outputPhrase6 = '��������� � ������ ��������� ��������';
$outputPhrase7 = '�������� ��������� ������������� ���������� �������� �����������';


$outputPhrase1 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase1);
$outputPhrase2 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase2);
$outputPhrase3 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase3);
$outputPhrase4 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase4);
$outputPhrase5 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase5);
$outputPhrase6 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase6);
$outputPhrase7 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase7);



   //������� �� ����� � ������� TEXTAREA
        //������ �������� �����������   
        echo("<form action=\"all_info.php\" method=\"post\"><table align='center'><tr><td align='center'><h3>$outputPhrase1 $SentencePercentsGet $outputPhrase2 </h3></td></tr><br />");
        //echo("<tr><td align=\"center\"><TEXTAREA name=keysentenceslist rows=$textareaCountRow cols=$textareaCountCol value='$oldKeyWordsList' >");
        echo("<tr><td align=\"center\"><TEXTAREA name=keysentenceslist rows=$textareaCountRow cols=$textareaCountCol>");
       
        //������� �������� ����������� �� ��������
        for ($i = 0; $i < $SentencePercents; $i++) 
        {
                //��������� �� ������ ���������� ����� � ������� $content � ����������� ��������� �������
                $pointer = $keySentences_percents[$i][0];
                echo($content[$pointer][0]);
                echo(chr(10));
                echo(chr(10));
        }  
        
        
        echo('</TEXTAREA></td></tr></table><br />');
        echo("<div align='right'><b>($outputPhrase3)</b></div>");      
        
 //������� �������� �����������, ������� ��� ���� ��������� � ��
 
 //������ ����� ������, ��� ����������� 
 //��������� � SQL-������
 //������� �������
 $prefix = $CFG->prefix;
 //�������� �������
 $tablename = 'keywords';
 //�������� ���� ������� - �������������
 $idfield = 'id';
 //�������� ���� ������� - �������� �����
 $sentencesfield = 'sentences';

 //����� ������ id �������, � ������� ��������
 $idstring = $resourceID;
        
 //���������� SQL-������ ��� ������� ���� ������ 
 //��� ������� � ��������������� $idstring
 $sqlStringSelect = "SELECT $sentencesfield from $prefix".$tablename." WHERE $idfield=$idstring";
        
 //� ���������� �������� ������, ���������� ��
 //������ � ��������������� $idstring
 $isExistSentences= record_exists_sql($sqlStringSelect);
 //���� ������ c ������ ��������������� ����
 if( $isExistSentences === true  )
 {
    //�������� ���� �������� ����� � ���� �������
    $oldKeySentencesList = get_record_sql($sqlStringSelect,false,false);
    //���������� � ���������� �������
    $oldKeySentencesList = $oldKeySentencesList->sentences;          
    $pattern = chr(10);
    $pattern .= chr(10);
    $oldKeySentencesList = str_replace ("|", $pattern , $oldKeySentencesList);
            
    if ($oldKeySentencesList)
    {
        //������� �� ����� � ������� TEXTAREA
        //������ �������� ����, ����������� �����   
        echo("<table align='center'><tr><td align='center'><h3>$outputPhrase4  </h3></td></tr><br />");
       // echo("<tr><td align=\"center\"><TEXTAREA name=keywordslistold rows=$textareaCountRow cols=$textareaCountCol disabled value='$oldKeySentencesList' >");
        echo("<tr><td align=\"center\"><TEXTAREA name=keywordslistold rows=$textareaCountRow cols=$textareaCountCol disabled >");
        echo($oldKeySentencesList);
        echo('</TEXTAREA></td></tr></table><br />');
    }            
 }       
        
        
        
        //������ "����������"
        echo("<input type=\"hidden\" name=\"resourceID\" value=\"$resourceID\">
        <input name=\"analise\" value=\"yes\" type=\"hidden\"> 
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
        <input name=\"flesch\" value=\"$Flesch\" type=\"hidden\">
        <input name=\"educationlevel\" value=\"$educationLevel\" type=\"hidden\">
        <input name=\"quality\" value=\"$textQuality\" type=\"hidden\">
        <input type=\"submit\" value=\"$outputPhrase5\"></form>");
        
        echo("<br />");
        
        //������ "��������� � ������ ��������� ��������"
        echo("
        <br />
        <form action=\"keyWords_main.php\" method=\"post\">   
        <input type=\"hidden\" name=\"resourceID\" value=\"$resourceID\">
        <input name=\"analise\" value=\"yes\" type=\"hidden\"> 
        <input name=\"first\" value=\"$first\" type=\"hidden\"> 
        <input name=\"last\" value=\"$last\" type=\"hidden\"> 
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
        <input type=\"submit\" value=\"$outputPhrase6\">
        </form>
        ");  
        
        //������ "�������� ��������� ������������� ���������� �������� ����"
        echo("
        <form action=\"numeric_sentences.php\" method=\"post\" target=\"_blank\">
        <input type=\"hidden\" name=\"resourceID\" value=\"$resourceID\">
        <input name=\"analise\" value=\"yes\" type=\"hidden\"> 
        <input name=\"first\" value=\"$firstPercent\" type=\"hidden\"> 
        <input name=\"last\" value=\"$lastPercent\" type=\"hidden\"> 
        <input name=\"lectionlink\" value=\"$lectionlink\" type=\"hidden\">
        <input name=\"sentences\" value=\"$toDataBaseSentenceList\" type=\"hidden\">
        <input name=\"numeric\" value=\"$numericSentencesOutput\" type=\"hidden\">
        <input name=\"header_direction\" value=\"$header_direction_post\" type=\"hidden\">
        <input name=\"header_meta\" value=\"$header_meta_post\" type=\"hidden\">
        <input name=\"header_title\" value=\"$header_title_post\" type=\"hidden\">
        <input name=\"header_bodytags\" value=\"$header_bodytags_post\" type=\"hidden\">
        <input name=\"header_focus\" value=\"$header_focus_post\" type=\"hidden\">
        <input name=\"header_home\" value=\"$header_home_post\" type=\"hidden\">
        <input name=\"header_menu\" value=\"$header_menu_post\" type=\"hidden\">
        <input name=\"header_heading\" value=\"$header_heading_post\" type=\"hidden\">
        <input name=\"header_navigation\" value=\"$header_navigation_post\" type=\"hidden\">         
        <input type=\"submit\" value=\"$outputPhrase7\"></form>");
  
?>
