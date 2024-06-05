<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 10px; /* Adjust font size */
    }

    .invoice {
        width: 100%; /* Adjust width to fit within page */
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        page-break-inside: avoid; /* Prevent page breaks within invoice */
        height: 120vh;
    }

    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .invoice-header-left {
        flex: 1;
    }

    .invoice-header-right {
        flex: 1;
        text-align: right;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
    }

    .invoice-table th,
    .invoice-table td {
        border: 1px solid #000;
        padding: 8px; /* Adjust cell padding */
        text-align: center;
    }

    .invoice-table th {
        background-color: #E64A19;
        color: #fff;
        font-weight: bold;
    }

    .invoice-total {
        float: right;
        margin-top: 20px;
    }
</style>

</head>

<body>
        <div class="invoice">
            <div class="invoice-header">
                <div class="invoice-header-left">
                    <!-- <img src="{{ asset('assets/logo/logo8.jpg') }}" alt="Company Logo" width="100"> -->
                    <h1>Siddiqia Publication</h1>
                    <p>38/3 Bangla Bazar (1st Floor), Dhaka-1100</p>
                    <p>Email: siddiqiap@gmail.com</p>
                    <p>Phone: 002-47122047, 01912238187, 01715339902</p>
                </div>
                <div class="invoice-header-right">
                    <h2>Invoice</h2>
                    <p>Invoice Number: #123456</p>
                    <p>Date: {{ $currentDate }}</p>
                    <p>Customer Name : {{ $customer->name }}</p>
                    <p>Phone : 0{{ $customer->phone }}</p>
                </div>
            </div>

            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>#sL</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Unit Price( Taka )</th>
                        <th>Total ( Taka )</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sub_total = 0; @endphp
                    @foreach ($details as $key => $item)
                    @php
                    $item_total = $item->quantity * $item->price;
                    $sub_total += $item_total;
                    @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->book->book_english_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item_total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="invoice-total">
                <p>Subtotal: {{ $sub_total }} Taka </p>
                <p>Total: {{ $sale->total_price ?? 'N/A' }} Taka </p>
            </div>

            <div class="invoice-footer">
                <p>Thank you for shopping with us!</p>
            </div>
        </div>
</body>

</html>