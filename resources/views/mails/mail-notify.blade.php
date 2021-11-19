<div class="mail-container">

   <h2>Your order</h2>
   <ul class="list-group mb-3">
       @foreach($orders['order'] as $order)
            <li class="list-group-item"> 
                <strong>{{ $order['name'] }}</strong>, <small>{{ $order['category'] }}</small>
                <span class="float-right">
                {{ $order['price'] }}
                </span>
            </li>
        @endforeach
    </ul>
</div>