<?php   
require_once('../../config.php');
// ���������� ���� ��� print_header(), print_footer()                            
require_once($CFG->dirroot .'/lib/weblib.php'); 

// �������� ID �������, ������ �������� ����� ����������� 
$resourceID = isset($_POST['resourceID']) ? $_POST['resourceID'] : false;


$keyWordsList = isset($_POST['keywordslist']) ? $_POST['keywordslist'] : false;
 

$header_direction_post = isset($_POST['header_direction']) ? $_POST['header_direction'] : false;  
$header_meta_post = isset($_POST['header_meta']) ? $_POST['header_meta'] : false;  
$header_title_post = isset($_POST['header_title']) ? $_POST['header_title'] : false;  
$header_bodytags_post = isset($_POST['header_bodytags']) ? $_POST['header_bodytags'] : false;  
$header_focus_post = isset($_POST['header_focus']) ? $_POST['header_focus'] : false;  
$header_home_post = isset($_POST['header_home']) ? $_POST['header_home'] : false;  
$header_menu_post = isset($_POST['header_menu']) ? $_POST['header_menu'] : false;  
$header_heading_post = isset($_POST['header_heading']) ? $_POST['header_heading'] : false;  
$header_navigation_post = isset($_POST['header_navigation']) ? $_POST['header_navigation'] : false;  
$lectionlink = isset($_POST['lectionlink']) ? $_POST['lectionlink'] : false;

// ����������� � ���������� ���
$header_direction = stripslashes(htmlspecialchars_decode($header_direction_post));
$header_meta = stripslashes(htmlspecialchars_decode($header_meta_post));
$header_title = stripslashes(htmlspecialchars_decode($header_title_post));
$header_bodytags = stripslashes(htmlspecialchars_decode($header_bodytags_post));
$header_focus = stripslashes(htmlspecialchars_decode($header_focus_post));
$header_home = stripslashes(htmlspecialchars_decode($header_home_post));
$header_menu = stripslashes(htmlspecialchars_decode($header_menu_post));
$header_heading = stripslashes(htmlspecialchars_decode($header_heading_post));
$header_navigation = stripslashes(htmlspecialchars_decode($header_navigation_post));
$lectionlink = stripslashes(htmlspecialchars_decode($lectionlink));


$header_navigation_array['navlinks'] = $header_navigation;
$header_navigation_array['newnav'] = 1;


$cache = true;
$button='&nbsp;';
$usexml=false;
$return=false;

$header_meta2=' ';




print_header($header_title, $header_heading, $header_navigation_array, $header_focus, $header_meta2, $cache, $button, $header_menu, $usexml, $header_bodytags, $return );
   
//���������� css
require_once($CFG->dirroot .'/analise/common/include/styles.inc.php');


//�������� ���������� � �� ���������� � ����������������� �������������
//�������� ����
require_once($CFG->dirroot .'/analise/common/include/saveKeyWords.inc.php');



/*$phrase1 = '��������� � ������';
$phrase1 = iconv("CP1251", "UTF-8//IGNORE", $phrase1);
echo("<br /><br /><input type='button' onclick=\"document.location='$lectionlink'\" value=\"$phrase1\">");*/

// �������� ������ �������� ����, ����������� �������������

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
//�������� ���� �������� ����� � ���� �������
$KeyWordsList = get_record_sql($sqlStringSelect,false,false);
//���������� � ���������� �������
$KeyWordsList = $KeyWordsList->words;
//��������� ������ �� ��������� ����� � ������� �������
$keyWordsList = explode(",",$keyWordsList);
 

foreach ($keyWordsList as &$element)
{
    $element = trim ($element);
    //if ($element !== "") echo("$element<br />");
}
 
$resource = get_record("resource", "id", $resourceID);
// �������� �������� ����� ����� � ������ ID �� mdl_resources
$content = $resource->alltext;
// ����������� ����� �� ��������� utf-8 � win1251(cp1251)
$content = iconv("UTF-8", "CP1251//IGNORE", $content);
$content1 = $content;
$keyWordsList1 = $keyWordsList;

//���������� �������� ��������� �������� ����
require($CFG->dirroot .'/analise/common/include/keyWordsAnaliseAlghoritm11.inc.php');




















