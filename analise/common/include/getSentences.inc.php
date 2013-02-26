<?php


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


        //������ ����� � �� �
        $content = preg_replace ("'�'i","�", $content);

        //   // ������ ������� :  ,  ( ) + * � �
        $content = preg_replace ("'[,\:()\"+*��]'i", " ", $content); 

    }



    function delete_punctuation(&$content)
    {
        //�������� "." �� " " ������ ���� ����� �� ���� ����� �����    
        $content = preg_replace("'([^0-9])\.'i",'$1 ',$content);

        //   // ������ ������� : ; , ? ( ) + * � �
        $content = preg_replace ("'[,;:?()\"+*��]'i", " ", $content); 

    } 



    html_content_word1( $content );

    // ����������� ����� � ��������� utf-8 

    $content = iconv('windows-1251', "UTF-8", $content);

    $content = divide_to_sentence($content);

    // � $content ����������� ������ ���������� ����:
    // [i] - ���������� ����� (������-array(4))
    //      [0] - ����������� � ������ �������� ����� ������
    //            � ��� ���������� (string)
    //      [1] - ���-�� ���� � ����������� (int)
    //      [2] - ������ (array) ���� ����������� (string) � 
    //            ������� �������� 
    //      [3] - ������ (array) ��� �� �����������, ��� � [2] 
    //            ���������� ���-�� ������ (int) � ���������������
    //            ����� ��  ������� [2] 
    //            ����� �� [i][2][j] ������������� ���-�� ������ � [i][3][j]

    //���������� �������� ��������� �������� ����
    require($CFG->dirroot .'/analise/common/include/keyWordsAnaliseAlghoritm11.inc.php');

    //////////////////////////////////////////////////////////////////////////////   
    // ������� ��������� phpMorphy 

    try 
    {
        $morphyNew = new phpMorphy($dir, $lang, $opts);
    } 
    catch(phpMorphy_Exception $e) 
    {
        die('������ ��� �������� ��������� phpMorphy : ' . PHP_EOL . $e);
    }


    try 
    {
        for ($i = 0; $i < count($content);$i++)
        {
            for ($j = 0; $j < count($content[$i][2]); $j++)
            {
                $content[$i][2][$j] = $morphyNew->lemmatize($content[$i][2][$j],phpMorphy::NORMAL);
            }                                                                           
        }
    } 
    catch(phpMorphy_Exception $e) 
    {
        die('Error occured while text processing: ' . $e->getMessage());
    }

    //�������� �� ������ ������� $content
    for ($i = 0; $i < count($content);$i++)
    {
        // �������� �� ���� ������ ������� �����������
        // $localCountKey - ������� �������� ���� � ������� ����������� 
        for ($j = 0, $localCountKey=0; $j < count($content[$i][2]); $j++)
        {


            //��������� �� ��������� �����, �������
            //PhpMorphy �� ���� ����� � ������� (�������� �� ��������)
            if ( $content[$i][2][$j] !== false)
            {
                //���� ��� ������ PhpMorphy ���� �������� ��������� ����
                //�� ������������� �� ���
                if(is_array($content[$i][2][$j]))
                {
                    for ($l = 0; $l < count($content[$i][2][$j]); $l++)
                    {

                        //�������� �� ���� ����������� ������ � ��� ������������
                        //�������� ������������� � ������
                        //������������ �������  �������������
                        for ($k = 0; $k < count($massiv_chastota_sort); $k++)
                        {   
                            //���������� �� ������� ���� � ������������ �������� �������������
                            for ($m = 0; $m < count($massiv_chastota_sort[$k][1]); $m++)
                            {                  
                                //���� ����� � ����������� ������� � ��������
                                if ($content[$i][2][$j][$l] == $massiv_chastota_sort[$k][1][$m])
                                {
                                    //����������� ������� 
                                    $localCountKey += $massiv_chastota_sort[$k][0];
                                }
                            }   
                        } 
                    }
                }
                else
                {     
                    //�������� �� ���� ����������� ������ � ��� ������������
                    //�������� ������������� � ������
                    //������������ �������  �������������
                    for ($k = 0; $k < count($massiv_chastota_sort); $k++)
                    {   
                        //���������� �� ������� ���� � ������������ �������� �������������
                        for($m = 0; $m < count($massiv_chastota_sort[$k][1]); $m++)
                        {                  
                            //���� ����� � ����������� ������� � ��������
                            if ($content[$i][2][$j] == $massiv_chastota_sort[$k][1][$m])
                            {
                                //����������� ������� 
                                $localCountKey += $massiv_chastota_sort[$k][0];
                            }
                        }   
                    }  
                }
            }


            //$content[4] - c���� ������ ������������� ������� ����� � ����������� ��� ����������� �����������
            $content[$i][4] = $localCountKey;   
        }
    }
    //������� ������ ��� ������� ������� ����������� ���������� 
    //�������� ����������� �� ���� �����������
    $keySentences_percents = array();
    for ($i = 0; $i < count($content); $i++)
    {
        //���������� ����� � ������� $content � ����������� ��������� ������� 
        $keySentences_percents[$i][0] = $i;
        //���� �������� ���� ������ ������������� ���� �� ������� ����������� � ������ 
        $keySentences_percents[$i][1] = $content[$i][4];
    }

    //���������� ���������� �� �������� ������������ ���� ������ ������������� ���� � ����������� 
    //����� ���� �����������

    for ($i = 0; $i < count($keySentences_percents); $i++)
    {
        for ($j = $i+1; $j < count($keySentences_percents); $j++)
        {
            if ( $keySentences_percents[$j][1] > $keySentences_percents[$i][1] )
            {
                $tmp1 = $keySentences_percents[$i][0];
                $tmp2 = $keySentences_percents[$i][1];

                $keySentences_percents[$i][0] = $keySentences_percents[$j][0];
                $keySentences_percents[$i][1] = $keySentences_percents[$j][1];

                $keySentences_percents[$j][0] = $tmp1;
                $keySentences_percents[$j][1] = $tmp2;
            }
        }
    }          

    //������ ��������� �������������
    // (������� �����, ������� �����������)
    require_once($CFG->dirroot .'/analise/common/include/numeric.inc.php');


    //��������� ������ �������� ����������� ��� �������� � ��
    //����������� ����������� ����������� " | "
    $toDataBaseSentenceList = "";
    for ($i = 0; $i < $SentencePercents; $i++) 
    {
        //��������� �� ������ ���������� ����� � ������� $content � ����������� ��������� �������
        $pointer = $keySentences_percents[$i][0];
        $toDataBaseSentenceList .= $content[$pointer][0];
        $toDataBaseSentenceList .= " | ";
    }

    //��������� ������ � ���������� ����������������
    //(������ ������ ������������� ���� ���� �����������)
    //��� �������� �� �������� � ������� ��������� 
    //������������� �����������
    $numericSentencesOutput = "";
    for ($i = 0; $i < $SentencePercents; $i++)
    {
        $numericSentencesOutput .= $keySentences_percents[$i][1];
        $numericSentencesOutput .= " | ";
    }





    //������� ����� �� ��������
    require_once($CFG->dirroot .'/analise/common/include/Sentences_output.inc.php');


    function divide_to_sentence(&$insideContent)
    {
        //��������� �� ����������� ������� 
        //�� ������ ����
        $PatternForList = '[\s]';      //������� ��� ��������  
        $insideContent .= ' ';           
        $insideList = preg_split( $PatternForList, $insideContent, -1, PREG_SPLIT_NO_EMPTY ); 
        //var_dump($insideList);
        $upCaseList = '�����Ũ��������������������������ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $endSymbList = '.?!;';
        //����������� � ���������� ������ ������� ����, � ������� ���������� ����� �����������
        $firstWordList[0] = 0;
        //� ������� ��� ����� ������
        $firstWordListCounter = 1;
        //������������� ��� ���������� �� ������ �����
        for ( $i = 0; $i < count( $insideList ); $i++ )
        {
            //�������� �� ������ ������ ���������� ����� ������ � ������� ��������   
            if( (strrpos( $upCaseList,$insideList[ $i+1 ][0] )) !== false)
            {
                // ������� ���������� ������� �������� �����
                $lengthPrevWord = strlen( $insideList[ $i ] ) - 1;
                //���� ��������� ������ �������� ����������� ����� �������� ����� �� "?!.;"
                if ( (strrpos( $endSymbList,$insideList[ $i ][ $lengthPrevWord ] )) !== false )
                {
                    //������ ����� �������� ����� � ������ ������ ���� �����������
                    $firstWordList[ $firstWordListCounter ] = $i;
                    $firstWordListCounter++;
                }
            }

        }
        //"���������" ����������� �� ��������� ����.   
        //return $testVariable = create_sentences_from_words ( $firstWordList, $insideList ); 
        $testVariable = create_sentences_from_words ( $firstWordList, $insideList ); 
        
        //������� �����������
        $i=0; 

        foreach ( $testVariable as $elem )
        {

            //$testVariable[$i][2] - ������ ���� �����������
            //��������� ����������� �� ��������� �����
            $testVariable[$i][2] = preg_split("/[\s]+/",$elem[0]);
            // $testVariable[$i][2] = explode(" ",$elem[0]);
            //������� ���� � �����������
            $j=0;
            //������� ���-�� ������� ���� � ����� 
            //(��������� � ���-��� ������) 
            //�������� ������� ����� �������� �����������
            foreach ($testVariable[$i][2] as $insideElem)
            {
                //������� �������
                //����������� ����� ����� ������ �� ������� ����
                //� ������ �� ����
                $countChar = 0;
                $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "�"),"UTF-8");
                $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "�"),"UTF-8");
                $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "�"),"UTF-8");
                $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "�"),"UTF-8");
                $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "�"),"UTF-8");
                $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "�"),"UTF-8");
                $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "�"),"UTF-8");
                $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "�"),"UTF-8");
                $countChar += mb_substr_count($testVariable[$i][2][$j],iconv('windows-1251', "UTF-8", "�"),"UTF-8");

                //������� ���-�� ������ � ��������������� ����������
                //$testVariable[$i][3] - ������ ����������
                //������ (����. ����) � ������ ����� �����������
                $testVariable[$i][3][$j] = $countChar;

                /* echo($testVariable[$i][2][$j]);
                echo(" ---> ");
                echo ($testVariable[$i][3][$j]);
                echo(iconv('windows-1251', "UTF-8", " (������)"));*/


                //��������� ����� � ������� �������
                $testVariable[$i][2][$j] = mb_convert_case($testVariable[$i][2][$j],MB_CASE_UPPER,"UTF-8");
                /*echo(" ---> "); 
                echo($testVariable[$i][2][$j]);
                echo ( "<br />" );*/
                $j++;
            }  
            //echo ( "<br />" );
            $i++;

        }
        return $testVariable;

    }

    //������� ���������� �� ������� divide_to_sentence
    //�� ��������� ���� ���������� �����������.
    //���������: 
    //1. ������ ������� ������ ���� �����������
    //2. ������ ���� ����

    //���������� ������ $sentenceList,
    //������ ������� ����� ������� - ������ �� 2� ���������:
    //[ 0 ] - ���� ����������� 
    //[ 1 ] - ���-�� ���� � �����������

    function create_sentences_from_words( $firstWordList, $wordsList )
    {
        //������� ��� ������ ���� ����
        $wordsListCounter = 0;
        //������ ���������� �����������
        $sentenceList = array();
        //������� ���  ������ ���������� �����������
        $sentenceListCounter = 0;
        //�� ���� �������� ������ ����
        for ( $i=0; $i < count( $firstWordList ); $i++)
        {
            $sentenceList[ $sentenceListCounter ][ 0 ] = '';
            //������� ���-�� ���� � ������� �����������
            $currentSentenceWordsCounter = 0;

            //������������� ����� �������� �����������, 
            //������ �� ��������� ������� ����� ���������� �����������
            //(����� �������� ����� �� ����������� ������ ������� ����� ���������� �����������)

            //���� ��� ��������� �����������, �� ��������� ��� ����� �� �����
            //������� ����
            if ( $i === (count( $firstWordList )) - 1 )
            {
                $endSentence = (count( $wordsList )) - 1;
            }
            else 
            {
                $endSentence = $firstWordList[ $i+1 ];
            }


            while ( $wordsListCounter <= $endSentence  )
            {
                //�������� ����� � �����������
                $sentenceList[ $sentenceListCounter ][ 0 ] .= $wordsList[ $wordsListCounter ];
                //����������� ������� ���� � ������ �����������
                $currentSentenceWordsCounter++;

                //���� ��� �� ��������� ����� ����������� - ������� ������
                if ( $wordsListCounter !== ($firstWordList[ $i+1 ]) )
                {              
                    $sentenceList[ $sentenceListCounter ][ 0 ] .= ' ';
                }

                //��������� � ���������� �����
                $wordsListCounter++;
            }
            //�������� ���� ���������� � ����� ����������� 
            $sentenceList[ $sentenceListCounter ][ 0 ] = substr( ( $sentenceList[ $sentenceListCounter ][ 0 ] ), 0, strlen( $sentenceList[ $sentenceListCounter ][ 0 ] ) - 1 );
            //���� ����������� ����������� ����������� 
            //��������� ��������� 2 ������� 
            $tmpLength = strlen( $sentenceList[ $sentenceListCounter ][ 0 ] );
            if ( (( $sentenceList[ $sentenceListCounter ][ 0 ][$tmpLength - 1] ) === '.') && (( $sentenceList[ $sentenceListCounter ][ 0 ][$tmpLength - 2] ) === '.') )
            {
                //�������� ��� ��� ������� 
                $sentenceList[ $sentenceListCounter ][ 0 ] = substr( ( $sentenceList[ $sentenceListCounter ][ 0 ] ), 0, strlen( $sentenceList[ $sentenceListCounter ][ 0 ] ) - 2 );
            }
            // �������� ����������� � ������ �������
            $sentenceList[ $sentenceListCounter ][ 0 ] = mb_convert_case( $sentenceList[ $sentenceListCounter ][ 0 ], MB_CASE_LOWER,"UTF-8" );
            //������ � ������ ���-�� ���� � ������ �����������
            $sentenceList[ $sentenceListCounter ][ 1 ] = $currentSentenceWordsCounter;

            $sentenceListCounter++;
        }
        return $sentenceList;
    }

?>
