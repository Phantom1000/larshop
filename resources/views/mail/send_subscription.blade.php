@component('mail::message')
Уважаемый клиент, товар {{ $product->name }} появился в наличии

@component('mail::button', ['url' => route('product', [$product->category, $product])])
К товару
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