////////////////////////////////////////////////////////////////////////////////////////////////////////
       
//������� ����. �������, ���� � ��.   
html_content_word1( $content );     
$result = htmlspecialchars( "$content" );
$result = strtolower( $result ); 



            
//��������� ������ �� �������� �� ����������� �������            
$PatternForList = '[\s]';      //������� ��� ��������              
$list = preg_split( $PatternForList, $result, -1, PREG_SPLIT_NO_EMPTY ); 
//������� �������
unset( $PatternForList ); 



//�������� ������ �� 2 �������: 
//������� �����
// � 
//�����, ���������� ��������
$i = 0;
$j = 0;
foreach ( $list as $element ) 
{
    //���� ���� ��������� �������
   if( latin_symbols1($element) )
   {
       //����� ����� � ��������� ������ ���������� ����
       $list_eng[$j] = $element;
       $j++;
       //������� �������� �� �������� �������
       unset( $list[$i] ); 
       $i++;
   }
   else $i++; 
} 

 //C�������� ������ �� ��������
 asort($list,SORT_STRING); 

 //������� ������ biglist ���� ���������� ����� � ������� ��������
$biglist=array();
$i=0;
foreach($list as $element)
{
   $biglist[$i]=$element; 
   $biglist[$i]=strtoupper($biglist[$i]);
   $i++; 
}
//////////////////////////////////////////////////////////////////////////////   
   // ������� ��������� phpMorphy 
try {
    $morphy = new phpMorphy($dir, $lang, $opts);
} catch(phpMorphy_Exception $e) {
    die('������ ��� �������� ��������� phpMorphy : ' . PHP_EOL . $e);
}

//���� ����� � ��������� cp1251, ��������������� � utf8
if(function_exists('iconv')) 
{
    foreach($biglist as &$word) 
{
        $word = iconv('windows-1251', $morphy->getEncoding(), $word);
    }
    unset($word);
}

//����������� ����� � ������� �������
$i=0;
foreach($biglist as $word) 
{      
    $biglist[$i]=mb_convert_case($word, MB_CASE_UPPER, "UTF-8");
    $i++;
}

try {
$i=0;
foreach($biglist as $word) 
{      
    $biglist[$i]=$morphy->lemmatize("$word",phpMorphy::NORMAL);
    $i++;
}
} catch(phpMorphy_Exception $e) {
    die('Error occured while text processing: ' . $e->getMessage());
}

//������� ������ � ������� ���������, ������� ������� False
// � ���������� ���������� lemmatize (�� ������� �����������, ���� ��� ���������)

$i=0;
// ����������� ����� �������
foreach( $biglist as $element ) 
{
    if ( ( $element ) && ( $element !== NULL ) ) 
    {
        $biglist2[$i] = $element;
        $i++;
    }    
}

$i=0;
foreach( $biglist2 as $element ) 
{
    $biglist[$i] = $element; 
    $i++;
}

unset( $biglist2 );
 
 //���������� ���������� � ������
$i=0;
$j=2;
foreach($biglist as $elems)
{
    //���� �������� ����� ����� ����������
    //�� �������� � ������� ���-��� ��������
    //���� ���-�� �������� ���������, �� ����� ������
    if(isset($elems[1])) 
    {
     $a=strlen($elems[0]);
     $b=strlen($elems[1]);
     //������� ����������� ����� 
     if ($a<$b)
     {
         $min=$a;
         $point=0;
     }
     else
     {
         $min=$b;
         $point=1;
     }
     $j=2;
     //���� ��������� ������ 2�, �� ������������� � ��
        if(isset($elems[$j]))
        {
            while(isset($elems[$j]))
            {
            $c=strlen($elems[$j]);
            if($c<$min)
            {
                $min=$c;   
                $point=$j;
            } 
            $j++;
            }
        }
     $biglist[$i]=$elems[$point];    
     $i++;  
    }    
    else
    {
        $biglist[ $i ] = $elems[ 0 ]; 
        $i++;
    }
     
}
unset( $a );
unset( $b );
unset( $min );

