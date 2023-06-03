<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Orders</title>
</head>

<body>
    <div class="container">
        <h1>Order creation</h1>
        <form action="{{route('order.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="fio">First/Last name</label>
                <input type="text" name="name" class="form-control" id="fio" aria-describedby="emailHelp" placeholder="Place your name">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email">
            </div>


            <div class="form-group">
                <label for="">Goods</label>
                <select class="form-control" name="product">
                    <option value="knife">Knife</option>
                    <option value="pancil">Pencil</option>
                    <option value="notebook">Notebook</option>
                    <option value="keyboard">keyboard</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Place order</button>
        </form>

        <div class="mt-3">
            <div class="mb-3">
                <h5>Accepted orders</h5>
            </div>
            <div>
                <table style="width: 600px;" class="border">
                    <thead style="width: 100%;">
                        <tr class="border-bottom">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Product</th>
                        </tr>
                    </thead>
                    <tbody style="width: 100%;">
                        @foreach($orders as $order)
                        <tr class="border-bottom">
                            <th class="border-left border-right d-flex justify-content-center">{{$order->id}}</th>
                            <th class="border-left border-right">{{$order->name}}</th>
                            <th class="border-left border-right">{{$order->email}}</th>
                            <th class="border-left border-right">{{$order->product}}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>