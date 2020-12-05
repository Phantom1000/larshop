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
            <p>
                <form action="{{ route('basket-add', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                    <a href="{{ route('product', [$category ?? $product->category, $product]) }}" class="btn btn-default"
                        role="button">Подробнее</a>
                </form>
            </p>
        </div>
    </div>
</div>