<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="container">
    <div class="container">
        <h3> {{ $email }}, Your order is been placed successfully !!</h3>
        <br>
        Below are the Order Details :
        </p>
    </div>

    <table class="table" id="example1">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Order Specification</th>
                <th scope="col">Order Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>1</th>
                <th>Customer Name</th>
                <td>{{ $name }}</td>
            </tr>
            <tr>
                <th>2</th>
                <th>Customer Email</th>
                <td>{{ $email }}</td>
            </tr>
            <tr>
                <th>3</th>
                <th>Customer Address</th>
                <td>{{ $address }}</td>
            </tr>
            <tr>
                <th>4</th>
                <th>Customer Zip Code</th>
                <th>{{ $pcode }}</th>
            </tr>
            <tr>
                <th>5</th>
                <th>Customer Phone</th>
                <td>{{ $mobile }}</td>
            </tr>
            <tr>
                <th>6</th>
                <th>Order Total</th>
                <td class="text text-danger">$ {{ $cart_sub_total }}</td>
            </tr>
            <tr>
                <th>7</th>
                <th>Shipping Cost</th>
                <td class="text text-danger">$ {{ $shipping_cost }}</td>
            </tr>
            <tr>
                <th>8</th>
                <th>Billing Amount (* including coupons)</th>
                <td class="text text-success">$ {{ $total }}</td>
            </tr>
        </tbody>
    </table>

    <div class="container">
        <p>
        <h2>Thanks & Regards,</h2><br>
        <h5>Shopping Cart Team.</h5>
        </p>
    </div>

</body>

</html>
