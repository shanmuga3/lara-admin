<aside class="app-sidebar shadow transition-none" data-bs-theme="light">
    <div class="sidebar-brand">
        <a href="{{ route('home') }}" class="brand-link" target="_blank">
            <img src="{{ $site_logo }}" alt="{{ $site_name }}" class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light"> {{ $site_name }}</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                @foreach(\App\Services\NavigationService::generate_menu($active_menu) as $menu)
                <li class="nav-item {{ $menu['has_submenu'] && $menu['is_active'] ? 'menu-open': '' }}">
                    @if($menu['has_submenu'])
                    <a href="#" class="nav-link {{ $menu['is_active'] ? 'active':'' }}">
                        <i class="{{ $menu['icon'] }}"></i>
                        <p> {{ $menu['text'] }} </p>
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach($menu['sub_menu'] as $sub_menu)
                        <li class="nav-item">
                            <a href="{{ $sub_menu['link'] }}" class="nav-link {{ $sub_menu['is_active'] ? 'active':'' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p> {{ $sub_menu['text'] }} </p>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <a href="{{ $menu['link'] }}" class="nav-link {{ $menu['is_active'] ? 'active':'' }}">
                        <i class="{{ $menu['icon'] }}"></i>
                        <p> {{ $menu['text'] }} </p>
                    </a>
                    @endif
                </li>
                @endforeach
            </ul>
        </nav>
    </div>
</aside>