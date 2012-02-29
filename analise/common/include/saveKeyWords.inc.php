<?php   
require_once('../../config.php');


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
//�������� ���� ������� - �������� �����������
$sentencesfield = 'sentences';
//�������� ���� ������� - ���������� �������������� (������ �����)
$fleschfield = 'flesch';
//�������� ���� ������� - ������� ����������� 
$edulevelfield = 'edulevel';

//����� ������ id �������, � ������� ��������
$idstring = $resourceID;


//���� ������� KEYWORDS ��� �� �������, ������� ��

//SQL-������ �� �������� �������
//�������� ������� �������������� � ��� ������, ���� �� �� ���� ������� �����
$sqlstring = "CREATE TABLE IF NOT EXISTS ".$prefix."$tablename ($idfield INT NOT NULL,$wordsfield LONGTEXT,$sentencesfield LONGTEXT,$fleschfield FLOAT,$edulevelfield FLOAT)";
execute_sql($sqlstring,false);


//���������� SQL-������ ��� ������� ���� ������ 
//��� ������� � ��������������� $idstring
$sqlStringSelect = "SELECT words from $prefix".$tablename." WHERE $idfield=$idstring";

//��������� ������ ��� ���������� � �������
//�������� ������ - �������� �����
$valuestringBefore = $keyWordsList;
//���� ���� �����-�� �����������, ����������� ��
//$valuestring = htmlspecialchars($valuestring);

//� �� ��������� ������ �����, ����� � ������� "-", "/", ",","&" � ������
//��������� ������� ����������
$pattern  = '��������������������������������';
$pattern .= '�����Ũ��������������������������';
$pattern .= '0123456789';
$pattern .= '/, -';
$pattern = iconv("CP1251", "UTF-8//IGNORE", $pattern);
$valuestring = ' ';

for( $i=0; $i < strlen($valuestringBefore); $i++ )
{
    
    //���� ������ ������ � ������ �����������
    if ( strrpos( $pattern, $valuestringBefore[ $i ] )!== false )
    {
        $valuestring .= $valuestringBefore[ $i ];
    }
}
//$valuestring = iconv("UTF-8", "CP1251//IGNORE", $valuestring);
//echo($valuestring);


//� ���������� �������� ������, ���������� ��
//������ � ��������������� $idstring
$isExistWords = record_exists_sql($sqlStringSelect);

//���� ������� c ������ ��������������� ���, 
//�� ��������� ������
if( $isExistWords === false  )
{
    //SQL-������ �� ���������� ���������� � �������
    $sqlstring2 = "INSERT INTO ".$prefix."$tablename ($idfield, $wordsfield) VALUES ('".$idstring."', '".$valuestring."')";
    execute_sql($sqlstring2,false);
}
//���� ����, �� ��������� ������
else
{
    //SQL-������ �� ���������� ���������� � �������
    $sqlstring2 = "UPDATE ".$prefix."$tablename SET $wordsfield='$valuestring' WHERE $idfield=$idstring";
    execute_sql($sqlstring2,false);
}



?>