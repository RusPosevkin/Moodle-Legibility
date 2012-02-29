<?php
require_once('../../config.php');                               
require_once($CFG->dirroot .'/lib/dmllib.php');

//���������� �������� ��������� �������� ���� - ����� 1
require_once($CFG->dirroot .'/analise/common/include/keyWordsAnaliseAlghoritm1.inc.php');
// �������� ID �������, ������ �������� ����� ����������� 
$resourceID = isset($_POST['resourceID']) ? $_POST['resourceID'] : false; 
$resource = get_record("resource", "id", $resourceID);
// �������� �������� ����� ����� � ������ ID �� mdl_resources
$content = $resource->alltext;
// ����������� ����� �� ��������� utf-8 � win1251(cp1251)
$content = iconv("UTF-8", "CP1251//IGNORE", $content);
//���������� �������� ��������� �������� ���� - ����� 2
require_once($CFG->dirroot .'/analise/common/include/keyWordsAnaliseAlghoritm2.inc.php');

//�������� ������ �� ����� (���������� �������� ����)
$firstPercent = isset( $_POST[ "first" ] ) ? $_POST[ "first" ] : false;
$lastPercent = isset( $_POST[ "last" ] ) ? $_POST[ "last" ] : false;



//������� ������ ������������ ����������� � ������������ ������� ������
//$massiv_percents = array[ count( $massiv_chastota_sort ) ];
//����� 100% �� ���-�� ������ -1, ����� ���������� ������� ��������� ���������� �� ���� ����
$rang_percent = 100 / ( count( $massiv_chastota_sort )-1  );
$massiv_percents[ 1 ] =  0;
$massiv_percents[ count( $massiv_chastota_sort ) ] =  100;
for( $i = 2; $i < count( $massiv_chastota_sort ); $i++)
{
    $massiv_percents[ $i ] = ($i-1) * $rang_percent;
}
//��������� ����� �������� ������ ������� ���� ������ �����
if (( $firstPercent > $lastPercent ) || ( $lastPercent > 100 ) || ( $firstPercent < 0 ) || (preg_match('([^0-9])',$lastPercent)) || preg_match('([^0-9])',$firstPercent) || ($firstPercent === false) || ($lastPercent === false)) 
{
        $outputPhrase100 = '������� ������ �������';  
        $outputPhrase100 = iconv("CP1251", "UTF-8//IGNORE", $outputPhrase100);  
        echo( $outputPhrase100 );
        echo('<meta http-equiv="Refresh" content=" 1; url=error.php">');    
}
else
{
//���� ���������� �������� ������ � �������� ���������
//���� ������ �� �����, ��
//����� ������� - ��������� �� ��������
//������ ������� - ��������� �� ��������
for( $i = 1, $flag1 = true, $flag2 = true ; $i <= count( $massiv_percents ); $i++)
{
    //�������� ��� ���� �������?
    if( $flag1 )
    {
        //���� ����� ����� ����� �� �������� ����� ������� ��� � �����
        if ($massiv_percents[ $i ] == $firstPercent) 
        {
                //���������� � ���������� ���� � false, ����� ������ �� �������� � ����� ��������
            $masBorder[ 0 ] = $i;
            $flag1 = false;
        }
        //���� ����� ����� ��������  ����� ������� �������, ��� ������� � �����
        if ($massiv_percents[ $i ] > $firstPercent) 
        {
            //���������� ���������� � ���������� ���� � false, ����� ������ �� �������� � ����� ��������
            $masBorder[ 0 ] = $i-1;
            $flag1 = false;
        }
    }
    //�������� ��� ���� �������?
    if( $flag2 )
    {
        //���� ����� ����� ����� �� �������� ������ ������� ��� � �����
        if ($massiv_percents[ $i ] == $lastPercent) 
        {
            //���������� � ���������� ���� � false, ����� ������ �� �������� � ������ ��������
            $masBorder[ 1 ] = $i;
            $flag2 = false;
        }
        //���� ����� ����� ��������  ����� ������� �������, ��� ������� � �����
        if ($massiv_percents[ $i ] > $lastPercent) 
        {
            //���������� � ���������� ���� � false, ����� ������ �� �������� � ������ ��������
            $masBorder[ 1 ] = $i;
            $flag2 = false;
        }
    }
}
unset($elem);
//���������� �������� ����� �� ����������������� ���������
$k = 0;     //������� ������� �������� ���� ����������������� ���������
//������ �������� ������ 
for ($i = $masBorder[ 0 ]; $i <= $masBorder[ 1 ]; $i++)
{
    //���������� ��� �������� ������� $massiv_chastota_sort 
    for($j = ( count( $massiv_chastota_sort ) ) - 1; $j > 0;$j--)
    {
        //����� ������ � ������ ������
        if ( $massiv_chastota_sort[ $j ][ 2 ] === $i )
        {
            //���������� ���� ������ ����, ��������� � ������ ������ 
            // � ������ ���������������� �������� ����
            foreach ($massiv_chastota_sort[ $j ][ 1 ] as $elem)
            {
                $UserKeyWords[ $k ] = $elem;
                $k++;
            }            
        }
    }
}
//���������� ���������� �������
 asort( $UserKeyWords, SORT_STRING ); 
//����������� ����� ������� ����
 $biglist = array_values( $UserKeyWords );

//������� �� �����


// �������� ������������� ����, ��� ��������� �������� �������
$yes = isset($_POST['analise']) ? $_POST['analise'] : false;
// �������� ID �������, ������ �������� ����� ����������� 
$resourceID = isset($_POST['resourceID']) ? $_POST['resourceID'] : false;

//��� �������� TEXTAREA 
//���������� �������� (������ ����� �� ������)
$textareaCountCol = 100;
//���������� ����� (������ ����� �� ������)
$textareaCountRow = 8;

$outputPhrase1 = '������ �������� ���� ��� ���������� ���� ��������� (�� <strong>';
$outputPhrase2 = '</strong> % �� <strong>';
$outputPhrase3 = '</strong> %):';
$outputPhrase4 = '��������� � ������ ��������� ��������';
$outputPhrase5 = '����������';
$outputPhrase6 = '����� ���������� �������� ������ ����� �������';
$outputPhrase7 = '������ �������� ����, ����������� �����:';
$outputPhrase8 = '��������� �������� ����� � ���������� �������� ����������� � ���������';
$outputPhrase9 = '�������� ��������� ������������� ���������� �������� ����';



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

// ���� ������� �� �������� �� �������� � ��������� � �������� ID �������
// ���������� ��������
if ( ($yes) && ($resourceID) )
{
    //���������� css
    require_once($CFG->dirroot .'/analise/common/include/styles.inc.php');
    
    echo("<form action=\"saveKeyWords.php\" method=\"post\">");
    echo("<table align='center'><tr><td align='center'><h3>$outputPhrase1 $firstPercent$outputPhrase2$lastPercent $outputPhrase3 </h3></td></tr><br />");
           
     //� ��� ���������� ���������� ��� ���������� �������� �����
    $fullText = '';
    //��������������� � ������ ��������� � 
    //�������� � ������ ����� �������
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
        //    ��������� �������� �����, ���� ���� ��������� �����    //
        ///////////////////////////////////////////////////////////////
         
        
        //���������� ��� ������� � �������� ������ � SQL-���������
        require_once($CFG->dirroot .'/lib/ddllib.php');


        //������ ����� ������, ��� ����������� 
        //��������� � SQL-������
        //������� �������
        $prefix = $CFG->prefix;
        //�������� �������
        $tablename = 'keywords';
        //�������� ���� ������� - �������������
        $idfield = 'id';
        //�������� ���� ������� - �������� �����
        $wordsfield = 'words';

        //����� ������ id �������, � ������� ��������
        $idstring = $resourceID;
        
        //���������� SQL-������ ��� ������� ���� ������ 
        //��� ������� � ��������������� $idstring
        $sqlStringSelect = "SELECT words from $prefix".$tablename." WHERE $idfield=$idstring";
        
        //� ���������� �������� ������, ���������� ��
        //������ � ��������������� $idstring
        $isExistWords = record_exists_sql($sqlStringSelect);

        //���� ������ c ������ ��������������� ����
        if( $isExistWords === true  )
        {
            //�������� ���� �������� ����� � ���� �������
            $oldKeyWordsList = get_record_sql($sqlStringSelect,false,false);
            //���������� � ���������� �������
            $oldKeyWordsList = $oldKeyWordsList->words;
              
            
            //������� �� ����� � ������� TEXTAREA
            //������ �������� ����, ����������� �����   
            echo("<table align='center'><tr><td align='center'><h3>$outputPhrase7  </h3></td></tr><br />");
            echo("<tr><td align=\"center\"><TEXTAREA name=keywordslistold rows=$textareaCountRow cols=$textareaCountCol disabled value='$oldKeyWordsList' >");
        echo($oldKeyWordsList);
        echo('</TEXTAREA></td></tr></table><br />');
            
        }
        //������ "����������"
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
        //������ "��������� � ������ ��������� ��������"
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
        
       
       //�������� ��������� ������������� ���������� �������� ����
       
       //�������������� ������ � ����������� ��������� ������� ���
       //�������� �� �������� � ������� ��������� �������������
       $UserKeyWordsOutput = implode("|",$UserKeyWords);
       
       for ($i = 0; $i < count($UserKeyWords); $i++)
       {
               for ($j = 0; $j < count($massiv_chastota_sort); $j++)
               {
                   for ($k = 0; $k < count($massiv_chastota_sort[$j][1]); $k++)
                   {
                       //���� �������� ����� ������� � ������� �������� ����
                       //� ������������ �������� �������������,
                       //�� ���������� ��� �������
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
       
       //�������������� ������ � ���������� ���-���� �������� ���� ���
       //�������� �� �������� � ������� ��������� �������������
       $UserKeyWordsNumericOutput = implode("|",$UserKeyWordsNumeric);
          
       //������ "�������� ��������� ������������� ���������� �������� ����"
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