$i = 0;
//������� ����-����� � NULL ��������
foreach( $biglist as $element )
{
    if (( stop_words_delete1($element) === true ) || ( $element === NULL )) unset($biglist[ $i ]); 
    $i++;
}     
//����������� ����� ������� ����
$biglist = array_values( $biglist );  
 
//���������� ���������� �������
asort( $biglist, SORT_STRING ); 
//����������� ����� ������� ����
$biglist = array_values( $biglist );


//�������� ���������� �����   
$biglist_uniq = array_unique($biglist);
$i = 0;
//����������� ����� ������� ���������� ����
$biglist_uniq = array_unique( $biglist_uniq );

//������������ ������� ������������� ������� �����


//������� ��� ��������� ������� ������� ����
$i = 0;
//������� ��� ��������� ������� ������� ���������� ����
$j = 0;
//�� ���� ��������� ������� ���������� ����
foreach( $biglist_uniq as $uniq ) 
{
    
    //�� ���� ��������� ������� ������� ����
   for( $flag = 0, $count = 0; $i <= count ( $biglist ) ; $i++)
    {
        //���� ���������� ����� ������� � ������� ������
        if ( $uniq == $biglist[ $i ] )
        {   
             //����������� ������� ���������� ����������� ����� � ������� ����
            $count++;
            $flag = 1;
        }
        //����� ��� ���������� �������� ����������� ����� � ���������� ������� ������� ����
        elseif ( $flag == 1 )
        {
            //���������� ����� � ������ ������� ���������� ����
            $words_counts[ $j ][ 0 ] = $uniq;
            //���������� ������� ���������� �����
            $words_counts[ $j ][ 1 ] = $count;
            //��������� �������, ����� ������ �����  � ������� �����
            $i--;
            $j++;
            break;
        }
    }    
}
 
//���������� �� �����������
// �� ������ ������� ��������� ������:
//   $massiv_chastota_sort [ $one ][ $two ]
//  $one - ������ ���������� �����
//  $two = 0    -   ����������� �������������
//  $two = 1    -   ������ ���� ����, ������������� ������� ���, ������� �������� � $massiv_chastota_sort [ $one ][ 0 ]
//  $two = 2    -   ����
$i = 0;
foreach ( $words_counts as $element )
{
    //������� �������� �����������
    $massiv_sort[ $i ] = $element [ 1 ];  
    $i++;  
}
// ���������� ��� ���������� �������� ����������� ���������� ����
$massiv_sort_unique = array_unique( $massiv_sort ); 
//��������� �� �����������  ��� ���������� �������� ����������� ���������� ����
sort( $massiv_sort_unique );

unset( $massiv_sort );

$i = 0;
foreach( $massiv_sort_unique as $uniq )
{
    //$massiv_chastota_element = $massiv_chastota_sort [ $i ];
    //���������� �������� ����������� ���������� ����
    $massiv_chastota_sort [ $i ][ 0 ] = $uniq;
    //�� ���� ��������� ������ ������������ ���������� ����
    $j = 0;
    foreach( $words_counts as $element )
    {
        //���������� ��� �����, � ������ ������������
        if ( $element[ 1 ] == $uniq ) 
        {
            $massiv_chastota_sort [ $i ][ 1 ][ $j ] = $element[ 0 ];
            $j++;
        }
        
    }
    
    $i++;
}

//������ ����, ������� ���������������� ������� ( ������������ ������� - ����������� ���� )
//  ���� ���������� �  $massiv_chastota_sort [ %SomeNumber% ][ 2 ]

