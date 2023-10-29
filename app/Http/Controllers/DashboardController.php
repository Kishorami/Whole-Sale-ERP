<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ImportedItem;
use App\Models\SoldItem;
use App\Models\Customer;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index()
    {

        $imported_items = ImportedItem::where('stock','>',0)->get();

        $data = [
                    'product_stock' => self::product_stock($imported_items->groupBy('sku')),
                    'fast_to_slow' => self::fast_to_slow(),
                    'fast_to_slow_with_profit' => self::fast_to_slow_with_profit(),
                    'customer_by_profit' => self::customer_by_profit(),
                    'customer_by_balance' => self::customer_by_balance(),
                ];


        // dd($imported_items->groupBy('id'));

        return view('livewire.dashboard.dashboard',$data);
    }



    public function product_stock($data)
    {
        $temp = array();
        foreach ($data as $key => $value) {
            $info = stock_info($value)['stock_total'];

            $temp[$value[0]->item_description] = $info;
        }

        $labels = array();
        $datas = array();
        foreach ($temp as $key => $value) {
            array_push($labels, $key);
            array_push($datas, $value);
        }

        $info = [
                    'labels' => $labels,
                    'data' => $datas,
                ];

        // dd($info,$temp);
        return $info;
    }


    public function fast_to_slow()
    {
        $sold_items = SoldItem::with('product')->get()->groupBy('imported_item_id');

        $temp = array();

        foreach ($sold_items as $key_s => $value_s) {
            
            $product; $days; $sold=0;
            foreach ($value_s as $key => $value) {
                
                $product = $value->product->item_description;
                $sold = $sold + $value->quantity;
                // $days = ($value->product->created_at)->diffInDays($value->created_at);
                $days = ($value->product->created_at)->diffInDays(Carbon::now());
            }

            $info = [
                        'ratio' => 0,
                        'sold' => $sold,
                        'days' => $days+1,
                    ];


            if (array_key_exists($product, $temp)) {
                $temp[$product]['sold'] = $temp[$product]['sold'] + $info['sold'];
                if ($temp[$product]['days'] < $info['days']) {
                    $temp[$product]['days'] = $info['days'];
                }
            } else {
                $temp[$product] = $info;
            }
        }

        foreach ($temp as $key => $value) {
            $temp[$key]['ratio'] = $temp[$key]['sold']/$temp[$key]['days'];
        }

        arsort($temp);

        $labels = array();
        $datas = array();
        foreach ($temp as $key => $value) {
            array_push($labels, $key);
            array_push($datas, [
                'y'=>number_format($value['ratio'],2),
                'sold'=>$value['sold'],
                'days' => $value['days'],
                ]);

        }

        $info = [
                    'labels' => $labels,
                    'data' => $datas,
                ];
        return $info;
    }

    public function fast_to_slow_with_profit()
    {
        $sold_items = SoldItem::with('product')->get()->groupBy('imported_item_id');

        $temp = array();

        foreach ($sold_items as $key_s => $value_s) {
            
            $product; $days; $sold=0; $profit=0;
            foreach ($value_s as $key => $value) {
                
                $product = $value->product->item_description;
                $sold = $sold + $value->quantity;
                $profit = $profit + $value->profit;
                $days = ($value->product->created_at)->diffInDays(Carbon::now());
            }

            $info = [
                        'ratio' => 0,
                        'profit' =>$profit,
                        'sold' => $sold,
                        'days' => $days+1,
                    ];


            if (array_key_exists($product, $temp)) {
                $temp[$product]['sold'] = $temp[$product]['sold'] + $info['sold'];
                $temp[$product]['profit'] = $temp[$product]['profit'] + $info['profit'];
                if ($temp[$product]['days'] < $info['days']) {
                    $temp[$product]['days'] = $info['days'];
                }
            } else {
                $temp[$product] = $info;
            }
        }

        foreach ($temp as $key => $value) {
            $temp[$key]['ratio'] = $temp[$key]['sold']/$temp[$key]['days'];
            $temp[$key]['profit'] = $temp[$key]['profit']/$temp[$key]['sold'];
        }

        arsort($temp);

        $labels = array();
        $datas = array();
        foreach ($temp as $key => $value) {
            array_push($labels, $key);
            array_push($datas, [
                'y'=>number_format($value['profit'],2),
                'sold'=>$value['sold'],
                'days' => $value['days'],
                ]);

        }

        $info = [
                    'labels' => $labels,
                    'data' => $datas,
                ];

        // dd($temp,$info);
        return $info;
    }


    public function customer_by_profit()
    {
        $customers = Customer::select('id','firm_name')->get();

        $temp = array();

        foreach ($customers as $key => $value) {
            
            $temp[$value->firm_name] = customer_profit($value->id);
        }

        arsort($temp);

        $labels = array();
        $datas = array();
        foreach ($temp as $key => $value) {
            array_push($labels, $key);
            array_push($datas, $value);
        }

        $info = [
                    'labels' => $labels,
                    'data' => $datas,
                ];
        
        return $info;
    }

    public function customer_by_balance()
    {
        $customers = Customer::select('id','firm_name','balance')->get();

        $temp = array();

        foreach ($customers as $key => $value) {
            
            $temp[$value->firm_name] = $value->balance;
        }

        arsort($temp);

        $labels = array();
        $datas = array();
        foreach ($temp as $key => $value) {
            array_push($labels, $key);
            array_push($datas, $value);
        }

        $info = [
                    'labels' => $labels,
                    'data' => $datas,
                ];
        
        // dd($temp);

        return $info;
    }

}
