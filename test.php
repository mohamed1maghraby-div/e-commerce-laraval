<?php

function romanToInt($s) {
        $src = [
                'I' => 1,
                'V' => 5,
                'X' => 10,
                'L' => 50,
                'C' => 100,
                'D' => 500,
                'M' => 1000
        ];
        $input = str_split($s);
        $output = 0;
        
        for($i=0; $i<=count($input); $i++){
                $indexValue = $src[$input[$i]];
                $prevValue = $src[$input[$i-1]];
                if(!is_null($input[$i-1])){
                        if($input[$i] == 'I' && ($input[$i-1] == 'Y' || $input[$i-1] == 'X')){
                                $output-=$indexValue;
                        }elseif($input[$i] == 'X' && ($input[$i-1] == 'L' || $input[$i-1] == 'C')){
                                $output-=$prevValue;
                        }elseif($input[$i] == 'C' && ($input[$i-1] == 'D' || $input[$i-1] == 'M')){
                                $output-=$prevValue;
                        }else{
                                $output+=$indexValue;
                        }
                }
        }
        echo $output;
}

romanToInt('MCMXCIV');