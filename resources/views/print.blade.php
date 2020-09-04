<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Invoice Print</title>

    <!-- Styles -->
    <style>
        {
            font-family: Arial, Helvetica, sans-serif !important
        ;
        }

        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding-right: 20px !important;
            width: 88mm;

        }

        .MB {
            margin-bottom: 2px;
            margin-top: 2px;
        }

        .MBB {
            margin-bottom: 5px;
        }

        h4 {
            margin: 2px;
        }

        p {
            margin: 0;
            margin-bottom: 2px;
        }

        hr {
        / / border: 1 px solid #dadada;
            display: none;
        }

        .f11 {
            font-size: 11px;
            font-weight: 100;
            text-align: center;
        }

        .TextLeft {
            text-align: left !important;
        }
        .TextCenter {
            text-align: center !important;
        }
        .f12 {
            font-size: 14px !important;
        }

        .f17 {
            font-size: 20px !important;
        }

        .location {
            font-size: 12px;
            padding: 2px;
        }

        .note {
            font-size: 10px;
            padding-bottom: 5px;
        }

        .td-border {
            border-top: 2px solid #000;
        }

        .BrRight {
            border-right-width: 1px;
            border-style: none dotted none none;
        }

        .totalBr {
            padding: 5px;
            text-align: center;
            border: 1px solid;
        }

        .TbHeaderBorder {
            border: 2px solid #000;
        }

        .TbHeaderBorder1 {
            border: 1px solid #000;
        }

        .mainTable {
            border-collapse: collapse;
        }

        .service {
            border-bottom: 1px solid #000;
        }

        .netTable {
            margin: 15px 0 15px 0;
            width: 100%;
        }

        .P3 {
            padding: 3px;
        }

        .P5 {
            padding: 5px;
        }

        .tdWidth {
            width: 10%;
            text-align: left !important;
        }

        .PdTop {

            padding-top: 5px;
        }

        .PdBottom {

            padding-bottom: 5px;
        }
        .noteH5{
            margin: 0px !important;
            padding: 0px !important;
            margin-bottom: 5px !important;
        }
    </style>
</head>
<body>
<div id="invoice-POS">
    <center id="top">
        <span class="icon-logo-BSP" style="font-size:90px;"></span>
    </center>
    <center id="top">
        <strong class="f12">Pakistan E Store</strong>
    </center>
    <center id="top">
        <h4 class="location">A PROJECT OF ABIXION DIGITAL MARKETING</h4>
    </center>
    <center id="top MB">

        <img class="MBB" style="width:70%;height:10%;" alt="barcode"
             src="https://pakistanestore.com/wp-content/uploads/2020/06/estore-logo.png"/>

    </center>

    <table class="td-border" style="width:  100%;">
        <tr class="tabletitle" style="width:100%;">
            <td class="f17 TextLeft" style="width: 20%;"><h6 class="MB">Invoice ID : </h6></td>
            <td class="f17" style="width:  30%;"><h6 class="MB">{{ $order->id }}</h6></td>
            @php
                $date = \Carbon\Carbon::parse($order->date_created);
            @endphp
            <td class="f17" style="width: 40%; text-align:right !important;"><h6
                    class="MB">{{  $date->isoFormat('h:mm  MMMM Do YYYY') }}</h6>
            </td>
        </tr>
        <tr class="tabletitle" style="width:100%;">
            <td class="f17 TextLeft" style="width: 20%;"><h6 class="MB">Customer : </h6></td>
            <td class="f17" style="width:  30%;"><h6
                    class="MB">{{ $order->shipping['first_name'] }} {{$order->shipping['last_name']}}</h6></td>
            <td class="f17" style="width: 40%; text-align:right !important;"><h6
                    class="MB">{{  $order->billing['phone'] }}</h6>
            </td>
        </tr>
        <tr class="tabletitle" style="width:100%;">
            <td class="f17 PdBottom" colspan="3"><h6 class="MB">
                    {{ $order->shipping['address_1'] }}
                    {{ $order->shipping['address_2'] }},
                    {{ $order->shipping['city'] }}
                </h6></td>
        </tr>
    </table>
    <table class="td-border mainTable">
        <tr class="service">
            <td class="f12 P5 TextLeft" style="width:45%;"><strong>Particulars</strong></td>
            <td class="f12 TextCenter" style="width:10%;"><strong>Rate</strong></td>
            <td class="f12 TextCenter" style="width:10%;"><strong>Qty</strong></td>
            <td class="f12 TextCenter" style="width:15%;"><strong>Total</strong></td>
        </tr>
        @foreach($order->line_items as $item)
            <tr class="service">
                <td><p class="f12 TextLeft">{{ $item['name'] }}</p></td>
                <td><p class="f12 TextCenter">{{ $item['price'] }}</p></td>
                <td><p class="f12 TextCenter">{{ $item['quantity'] }}</p></td>
                <td><p class="f12 TextCenter">{{ $item['total'] }}</p></td>
            </tr>
        @endforeach
        <tr class="tabletitle">
            <td class="f14 TbHeaderBorder1" colspan="3"><span>Grand Total</span></td>
            <td class="f14 TbHeaderBorder1 TextCenter" style="width:30%;">
                <span>{{ ($order->total - $order->shipping_total)  }}</span></td>
        </tr>
        <tr class="tabletitle ">
            <td class="f12 " colspan="3"><span>Delivery Charges</span></td>
            <td class="f12 TextCenter" style="width:30%;"><span>{{ $order->shipping_total }}</span></td>
        </tr>
    </table>
    <table class="netTable">
        <tr class="tabletitle">
            <td class="f12 TbHeaderBorder P3" style="width: 30%;">
                <span>No. of items: {{ count($order->line_items) }}</span></td>
            <td class="f12 TbHeaderBorder TextCenter" colspan="3"><strong>Net Payable </strong></td>
            <td class="f12 TbHeaderBorder" style="text-decoration:  underline; text-align: center">
                <strong>{{ $order->total }}</strong></td>
        </tr>
    </table>
    <center id="top">
        <h4 class="f11">------------------- Thank you for shopping with us -------------------</h4>
        <h4 class="note">Get fresh products delivered at your doorstep.</h4>
        <h5 class="noteH5"><span class="icon-facebook-official"></span> 0309 1052780</h5>
        <h5 class="noteH5"><span class="icon-globe"></span> www.pakistanestore.com</h5>
    </center>
</div><!--End Invoice-->
</body>
</html>
