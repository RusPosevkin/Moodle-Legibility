<?php
//реализация алгоритма Mamdani
//инклудится в include/numeric.inc.php

// преобразование количественных характеристик 
// (Уровень образования и Индекс Флеша)
//  в качественные  
$Flesch_quality = '';
$eduLevel_quality = '';

// границы интервалов   
   $border_left[1] = 0;
   $border_right[1] = 1;
   
   $border_left[2] = 0.8;
   $border_right[2] = 2;
   
   $border_left[3] = 1.8;
   $border_right[3] = 3;
   
   $border_left[4] = 2.8;
   $border_right[4] = 4;
   
   $border_left[5] = 3.8;
   $border_right[5] = 5;
   
 // Инициализация функций
 
 //Функции входных переменных 
    //Индекс Флеша
 flesch_high ($flesch_level);
 flesch_medium ($flesch_level);
 flesch_low ($flesch_level);
 
    //Уровень образования
 edulevel_high ($edulevel_level);
 edulevel_medium ($edulevel_level);
 edulevel_low ($edulevel_level);
 
 
 //Функции расчета периметра и центра тяжести трапеции
 centerOfGravity_isosceles ($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid);
 centerOfGravity_90_left ($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid);
 centerOfGravity_90_right ($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid);
 perimeter_trapezoid_isosceles($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid);         
 perimeter_trapezoid_90($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid); 
 
 //Функции расчета центра тяжести сложной фигуры
 //Перебираются все возможные сочетания трапеций выходной переменной
 // Простая фигура - одна трапеция
 ql_one ($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid,$border_left,$border_right);
 ql_two ($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid,$border_left,$border_right);
 ql_three ($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid,$border_left,$border_right);
 ql_four ($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid,$border_left,$border_right);
 ql_five ($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid,$border_left,$border_right);
 
 
 //Сложная фигура - пересечение двух трапеций
 ql_one_two ($up_base_trapezoid1,$down_base_trapezoid1,$height_trapezoid1,
             $up_base_trapezoid2,$down_base_trapezoid2,$height_trapezoid2,$border_left,$border_right);
 ql_two_three ($up_base_trapezoid1,$down_base_trapezoid1,$height_trapezoid1,
               $up_base_trapezoid2,$down_base_trapezoid2,$height_trapezoid2,$border_left,$border_right);
 ql_three_four ($up_base_trapezoid1,$down_base_trapezoid1,$height_trapezoid1,
                $up_base_trapezoid2,$down_base_trapezoid2,$height_trapezoid2,$border_left,$border_right);
 ql_four_five ($up_base_trapezoid1,$down_base_trapezoid1,$height_trapezoid1,
               $up_base_trapezoid2,$down_base_trapezoid2,$height_trapezoid2,$border_left,$border_right);
 
 //Сложная фигура - пересечение трех трапеций             
 ql_one_two_three ($up_base_trapezoid1,$down_base_trapezoid1,$height_trapezoid1,
                   $up_base_trapezoid2,$down_base_trapezoid2,$height_trapezoid2,
                   $up_base_trapezoid3,$down_base_trapezoid3,$height_trapezoid3);
                    
 ql_two_three_four ($up_base_trapezoid1,$down_base_trapezoid1,$height_trapezoid1,
                    $up_base_trapezoid2,$down_base_trapezoid2,$height_trapezoid2,
                    $up_base_trapezoid3,$down_base_trapezoid3,$height_trapezoid3);
                                                                             
 ql_three_four_five ($up_base_trapezoid1,$down_base_trapezoid1,$height_trapezoid1,
                    $up_base_trapezoid2,$down_base_trapezoid2,$height_trapezoid2,
                    $up_base_trapezoid3,$down_base_trapezoid3,$height_trapezoid3); 

 //Функции выходной переменной
 // Уровень сложности                      
