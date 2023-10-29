<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Money Receipt- </title>

    <link rel="stylesheet" type="text/css" href="{{ public_path('assets/dist/css/adminlte.min.css') }}">

	
    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
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

    <main  style="border: 1px solid; padding: 10px;">

        <table width="100%">
            <tr>
                <td valign="top" width="15%">
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

        <h4 style="text-align:center;">Money Receipt</h4>

        <hr>

        <table width="100%">
            <thead>
                <tr>
                    <th width="49%" style="border-bottom: 1px solid;">Payment Received From</th>
                    <th></th>
                    <th width="49%" style="border-bottom: 1px solid;">Date</th>
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
                        {{ Carbon\Carbon::parse($ledger->date)->format('d, F Y') }}
                    </td>
                </tr>
            </tbody>

        </table>

        <hr>

        <table width="100%">
            <thead>
                <tr>
                    <th width="30%">Amount in Figure (BDT)</th>
                    <th width="5%">:</th>
                    <td>{{ $ledger->debit }}</td>
                </tr>

                <tr>
                    <th width="30%">Amount in Word</th>
                    <th width="5%">:</th>
                    <td>{{ $amount_in_word }}</td>
                </tr>

                <tr>
                    <th width="30%">Payment Method</th>
                    <th width="5%">:</th>
                    <td>{{ $ledger->paymentMethod->name}}</td>
                </tr>

                <tr>
                    <th width="30%">Description</th>
                    <th width="5%">:</th>
                    <td>{{ $ledger->note}}</td>
                </tr>

            </thead>
        </table>

        <br>
        <table width="100%">
            <thead>
                <tr>
                    <h5 style="text-align:right;">For BRM Trading International</h5>
                </tr>        
            </thead>
        </table>

    </main>

</body>
</html>