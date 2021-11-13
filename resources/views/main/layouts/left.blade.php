@auth
    <section class="p-4 mb-4">
        <h2>Nawigacja</h2>
        <ul class="list">
            <li><a href="{{ route('user.dashboard') }}">Twoje konto</a></li>
            <li><a href="{{ route('user.manage') }}">Ustawienia konta</a></li>
            @can('admin')
                <li><a href="{{ route('admin.dashboard') }}">Panel administracyjny</a></li>
            @endcan
            <li><a href="{{ route('user.logout') }}">Wyloguj się</a></li>
        </ul>
    </section>
    <section class="p-4">
        <h2>{{ config('sopicms.item.name') }}</h2>
        <ul class="list">
            <li><a href="{{ route('user.item.list') }}">{{ config('sopicms.item.userList') }}</a></li>
            <li><a href="{{ route('user.item.add') }}">{{ config('sopicms.item.add') }}</a></li>
            <li><a href="{{ route('user.item.favorite.list') }}">{{ config('sopicms.item.favoriteList') }}</a></li>
            <li><a href="{{ route('item.list') }}">{{ config('sopicms.item.search') }}</a></li>
        </ul>
    </section>
@else
    <section class="p-4 mb-4">
        <h2>Nawigacja</h2>
        <ul class="list">
            <li><a href="{{ route('user.login') }}">Logowanie</a></li>
            <li><a href="{{ route('user.register') }}">Rejestracja</a></li>
            <li><a href="{{ route('user.password') }}">Przypomnij hasło</a></li>
        </ul>
    </section>
@endauth