quality_ochen_prost ($quality_level); 
quality_prost ($quality_level);
quality_sredn ($quality_level);
quality_dovol_slozh ($quality_level); 
quality_slozh ($quality_level);                 
                
 /*
 //Индекс Флеша
 if (($Flesch >= 0) && ($Flesch < 30)) 
 {
     $Flesch_quality = 'High';
 }
 else
 if (($Flesch >= 30) && ($Flesch < 80)) 
 {
     $Flesch_quality = 'Medium';
 }
 else 
 {
     $Flesch_quality = 'Low';
 }
  

 if (($educationLevel >= 0) && ($educationLevel < 10)) 
 {
     $eduLevel_quality = 'Low';
 }
 else
 if (($educationLevel >= 10.0) && ($educationLevel < 15.0)) 
 {
     $eduLevel_quality = 'Medium';
 }
 else 
 {
     $eduLevel_quality = 'High';
 } 

 
 // Определение качественной характеристики качества материала
 // на основе полученных данных
 
 //качество текста
 $textQuality = '';
 
 if ( ($Flesch_quality === 'Low') && ($eduLevel_quality === 'Low') )
 {
     $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Очень простой');
 }
 else
 if (( ($Flesch_quality === 'Low') && ($eduLevel_quality === 'Medium') ) || 
    ( ($Flesch_quality === 'Medium') && ($eduLevel_quality === 'Low') ) )
 {
     $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Простой');
 }
 else
 if (( ($Flesch_quality === 'Medium') && ($eduLevel_quality === 'Medium') ) || 
    ( ($Flesch_quality === 'Low') && ($eduLevel_quality === 'High') )  ||
    ( ($Flesch_quality === 'High') && ($eduLevel_quality === 'Low') ))
 {
     $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Средний');
 }
 else
 if (( ($Flesch_quality === 'High') && ($eduLevel_quality === 'Medium') ) || 
    ( ($Flesch_quality === 'Medium') && ($eduLevel_quality === 'High') ) )
 {
     $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Довольно сложный');
 }
 else
 {
     $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Сложный');
 }
 
      */

  // Этап фазификации 
  
  //количество правил
  $countOfRules = 9;
  
  //"Очень простой"  
  //низкий + низкий 
  $flesch_rule[1] =  flesch_low ($Flesch);
  $edulevel_rule[1] =  edulevel_low($educationLevel);
  
   //"Простой"  
  //низкий + средний 
  $flesch_rule[2] =  flesch_low ($Flesch);
  $edulevel_rule[2] =  edulevel_medium($educationLevel); 
  
  //средний + низкий
  $flesch_rule[3] =  flesch_medium ($Flesch);
  $edulevel_rule[3] =  edulevel_low($educationLevel);
  
  //"Средний"  
  //средний + средний 
  $flesch_rule[4] =  flesch_medium ($Flesch);
  $edulevel_rule[4] =  edulevel_medium($educationLevel); 
  
  //низкий + высокий
  $flesch_rule[5] =  flesch_low ($Flesch);
  $edulevel_rule[5] =  edulevel_high($educationLevel);
  
  //высокий + низкий
  $flesch_rule[6] =  flesch_high ($Flesch);
  $edulevel_rule[6] =  edulevel_low($educationLevel);
  
  //"Довольно сложный"  
  //высокий + средний 
  $flesch_rule[7] =  flesch_high ($Flesch);
  $edulevel_rule[7] =  edulevel_medium($educationLevel); 
  
  //средний + высокий
  $flesch_rule[8] =  flesch_medium ($Flesch);
  $edulevel_rule[8] =  edulevel_high($educationLevel);
  
  //"Сложный"  
  //высокий + высокий 
  $flesch_rule[9] =  flesch_high ($Flesch);
  $edulevel_rule[9] =  edulevel_high($educationLevel); 
  


  
   // Этап вывода
   
   //нахождение уровней отсечения для предпосылок каждого из правил (min)
   for ($i = 1; $i <= $countOfRules; $i++)
   {
       $mas_vyvod[$i] = ($flesch_rule[$i] < $edulevel_rule[$i]) ? ($flesch_rule[$i]) : ($edulevel_rule[$i]);
   }
  
   
   /*
   //находим максимальное значение функции принадлежности 
   $max_vyvod = max ($mas_vyvod);
   
   //ищем какой величине соответствует значение функции 
  
   for ($i = 0, $max_index = 0; $i <= $countOfRules; $i++)
   {
       if ($mas_vyvod[$i] === $max_vyvod)
       {
           $max_index = $i;
           $i = $countOfRules;
       }
   }
   
    switch ($max_index) 
    {
        case 1:
            $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Очень простой');
            break;
        case 2:
            $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Простой');
            break;
        case 3:
            $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Простой');
            break;
        case 4:
            $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Средний');
            break;
        case 5:
            $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Средний');
            break;
        case 6:
            $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Средний');
            break;
        case 7:
            $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Довольно сложный');
            break;
        case 8:
            $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Довольно сложный');
            break;
        case 9:
            $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Сложный');
            break;
    } 
   
      */
  // кол-во выходных оценок
  // (очень простой, простой, средний, довольно сложный, сложный)    
  $count_output_marks = 5;
  for ($i = 1; $i <= $count_output_marks;$i++)
  {
      $output[$i] = 0; 
  }    
  
  // определяем к какой из выходных оценок (quality level) относится  данное правило 
  // (очень простой, простой, средний, довольно сложный, сложный)  
    $output[1] = $mas_vyvod[1];
    $output[2] = max ($mas_vyvod[2],$mas_vyvod[3]); 
    $output[3] = max ($mas_vyvod[4],$mas_vyvod[5], $mas_vyvod[6]); 
    $output[4] = max ($mas_vyvod[7],$mas_vyvod[8]);   
    $output[5] = $mas_vyvod[9];
    
   echo ("<br />");
  
  
  
  // В дальнейшем $output - высота каждой из трапеций
  
  
  //значения оснований трапеций
  $a_left_90 = 0.8;
  $b_left_90 = 1;
  $a_right_90 = 0.8;
  $b_right_90 = 1;
  $a_isosceles = 0.8;
  $b_isosceles = 1;
                       

  $centerOfGravity = 0;
  
  // Далее происходит перебор всех возможных сочетаний
  // объединений трапеций выходной переменной которые только возможны
  // Это комбинации:
  // 1  | 2 | 3 | 4 | 5 |
  // 1 + 2  |   2 + 3   |   3 + 4   |   4 + 5   | 
  // 1 + 2 + 3  |   2 + 3 + 4   |   3 + 4 + 5   | 
  
  // quality level: 1
  if (
        ($output[1] !== 0) &&
        ($output[2] == 0) &&
        ($output[3] == 0) &&
        ($output[4] == 0) &&
        ($output[5] == 0) 
     )
  {
      $centerOfGravity = ql_one($a_left_90,$b_left_90,$output[1],$border_left,$border_right);
  }
  
  // quality level: 2
  else if (
        ($output[1] == 0) &&
        ($output[2] !== 0) &&
        ($output[3] == 0) &&
        ($output[4] == 0) &&
        ($output[5] == 0) 
     )
  {
      $centerOfGravity = ql_two($a_isosceles,$b_isosceles,$output[2],$border_left,$border_right);
  }
  
  // quality level: 3
  else if (
        ($output[1] == 0) &&
        ($output[2] == 0) &&
        ($output[3] !== 0) &&
        ($output[4] == 0) &&
        ($output[5] == 0) 
     )
  {
      $centerOfGravity = ql_three($a_isosceles,$b_isosceles,$output[3],$border_left,$border_right);
  }
  
  // quality level: 4
  else if (
        ($output[1] == 0) &&
        ($output[2] == 0) &&
        ($output[3] == 0) &&
        ($output[4] !== 0) &&
        ($output[5] == 0) 
     )
  {
      $centerOfGravity = ql_four($a_isosceles,$b_isosceles,$output[4],$border_left,$border_right);
  }
  
  // quality level: 5
  else if (
        ($output[1] == 0) &&
        ($output[2] == 0) &&
        ($output[3] == 0) &&
        ($output[4] == 0) &&
        ($output[5] !== 0) 
     )
  {
      $centerOfGravity = ql_five($a_right_90,$b_right_90,$output[5],$border_left,$border_right);
  }
  
  // quality level: 1+2
  else if (
        ($output[1] !== 0) &&
        ($output[2] !== 0) &&
        ($output[3] == 0) &&
        ($output[4] == 0) &&
        ($output[5] == 0) 
     )
  {
      $centerOfGravity = ql_one_two($a_left_90,$b_left_90, $output[1], $a_isosceles, $b_isosceles,$output[2],$border_left,$border_right);
  }  
  
  // quality level: 2+3
  else if (
        ($output[1] == 0) &&
        ($output[2] !== 0) &&
        ($output[3] !== 0) &&
        ($output[4] == 0) &&
        ($output[5] == 0) 
     )
  {
      $centerOfGravity = ql_two_three($a_isosceles,$b_isosceles, $output[2], $a_isosceles, $b_isosceles,$output[3],$border_left,$border_right);
  }
  
  // quality level: 3+4
  else if (
        ($output[1] == 0) &&
        ($output[2] == 0) &&
        ($output[3] !== 0) &&
        ($output[4] !== 0) &&
        ($output[5] == 0) 
     )
  {
      $centerOfGravity = ql_three_four($a_isosceles,$b_isosceles, $output[3], $a_isosceles, $b_isosceles,$output[4],$border_left,$border_right);
  }
  
  // quality level: 4+5
  else if (
        ($output[1] == 0) &&
        ($output[2] == 0) &&
        ($output[3] == 0) &&
        ($output[4] !== 0) &&
        ($output[5] !== 0) 
     )
  {
      $centerOfGravity = ql_four_five($a_isosceles,$b_isosceles, $output[4], $a_right_90, $b_right_90,$output[5],$border_left,$border_right);
  }
  
  // quality level: 1+2+3
  else if (
        ($output[1] !== 0) &&
        ($output[2] !== 0) &&
        ($output[3] !== 0) &&
        ($output[4] == 0) &&
        ($output[5] == 0) 
     )
  {
      $centerOfGravity = ql_one_two_three($a_left_90,$b_left_90, $output[1], $a_isosceles, $b_isosceles,$output[2],$a_isosceles, $b_isosceles,$output[3],$border_left,$border_right);
  }
  
  
  // quality level: 2+3+4
  else if (
        ($output[1] == 0) &&
        ($output[2] !== 0) &&
        ($output[3] !== 0) &&
        ($output[4] !== 0) &&
        ($output[5] == 0) 
     )
  {
      $centerOfGravity = ql_two_three_four($a_isosceles,$b_isosceles, $output[2], $a_isosceles, $b_isosceles,$output[3],$a_isosceles, $b_isosceles,$output[4],$border_left,$border_right);
  }
  
  // quality level: 3+4+5
  else if (
        ($output[1] == 0) &&
        ($output[2] == 0) &&
        ($output[3] !== 0) &&
        ($output[4] !== 0) &&
        ($output[5] !== 0) 
     )
  {
      $centerOfGravity = ql_three_four_five($a_isosceles,$b_isosceles, $output[3], $a_isosceles, $b_isosceles,$output[4],$a_right_90, $b_right_90,$output[5],$border_left,$border_right);
  }
  

  
  //Вычисляем степень принадлежности полученной характеристики к каждой из оценок
  $quality_rule[1] = quality_ochen_prost($centerOfGravity);
  $quality_rule[2] = quality_prost($centerOfGravity);
  $quality_rule[3] = quality_sredn($centerOfGravity);
  $quality_rule[4] = quality_dovol_slozh($centerOfGravity);
  $quality_rule[5] = quality_slozh($centerOfGravity);
  

  //находим максимальную степень принадлежности
  $max_quality = max($quality_rule[1],$quality_rule[2],$quality_rule[3],$quality_rule[4],$quality_rule[5]);
  
  //Определяем значение выходной переменной
  // (уровня сложности материала)
  if ($max_quality == $quality_rule[1])
  {
      $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Очень простой');
  }
  else if  ($max_quality == $quality_rule[2])
  {
      $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Простой');
  }
  else if  ($max_quality == $quality_rule[3])
  {
      $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Средний');
  }
  else if  ($max_quality == $quality_rule[4])
  {
      $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Довольно сложный');
  }
  else 
  {
      $textQuality = iconv("CP1251", "UTF-8//IGNORE", 'Сложный');
  }

  
  
  
  
  //Функции входных переменных
    
 //функция для индекса Флеша - высокий уровень
 function flesch_high ($flesch_level)
 {
     if ( ($flesch_level >= 0) && ($flesch_level <= 20) )
        return 1;
     else if ( ($flesch_level > 20) && ($flesch_level <= 30) )
        return ( (30 - $flesch_level) / 10 );
     else if (($flesch_level > 30) || ($flesch_level < 0))
        return 0;
 }
 
  //функция для индекса Флеша - средний уровень
 function flesch_medium ($flesch_level)
 {
     if ( ($flesch_level < 20) || ($flesch_level > 80) )
        return 0;
     else if ( ($flesch_level >= 20) && ($flesch_level <= 30) )
        return (($flesch_level - 20) / 10);
     else if ( ($flesch_level > 30) && ($flesch_level <= 70) )
        return 1;
     else if ( ($flesch_level > 70) && ($flesch_level <= 80) )
        return ( (80 - $flesch_level) / 10 ); 
 }
 
  //функция для индекса Флеша - низкий уровень
 function flesch_low ($flesch_level)
 {
     if (($flesch_level < 70) || ($flesch_level > 100)) 
        return 0;
     else if ( ($flesch_level >= 70) && ($flesch_level <= 80) )
        return ( ($flesch_level - 70) / 10 );
     else if ( ($flesch_level > 80) && ($flesch_level <= 100) )
        return 1;
 }
 
 
 //функция для уровня образования - низкий уровень
 function edulevel_low ($edulevel_level)
 {
     if ( ($edulevel_level >= 0) && ($edulevel_level <= 6) )
        return 1;
     else if ( ($edulevel_level > 6) && ($edulevel_level <= 8) )
        return ( (8 - $edulevel_level) / 2 );
     else if (($edulevel_level > 8) || ($edulevel_level < 0))
        return 0;
 }
 
 //функция для уровня образования - средний уровень
 function edulevel_medium ($edulevel_level)
 {
     if ( ($edulevel_level < 6) || ($edulevel_level > 15) )
        return 0;
     else if ( ($edulevel_level >= 6) && ($edulevel_level <= 8) )
        return ( ($edulevel_level - 6) / 2 );
     else if (($edulevel_level > 8) && ($edulevel_level <= 13))
        return 1;
     else if (($edulevel_level > 13) && ($edulevel_level <= 15))
        return ( (15 - $edulevel_level) / 2 );
 }
 
 //функция для уровня образования - высокий уровень
 function edulevel_high ($edulevel_level)
 {
     if ( ($edulevel_level < 13) || ($edulevel_level > 20) )
        return 0;
     else if ( ($edulevel_level > 13) && ($edulevel_level <= 15) )
        return ( ($edulevel_level - 13) / 2 );
     else if (($edulevel_level > 15) && ($edulevel_level <= 20))
        return 1;
 }
 
 
 
  
  // Трапеция: http://mathworld.wolfram.com/Trapezoid.html
  // http://www.autoit-vt.ru/%D0%BF%D0%B5%D1%80%D0%B8%D0%BC%D0%B5%D1%82%D1%80-%D1%80%D0%B0%D0%B2%D0%BD%D0%BE%D0%B1%D0%B5%D0%B4%D1%80%D0%B5%D0%BD%D0%BD%D0%BE%D0%B9-%D1%82%D1%80%D0%B0%D0%BF%D0%B5%D1%86%D0%B8%D0%B8/
  // a - верхнее основание трапеции
  // b - нижнее основание трапеции
  // h - высота трапеции
  
  
  // РАВНОБЕДРЕННАЯ ТРАПЕЦИЯ 
  // периметр равнобедренной трапеции: P = 2 * sqrt(h^2 + ((b - a) / 2)^2) + b + a
  // центр тяжести для трапеции Xc = b/2 + ((2*a + b) * (c^2 - d^2))/(6 * (b^2 - a^2) )
  // но т.к. трапеция равнобедренная => c=d, то Xc = b/2  
  
  // ПРЯМОУГОЛЬНАЯ ТРАПЕЦИЯ
  // периметр прямоугольной трапеции: P = a + b + h + sqrt(h^2 + (b - a)^2)
  
  // центр тяжести для трапеции с прямым углом справа /---|
  // Xc = b/2 + ((2*a + b)(c^2 - h^2))/(6 * (b^2 - a^2) )
  // где с = sqrt(h^2 + (b - a)^2)
  // тогда  Xc = b/2 + ((2*a + b) * ((b - a)^2))/(6 * (b^2 - a^2) ) 
  
  // центр тяжести для трапеции с прямым углом слева |---\
  // Xc = b/2 + ((2*a + b)(h^2 - d^2))/(6 * (b^2 - a^2) )
  // где d = sqrt(h^2 + (b - a)^2)
  // тогда  Xc = b/2 - ((2*a + b) * ((b - a)^2))/(6 * (b^2 - a^2) )
  
   // Возможные варианты сочетаний выходных оценок  (quality level):
  // 1  | 2 | 3 | 4 | 5 |
  // 1+2 | 2+3 | 3+4 | 4+5 |
  // 1+2+3 | 2+3+4 | 3+4+5 |
  
  // quality level: 1 
  function ql_one ($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid,$border_left,$border_right)
  {
      $a = $up_base_trapezoid;
      $b = $down_base_trapezoid;
      $h = $height_trapezoid ;
      $center =  centerOfGravity_90_left($a,$b,$h);
      $center = ($border_right[1] - $border_left[1]) * $center + $border_left[1];   
      return $center;                                              
  }  
  
  // quality level: 2
  function ql_two ($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid,$border_left,$border_right)
  {
      $a = $up_base_trapezoid;
      $b = $down_base_trapezoid;
      $h = $height_trapezoid;
      $center = centerOfGravity_isosceles($a,$b,$h);
      $center = ($border_right[2] - $border_left[2]) * $center + $border_left[2];
      return $center;
  }
  
  // quality level: 3
  function ql_three ($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid,$border_left,$border_right)
  {   
      $a = $up_base_trapezoid;
      $b = $down_base_trapezoid;
      $h = $height_trapezoid ;
      $center = centerOfGravity_isosceles($a,$b,$h);
      $center = ($border_right[3] - $border_left[3]) * $center + $border_left[3];
      return $center;
  } 
  
  // quality level: 4
  function ql_four ($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid,$border_left,$border_right)
  {   
      $a = $up_base_trapezoid;
      $b = $down_base_trapezoid;
      $h = $height_trapezoid ;
      $center = centerOfGravity_isosceles($a,$b,$h);
      $center = ($border_right[4] - $border_left[4]) * $center + $border_left[4];
      return $center;
  }
  
  // quality level: 5  
  function ql_five ($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid,$border_left,$border_right)
  {
      $a = $up_base_trapezoid;
      $b = $down_base_trapezoid;
      $h = $height_trapezoid ;
      $center = centerOfGravity_90_right($a,$b,$h);
      $center = ($border_right[5] - $border_left[5]) * $center + $border_left[5];
      return $center;
  }
  
  
  // quality level: 1+2 
  function ql_one_two ($up_base_trapezoid1,$down_base_trapezoid1,$height_trapezoid1,
                       $up_base_trapezoid2,$down_base_trapezoid2,$height_trapezoid2,                         $border_left,$border_right)
  {
      $a1 = $up_base_trapezoid1;
      $b1 = $down_base_trapezoid1;
      $h1 = $height_trapezoid1;
      
      $a2 = $up_base_trapezoid2;
      $b2 = $down_base_trapezoid2;
      $h2 = $height_trapezoid2;
      
      
      // h1 > h2
      if ($h1 > $h2)
      {
          $a = $a1;
          $b = $a1 + (($b2 - $a2) / 2);
          $h = $h1 - $h2;
          $x_center_1 = centerOfGravity_90_left($a,$b,$h);
          $x_center_1 = ($border_right[1] - $border_left[1]) * $x_center_1 + $border_left[1]; 
          $perimeter_1 = perimeter_trapezoid_90($a,$b,$h);
         
          $a = $a1 + $a2 + ($b1 - $a1);
          $b = $a1 + $a2 + ($b1 - $a1) + ( ($b2 - $a2) / 2);
          $h = $h2;
          $x_center_2 = centerOfGravity_90_left($a,$b,$h);
          $x_center_2 = ($border_right[2] - $border_left[1]) * $x_center_2 + $border_left[1];  
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2);
         
          return $x_center;
      }
      // h1 < h2
      else if ($h1 < $h2)
      {
          $a = $a2;
          $b = 2 * ($b1 - $a1) + $a2;
          $h = $h2 - $h1;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[2] - $border_left[2]) * $x_center_1 + $border_left[2];  
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + $a2 + ($b1 - $a1);
          $b = $b1 + $a2 + (($b2 - $a2) / 2);
          $h = $h1;
          $x_center_2 = centerOfGravity_90_left($a,$b,$h);
          $x_center_2 = ($border_right[2] - $border_left[1]) * $x_center_2 + $border_left[1]; 
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          
          return $x_center;    
      }
      // h1 = h2
      else
      {
          $a = $a1 + $a2 + ($b1 - $a1);
          $b = $a + (($b2 - $a2) / 2);
          $h = $h1;
          $x_center = centerOfGravity_90_left($a,$b,$h);
          $x_center = ($border_right[2] - $border_left[1]) * $x_center + $border_left[1]; 
          return $x_center;   
      }
      
  }
  
  
  
  // quality level: 2+3 
  function ql_two_three ($up_base_trapezoid1,$down_base_trapezoid1,$height_trapezoid1,
                         $up_base_trapezoid2,$down_base_trapezoid2,$height_trapezoid2,$border_left,$border_right)
  {
      $a1 = $up_base_trapezoid1;
      $b1 = $down_base_trapezoid1;
      $h1 = $height_trapezoid1;
      
      $a2 = $up_base_trapezoid2;
      $b2 = $down_base_trapezoid2;
      $h2 = $height_trapezoid2;
      
      // h1 > h2
      if ($h1 > $h2)
      {
          $a = $a1;
          $b = $a1 + ($b2 - $a2);
          $h = $h1 - $h2;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[2] - $border_left[2]) * $x_center_1 + $border_left[2];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + $a2 + ($b2 - $a2);
          $b = $a1 + $b2 + ( ($b2 - $a2) / 2);
          $h = $h2;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[3] - $border_left[2]) * $x_center_2 + $border_left[2];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
      }
      // h1 < h2
      else if ($h1 < $h2)
      {
          $a = $a2;
          $b = $a2 + ($b1 - $a1);
          $h = $h2 - $h1;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[3] - $border_left[3]) * $x_center_1 + $border_left[3];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
      
         
          $a = $a1 + $a2 + ($b1 - $a1);
          $b = $b1 + $a2 + (($b2 - $a2) / 2);
          $h = $h1;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[3] - $border_left[2]) * $x_center_2 + $border_left[2];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;    
      }
      // h1 = h2
      else
      {
          $a = $a1 + $a2 + (($b1 - $a1) / 2);
          $b = $a + ($b2 - $a2);
          $h = $h1;
          $x_center = centerOfGravity_isosceles($a,$b,$h); 
          $x_center = ($border_right[3] - $border_left[2]) * $x_center_1 + $border_left[2];
          return $x_center;   
      }
      
  }
  
  
  // quality level: 3+4 
  function ql_three_four ($up_base_trapezoid1,$down_base_trapezoid1,$height_trapezoid1,
                         $up_base_trapezoid2,$down_base_trapezoid2,$height_trapezoid2,$border_left,$border_right)
  {
      $a1 = $up_base_trapezoid1;
      $b1 = $down_base_trapezoid1;
      $h1 = $height_trapezoid1;
      
      $a2 = $up_base_trapezoid2;
      $b2 = $down_base_trapezoid2;
      $h2 = $height_trapezoid2;
      
      // h1 > h2
      if ($h1 > $h2)
      {
          $a = $a1;
          $b = $a1 + ($b2 - $a2);
          $h = $h1 - $h2;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[3] - $border_left[3]) * $x_center_1 + $border_left[3];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + $a2 + ($b2 - $a2);
          $b = $a1 + $b2 + ( ($b2 - $a2) / 2);
          $h = $h2;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[4] - $border_left[3]) * $x_center_2 + $border_left[3];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
      }
      // h1 < h2
      else if ($h1 < $h2)
      {
          $a = $a2;
          $b = $a2 + ($b1 - $a1);
          $h = $h2 - $h1;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[4] - $border_left[4]) * $x_center_1 + $border_left[4];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + $a2 + ($b1 - $a1);
          $b = $b2 + $a1 + (($b1 - $a1) / 2);
          $h = $h1;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[4] - $border_left[3]) * $x_center_2 + $border_left[3];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;    
      }
      // h1 = h2
      else
      {
          $a = $a1 + $a2 + (($b1 - $a1) / 2);
          $b = $a + ($b2 - $a2);
          $h = $h1;
          $x_center = centerOfGravity_isosceles($a,$b,$h);
          $x_center = ($border_right[4] - $border_left[3]) * $x_center + $border_left[3]; 
          return $x_center;   
      }
      
  }
  
  
  // quality level: 4+5 
  function ql_four_five ($up_base_trapezoid1,$down_base_trapezoid1,$height_trapezoid1,
                         $up_base_trapezoid2,$down_base_trapezoid2,$height_trapezoid2,$border_left,$border_right)
  {
      $a1 = $up_base_trapezoid1;
      $b1 = $down_base_trapezoid1;
      $h1 = $height_trapezoid1;
      
      $a2 = $up_base_trapezoid2;
      $b2 = $down_base_trapezoid2;
      $h2 = $height_trapezoid2;
      
      // h1 > h2
      if ($h1 > $h2)
      {
          $a = $a1;
          $b = $a1 + 2 * ($b2 - $a2);
          $h = $h1;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[4] - $border_left[4]) * $x_center_1 + $border_left[4];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + $a2 + 2 * ($b2 - $a2);
          $b = $a1 + $b2 + ( ($b1 - $a1) / 2);
          $h = $h2;
          $x_center_2 = centerOfGravity_90_right($a,$b,$h);
          $x_center_2 = ($border_right[5] - $border_left[4]) * $x_center_2 + $border_left[4];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
      }
      // h1 < h2
      else if ($h1 < $h2)
      {
          $a = $a2;
          $b = $a2 + (($b1 - $a1) / 2);
          $h = $h2 - $h1;
          $x_center_1 = centerOfGravity_90_right($a,$b,$h);
          $x_center_1 = ($border_right[5] - $border_left[5]) * $x_center_1 + $border_left[5];
          $perimeter_1 = perimeter_trapezoid_90($a,$b,$h);
         
          $a = $a1 + $a2 + (($b1 - $a1) / 2);
          $b = $b1 + $a2;
          $h = $h1;
          $x_center_2 = centerOfGravity_90_right($a,$b,$h);
          $x_center_2 = ($border_right[5] - $border_left[4]) * $x_center_2 + $border_left[4];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;    
      }
      // h1 = h2
      else
      {
          $a = $a1 + $a2 + (($b1 - $a1) / 2);
          $b = $b1 + $a2;
          $h = $h1;
          $x_center = centerOfGravity_90_right($a,$b,$h); 
          $x_center = ($border_right[5] - $border_left[4]) * $x_center + $border_left[4];
          return $x_center;   
      }
      
  }
   
  
  
  
  
  
  // quality level: 1+2+3
  function ql_one_two_three ($up_base_trapezoid1,$down_base_trapezoid1,$height_trapezoid1,
                             $up_base_trapezoid2,$down_base_trapezoid2,$height_trapezoid2,
                             $up_base_trapezoid3,$down_base_trapezoid3,$height_trapezoid3,$border_left,$border_right)
  {
        $a1 = $up_base_trapezoid1;
        $b1 = $down_base_trapezoid1;
        $h1 = $height_trapezoid1;
      
        $a2 = $up_base_trapezoid2;
        $b2 = $down_base_trapezoid2;
        $h2 = $height_trapezoid2;
        
        $a3 = $up_base_trapezoid3;
        $b3 = $down_base_trapezoid3;
        $h3 = $height_trapezoid3;
        
        // 1
        if (($h1 > $h2) && ($h2 > $h3) && ($h1 > $h3))
        {
          $a = $a1;
          $b = $a1 + (($b2 - $a2) / 2);
          $h = $h1 - $h2;
          $x_center_1 = centerOfGravity_90_left($a,$b,$h);
          $x_center_1 = ($border_right[1] - $border_left[1]) * $x_center_1 + $border_left[1];
          $perimeter_1 = perimeter_trapezoid_90($a,$b,$h);
         
          $a = $a1 + (($b2 - $a2) / 2) + $a2;
          $b = $a1 + $b2;
          $h = $h2 - $h3;
          $x_center_2 = centerOfGravity_90_left($a,$b,$h);
          $x_center_2 = ($border_right[2] - $border_left[1]) * $x_center_2 + $border_left[1];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
          
          $a = $a1 + $b2 + $a3;
          $b = $a1 + $b2 + $a3 + (($b3 - $a3) / 2);
          $h = $h3;
          $x_center_3 = centerOfGravity_90_left($a,$b,$h);
          $x_center_3 = ($border_right[3] - $border_left[1]) * $x_center_3 + $border_left[1];
          $perimeter_3 = perimeter_trapezoid_90($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2 + Xc3 * P3) / (P1 + P2 + P3)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2 + $x_center_3 * $perimeter_3;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2 + $perimeter_3); 
          return $x_center;
        }
        // 2, 3, 4
        else if (
                 ($h1 > $h2) && ($h2 < $h3) && ($h1 > $h3) ||
                 ($h1 > $h2) && ($h2 < $h3) && ($h1 < $h3) ||
                 ($h1 > $h2) && ($h2 < $h3) && ($h1 == $h3)
                )
        {
          $a = $a1;
          $b = $a1 + (($b2 - $a2) / 2);
          $h = $h1 - $h2;
          $x_center_1 = centerOfGravity_90_left($a,$b,$h);
          $x_center_1 = ($border_right[1] - $border_left[1]) * $x_center_1 + $border_left[1];
          $perimeter_1 = perimeter_trapezoid_90($a,$b,$h);
         
          $a = $a3;
          $b = $a3 + ($b2 - $a2);
          $h = $h3 - $h2;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[3] - $border_left[3]) * $x_center_2 + $border_left[3];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          $a = $a1 + $b2 + $a3 + (($b2 - $a2) / 2);
          $b = (($b3 - $a3) / 2) + $a1 + $b2 + $a3 + (($b2 - $a2) / 2);
          $h = $h2;
          $x_center_3 = centerOfGravity_90_left($a,$b,$h);
          $x_center_3 = ($border_right[3] - $border_left[1]) * $x_center_3 + $border_left[1];
          $perimeter_3 = perimeter_trapezoid_90($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2 + Xc3 * P3) / (P1 + P2 + P3)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2 + $x_center_3 * $perimeter_3;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2 + $perimeter_3); 
          return $x_center;
        }
        // 5
        else if (($h1 > $h2) && ($h2 == $h3) && ($h1 > $h3))
        {
          $a = $a1;
          $b = $a1 + (($b2 - $a2) / 2);
          $h = $h1 - $h2;
          $x_center_1 = centerOfGravity_90_left($a,$b,$h);
          $x_center_1 = ($border_right[1] - $border_left[1]) * $x_center_1 + $border_left[1];
          $perimeter_1 = perimeter_trapezoid_90($a,$b,$h);
         
          $a = $a1 + $b2 + $a3;
          $b = $a1 + $b2 + $a3 + (($b3 - $a3) / 2);
          $h = $h2;
          $x_center_2 = centerOfGravity_90_left($a,$b,$h);
          $x_center_2 = ($border_right[3] - $border_left[1]) * $x_center_2 + $border_left[1];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
   
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
        }
        // 6
        else if (($h1 < $h2) && ($h2 > $h3) && ($h1 > $h3))
        {
          $a = $a2;
          $b = $a2 + 2 * ($b1 - $a1);
          $h = $h2 - $h1;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[2] - $border_left[2]) * $x_center_1 + $border_left[2];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + $a2 + 2 * ($b1 - $a1);
          $b = $b1 + $a2 + (($b3 - $a3) / 2);
          $h = $h1 - $h3;
          $x_center_2 = centerOfGravity_90_left($a,$b,$h);
          $x_center_2 = ($border_right[2] - $border_left[1]) * $x_center_2 + $border_left[1];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
          
          $a = $b1 + $a2 + (($b3 - $a3) / 2) + $a3;
          $b = $b1 + $a2 + $b3;
          $h = $h3;
          $x_center_3 = centerOfGravity_90_left($a,$b,$h);
          $x_center_3 = ($border_right[3] - $border_left[1]) * $x_center_3 + $border_left[1];
          $perimeter_3 = perimeter_trapezoid_90($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2 + Xc3 * P3) / (P1 + P2 + P3)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2 + $x_center_3 * $perimeter_3;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2 + $perimeter_3); 
          return $x_center;
        }
        // 7
        else if (($h1 < $h2) && ($h2 > $h3) && ($h1 < $h3))
        {
          $a = $a2;
          $b = $a2 + ($b3 - $a3);
          $h = $h2 - $h3;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[2] - $border_left[2]) * $x_center_1 + $border_left[2];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a2 + ($b3 - $a3) + $a3;
          $b = $b1 - $a1 + $a2 + (($b3 - $a3) / 2) + $a3 + ((($h3 - $h1) * ($b3 - $a3)) / (2 * $h3) );
          $h = $h3 - $h1;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[3] - $border_left[2]) * $x_center_2 + $border_left[2];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          $a = $a1 + $b1 - $a1 + $a2 + (($b3 + $a3) / 2) + ((($h3 - $h1) * ($b3 - $a3)) / (2 * $h3) );
          $b = $b1 + $a2 + $b3;
          $h = $h1;
          $x_center_3 = centerOfGravity_90_left($a,$b,$h);
          $x_center_3 = ($border_right[3] - $border_left[1]) * $x_center_3 + $border_left[1];
          $perimeter_3 = perimeter_trapezoid_90($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2 + Xc3 * P3) / (P1 + P2 + P3)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2 + $x_center_3 * $perimeter_3;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2 + $perimeter_3); 
          return $x_center;
        }
        // 8
        else if (($h1 < $h2) && ($h2 > $h3) && ($h1 == $h3))
        {
          $a = $a2;
          $b = $a2 + ($b3 - $a3);
          $h = $h2 - $h1;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[2] - $border_left[2]) * $x_center_1 + $border_left[2];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $b1 + $a2 + $a3 + (($b3 - $a3) / 2);
          $b = $b1 + $a2 + $b3;
          $h = $h1;
          $x_center_2 = centerOfGravity_90_left($a,$b,$h);
          $x_center_2 = ($border_right[3] - $border_left[1]) * $x_center_2 + $border_left[1];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
   
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
        }
        // 9
        else if (($h1 < $h2) && ($h2 < $h3) && ($h1 < $h3))
        {
          $a = $a3;
          $b = $a3 + ($b2 - $a2);
          $h = $h3 - $h2;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[3] - $border_left[3]) * $x_center_1 + $border_left[3];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a3 + $b2;
          $b = $b1 - $a1 + $a2 + $a3 + (($b2 - $a2) / 2) + ((($b3 - $a3) * ($h3 - $h1)) / (2 * ($h3 - $h2)) ) ;
          $h = $h2 - $h1;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[3] - $border_left[2]) * $x_center_2 + $border_left[2];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          $a = $b1 + $a2 + $a3 + (($b2 - $a2) / 2) + ((($b3 - $a3) * ($h3 - $h1)) / (2 * ($h3 - $h2)) ) ;
          $b = $b1 + $a2 + $a3 + (($b2 - $a2) / 2) + (($b3 - $a3) / 2)  ;
          $h = $h1;
          $x_center_3 = centerOfGravity_90_left($a,$b,$h);
          $x_center_3 = ($border_right[3] - $border_left[1]) * $x_center_3 + $border_left[1];
          $perimeter_3 = perimeter_trapezoid_90($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2 + Xc3 * P3) / (P1 + P2 + P3)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2 + $x_center_3 * $perimeter_3;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2 + $perimeter_3); 
          return $x_center;
        }
        // 10
        else if (($h1 < $h2) && ($h2 == $h3) && ($h1 < $h3))
        {
          $a = $a2 + (($b2 - $a2) / 2) + $a3;
          $b = $a2 + ($b1 - $a1) + (($b2 - $a2) / 2) + $a3 + ((($b3 - $a3) * ($h2 - $h1)) / (2 * $h2));
          $h = $h2 - $h1;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[3] - $border_left[2]) * $x_center_1 + $border_left[2];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + $a2 + ($b1 - $a1) + (($b2 - $a2) / 2) + $a3 + ((($b3 - $a3) * ($h2 - $h1)) / (2 * $h2));
          $b = $b1 + $a2 + $b3;
          $h = $h1;
          $x_center_2 = centerOfGravity_90_left($a,$b,$h);
          $x_center_2 = ($border_right[3] - $border_left[1]) * $x_center_2 + $border_left[1];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
   
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
        }
        // 11
        else if (($h1 == $h2) && ($h2 > $h3) && ($h1 > $h3))
        {
          $a = $a2 + $b1;
          $b = $a2 + $b1 + ((($b2 - $a2) * ($h1 - $h3)) / (2 * $h3));
          $h = $h1 - $h3;
          $x_center_1 = centerOfGravity_90_left($a,$b,$h);
          $x_center_1 = ($border_right[2] - $border_left[1]) * $x_center_1 + $border_left[1];
          $perimeter_1 = perimeter_trapezoid_90($a,$b,$h);
         
          $a = $a3 + $a2 + $b1 + ((($b2 - $a2) * ($h1 - $h3)) / (2 * $h3));
          $b = $b1 + $a2 + $b3;
          $h = $h3;
          $x_center_2 = centerOfGravity_90_left($a,$b,$h);
          $x_center_2 = ($border_right[3] - $border_left[1]) * $x_center_2 + $border_left[1];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
   
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
        }
        // 12
        else if (($h1 == $h2) && ($h2 < $h3) && ($h1 < $h3))
        {
          $a = $a3;
          $b = $a3 + (($b2 - $a2) / 2) + ((($b3 - $a3) * ($h3 - $h1)) / (2 * $h3));
          $h = $h3 - $h1;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[3] - $border_left[3]) * $x_center_1 + $border_left[3];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $b1 + $a2 + $a3 + (($b2 - $a2) / 2) + ((($b3 - $a3) * ($h3 - $h1)) / (2 * $h3));
          $b = $a1 + $b2 + $a3 + (($b3 - $a3) / 2);
          $h = $h1;
          $x_center_2 = centerOfGravity_90_left($a,$b,$h);
          $x_center_2 = ($border_right[3] - $border_left[1]) * $x_center_2 + $border_left[1];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
   
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
        }
        // 13
        //h1 = h2 = h3
        else
      {
          $a = $b1 + $a2 + $a3 + (($b3 - $a3) / 2);
          $b = $b1 + $a2 + $b3;
          $h = $h1;
          $x_center = centerOfGravity_90_left($a,$b,$h);
          $x_center = ($border_right[3] - $border_left[1]) * $x_center + $border_left[1]; 
          return $x_center;   
      }
        
  }
  
  
 
  
  
    // quality level: 2+3+4
  function ql_two_three_four ($up_base_trapezoid1,$down_base_trapezoid1,$height_trapezoid1,
                             $up_base_trapezoid2,$down_base_trapezoid2,$height_trapezoid2,
                             $up_base_trapezoid3,$down_base_trapezoid3,$height_trapezoid3,$border_left,$border_right)
  {
        $a1 = $up_base_trapezoid1;
        $b1 = $down_base_trapezoid1;
        $h1 = $height_trapezoid1;
      
        $a2 = $up_base_trapezoid2;
        $b2 = $down_base_trapezoid2;
        $h2 = $height_trapezoid2;
        
        $a3 = $up_base_trapezoid3;
        $b3 = $down_base_trapezoid3;
        $h3 = $height_trapezoid3;
        
        // 1
        if (($h1 > $h2) && ($h2 > $h3) && ($h1 > $h3))
        {
          $a = $a1;
          $b = $a1 + ($b2 - $a2) ;
          $h = $h1 - $h2;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[2] - $border_left[2]) * $x_center_1 + $border_left[2];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + $b2;
          $b = $b1 + $a2 + (($b2 - $a2) / 2);
          $h = $h2 - $h3;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[3] - $border_left[2]) * $x_center_2 + $border_left[2];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          $a = $b1 + $a2 + $a3 + (($b2 - $a2) / 2) - (($b1 - $a1) / 2);
          $b = $b1 + $a2 + $b3;
          $h = $h3;
          $x_center_3 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_3 = ($border_right[4] - $border_left[2]) * $x_center_3 + $border_left[2];
          $perimeter_3 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2 + Xc3 * P3) / (P1 + P2 + P3)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2 + $x_center_3 * $perimeter_3;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2 + $perimeter_3); 
          return $x_center;
        }
        // 2, 3, 4
        else if (
                 ($h1 > $h2) && ($h2 < $h3) && ($h1 > $h3) ||
                 ($h1 > $h2) && ($h2 < $h3) && ($h1 < $h3) ||
                 ($h1 > $h2) && ($h2 < $h3) && ($h1 == $h3)
                )
        {
          $a = $a1;
          $b = $a1 + ($b2 - $a2);
          $h = $h1 - $h2;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[2] - $border_left[2]) * $x_center_1 + $border_left[2];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a3;
          $b = $a3 + ($b2 - $a2);
          $h = $h3 - $h2;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[4] - $border_left[4]) * $x_center_2 + $border_left[4];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          $a = $a1 + $b2 + $a3 + ($b2 - $a2);
          $b = (($b3 - $a3) / 2) + $a1 + $b2 + $a3 + (($b2 - $a2) / 2) + (($b1 - $a1) / 2);
          $h = $h2;
          $x_center_3 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_3 = ($border_right[4] - $border_left[2]) * $x_center_3 + $border_left[2];
          $perimeter_3 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2 + Xc3 * P3) / (P1 + P2 + P3)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2 + $x_center_3 * $perimeter_3;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2 + $perimeter_3); 
          return $x_center;
        }
        // 5
        else if (($h1 > $h2) && ($h2 == $h3) && ($h1 > $h3))
        {
          $a = $a1;
          $b = $a1 + ($b2 - $a2);
          $h = $h1 - $h2;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[2] - $border_left[2]) * $x_center_1 + $border_left[2];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + $b2 + $a3 + (($b2 - $a2) / 2);
          $b = $a1 + $b2 + $a3 + (($b3 - $a3) / 2)+ (($b1 - $a1) / 2);
          $h = $h2;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[4] - $border_left[2]) * $x_center_2 + $border_left[2];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
   
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
        }
        // 6
        else if (($h1 < $h2) && ($h2 > $h3) && ($h1 > $h3))
        {
          $a = $a2;
          $b = $a2 + 2 * ($b1 - $a1);
          $h = $h2 - $h1;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[3] - $border_left[3]) * $x_center_1 + $border_left[3];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + $a2 + 2 * ($b1 - $a1);
          $b = (($b1 - $a1) / 2) + $a1 + ((($b1 - $a1) * ($h1 - $h3)) / (2 * $h3) ) + $a2 + (($b3 - $a3) / 2)  + ((($b1 - $a1) * ($h1 - $h3)) / (2 * $h1) );
          $h = $h1 - $h3;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[3] - $border_left[2]) * $x_center_2 + $border_left[2];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          $a = (($b1 - $a1) / 2) + $a1 + ((($b1 - $a1) * ($h1 - $h3)) / (2 * $h3) ) + $a2 + (($b3 - $a3) / 2)  + ((($b1 - $a1) * ($h1 - $h3)) / (2 * $h1) ) + $a3;
          $b = $b1 + $a2 + $b3;
          $h = $h3;
          $x_center_3 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_3 = ($border_right[4] - $border_left[2]) * $x_center_3 + $border_left[2];
          $perimeter_3 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2 + Xc3 * P3) / (P1 + P2 + P3)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2 + $x_center_3 * $perimeter_3;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2 + $perimeter_3); 
          return $x_center;
        }
        // 7
        else if (($h1 < $h2) && ($h2 > $h3) && ($h1 < $h3))
        {
          $a = $a2;
          $b = $a2 + ($b3 - $a3);
          $h = $h2 - $h3;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[3] - $border_left[3]) * $x_center_1 + $border_left[3];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a2 + (($b3 - $a3) / 2) + $a3;
          $b = (($b1 - $a1) / 2) + $a2 + (($b3 - $a3) / 2) + $a3 + ((($h3 - $h1) * ($b3 - $a3)) / (2 * $h3) );
          $h = $h3 - $h1;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[4] - $border_left[3]) * $x_center_2 + $border_left[3];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          $a = $a1 + (($b1 - $a1) / 2) + $a2 + (($b3 + $a3) / 2) + ((($h3 - $h1) * ($b3 - $a3)) / (2 * $h3) );
          $b = $b1 + $a2 + $b3;
          $h = $h1;
          $x_center_3 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_3 = ($border_right[4] - $border_left[2]) * $x_center_3 + $border_left[2];
          $perimeter_3 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2 + Xc3 * P3) / (P1 + P2 + P3)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2 + $x_center_3 * $perimeter_3;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2 + $perimeter_3); 
          return $x_center;
        }
        // 8
        else if (($h1 < $h2) && ($h2 > $h3) && ($h1 == $h3))
        {
          $a = $a2;
          $b = $a2 + ($b3 - $a3);
          $h = $h2 - $h1;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[3] - $border_left[3]) * $x_center_1 + $border_left[3];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + $a2 + (($b1 - $a1) / 2) + $a3 + (($b3 - $a3) / 2);
          $b = $b1 + $a2 + $b3;
          $h = $h1;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[4] - $border_left[2]) * $x_center_2 + $border_left[2];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
   
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
        }
        // 9
        else if (($h1 < $h2) && ($h2 < $h3) && ($h1 < $h3))
        {
          $a = $a3;
          $b = $a3 + ($b2 - $a2);
          $h = $h3 - $h2;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[4] - $border_left[4]) * $x_center_1 + $border_left[4];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a3 + $b2 - (($b2 - $a2) / 2);
          $b = (($b1 - $a1) / 2) + $a2 + $a3 + (($b3 - $a3) / 2) + ((($b3 - $a3) * ($h3 - $h1)) / (2 * ($h3 - $h2)) ) ;
          $h = $h2 - $h1;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[4] - $border_left[3]) * $x_center_2 + $border_left[3];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          $a = $a1 + (($b1 - $a1) / 2) + $a2 + $a3 + (($b3 - $a3) / 2) + ((($b3 - $a3) * ($h3 - $h1)) / (2 * ($h3 - $h2)) ) ;
          $b = $b1 + $a2 + $a3 + (($b2 - $a2) / 2) + (($b3 - $a3) / 2)  ;
          $h = $h1;
          $x_center_3 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_3 = ($border_right[4] - $border_left[2]) * $x_center_3 + $border_left[2];
          $perimeter_3 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2 + Xc3 * P3) / (P1 + P2 + P3)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2 + $x_center_3 * $perimeter_3;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2 + $perimeter_3); 
          return $x_center;
        }
        // 10
        else if (($h1 < $h2) && ($h2 == $h3) && ($h1 < $h3))
        {
          $a = $a2 + (($b2 - $a2) / 2) + $a3;
          $b = $a2 + (($b1 - $a1) / 2) + (($b2 - $a2) / 2) + $a3 + ((($b3 - $a3) * ($h2 - $h1)) / (2 * $h2));
          $h = $h2 - $h1;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[4] - $border_left[3]) * $x_center_1 + $border_left[3];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + $a2 + (($b1 - $a1) / 2) + (($b2 - $a2) / 2) + $a3 + ((($b3 - $a3) * ($h2 - $h1)) / (2 * $h2));
          $b = $b1 + $a2 + $b3;
          $h = $h1;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[4] - $border_left[2]) * $x_center_2 + $border_left[2];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
   
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
        }
        // 11
        else if (($h1 == $h2) && ($h2 > $h3) && ($h1 > $h3))
        {
          $a = $a1 + $a2 + (($b1 - $a1) / 2);
          $b = (($b1 - $a1) / 2) + $a1 + ((($b1 - $a1) * ($h1 - $h3)) / (2 * $h3) ) + $a2 + ((($b2 - $a2) * ($h1 - $h3)) / (2 * $h3));
          $h = $h1 - $h3;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[3] - $border_left[2]) * $x_center_1 + $border_left[2];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = (($b1 - $a1) / 2) + $a1 + ((($b1 - $a1) * ($h1 - $h3)) / (2 * $h3) )  + $a2 + $a3 + ((($b2 - $a2) * ($h1 - $h3)) / (2 * $h3));
          $b = $b1 + $a2 + $b3;
          $h = $h3;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[4] - $border_left[2]) * $x_center_2 + $border_left[2];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
   
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
        }
        // 12
        else if (($h1 == $h2) && ($h2 < $h3) && ($h1 < $h3))
        {
          $a = $a3;
          $b = $a3 + (($b2 - $a2) / 2) + ((($b3 - $a3) * ($h3 - $h1)) / (2 * $h3));
          $h = $h3 - $h1;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[4] - $border_left[4]) * $x_center_1 + $border_left[4];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + (($b1 - $a1) / 2) + $a2 + (($b2 - $a2) / 2) + $a3 + ((($b3 - $a3) * ($h3 - $h1)) / (2 * $h3));
          $b = $b1 + $a2 + $a3 + (($b2 - $a2) / 2) + (($b3 - $a3) / 2);
          $h = $h1;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[4] - $border_left[4]) * $x_center_2 + $border_left[2];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
   
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
        }
        // 13
        //h1 = h2 = h3
        else
      {
          $a = $a1 + (($b1 - $a1) / 2) + $a2 + (($b2 - $a2) / 2) + $a3 + (($b3 - $a3) / 2);
          $b = $b1 + $a2 + $b3;
          $h = $h1;
          $x_center = centerOfGravity_isosceles($a,$b,$h);
          $x_center = ($border_right[4] - $border_left[2]) * $x_center + $border_left[2]; 
          return $x_center;   
      }
        
  }
  
  
  
     
  
  
  
  
       // quality level: 3+4+5
  function ql_three_four_five ($up_base_trapezoid1,$down_base_trapezoid1,$height_trapezoid1,
                               $up_base_trapezoid2,$down_base_trapezoid2,$height_trapezoid2,
                               $up_base_trapezoid3,$down_base_trapezoid3,$height_trapezoid3,$border_left,$border_right)
  {
       
        $a1 = $up_base_trapezoid1;
        $b1 = $down_base_trapezoid1;
        $h1 = $height_trapezoid1;
      
        $a2 = $up_base_trapezoid2;
        $b2 = $down_base_trapezoid2;
        $h2 = $height_trapezoid2;
        
        $a3 = $up_base_trapezoid3;
        $b3 = $down_base_trapezoid3;
        $h3 = $height_trapezoid3;
        
        // 1
        if (($h1 > $h2) && ($h2 > $h3) && ($h1 > $h3))
        {
          $a = $a1;
          $b = $a1 + ($b2 - $a2) ;
          $h = $h1 - $h2;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[3] - $border_left[3]) * $x_center_1 + $border_left[3];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + $b2;
          $b = $b1 + $a2 + (($b2 - $a2) / 2);
          $h = $h2 - $h3;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[4] - $border_left[3]) * $x_center_2 + $border_left[3];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          $a = $b1 + $a2 + $a3 + (($b2 - $a2) / 2) - (($b1 - $a1) / 2);
          $b = $b1 + $a2 + $b3;
          $h = $h3;
          $x_center_3 = centerOfGravity_90_right($a,$b,$h);
          $x_center_3 = ($border_right[5] - $border_left[3]) * $x_center_3 + $border_left[3];
          $perimeter_3 = perimeter_trapezoid_90($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2 + Xc3 * P3) / (P1 + P2 + P3)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2 + $x_center_3 * $perimeter_3;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2 + $perimeter_3); 
          return $x_center;
        }
        // 2, 3, 4
        else if (
                 ($h1 > $h2) && ($h2 < $h3) && ($h1 > $h3) ||
                 ($h1 > $h2) && ($h2 < $h3) && ($h1 < $h3) ||
                 ($h1 > $h2) && ($h2 < $h3) && ($h1 == $h3)
                )
        {
          $a = $a1;
          $b = $a1 + ($b2 - $a2);
          $h = $h1 - $h2;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[3] - $border_left[3]) * $x_center_1 + $border_left[3];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a3;
          $b = $a3 + (($b2 - $a2) / 2);
          $h = $h3 - $h2;
          $x_center_2 = centerOfGravity_90_right($a,$b,$h);
          $x_center_2 = ($border_right[5] - $border_left[5]) * $x_center_2 + $border_left[5];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
          
          $a = $a1 + $b2 + $a3 + (($b2 - $a2) / 2);
          $b = $a1 + $b2 + $a3 + (($b1 - $a1) / 2);
          $h = $h2;
          $x_center_3 = centerOfGravity_90_right($a,$b,$h);
          $x_center_3 = ($border_right[5] - $border_left[3]) * $x_center_3 + $border_left[3];
          $perimeter_3 = perimeter_trapezoid_90($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2 + Xc3 * P3) / (P1 + P2 + P3)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2 + $x_center_3 * $perimeter_3;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2 + $perimeter_3); 
          return $x_center;
        } 
        // 5
        else if (($h1 > $h2) && ($h2 == $h3) && ($h1 > $h3))
        {
          $a = $a1;
          $b = $a1 + ($b2 - $a2);
          $h = $h1 - $h2;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[3] - $border_left[3]) * $x_center_1 + $border_left[3];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + $b2 + $a3 + (($b2 - $a2) / 2);
          $b = $a1 + $b2 + $a3 + (($b1 - $a1) / 2);
          $h = $h2;
          $x_center_2 = centerOfGravity_90_right($a,$b,$h);
          $x_center_2 = ($border_right[5] - $border_left[3]) * $x_center_2 + $border_left[3];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
   
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
        }
        // 6
        else if (($h1 < $h2) && ($h2 > $h3) && ($h1 > $h3))
        {
          $a = $a2;
          $b = $a2 + 2 * ($b1 - $a1);
          $h = $h2 - $h1;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[4] - $border_left[4]) * $x_center_1 + $border_left[4];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + $a2 + 2 * ($b1 - $a1);
          $b = (($b1 - $a1) / 2) + $a1 + ((($b1 - $a1) * ($h1 - $h3)) / (2 * $h3) ) + $a2 + (($b3 - $a3) / 2)  + ((($b1 - $a1) * ($h1 - $h3)) / (2 * $h1) );
          $h = $h1 - $h3;
          $x_center_2 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_2 = ($border_right[4] - $border_left[3]) * $x_center_2 + $border_left[3];
          $perimeter_2 = perimeter_trapezoid_isosceles($a,$b,$h);
          
          $a = (($b1 - $a1) / 2) + $a1 + ((($b1 - $a1) * ($h1 - $h3)) / (2 * $h3) ) + $a2 + $b3 ;
          $b = $b1 + $a2 + $b3;
          $h = $h3;
          $x_center_3 = centerOfGravity_90_right($a,$b,$h);
          $x_center_3 = ($border_right[5] - $border_left[3]) * $x_center_3 + $border_left[3];
          $perimeter_3 = perimeter_trapezoid_90($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2 + Xc3 * P3) / (P1 + P2 + P3)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2 + $x_center_3 * $perimeter_3;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2 + $perimeter_3); 
          return $x_center;
        }
        // 7
        else if (($h1 < $h2) && ($h2 > $h3) && ($h1 < $h3))
        {
          $a = $a2;
          $b = $a2 + ($b3 - $a3);
          $h = $h2 - $h3;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[4] - $border_left[4]) * $x_center_1 + $border_left[4];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a2 + (($b3 - $a3) / 2) + $a3;
          $b = (($b1 - $a1) / 2) + $a2 + (($b3 - $a3) / 2) + $a3;
          $h = $h3 - $h1;
          $x_center_2 = centerOfGravity_90_right($a,$b,$h);
          $x_center_2 = ($border_right[5] - $border_left[4]) * $x_center_2 + $border_left[4];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
          
          $a = $a1 + (($b1 - $a1) / 2) + $a2 + (($b3 + $a3) / 2);
          $b = $b1 + $a2 + $b3;
          $h = $h1;
          $x_center_3 = centerOfGravity_90_right($a,$b,$h);
          $x_center_3 = ($border_right[5] - $border_left[3]) * $x_center_3 + $border_left[3];
          $perimeter_3 = perimeter_trapezoid_90($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2 + Xc3 * P3) / (P1 + P2 + P3)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2 + $x_center_3 * $perimeter_3;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2 + $perimeter_3); 
          return $x_center;
        }  
        // 8
        else if (($h1 < $h2) && ($h2 > $h3) && ($h1 == $h3))
        {
          $a = $a2;
          $b = $a2 + ($b3 - $a3);
          $h = $h2 - $h1;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[4] - $border_left[4]) * $x_center_1 + $border_left[4];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = $a1 + $a2 + (($b1 - $a1) / 2) + $a3 + (($b3 - $a3) / 2);
          $b = $b1 + $a2 + $b3;
          $h = $h1;
          $x_center_2 = centerOfGravity_90_right($a,$b,$h);
          $x_center_2 = ($border_right[5] - $border_left[3]) * $x_center_2 + $border_left[3];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
   
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
        }
        // 9
        else if (($h1 < $h2) && ($h2 < $h3) && ($h1 < $h3))
        {
          $a = $a3;
          $b = $a3 + (($b2 - $a2) / 2);
          $h = $h3 - $h2;
          $x_center_1 = centerOfGravity_90_right($a,$b,$h);
          $x_center_1 = ($border_right[5] - $border_left[5]) * $x_center_1 + $border_left[5];
          $perimeter_1 = perimeter_trapezoid_90($a,$b,$h);
         
          $a = $a3 + (($b2 - $a2) / 2) + $a2;
          $b = (($b1 - $a1) / 2) + $a2 + $a3 + (($b2 - $a2) / 2);
          $h = $h2 - $h1;
          $x_center_2 = centerOfGravity_90_right($a,$b,$h);
          $x_center_2 = ($border_right[5] - $border_left[4]) * $x_center_2 + $border_left[4];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
          
          $a = $a1 + (($b1 - $a1) / 2) + $a2 + $a3 + (($b2 - $a2) / 2);
          $b = $b1 + $a2 + $a3 + (($b2 - $a2) / 2);
          $h = $h1;
          $x_center_3 = centerOfGravity_90_right($a,$b,$h);
          $x_center_3 = ($border_right[5] - $border_left[3]) * $x_center_3 + $border_left[3];
          $perimeter_3 = perimeter_trapezoid_90($a,$b,$h);
          
          // Xc = (Xc1 * P1 + Xc2 * P2 + Xc3 * P3) / (P1 + P2 + P3)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2 + $x_center_3 * $perimeter_3;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2 + $perimeter_3); 
          return $x_center;
        }
        // 10
        else if (($h1 < $h2) && ($h2 == $h3) && ($h1 < $h3))
        {
          $a = $a2 + (($b2 - $a2) / 2) + $a3;
          $b = $a2 + (($b1 - $a1) / 2) + (($b2 - $a2) / 2) + $a3;
          $h = $h2 - $h1;
          $x_center_1 = centerOfGravity_90_right($a,$b,$h);
          $x_center_1 = ($border_right[5] - $border_left[4]) * $x_center_1 + $border_left[4];
          $perimeter_1 = perimeter_trapezoid_90($a,$b,$h);
         
          $a = $a1 + $a2 + (($b1 - $a1) / 2) + (($b2 - $a2) / 2) + $a3;
          $b = $b1 + $a2 + $b3;
          $h = $h1;
          $x_center_2 = centerOfGravity_90_right($a,$b,$h);
          $x_center_2 = ($border_right[5] - $border_left[3]) * $x_center_2 + $border_left[3];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
   
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
        }
        // 11
        else if (($h1 == $h2) && ($h2 > $h3) && ($h1 > $h3))
        {
          $a = $a1 + $a2 + (($b1 - $a1) / 2);
          $b = (($b1 - $a1) / 2) + $a1 + ((($b1 - $a1) * ($h1 - $h3)) / (2 * $h3) ) + $a2 + ((($b2 - $a2) * ($h1 - $h3)) / (2 * $h3));
          $h = $h1 - $h3;
          $x_center_1 = centerOfGravity_isosceles($a,$b,$h);
          $x_center_1 = ($border_right[4] - $border_left[3]) * $x_center_1 + $border_left[3];
          $perimeter_1 = perimeter_trapezoid_isosceles($a,$b,$h);
         
          $a = (($b1 - $a1) / 2) + $a1 + ((($b1 - $a1) * ($h1 - $h3)) / (2 * $h3) )  + $a2 + $a3 + ((($b2 - $a2) * ($h1 - $h3)) / (2 * $h3));
          $b = $b1 + $a2 + $a3 + (($b2 - $a2) / 2);
          $h = $h3;
          $x_center_2 = centerOfGravity_90_right($a,$b,$h);
          $x_center_2 = ($border_right[5] - $border_left[3]) * $x_center_2 + $border_left[3];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
   
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
        }
        // 12
        else if (($h1 == $h2) && ($h2 < $h3) && ($h1 < $h3))
        {
          $a = $a3;
          $b = $a3 + (($b2 - $a2) / 2);
          $h = $h3 - $h1;
          $x_center_1 = centerOfGravity_90_right($a,$b,$h);
          $x_center_1 = ($border_right[5] - $border_left[5]) * $x_center_1 + $border_left[5];
          $perimeter_1 = perimeter_trapezoid_90($a,$b,$h);
         
          $a = $a1 + $b2 + $a3;
          $b = $b1 + $a2 + $a3 + (($b2 - $a2) / 2);
          $h = $h1;
          $x_center_2 = centerOfGravity_90_right($a,$b,$h);
          $x_center_2 = ($border_right[5] - $border_left[3]) * $x_center_2 + $border_left[3];
          $perimeter_2 = perimeter_trapezoid_90($a,$b,$h);
   
          
          // Xc = (Xc1 * P1 + Xc2 * P2) / (P1 + P2)
          $x_center = $x_center_1 * $perimeter_1 + $x_center_2 * $perimeter_2;
          $x_center = $x_center / ($perimeter_1 + $perimeter_2); 
          return $x_center;
        }
        // 13
        //h1 = h2 = h3
        else
      {
          $a = $a1 + (($b1 - $a1) / 2) + $a2 + (($b2 - $a2) / 2) + $a3;
          $b = $b1 + $a2 + $b3;
          $h = $h1;
          $x_center = centerOfGravity_90_right($a,$b,$h); 
          $x_center = ($border_right[5] - $border_left[3]) * $x_center + $border_left[3];
          return $x_center;   
      }
         
  }
  
  
    
  
  
  
  
  // периметр прямоугольной трапеции
  // P = a + b + h + sqrt(h^2 + (b - a)^2)
  function perimeter_trapezoid_90($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid)
  {
      $a = $up_base_trapezoid;
      $b = $down_base_trapezoid;
      $h = $height_trapezoid; 
      return ($a + b + $h + sqrt( pow($h,2) + pow(($b - $a),2) ));
  }
  
  // периметр равнобедренной трапеции
  // P = 2 * sqrt(h^2 + ((b - a) / 2)^2) + b + a
  function perimeter_trapezoid_isosceles($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid)
  {
       $a = $up_base_trapezoid;
       $b = $down_base_trapezoid;
       $h = $height_trapezoid;
       return (2 * sqrt( pow($h,2) + pow((($b - $a) / 2),2) ) + $b + $a);
  }
  
  // центр тяжести для трапеции с прямым углом справа /---|
  // Xc = b/2 + ((2*a + b)(c^2 - h^2))/(6 * (b^2 - a^2) )
  // где с = sqrt(h^2 + (b - a)^2)
  // тогда  Xc = b/2 + ((2*a + b) * ((b - a)^2))/(6 * (b^2 - a^2) ) 
  function centerOfGravity_90_right ($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid)
  {
      $a = $up_base_trapezoid;
      $b = $down_base_trapezoid;
      $c = $height_trapezoid;
      // ((2*a + b) * ((b - a)^2))
      $x_center_trapezoid = (2 * $a + $b) * pow( ($b - $a),2);
      // ((2*a + b) * ((b - a)^2))/(6 * (b^2 - a^2)) 
      $x_center_trapezoid = $x_center_trapezoid / (6 * (pow($b,2) - pow($a,2)));
      // Xc = b/2 + ((2*a + b) * ((b - a)^2))/(6 * (b^2 - a^2) )
      $x_center_trapezoid = ($b / 2) + $x_center_trapezoid; 
      
      //$x_center_trapezoid = (($b + 2 * $a) / (3 * ($a + $b))) * $h;
      
      
      return $x_center_trapezoid;
  } 
  
  
  // центр тяжести для трапеции с прямым углом слева |---\
  // Xc = b/2 + ((2*a + b)(h^2 - d^2))/(6 * (b^2 - a^2) )
  // где d = sqrt(h^2 + (b - a)^2)
  // тогда  Xc = b/2 - ((2*a + b) * ((b - a)^2))/(6 * (b^2 - a^2) ) 
  function centerOfGravity_90_left ($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid)
  {
      $a = $up_base_trapezoid;
      $b = $down_base_trapezoid;
      $c = $height_trapezoid;
      // ((2*a + b) * ((b - a)^2))
      $x_center_trapezoid = (2 * $a + $b) * pow( ($b - $a),2);
      // ((2*a + b) * ((b - a)^2))/(6 * (b^2 - a^2)) 
      $x_center_trapezoid = $x_center_trapezoid / (6 * (pow($b,2) - pow($a,2)));
      // Xc = b/2 + ((2*a + b) * ((b - a)^2))/(6 * (b^2 - a^2) )
      $x_center_trapezoid = ($b / 2) - $x_center_trapezoid;
      
     // $x_center_trapezoid = (($b + 2 * $a) / (3 * ($a + $b))) * $h;
      return $x_center_trapezoid;
  } 
  
  // центр тяжести для равнобедренной трапеции 
  function centerOfGravity_isosceles ($up_base_trapezoid,$down_base_trapezoid,$height_trapezoid)                        
  {
      $a = $up_base_trapezoid;
      $b = $down_base_trapezoid;
      $c = $height_trapezoid;
      //return ($b / 2);
     // ((2*a + b) * ((b - a)^2))
      $x_center_trapezoid = (2 * $a + $b) * pow( ($b - $a),2);
      // ((2*a + b) * ((b - a)^2))/(6 * (b^2 - a^2)) 
      $x_center_trapezoid = $x_center_trapezoid / (6 * (pow($b,2) - pow($a,2)));
      // Xc = b/2 + ((2*a + b) * ((b - a)^2))/(6 * (b^2 - a^2) )
      $x_center_trapezoid = ($b / 2) - $x_center_trapezoid;
      return $x_center_trapezoid;
  }
  
   
  
 
 
   

   
   
   //Функции выходной переменной
   
 //функция для уровня сложности - очень простой
 function quality_ochen_prost ($quality_level)
 {
     if ( ($quality_level >= 0) && ($quality_level <= 0.8) )
        return 1;
     else if ( ($quality_level > 0.8) && ($quality_level <= 1) )
        return ( (1 - $quality_level) / 0.2 );
     else if (($quality_level > 1) || ($quality_level < 0))
        return 0;
 }
 
 //функция для уровня сложности - простой
 function quality_prost ($quality_level)
 {
     if ( ($quality_level < 0.8) || ($quality_level > 2) )
        return 0;
     else if ( ($quality_level >= 0.8) && ($quality_level <= 1) )
        return ( ($quality_level - 0.8) / 0.2 );
     else if (($quality_level > 1) && ($quality_level <= 1.8))
        return 1;
     else if (($quality_level > 1.8) && ($quality_level <= 2))
        return ( (2 - $quality_level) / 0.2 );
 }
 
 //функция для уровня сложности - средний
 function quality_sredn ($quality_level)
 {
     if ( ($quality_level < 1.8) || ($quality_level > 3) )
        return 0;
     else if ( ($quality_level >= 1.8) && ($quality_level <= 2) )
        return ( ($quality_level - 1.8) / 0.2 );
     else if (($quality_level > 2) && ($quality_level <= 2.8))
        return 1;
     else if (($quality_level > 2.8) && ($quality_level <= 3))
        return ( (3 - $quality_level) / 0.2 );
 }
 
 //функция для уровня сложности - средний
 function quality_dovol_slozh ($quality_level)
 {
     if ( ($quality_level < 2.8) || ($quality_level > 4) )
        return 0;
     else if ( ($quality_level >= 2.8) && ($quality_level <= 3) )
        return ( ($quality_level - 2.8) / 0.2 );
     else if (($quality_level > 3) && ($quality_level <= 3.8))
        return 1;
     else if (($quality_level > 3.8) && ($quality_level <= 4))
        return ( (4 - $quality_level) / 0.2 );
 }
 
 //функция для уровня сложности - очень простой
 function quality_slozh ($quality_level)
 {
     if ($quality_level < 3.8)
        return 0;
     else if ( ($quality_level >= 3.8) && ($quality_level < 4) )
        return ( (1 - $quality_level) / 0.2 );
     else if ($quality_level > 4)
        return 1;
 }
 
?>
