<?php 

use App\Models\ApprovedSell;


if (! function_exists('stock_info')) {
    function stock_info($data)
    {
        $info = [
        	'stock_total' => 0,
        	'sold_total' => 0,
        ];

        foreach ($data as $key => $value) {
        	$info['stock_total'] = $info['stock_total'] + $value->stock;
        	$info['sold_total'] = $info['sold_total'] + $value->sold;
        }
 
        return $info;
    }
}



if (! function_exists('customer_profit')) {
    function customer_profit($id)
    {
        $data = ApprovedSell::where('customer_id',$id)->with('soldItem')->get();
        // dd($data);
        $profit = 0;

        foreach ($data as $data_key => $sold_item) {
            
            foreach ($sold_item->soldItem as $key => $value) {
                $profit = $profit + $value->profit;
            }

        }

        return $profit;
    }
}


if (! function_exists('number_to_word_bdt')) {
    function number_to_word_bdt($number = '')
    {
        $my_number = $number;

        if (($number < 0) || ($number > 999999999)) 
        { 
            throw new Exception("Number is out of range");
        }


        $Kt = floor($number / 10000000); /* Koti */
        $number -= $Kt * 10000000;
        $Gn = floor($number / 100000);  /* lakh  */ 
        $number -= $Gn * 100000; 
        $kn = floor($number / 1000);     /* Thousands (kilo) */ 
        $number -= $kn * 1000; 
        $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
        $number -= $Hn * 100; 
        $Dn = floor($number / 10);       /* Tens (deca) */ 
        $n = $number % 10;               /* Ones */ 

        $res = ""; 

        if ($Kt) 
        { 
            $res .= number_to_word_bdt($Kt) . " Koti "; 
        } 
        if ($Gn) 
        { 
            $res .= number_to_word_bdt($Gn) . " Lakh"; 
        } 

        if ($kn) 
        { 
            $res .= (empty($res) ? "" : " ") . 
                number_to_word_bdt($kn) . " Thousand"; 
        } 

        if ($Hn) 
        { 
            $res .= (empty($res) ? "" : " ") . 
                number_to_word_bdt($Hn) . " Hundred"; 
        } 

        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
            "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
            "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
            "Nineteen"); 
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
            "Seventy", "Eigthy", "Ninety"); 

        if ($Dn || $n) 
        { 
            if (!empty($res)) 
            { 
                // $res .= " and ";
                $res .= " "; 
            } 

            if ($Dn < 2) 
            { 
                $res .= $ones[$Dn * 10 + $n]; 
            } 
            else 
            { 
                $res .= $tens[$Dn]; 

                if ($n) 
                { 
                    $res .= "-" . $ones[$n]; 
                } 
            } 
        } 

        if (empty($res)) 
        { 
            $res = "zero"; 
        } 

        return $res;
    }
}