<!DOCTYPE html>
<html>
<head>
    <title>CraigHughesUpholstery.co.uk</title>
</head>
<body>
<table border-spacing="0" style="width: 100%; border: solid 1px #d4d4d4; font-family: 'Nunito', sans-serif;">
    <tr style="color:#FFF; background-color: #000; width: 100%;" >
        <td style="text-align: center; padding: 20px;" colspan="4">
            <img src="https://www.craighughesupholstery.co.uk/img/CraigHughesUpholstery-Logo.png" width="200px"/>
        </td>
    </tr>
    <tr style="color:#888; background-color: #d4d4d4;">
        <td style="text-align: center; padding: 40px"  colspan="4">
            <h2 style="font-weight: lighter;">Thankyou for your order from the Craig Hughes Upholstery Website</h2>
            <img src="https://www.craighughesupholstery.co.uk/img/neworder.png" width="120px"/>
        </td>
    </tr>
    <tr style="color:#888; background-color: #FFF;">
        <td style="text-align: left; padding: 15px"  colspan="2">
            <p style="font-weight: bold">Order No: {{ $order->order_no }} </p>
            <p style="font-weight: bold">Order Total: {{ $order->total }} </p>
        </td>
        <td style="text-align: right; padding: 15px; font-weight: bold"  colspan="2">
            <p>Ship To:<br/><br/>
                {{$order->title}} {{$order->forname}} {{$order->surname}}<br/>
                {{$order->address1}}<br/>
                @if ($order->address2)
                    {{$order->address2}}
                @endif
                @if ($order->town)
                    {{$order->town}}<br/>
                @endif
                @if ($order->county)
                    {{$order->county}}<br/>
                @endif
                @if ($order->postcode)
                    {{$order->postcode}}<br/>
                @endif
            </p>
        </td>
    </tr>
    @foreach ($order->products as $product)
        <tr style="color:#888;">
            <td style="padding:15px; width:20%;">
                <img src="https://www.craighughesupholstery.co.uk/{{$product->images[0]->src}}" width="100%">
            </td>
            <td>
                <p style="font-weight: bold">{{$product->name}}</p>
                <p>{{$product->product_code}}</p>
                <p>{{$product->tagline}}</p>
            </td>
            <td>
                <p style="font-weight:bold">Qty: {{$product->pivot->quantity}}</p>
            </td>
            <td>
                <p style="font-weight:bold">&pound; {{$product->price}}</p>
            </td>
        </tr>
    @endforeach

    <tr style="color:#888; background-color: #FFF;">
        <td style="text-align: left; padding: 15px"  colspan="4">
            <a href="{{'https://www.craighughesupholstery.co.uk/my-account'}}" target="_blank" style="text-decoration:none; margin-bottom: 30px; border:none; color:#FFF; padding: 15px; background-color: #0dcaf0;">Click here to view your orders.</a>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>
</body>
</html>
