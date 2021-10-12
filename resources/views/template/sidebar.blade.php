<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">SIGASI Personil</a>
        </div>
        <ul class="sidebar-menu">
            @foreach ($Menu as $m)
            <li class="menu-header">{{ $m->menu; }}</li>
            <?php
            $ds = App\Models\UserSubMenu::where('menu_id', $m->menu_id)->get(); ?>
            @foreach ($ds as $sm)
            @if ($title == $sm->title)
            <li class="active">
                @else
                <li class="nav-item">
                    @endif
                    <a class="nav-link" href="{{route($sm->url)}}"><i class="{{ $sm->gambar }}"></i><span> {{ $sm->title }}</span></a>
                </li>
                @endforeach
            @endforeach
        </ul>
    </aside>
</div>