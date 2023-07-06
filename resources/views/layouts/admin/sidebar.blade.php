<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" width="50" src="{{asset('images/logo.png')}}" alt="User Image">
    <div>
      <p class="app-sidebar__user-name">Hello,</p>
      <p class="app-sidebar__user-designation">Admin</p>
    </div>
  </div>
  <ul class="app-menu">
    <li><a class="app-menu__item {{ Request::routeIs('admin-dashboard') ? 'active' : '' }}" href="{{route('admin-dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
    <li><a class="app-menu__item {{ Request::routeIs('orders') ? 'active' : '' }}" href="{{route('orders')}}"><i class="app-menu__icon fa fa-cart-arrow-down"></i><span class="app-menu__label">Orders</span></a></li>
    <li><a class="app-menu__item {{ Request::routeIs('customers') ? 'active' : '' }}" href="{{route('customers')}}"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Customers</span></a></li>
    <li><a class="app-menu__item {{ Request::routeIs('vendors') ? 'active' : '' }}" href="{{route('vendors')}}"><i class="app-menu__icon fa fa-vcard"></i><span class="app-menu__label">Vendors</span></a></li>
    <li><a class="app-menu__item {{ Request::routeIs('products') ? 'active' : '' }}" href="{{route('products')}}"><i class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Products</span></a></li>
    <li><a class="app-menu__item {{ Request::routeIs('riders') ? 'active' : '' }}" href="{{route('riders')}}"><i class="app-menu__icon fa fa-bicycle"></i><span class="app-menu__label">Riders</span></a></li>
    <li><a class="app-menu__item {{ Request::routeIs('category') ? 'active' : '' }}" href="{{route('categories')}}"><i class="app-menu__icon fa fa-calendar"></i><span class="app-menu__label">Vendor Categories</span></a></li>
    <li><a class="app-menu__item {{ Request::routeIs('item_types') ? 'active' : '' }}" href="{{route('item_types')}}"><i class="app-menu__icon fa fa-clipboard"></i><span class="app-menu__label">Item Types</span></a></li>
    <li><a class="app-menu__item {{ Request::routeIs('vouchers') ? 'active' : '' }}" href="{{route('vouchers')}}"><i class="app-menu__icon fa fa-sticky-note"></i><span class="app-menu__label">Vouchers</span></a></li>
    <li><a class="app-menu__item {{ Request::routeIs('push_notification') ? 'active' : ''}}" href="{{route('push_notification')}}"><i class="app-menu__icon fa fa-bullhorn"></i><span class="app-menu__label">Send Notification</span></a></li>
  </ul>
</aside>