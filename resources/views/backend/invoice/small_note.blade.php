<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Small Note</title>

    <!-- External CSS file can be used for better maintainability -->
    <style>
        /* Define your styles here */
        * {
            font-family: "consolas", sans-serif;
        }
        p {
            display: block;
            margin: 3px;
            font-size: 10pt;
        }
        table td {
            font-size: 9pt;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }

        @media print {
            /* CSS specific to print media */
            @page {
                margin: 0;
                size: 75mm;
            }
            html, body {
                width: 70mm;
            }
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <!-- Print button -->
    <button class="btn-print" style="position: absolute; right: 1rem; top: 1rem;" onclick="window.print()">Print</button>
    
    <!-- Company information -->
    <div class="text-center">
        <h3 style="margin-bottom: 5px;">Siddiqia Publication</h3>
        <p>38/3 Bangla Bazar (1st Floor), Dhaka-1100</p>
    </div>
    <br>
    
    <!-- Date and user information -->
    <div>
        <p style="float: left;">{{ date('d-m-Y') }}</p>
        <p style="float: right">{{ strtoupper(auth()->user()->name) }}</p>
    </div>
    <div class="clear-both" style="clear: both;"></div>

    <!-- Sale details -->
    <p>No: {{ addLeadingZeros($sale->id, 10) }}</p>
    <p class="text-center">===================================</p>
    <br>
    <table width="100%" style="border: 0;">
        @foreach ($details as $item)
            <tr>
                <td colspan="3">{{ $item->book->book_bangla_name }}</td>
            </tr>
            <tr>
                <td>{{ $item->quantity }} x {{ format_money($item->price) }}</td>
                <td></td>
                <td class="text-right">{{ format_money($item->quantity * $item->price) }}</td>
            </tr>
        @endforeach
    </table>
    <p class="text-center">-----------------------------------</p>

    <!-- Sale totals -->
    <table width="100%" style="border: 0;">
        <tr>
            <td>Total Price:</td>
            <td class="text-right">{{ format_money($sale->total_price) }}</td>
        </tr>
        <tr>
            <td>Total Item:</td>
            <td class="text-right">{{ format_money($sale->total_quantity) }}</td>
        </tr>
        <tr>
            <td>Discount:</td>
            <td class="text-right">{{ format_money($sale->discount) }}</td>
        </tr>
        <tr>
            <td>Total Pay:</td>
            <td class="text-right">{{ format_money($sale->total_price - $sale->discount) }}</td>
        </tr>
        <tr>
            <td>Received:</td>
            <td class="text-right">{{ format_money($sale->received) }}</td>
        </tr>
        <tr>
            <td>Return:</td>
            <td class="text-right">{{ format_money($sale->received - ($sale->total_price - $sale->discount)) }}</td>
        </tr>
    </table>

    <!-- Footer -->
    <p class="text-center">===================================</p>
    <p class="text-center">-- THANK YOU --</p>

    <!-- JavaScript for adjusting print settings -->
    <script>
        let body = document.body;
        let html = document.documentElement;
        let height = Math.max(
                body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight
            );

        // Set innerHeight cookie to adjust print settings
        document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "innerHeight="+ ((height + 50) * 0.264583);
    </script>
</body>
</html>
