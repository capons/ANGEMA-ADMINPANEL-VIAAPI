<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel hide">
            <div class="pull-left image">
                <img src="{!! access()->user()->picture !!}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{!! access()->user()->name !!}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form hide">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('strings.backend.general.search_placeholder') }}"/>
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header hide">{{ trans('menus.backend.sidebar.general') }}</li>

            <!-- Optionally, you can add icons to the links -->

            @permission('region-management')
            <li class="{{ Active::pattern('admin/regions*') }}">
                <a href="{!! url('admin/regions') !!}"><span>{{ trans('menus.engena.regions.main') }}</span></a>
            </li>
            @endauth

            @permission('passes-management')
            <li class="{{ Active::pattern('admin/pass*') }} treeview">
                <a href="#">
                    <span>{{ trans('menus.engena.passes.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/pass*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/pass*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/passes*') }}">
                        <a href="{!! route('admin.passes.index') !!}">{{ trans('menus.engena.passes.main') }}</a>
                    </li>
                    <li class="{{ Active::pattern('admin/pass_types*') }}">
                        <a href="{!! route('admin.pass_types.index') !!}">{{ trans('menus.engena.passTypes.main') }}</a>
                    </li>
                    <li class="{{ Active::pattern('admin/pass_durations*') }}">
                        <a href="{!! route('admin.pass_durations.index') !!}">{{ trans('menus.engena.passDurations.main') }}</a>
                    </li>
                </ul>
            </li>
            @endauth

            @permission('reserves-management')
            <li class="{{ Active::pattern('admin/reserves*') }}">
                <a href="{!! route('admin.reserves.index') !!}">{{ trans('menus.engena.reserves.main') }}</a>
            </li>
            @endauth

            @permission('trail-management')
            <li class="{{ Active::pattern('admin/trails*') }}">
                <a href="{!! url('admin/trails') !!}"><span>{{ trans('menus.engena.trails.main') }}</span></a>
            </li>
            @endauth

            @permission('view-access-management')
            <li class="{{ Active::pattern('admin/access/*') }} treeview">
                <a href="#">
                    <span>{{ trans('menus.backend.access.title') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/access/*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/access/*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/access/users') }}">
                        <a href="{!! url('admin/access/users') !!}">{{ trans('menus.backend.access.users.main') }}</a>
                    </li>
                    <li class="{{ Active::pattern('admin/access/roles') }}">
                        <a href="{!! url('admin/access/roles') !!}">{{ trans('menus.backend.access.roles.main') }}</a>
                    </li>
                    <li class="{{ Active::pattern('admin/access/roles/permissions') }}">
                        <a href="{!! url('admin/access/roles/permissions#all-permissions') !!}">{{ trans('menus.backend.access.permissions.main') }}</a>
                    </li>
                </ul>
            </li>
            @endauth

            <li class="{{ Active::pattern('admin/log-viewer*') }} treeview hide">
                <a href="#">
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/log-viewer') }}">
                        <a href="{!! url('admin/log-viewer') !!}">{{ trans('menus.backend.log-viewer.dashboard') }}</a>
                    </li>
                    <li class="{{ Active::pattern('admin/log-viewer/logs') }}">
                        <a href="{!! url('admin/log-viewer/logs') !!}">{{ trans('menus.backend.log-viewer.logs') }}</a>
                    </li>
                </ul>
            </li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
