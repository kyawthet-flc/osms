<li class="nav-item">      
    <a class="nav-link" data-toggle="collapse" href="#product-dropdown" aria-expanded="false" aria-controls="product-dropdown">
    <i class="menu-icon mdi mdi-shopping"></i>
    <span class="menu-title">Product</span>
    <i class="menu-arrow"></i>
    </a>
    <div class="collapse show" id="product-dropdown">
    <ul class="nav flex-column sub-menu">
        <li class="nav-item" {!! is_active_route('product.index') !!}>
        <a class="nav-link" href="{{ route('product.index') }}"><i class="mdi mdi-format-list-numbers"></i> List</a>
        </li>
        <li class="nav-item" {!! is_active_route('product.create') !!}>
        <a class="nav-link" href="{{ route('product.create') }}"><i class="mdi mdi-plus-circle"></i> New</a>
        </li>
    </ul>
    </div>
</li>


<li class="nav-item">      
    <a class="nav-link" data-toggle="collapse" href="#order-dropdown" aria-expanded="false" aria-controls="order-dropdown">
    <i class="menu-icon mdi mdi-gift"></i>
    <span class="menu-title">Order</span>
    <i class="menu-arrow"></i>
    </a>
    <div class="collapse show" id="order-dropdown">
    <ul class="nav flex-column sub-menu">
        <li class="nav-item" {!! is_active_route('order.index') !!}>
        <a class="nav-link" href="{{ route('order.index') }}"><i class="mdi mdi-format-list-numbers"></i> List</a>
        </li>
        <li class="nav-item" {!! is_active_route('order.create') !!}>
        <a class="nav-link" href="{{ route('order.create') }}"><i class="mdi mdi-plus-circle"></i> New</a>
        </li>
    </ul>
    </div>
</li>
<li class="nav-item">      
    <a class="nav-link" data-toggle="collapse" href="#shop-dropdown" aria-expanded="false" aria-controls="shop-dropdown">
    <i class="menu-icon mdi mdi-store"></i>
    <span class="menu-title">Shop</span>
    <i class="menu-arrow"></i>
    </a>
    <div class="collapse show" id="shop-dropdown">
    <ul class="nav flex-column sub-menu">
        <li class="nav-item" {!! is_active_route('shop.index') !!}>
        <a class="nav-link" href="{{ route('shop.index') }}"><i class="mdi mdi-format-list-numbers"></i> List</a>
        </li>
        <li class="nav-item" {!! is_active_route('shop.create') !!}>
        <a class="nav-link" href="{{ route('shop.create') }}"><i class="mdi mdi-plus-circle"></i>New</a>
        </li>
    </ul>
    </div>
</li>

<li class="nav-item">      
    <a class="nav-link" data-toggle="collapse" href="#customer-dropdown" aria-expanded="false" aria-controls="customer-dropdown">
    <i class="menu-icon mdi mdi-account-multiple"></i>
    <span class="menu-title">Customer</span>
    <i class="menu-arrow"></i>
    </a>
    <div class="collapse show" id="customer-dropdown">
    <ul class="nav flex-column sub-menu">
        <li class="nav-item" {!! is_active_route('customer.index') !!}>
        <a class="nav-link" href="{{ route('customer.index') }}"><i class="mdi mdi-format-list-numbers"></i> List</a>
        </li>
        <li class="nav-item" {!! is_active_route('customer.create') !!}>
        <a class="nav-link" href="{{ route('customer.create') }}"><i class="mdi mdi-plus-circle"></i> New</a>
        </li>
    </ul>
    </div>
</li>

<li class="nav-item">      
    <a class="nav-link" data-toggle="collapse" href="#supplier-dropdown" aria-expanded="false" aria-controls="supplier-dropdown">
    <i class="menu-icon mdi mdi-account-multiple"></i>
    <span class="menu-title">Supplier</span>
    <i class="menu-arrow"></i>
    </a>
    <div class="collapse show" id="supplier-dropdown">
    <ul class="nav flex-column sub-menu">
        <li class="nav-item" {!! is_active_route('supplier.index') !!}>
        <a class="nav-link" href="{{ route('supplier.index') }}"><i class="mdi mdi-format-list-numbers"></i> List</a>
        </li>
        <li class="nav-item" {!! is_active_route('supplier.create') !!}>
        <a class="nav-link" href="{{ route('supplier.create') }}"><i class="mdi mdi-plus-circle"></i> New</a>
        </li>
    </ul>
    </div>
</li>