<p>Уважаемый {{ $name }}</p>

<p>Ваш заказ на сумму {{ $sum }} создан</p>

<table>
    <tbody>
        @foreach ($order->products as $product)
            <tr>
                <td>
                    <a href="{{ route('product', [$product->category, $product]) }}">
                        <img height="56px" src="{{ asset('storage/' . $product->image) }}">
                        {{ $product->name }}
                    </a>
                </td>
                <td><span class="badge">{{ $product->pivot->count }}</span>
                    <div class="btn-group form-inline">
                        {!! $product->description !!}
                    </div>
                </td>
                <td>{{ $product->price }} ₽</td>
                <td>{{ $product->getPriceForCount() }} ₽</td>
            </tr>
        @endforeach
    </tbody>
</table>