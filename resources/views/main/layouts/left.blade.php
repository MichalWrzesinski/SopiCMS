@auth
    <section class="p-4 pb-3 mb-4">
        <h2>Nawigacja</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('user.dashboard') }}">
                    Twoje konto
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('user.manage') }}">
                    Ustawienia konta
                </a>
            </li>
            @can('admin')
                <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                    <a href="{{ route('admin.dashboard') }}">
                        Panel administracyjny
                    </a>
                </li>
            @endcan
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('user.logout') }}">
                    Wyloguj się
                </a>
            </li>
        </ul>
    </section>
    <section class="p-4 pb-3 mb-4">
        <h2>{{ config('sopicms.item.name') }}</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('user.item.list') }}">
                    {{ config('sopicms.item.userList') }}
                </a>
                <span class="badge bg-primary rounded-pill">{{ App\Models\Item::where('user_id', Auth::id())->count() }}</span>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('user.item.add') }}">
                    {{ config('sopicms.item.add') }}
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('item.list') }}">
                    {{ config('sopicms.item.search') }}
                </a>
                <span class="badge bg-primary rounded-pill">{{ App\Models\Item::count() }}</span>
            </li>
        </ul>
    </section>
@else
    <section class="p-4 pb-3 mb-4">
        <h2>Nawigacja</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('user.login') }}">
                    Logowanie
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('user.register') }}">
                    Rejestracja
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('user.password') }}">
                    Przypomnij hasło
                </a>
            </li>
        </ul>
    </section>
@endauth
