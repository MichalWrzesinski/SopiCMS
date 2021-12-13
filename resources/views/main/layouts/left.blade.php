@auth
    <section class="p-4 pb-3 mb-4">
        <h2>{{ __('layout.header.nav') }}</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('user.dashboard') }}">
                    {{ __('user.header.title') }}
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('user.manage') }}">
                    {{ __('user.header.manage') }}
                </a>
            </li>
            @can('admin')
                <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                    <a href="{{ route('admin.dashboard') }}">
                        {{ __('user.header.admin') }}
                    </a>
                </li>
            @endcan
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('auth.logout') }}">
                    {{ __('user.header.logout') }}
                </a>
            </li>
        </ul>
    </section>
    <section class="p-4 pb-3 mb-4">
        <h2>{{ __('items.header.title') }}</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('user.item.list') }}">
                    {{ __('items.header.user') }}
                </a>
                <span class="badge bg-primary rounded-pill">{{ App\Models\Item::where('user_id', Auth::id())->count() }}</span>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('user.item.add') }}">
                    {{ __('items.header.add') }}
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('item.list') }}">
                    {{ __('items.header.title') }}
                </a>
                <span class="badge bg-primary rounded-pill">{{ App\Models\Item::count() }}</span>
            </li>
        </ul>
    </section>
@else
    <section class="p-4 pb-3 mb-4">
        <h2>{{ __('layout.header.nav') }}</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('auth.login') }}">
                    {{ __('auth.header.login') }}
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('auth.register') }}">
                    {{ __('auth.header.register') }}
                </a>
            </li>
            <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                <a href="{{ route('auth.password') }}">
                    {{ __('auth.header.password') }}
                </a>
            </li>
        </ul>
    </section>
@endauth

@if(config('settings.ads.block3'))
    <div id="block-3" class="mb-4">
        {!! config('settings.ads.block3') !!}
    </div>
@endif
