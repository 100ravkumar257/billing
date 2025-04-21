<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

              

                <!-- Dashboard -->
                <li class="{{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <i data-feather="book-open"></i>
                        <span>
                            {{__('sidebar.dashboard')}}
                        </span>
                    </a>
                </li>
                <!-- /Dashboard -->
                
                   <!-- CMS -->
                   @if(auth()->user()->can('Order_Management-list') || auth()->user()->can('cmscategory-list'))
                    <li class="submenu">
                        <a class="" href="javascript:void(0)" aria-expanded="false">
                            <!-- <i data-feather="file-text"></i> -->
                             <!-- https://feathericons.dev/?search=folder&iconset=feather -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z" />
                        </svg>

                            
                            <span class="hide-menu">{{__('Order Management')}} </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('Order_Management-list')
                                <li>
                                    <a href="{{ route('Order_Management.index') }}" title="{{__('Order List')}}" class="sidebar-link {{ (request()->is('')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('Order List')}}</span>
                                    </a>
                                </li>
                            @endcan

        
                        </ul>
                    </li>
                @endif
                <!-- /CMS -->

            <!-- catalogue -->

            @if(auth()->user()->can('categories-list') || auth()->user()->can('brand-list') || auth()->user()->can('packaging-type') || auth()->user()->can('product-list') )
                    <li class="submenu">
                        <a class="" href="javascript:void(0)" aria-expanded="false">
                            <i data-feather="book-open"></i>
                            <span class="hide-menu">{{__('sidebar.catalogues')}} </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('categories-list')
                                <li>
                                    <a href="{{ route('categories.index') }}" title="{{__('sidebar.category')}}" class="sidebar-link {{ (request()->is('admin/categories*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.category')}}</span>
                                    </a>
                                </li>
                            @endcan
                            
                            @can('brand-list')
                                <li>
                                    <a href="{{ route('brands.index') }}" title="{{__('sidebar.Brands ')}}" class="sidebar-link {{ (request()->is('admin/brands*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('Brands ')}}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- @can('product-list')
                                <li>
                                    <a href="{{ route('products.index') }}" title="{{__('sidebar.products ')}}" class="sidebar-link {{ (request()->is('admin/products*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('Products ')}}</span>
                                    </a>
                                </li>
                            @endcan -->

                            <!-- @can('shades-list')
                                <li>
                                    <a href="{{ route('shades.index') }}" title="{{__('sidebar.shades')}}" class="sidebar-link {{ (request()->is('admin/shades*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.shades')}}</span>
                                    </a> 
                                </li>
                            @endcan -->

                            <!-- @can('packaging-type-list')
                                <li>
                                    <a href="{{ route('packaging-types.index') }}" title="{{__('sidebar.packaging-type')}}" class="sidebar-link {{ (request()->is('admin/packaging-types*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.packaging-type')}}</span>
                                    </a> 
                                </li>
                            @endcan -->

                            @can('product-list')
                                <li>
                                    <a href="{{ route('products.index') }}" title="{{__('sidebar.products')}}" class="sidebar-link {{ (request()->is('admin/product*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.products')}}</span>
                                    </a> 
                                </li>
                            @endcan 

                        </ul>
                    </li>
                @endif 
                <!-- /catalogue -->    
                


                <!-- Users -->
                @if(auth()->user()->can('user-list') || auth()->user()->can('role-list') || auth()->user()->can('permission-list') || auth()->user()->can('user-activity'))
                    <li class="submenu">
                        <a class="" href="javascript:void(0)" aria-expanded="false">
                            <i data-feather="users"></i>
                            <span class="hide-menu">{{__('sidebar.user')}} </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('user-list')
                                <li>
                                    <a href="{{ route('users.index') }}" title="{{__('sidebar.user')}}" class="sidebar-link {{ (request()->is('admin/user*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.user')}}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('role-list')
                                <li>
                                    <a href="{{ route('roles.index') }}" title="{{__('sidebar.roles')}}" class="sidebar-link {{ (request()->is('admin/roles*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.roles')}}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('permission-list')
                                <li>
                                    <a href="{{ route('permissions.index') }}" title="{{__('sidebar.permissions')}}" class="sidebar-link {{ (request()->is('admin/permissions*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.permission')}}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('user-activity')
                                <li>
                                    <a href="/admin/user-activity" title="{{__('sidebar.user-activity')}}" class="sidebar-link {{ (request()->is('admin/setting/useractivity*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.user-activity')}}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                <!-- /Users -->

                <!-- Settings -->
                @if(auth()->user()->can('file-manager') || auth()->user()->can('currency-list') || auth()->user()->can('websetting-edit') || auth()->user()->can('log-view'))
                    <li class="submenu">
                        <a class="" href="javascript:void(0)" aria-expanded="false">
                            <i data-feather="settings"></i>
                            <span class="hide-menu">{{__('sidebar.settings')}} </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('currency-list')
                                <li>
                                    <a href="{{ route('currencies.index') }}" title="{{__('sidebar.currencies')}}" class="sidebar-link {{ (request()->is('admin/currencies*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.currency')}}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('websetting-edit')
                                <li>
                                    <a href="{{route('website-setting.edit')}}" title="{{__('sidebar.website-setting')}}" class="sidebar-link {{ (request()->is('admin/setting/website-setting*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.website-setting')}}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('file-manager')
                                <li>
                                    <a href="{{route('filemanager.index')}}" title="{{__('sidebar.file-manager')}}" class="sidebar-link {{ (request()->is('admin/setting/file-manager*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.file-manager')}}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('log-view')
                                <li>
                                    <a href="/admin/log-reader" title="{{__('sidebar.read-logs')}}" class="sidebar-link {{ (request()->is('admin/setting/log*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.read-logs')}}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                <!-- /Settings -->


                <!-- Testimonials -->
                <!-- @if(auth()->user()->can('cmspage-list') || auth()->user()->can('cmscategory-list'))
                    <li class="submenu">
                        <a class="" href="javascript:void(0)" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <line x1="4" x2="4" y1="21" y2="14" />
                        <line x1="4" x2="4" y1="10" y2="3" />
                        <line x1="12" x2="12" y1="21" y2="12" />
                        <line x1="12" x2="12" y1="8" y2="3" />
                        <line x1="20" x2="20" y1="21" y2="16" />
                        <line x1="20" x2="20" y1="12" y2="3" />
                        <line x1="1" x2="7" y1="14" y2="14" />
                        <line x1="9" x2="15" y1="8" y2="8" />
                        <line x1="17" x2="23" y1="16" y2="16" />
                        </svg>
                            <span class="hide-menu">{{__('Testimonials')}} </span>
                            <span class="menu-arrow"></span>                        
                        </a>

                        <ul style="display: none;">
                            @can('cmscategory-list')
                            <li>
                                    <a href="{{ route('testimonials.index') }}" title="{{__('Testimonials')}}" class="sidebar-link {{ (request()->is('admin/testimonials*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('Testimonials')}}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif -->
                <!-- /Testimonials -->                            
            </ul>
        </div> <!-- /Sidebar-Menu -->
    </div> <!-- /Sidebar-inner -->
</div><!-- /Sidebar -->
