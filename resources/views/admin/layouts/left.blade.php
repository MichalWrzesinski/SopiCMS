<div id="left-menu" class="collapse show">
    <section class="mb-4 d-block d-xl-none">
        <h4 class="p-4">{{ __('admin.nav') }}</h4>
        <ul class="list-group list-group-flush pb-3">
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.dashboard') }}">
                    {{ __('admin.home') }}
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('home') }}">
                    {{ __('admin.back') }}
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('user.dashboard') }}">
                    {{ __('admin.account') }}
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('auth.logout') }}">
                    {{ __('admin.logout') }}
                </a>
            </li>
        </ul>
    </section>
    <section class="mb-4">
        <h4 class="p-4">{{ __('items.header.title') }}</h4>
        <ul class="list-group list-group-flush pb-3">
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.items.list') }}">
                    {{ __('items.header.list') }}
                </a>
                <span class="badge bg-primary rounded-pill">
                    {{ App\Models\Item::count() }}
                </span>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.items.list.inactive') }}">
                    {{ __('items.header.deactive') }}
                </a>
                <span class="badge bg-primary rounded-pill">
                    {{ App\Models\Item::where('status', 0)->count() }}
                </span>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.items.settings') }}">
                    {{ __('items.header.settings') }}
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.categories.list') }}">
                    {{ __('categories.header.title') }}
                </a>
                <span class="badge bg-primary rounded-pill">
                    {{ App\Models\Category::count() }}
                </span>
            </li>
        </ul>
    </section>
    <section class="mb-4">
        <h4 class="p-4">{{ __('users.header.title') }}</h4>
        <ul class="list-group list-group-flush pb-3">
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.users.list') }}">
                    {{ __('users.header.list') }}
                </a>
                <span class="badge bg-primary rounded-pill">
                    {{ App\Models\User::count() }}
                </span>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.users.payments') }}">
                    {{ __('payments.header.title') }}
                </a>
                <span class="badge bg-primary rounded-pill">
                    {{ App\Models\Payment::count() }}
                </span>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.users.bans') }}">
                    {{ __('bans.header.title') }}
                </a>
                <span class="badge bg-primary rounded-pill">
                    {{ App\Models\Ban::count() }}
                </span>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.users.newsletter') }}">
                    {{ __('newsletter.header.title') }}
                </a>
            </li>
        </ul>
    </section>
    <section class="mb-4">
        <h4 class="p-4">{{ __('layout.header.pages') }}</h4>
        <ul class="list-group list-group-flush pb-3">
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.pages.list') }}">
                    {{ __('pages.header.title') }}
                </a>
                <span class="badge bg-primary rounded-pill">
                    {{ App\Models\Page::count() }}
                </span>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.blog.list') }}">
                    {{ __('blog.header.title') }}
                </a>
                <span class="badge bg-primary rounded-pill">
                    {{ App\Models\Blog::count() }}
                </span>
            </li>
        </ul>
    </section>
    <section class="mb-4">
        <h4 class="p-4">{{ __('settings.header.title') }}</h4>
        <ul class="list-group list-group-flush pb-3">
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.settings.seo') }}">
                    {{ __('settings.header.seo') }}
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.settings.socialmedia') }}">
                    {{ __('settings.header.socialMedia') }}
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.settings.email') }}">
                    {{ __('settings.header.email') }}
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.settings.ads') }}">
                    {{ __('settings.header.ads') }}
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-4">
                <a href="{{ route('admin.settings.other') }}">
                    {{ __('settings.header.other') }}
                </a>
            </li>
        </ul>
    </section>
</div>
