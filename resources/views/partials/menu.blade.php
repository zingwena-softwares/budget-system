<div class="sidebar">
    <nav class="sidebar-nav justify-content-start">

        <ul class="nav nav-tabs">
           
            <li class="nav-item">
                <a href="{{ route("admin.categories.index") }}" class="nav-link {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-cogs nav-icon">

                    </i>
                    {{ trans('cruds.category.title') }}
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route("admin.programmes.index") }}" class="nav-link {{ request()->is('admin/programmes') || request()->is('admin/programmes/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-cogs nav-icon">

                    </i>
                    Programmes
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route("admin.departments.index") }}" class="nav-link {{ request()->is('admin/departments') || request()->is('admin/categories/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-cogs nav-icon">

                    </i>
                   Departments
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route("admin.expenses.index") }}" class="nav-link {{ request()->is('admin/expenses') || request()->is('admin/expenses/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-cogs nav-icon">

                    </i>
                    {{ trans('cruds.expense.title') }}
                </a>
            </li>
            &nbsp;
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                &nbsp;
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>