$j = count( $massiv_chastota_sort ); 
for ($i = 0; $i < count( $massiv_chastota_sort ); $i++)
{
    $massiv_chastota_sort [ $i ][ 2 ] = $j;
    $j--;
}
     


 
 
 // �-��� ���������� ����-���� � �������            
 function stop_words_delete1(&$words_array_element)
 {
     $stop_words=array
     ("�",
     "��","���",
     "�","��","��","���","���","������","�������","�����",
     "���",
     "���","��������", "��","��",
     "��","���","����","���",
     "��",
     "��",
     "�","��","���","������","������","��",
     "�","���","���-��","���-����","���-������","���-���","�����","�����-������","�����-����","���-�����","�����","�����-��","�������","�������","���","���-��","���-����","���-������","���-���",
     "��","��","����","����",
     "��","���","���","���","���","����",
     "��","���","��������","���","��","��","��","��",
     "�","��","������","�����","��","���","���","���","��","�����",
     "��","�������","�����",
     "���","���","������","�������",
     "�","���","����","����","���","������","������","������","�������","�������","�������","��","����������","����������","�����",
     "���","�����","�����","���","���","������","��","����","�����","����","������","���","��",
     "�","��",
     "����",
     "�����","�����","���","���-��","���-����","�����","����",
     "���","����",
     "�");
     $signal = 0; 
     foreach($stop_words as $stops)
     {
         //����������� ����� �� ������� ����-���� � ��������� utf8 ��� ���������
         $stops = iconv("CP1251", "UTF-8//IGNORE", $stops);
         if ( $stops == $words_array_element ) $signal = 1;
     }
     if ( $signal == 1 ) return true;
     else return false;
 } 
  
 
 
 
 // �-��� ������� �����, ���������� ��������� �������                
 function latin_symbols1(&$word) 
 {
   if (preg_match("'[a-z]+'",$word))  return true;
   else return false;
 }  
     

    
    
       
// �-��� �������� ����. ��������, ����� � ��.               
 function html_content_word1(&$content)
 { 
  //�������� style
  $content = preg_replace ('/<style.*?>[^<>]*?<\/style.*?>/mi',' ',$content);
   
  //�������� javascript
  $content = preg_replace ("'<script[^>]*?>.*?</script>'si", " ", $content);

  //�������� html-�����
  $content = preg_replace ("'<[\/\!]*?[^<>]*?>'si", "", $content);
  
  // ��������� html-���������
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
 //���� ������� ����� ����� ������ !
  $content = preg_replace ("'\!+[�-�]+'i", " ", $content);
  $content = preg_replace ("'\!+[�-�]+'i", " ", $content);
//���� ������� ����� ����� ������ ~ 
  $content = preg_replace ("'\~+[�-�]+'i", " ", $content);
  $content = preg_replace ("'\~+[�-�]+'i", " ", $content);
  
 //�������� ����� 
 //� ���������� ������� 
  $content = preg_replace ("'\-?([0-9])+\.([0-9])+\.'i", " ", $content);
  //����� �����
  $content = preg_replace ("'\-?([0-9])'i", " ", $content);

  // ������� " - " �� " "
  $content = preg_replace ("'([\s]+)-([\s]+)|([\s]+)�([\s]+)'i", " ", $content);  
  
  //������� �����������
    $content = preg_replace ("'(http\:\/\/).+[:space]'i", " ", $content); 
    $content = preg_replace ("'(www\.).+[:space]'i", " ", $content); 
//   // ������ ������� : ; , ? ( ) + * � �
$content = preg_replace ("'[,;:?()\"+*��]'i", " ", $content); 
 //////////////////////// ��������� "�������"
 ////////////////////// 
  // ������ ������� : ; , ? ( ) + * � � \ | =
  $content = preg_replace ("'[,;:?!()\"+*��\/\|=]'i", " ", $content); 
   /////////////////////
   /////////////////////
  
   //�������� ���������� 
  $content = preg_replace ("'(�\.�\.|�\.�\.|�\.�\.|�\.�\.|�\.�\.|��\.|�\.|���\.)'i"," ", $content);
   //������ ����� � �� �
  $content = preg_replace ("'�'i","�", $content);
   //�������� "." �� " " ������ ���� ����� �� ���� ����� �����    
   $content = preg_replace("'([^0-9])\.'i",'$1 ',$content);
   
}            
////////////////////////////////////////////////////////////////////////////////////////////////////////
             

  


















/*$i=0;
for ($i = 0; $i < count($massiv_chastota_sort); $i++)
{
    for($j = 0; $j < count($massiv_chastota_sort[$i]); $j++)
    {
        //if ($j === 1) 
        echo("<br />");
        var_dump($massiv_chastota_sort[$i][$j]);
    }
    echo("<br /><br />");
}    */

//var_dump($massiv_chastota_sort);

$content = $content1;

//���������� �������� ��������� �����������
require_once($CFG->dirroot .'/analise/common/include/getSentences.inc.php');


print_footer();
?>