<?php
//$keySentencesList = isset($_POST['keysentenceslist']) ? $_POST['keysentenceslist'] : false; 

//�������� ������ ����������� � ���� ��� ��������� � ��
$pattern = chr(10);
$pattern .= chr(13);
$pattern .= chr(10);                                                                            
$toDataBaseSentenceList = str_replace($pattern, "|", $keySentencesList);

/*
//� �� ��������� ������ �����, ����� � ������� "-", "/", ",","|","&" � ������
//��������� ������� ����������
$pattern  = '��������������������������������';
$pattern .= '�����Ũ��������������������������';
$pattern .= '0123456789';
$pattern .= '/, -|';
$pattern = iconv("CP1251", "UTF-8//IGNORE", $pattern);
$valuestring = '';

for( $i=0; $i < strlen($toDataBaseSentenceList); $i++ )
{
    
    //���� ������ ������ � ������ �����������
    if ( strrpos( $pattern, $toDataBaseSentenceList[ $i ] )!== false )
    {
        $valuestring .= $toDataBaseSentenceList[ $i ];
    }
}
*/



//���������� ���� ������ � ��
  
 //������ ����� ������, ��� ����������� 
//��������� � SQL-������
//������� �������
$prefix = $CFG->prefix;
//�������� �������
$tablename = 'keywords';
//�������� ���� ������� - �������������
$idfield = 'id';
//�������� ���� ������� - �������� �����������
$sentencesfield = 'sentences';
//�������� ���� ������� - ���������� �������������� (������ �����)
$fleschfield = 'flesch';
//�������� ���� ������� - ������� ����������� 
$edulevelfield = 'edulevel';

//����� ������ id �������, � ������� ��������
$idstring = $resourceID;





//���������� SQL-������ ��� ������� �������� ����
//��� ������� � ��������������� $idstring
$sqlStringSelect = "SELECT $sentencesfield from $prefix".$tablename." WHERE $idfield=$idstring";
$sqlStringSelect2 = "SELECT $fleschfield from $prefix".$tablename." WHERE $idfield=$idstring";
$sqlStringSelect3 = "SELECT $edulevelfield from $prefix".$tablename." WHERE $idfield=$idstring";

  
//� ���������� �������� ������, ���������� ��
//������ � ��������������� $idstring
$isExist = record_exists_sql($sqlStringSelect);
$isExist2 = record_exists_sql($sqlStringSelect2);
$isExist3 = record_exists_sql($sqlStringSelect3);

//���� ������� c ������ ��������������� ���, 
//�� ��������� ������
if( $isExist === false  )
{
    //SQL-������ �� ���������� ���������� � ������� - �������� �����������
    $sqlstring2 = "INSERT INTO ".$prefix."$tablename ($idfield, $sentencesfield) VALUES ('".$idstring."', '".$toDataBaseSentenceList."')";
    execute_sql($sqlstring2,false);
    
}
//���� ����, �� ��������� ������
else
{
    //SQL-������ �� ���������� ���������� � ������� - �������� �����������
    $sqlstring2 = "UPDATE ".$prefix."$tablename SET $sentencesfield='$toDataBaseSentenceList' WHERE $idfield=$idstring";
    execute_sql($sqlstring2,false);
}

//���� ������� c ������ ��������������� ���, 
//�� ��������� ������
if( $isExist2 === false  )
{
    //SQL-������ �� ���������� ���������� � ������� - ������ ��������������� �����
    $sqlstring2 = "INSERT INTO ".$prefix."$tablename ($idfield, $fleschfield) VALUES ('".$idstring."', '".$Flesch."')";
    execute_sql($sqlstring2,false);
}
//���� ����, �� ��������� ������
else
{
    //SQL-������ �� ���������� ���������� � ������� - ������ ��������������� �����
    $sqlstring2 = "UPDATE ".$prefix."$tablename SET $fleschfield='$Flesch' WHERE $idfield=$idstring";
    execute_sql($sqlstring2,false);
}
  
//���� ������� c ������ ��������������� ���, 
//�� ��������� ������
if( $isExist3 === false  )
{
    //SQL-������ �� ���������� ���������� � ������� - ������� �����������
    $sqlstring2 = "INSERT INTO ".$prefix."$tablename ($idfield, $edulevelfield) VALUES ('".$idstring."', '".$educationLevel."')";
    execute_sql($sqlstring2,false);
}
//���� ����, �� ��������� ������
else
{
    //SQL-������ �� ���������� ���������� � ������� - ������� �����������
    $sqlstring2 = "UPDATE ".$prefix."$tablename SET $edulevelfield='$educationLevel' WHERE $idfield=$idstring";
    execute_sql($sqlstring2,false);
}




///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
 //�������� ���� ������� - �������� �����
 $wordsfield = 'words';
       
 //���������� SQL-������ ��� ������� ���� ������ 
 //��� ������� � ��������������� $idstring
 $sqlStringSelect = "SELECT $wordsfield from $prefix".$tablename." WHERE $idfield=$idstring";
        
 //� ���������� �������� ������, ���������� ��
 //������ � ��������������� $idstring
 $isExistWords= record_exists_sql($sqlStringSelect);
 //���� ������ c ������ ��������������� ����
 if( $isExistWords === true  )
 {
    //�������� ���� �������� ����� � ���� �������
    $KeyWordsList = get_record_sql($sqlStringSelect,false,false);
    //���������� � ���������� �������
    $KeyWordsList = $KeyWordsList->words;                  
 }       




///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////





//������� �������� ����� �� ��������
echo(iconv('windows-1251', "UTF-8", "<h2>�������� �����:</h2>"));
echo($KeyWordsList); 


//������� �������� ����������� �� ��������
echo(iconv('windows-1251', "UTF-8", " <br /><br /><h2>�������� �����������:</h2>"));
 
//���������, ��� ����, �������� �����
$pattern = chr(10);
$pattern .= chr(13);
$pattern .= chr(10);                                                                            
$keySentencesList = str_replace($pattern, "<br /><br />", $keySentencesList);

echo ($keySentencesList);

//������� ������ ��������������� ����� �� ��������
echo(iconv('windows-1251', "UTF-8", " <h2>������ ��������������� �����:</h2>"));
echo("<h1>$Flesch</h1>");

//������� ������� ����������� �� ��������
echo(iconv('windows-1251', "UTF-8", " <br /><h2>������� �����������:</h2>"));
echo("<h1>$educationLevel</h1>");

//������ "��������� � ������"
$phrase1 = '��������� � ������';
$phrase1 = iconv("CP1251", "UTF-8//IGNORE", $phrase1);
echo("<br /><br /><input type='button' onclick=\"document.location='$lectionlink'\" value=\"$phrase1\">");



?>
