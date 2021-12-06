<div id="left-menu" class="collapse show">
    <section class="mb-4 d-block d-xl-none">
        <h4 class="p-4">Nawigacja</h4>
        <ul class="list-group list-group-flush pb-3">
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.dashboard') }}">
                    Strona główna
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('home') }}">
                    Powrót do serwisu
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('user.dashboard') }}">
                    Twoje konto
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('auth.logout') }}">
                    Wyloguj się
                </a>
            </li>
        </ul>
    </section>
    <section class="mb-4">
        <h4 class="p-4">{{ config('sopicms.item.name') }}</h4>
        <ul class="list-group list-group-flush pb-3">
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.items.list') }}">
                    {{ config('sopicms.item.list') }}
                </a>
                <span class="badge bg-primary rounded-pill">
                    {{ App\Models\Item::count() }}
                </span>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.items.list.inactive') }}">
                    Do aktywacji
                </a>
                <span class="badge bg-primary rounded-pill">
                    {{ App\Models\Item::where('status', 0)->count() }}
                </span>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.items.settings') }}">
                    Ustawienia
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.categories.list') }}">
                    Kategorie
                </a>
                <span class="badge bg-primary rounded-pill">
                    {{ App\Models\Category::count() }}
                </span>
            </li>
        </ul>
    </section>
    <section class="mb-4">
        <h4 class="p-4">Użytkownicy</h4>
        <ul class="list-group list-group-flush pb-3">
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.users.list') }}">
                    Lista użytkowników
                </a>
                <span class="badge bg-primary rounded-pill">
                    {{ App\Models\User::count() }}
                </span>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.users.payments') }}">
                    Płatności
                </a>
                <span class="badge bg-primary rounded-pill">
                    {{ App\Models\Payment::count() }}
                </span>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.users.bans') }}">
                    Banicja
                </a>
                <span class="badge bg-primary rounded-pill">
                    {{ App\Models\Ban::count() }}
                </span>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.users.newsletter') }}">
                    Newsletter
                </a>
            </li>
        </ul>
    </section>
    <section class="mb-4">
        <h4 class="p-4">Treści</h4>
        <ul class="list-group list-group-flush pb-3">
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.pages.list') }}">
                    Strony
                </a>
                <span class="badge bg-primary rounded-pill">
                    {{ App\Models\Page::count() }}
                </span>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.blog.list') }}">
                    Blog
                </a>
                <span class="badge bg-primary rounded-pill">
                    {{ App\Models\Blog::count() }}
                </span>
            </li>
        </ul>
    </section>
    <section class="mb-4">
        <h4 class="p-4">Ustawienia</h4>
        <ul class="list-group list-group-flush pb-3">
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.settings.seo') }}">
                    Optymalizacja SEO
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.settings.socialmedia') }}">
                    Social media
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.settings.email') }}">
                    Poczta e-mail
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.settings.ads') }}">
                    Reklamy
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.settings.other') }}">
                    Inne ustawienia
                </a>
            </li>
        </ul>
    </section>
</div>
