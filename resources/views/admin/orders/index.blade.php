@extends('admin.layout')

@section('title', 'Заказы')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Заказы</div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Когда отправлен</th>
                            <th>Сумма</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $order->name ?? '' }}</td>
                                <td>{{ $order->phone ?? '' }}</td>
                                <td>{{ $order->created_at->format('H:i d.m.Y') ?? '' }}</td>
                                <td>{{ $order->calculateFullSum() }}</td>
                                <td class="btn-group" role="group">
                                <a @admin href="{{ route('orders.show', $order) }}" @else
                                        href="{{ route('person.orders.show', $order) }}" @endadmin class="btn btn-success"
                                        type="button">Просмотр</a>
                                </td>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
