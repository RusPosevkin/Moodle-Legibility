<?php
// �������������� PHP Morphy
// ���������� ���������� phpmorphy
require_once($CFG->dirroot .'/analise/src/common.php');


// ������������� �����
$opts = array(
    // storage type, follow types supported
    // PHPMORPHY_STORAGE_FILE - use file operations(fread, fseek) for dictionary access, this is very slow...
    // PHPMORPHY_STORAGE_SHM - load dictionary in shared memory(using shmop php extension), this is preferred mode
    // PHPMORPHY_STORAGE_MEM - load dict to memory each time when phpMorphy intialized, this useful when shmop ext. not activated. Speed same as for PHPMORPHY_STORAGE_SHM type
    'storage' => PHPMORPHY_STORAGE_FILE,
    // �������� ������������ �� ��������
 //   'predict_by_suffix' => true, 
    // �������� ������������ �� ��������
//    'predict_by_db' => true,
    // TODO: comment this
    'graminfo_as_text' => true,
);

// ���� � ����� �� ���������
$dir = $CFG->dirroot .'/analise/dicts';

$lang = 'ru_RU';

//������������� phpmorphy ��������� 





			  
?>
