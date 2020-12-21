<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if ($product->new)
            <span class="badge badge-success">Новинка</span>
            @endif
            @if ($product->recommend)
            <span class="badge badge-warning">Рекомендуемые</span>
            @endif
            @if ($product->hit)
            <span class="badge badge-danger">Хит продаж</span>
            @endif
        </div>
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->price }} ₽</p>
            <div class="d-flex mb-5 ml-5">
                @if ($product->isAvailable())
                    <form action="{{ route('basket-add', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                    </form>
                @else
                <div class="mt-1">
                    Нет в наличии
                </div>
                @endif
                <a href="{{ route('product', [$category ?? $product->category, $product]) }}" class="btn btn-default ml-2"
                    role="button">Подробнее</a>
            </div>
        </div>
    </div>
</div>