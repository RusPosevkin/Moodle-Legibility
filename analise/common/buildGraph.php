<?php
require_once('../../config.php');                             
require_once($CFG->dirroot .'/lib/dmllib.php');
// �������� ID �������, ������ �������� ����� ����������� 
$resourceID = isset($_GET['ID']) ? $_GET['ID'] : false;
$resource = get_record("resource", "id", $resourceID);

require_once( $CFG->dirroot .'/analise/common/include/main_analise.inc.php');
//c����� ������

// ������ ������� ������ 
// ������� ������ - ��� ����, ���������� ��������� ������.
// ������������
// ������ $DATA["x"] �������� ������� �� ��� "X"

$DATA=Array();
for ( $i = 0; $i <= count( $massiv_chastota_sort ); $i++ ) 
{
    $DATA["x"][]=$i;
}
$i = count( $massiv_chastota_sort );
foreach ( $massiv_chastota_sort as $element )
{
    $DATA[0][$i]=$element[0];
   // $DATA[1][]=rand(0,100)/2;
   // $DATA[2][]=rand(0,100)/3;
   $i--;
}
//$count=count($DATA[0])+1;
// ������ ������� ������ 
require_once( $CFG->dirroot .'/analise/common/include/graph.inc.php');


			  
?>
