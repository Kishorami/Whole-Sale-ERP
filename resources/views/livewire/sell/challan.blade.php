<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Challan- {{ $invoice->bill_no }}</title>

    <link rel="stylesheet" type="text/css" href="{{ public_path('assets/dist/css/adminlte.min.css') }}">

	<style>
        /** 
        * Define the width, height, margins and position of the watermark.
        **/
        #watermark {
            position: fixed;

            /** 
                Set a position in the page for your image
                This should center it vertically
            **/
            bottom:   10cm;
            left:     5.5cm;

            /** Change image dimensions**/
            width:    8cm;
            height:   8cm;

            /** Your watermark should be behind every content**/
            z-index:  -1000;

            opacity: .2;
        }
    </style>
    <style type="text/css">
        /** {
            font-family: Verdana, Arial, sans-serif;
        }*/
        table{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>

</head>
<body>
	<div id="watermark">
        <img src="{{ public_path('assets/images/logo/brm_logo.png') }}" height="100%" width="100%" />
    </div>

    <main>

        <table width="100%">
            <tr>
                <td valign="top" width="15%">
                    <img src="{{ public_path('assets/images/logo/brm_logo.png') }}" alt="" width="100"/>
                </td>
                <td style="text-align:center;">
                    <h3>BRM TRADING INTERNATIONAL</h3>
                    110, Shaheed Tajuddin Ahmed Sharnani,
                    Boro Moghbazar, Ramna, Dhaka-1217,<br>
                    Tel: +88 02 226663197
                    Mobile: +88 01711-100794
                    Email: brmtradebd@gmail.com
                </td>
                <td width="15%"></td>
            </tr>

        </table>

        <h4 style="text-align:center;">Delivary Challan</h4>

        <hr>

        <table width="100%">
            <thead>
                <tr>
                    <th width="49%" style="border-bottom: 1px solid;">Invoice To</th>
                    <th></th>
                    <th width="49%" style="border-bottom: 1px solid;">Challan</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>
                        <strong>{{ $customer->firm_name }}</strong><br>
                        <strong>Present Address: </strong>{{ $customer->present_address }}<br>
                        <strong>Contact Person: </strong> {{ $customer->contact_person }}<br>
                        <strong>Mobile: </strong> {{ $customer->mobile_phone }}<br>
                        <strong>Land Phone: </strong> {{ $customer->land_phone }}<br>
                        
                    </td>
                    <td></td>
                    <td>
                        <strong>Invoice No: </strong>{{ $invoice->bill_no }}<br>
                        <strong>Date: </strong> {{ $invoice->created_at }}<br>
                        <strong>Challan No: </strong> {{ $invoice->bill_no }}<br>
                        <strong>Date: </strong> <br>
                    </td>
                </tr>
            </tbody>

        </table>
        

        <hr>

        <table width="100%">
            <thead style="background-color: lightgray; text-align: center;">
                <tr>
                    <th style="border: 1px solid;">S/N</th>
                    <th style="border: 1px solid;">Description</th>
                    <th style="border: 1px solid;">Unit</th>
                    <th style="border: 1px solid;">Quantity</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $key=>$value)

                    <tr style="text-align: center;">
                        <th style="border: 1px solid;">{{ $key+1 }}</th>
                        <td style="border: 1px solid;">{{ $value['description'] }}</td>
                        <td style="border: 1px solid;">{{ $value['unit'] }}</td>
                        <td style="border: 1px solid;" align="right">{{ $value['quantity'] }}</td>
                    </tr>

                @endforeach
            </tbody>

            

        </table>

        <br>

        <table width="100%">
            <thead>
                <tr>
                    <th style="border-bottom: 1px solid;">Terms & Condition:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        terms and condition
                    </td>
                </tr>
            </tbody>
        </table>

        <br><br><br>

        <table width="100%">
            <thead>
                <tr>
                    <th width="15%" style="border-top: 1px solid; text-align: center;">Received By</th>
                    <th width="10%"></th>
                    <th width="15%" style="border-top: 1px solid; text-align: center;">Prepared By</th>
                    <th width="10%"></th>
                    <th width="15%" style="border-top: 1px solid; text-align: center;">Checked By</th>
                    <th width="10%"></th>
                    <th width="15%" style="border-top: 1px solid; text-align: center;">Approved By</th>
                </tr>
            </thead>
        </table>


    </main>

</body>
</html>