@auth
    <ul>
        {{-- Categories --}}
        @if (auth()->user()->hasOneRoleOf(['super admin', 'admin']) ||
                auth()->user()->can('view categories'))
            <li><a href="{{ route('admin.categories.index') }}">Categories</a></li>
        @endif
        @if (auth()->user()->hasOneRoleOf(['super admin', 'admin']) ||
                auth()->user()->can('create category'))
            <li><a href="{{ route('admin.category.create') }}">Create Category</a></li>
        @endif


        {{-- Roles --}}
        @if (auth()->user()->hasOneRoleOf(['super admin', 'admin']) ||
                auth()->user()->can('view roles'))
            <li><a href="{{ route('admin.roles.index') }}">Roles</a>
        @endif
        @if (auth()->user()->hasOneRoleOf(['super admin', 'admin']) ||
                auth()->user()->can('create role'))
            <li><a href="{{ route('admin.role.create') }}">Create Role</a></li>
        @endif

        {{-- Permissions --}}
        @if (auth()->user()->hasOneRoleOf(['super admin', 'admin']) ||
                auth()->user()->can('view permissions'))
            <li><a href="{{ route('admin.permissions.index') }}">Permissions</a></li>
        @endif
        @if (auth()->user()->hasOneRoleOf(['super admin', 'admin']) ||
                auth()->user()->can('create permission'))
            <li><a href="{{ route('admin.permission.create') }}">Create Permission</a></li>
        @endif
    </ul>
@endauth
