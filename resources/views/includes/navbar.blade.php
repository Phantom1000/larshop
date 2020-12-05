<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">Интернет Магазин</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbar" class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item @activeroute('index')"><a href="{{ route('index') }}" class="nav-link">Все
                        товары</a></li>
                <li class="nav-item @activeroute('categor*')"><a href="{{ route('categories') }}"
                        class="nav-link">Категории</a>
                </li>
                <li class="nav-item @activeroute('basket*')"><a href="{{ route('basket') }}" class="nav-link">В
                        корзину</a></li>
                <li class="nav-item"><a href="{{ route('reset') }}" class="nav-link">Сбросить проект в начальное
                        состояние</a></li>
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Войти</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Зарегистрироваться</a>
                </li>
                @endguest
                @auth
                @admin
                <li><a href="{{ route('home') }}" class="nav-link">Панель администратора</a></li>
                @else
                <li><a href="{{ route('person.orders.index') }}" class="nav-link">Мои заказы</a></li>
                @endadmin

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link text-white mt-1">Выйти</button>
                    </form>
                </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>