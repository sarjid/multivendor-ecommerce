<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
        @if (auth('admin')->user()->photo)
            <img src="{{ auth('admin')->user()->photo }}" class="rounded-circle user-photo" alt="User Profile Picture">
        @else
            <img src="{{ Helper::userDefaultImage() }}" class="rounded-circle user-photo" alt="User Profile Picture"">
        @endif
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="{{ route('admin') }}" class="user-name" ><strong>{{ auth()->guard('admin')->user()->username }}</strong></a>
            </div>
            <hr>
            <ul class="row list-unstyled">
                <li class="col-4">
                    <small>Sales</small>
                    <h6>456</h6>
                </li>
                <li class="col-4">
                    <small>Order</small>
                    <h6>1350</h6>
                </li>
                <li class="col-4">
                    <small>Revenue</small>
                    <h6>$2.13B</h6>
                </li>
            </ul>
        </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu">Menu</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Chat"><i class="icon-book-open"></i></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting"><i class="icon-settings"></i></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#question"><i class="icon-question"></i></a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content p-l-0 p-r-0">
            <div class="tab-pane active" id="menu">
                <nav id="left-sidebar-nav" class="sidebar-nav">
                    <ul id="main-menu" class="metismenu">
                        <li class="active">
                            <a href="{{ route('admin') }}"><i class="icon-home"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="@yield('manage-banner')">
                            <a href="javascript::void(0)" class="has-arrow"><i class="icon-picture"></i>
                                <span>Banner Management</span>
                            </a>
                            <ul>
                                <li class="@yield('all-banner')">
                                    <a href="{{ route('banner.index') }}">All Banners</a>
                                </li>
                                <li class="@yield('create-banner')">
                                    <a href="{{ route('banner.create') }}">Add Banner</a>
                                </li>
                            </ul>
                        </li>

                        <li class="@yield('manage-category')">
                            <a href="javascript::void(0)" class="has-arrow"><i class="icon-list"></i>
                                <span>Category Management</span>
                            </a>
                            <ul>
                                <li class="@yield('all-category')">
                                    <a href="{{ route('category.index') }}">All Categories</a>
                                </li>
                                <li class="@yield('create-category')">
                                    <a href="{{ route('category.create') }}">Add Categories</a>
                                </li>
                            </ul>
                        </li>

                        <li class="@yield('manage-brand')">
                            <a href="javascript::void(0)" class="has-arrow"><i class="icon-list"></i>
                                <span>Brand Management</span>
                            </a>
                            <ul>
                                <li class="@yield('all-brand')">
                                    <a href="{{ route('brand.index') }}">All Brands</a>
                                </li>
                                <li class="@yield('create-brand')">
                                    <a href="{{ route('brand.create') }}">Add Brand</a>
                                </li>
                            </ul>
                        </li>

                        <li class="@yield('manage-product')">
                            <a href="javascript::void(0)" class="has-arrow"><i class="icon-briefcase"></i>
                                <span>Products Management</span>
                            </a>
                            <ul>
                                <li class="@yield('all-product')">
                                    <a href="{{ route('product.index') }}">All Products</a>
                                </li>
                                <li class="@yield('create-product')">
                                    <a href="{{ route('product.create') }}">Add Product</a>
                                </li>
                            </ul>
                        </li>

                        <li class="@yield('manage-shipping')">
                            <a href="javascript::void(0)" class="has-arrow"><i class="icon-briefcase"></i>
                                <span>Shipping Management</span>
                            </a>
                            <ul>
                                <li class="@yield('all-shipping')">
                                    <a href="{{ route('shipping.index') }}">All Shipping</a>
                                </li>
                                <li class="@yield('create-shipping')">
                                    <a href="{{ route('shipping.create') }}">Add Shipping</a>
                                </li>
                            </ul>
                        </li>

                        <li class="{{ \Request::is('admin/currency*') ? 'active':'' }}">
                            <a href="javascript::void(0)" class="has-arrow"><i class="icon-briefcase"></i>
                                <span>Currency Management</span>
                            </a>
                            <ul>
                                <li class="{{ \Request::is('admin/currency') ? 'active':'' }}">
                                    <a href="{{ route('currency.index') }}">All Currency</a>
                                </li>
                                <li class="{{ \Request::is('admin/currency/create') ? 'active':'' }}">
                                    <a href="{{ route('currency.create') }}">Add Currency</a>
                                </li>
                            </ul>
                        </li>

                        <li class="{{ \Request::is('admin/order*') ? 'active':'' }}">
                            <a href="javascript::void(0)" class="has-arrow"><i class="icon-layers"></i>
                                <span>Orders Management</span>
                            </a>
                            <ul>
                                <li class="{{ \Request::is('admin/order*') ? 'active':'' }}"><a href="{{ route('order.index') }}">All Order</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript::void(0)" class="has-arrow"><i class="icon-basket-loaded"></i>
                                <span>Carts Management</span>
                            </a>
                            <ul>
                                <li><a href="app-inbox.html">All Carts</a></li>
                                <li><a href="app-inbox.html">Add Carts</a></li>
                            </ul>
                        </li>

                        <li class="{{ \Request::is('admin/seller*') ? 'active':'' }}">
                            <a href="javascript::void(0)" class="has-arrow"><i class="icon-users"></i>
                                <span>Seller Management</span>
                            </a>
                            <ul>
                                <li class="{{ \Request::is('admin/seller') ? 'active':'' }}"><a href="{{ route('seller.index') }}">All Seller</a></li>
                                <li class="{{ \Request::is('admin/seller/create') ? 'active':'' }}"><a href="{{ route('seller.create') }}">Add Seller</a></li>
                            </ul>
                        </li>


                        <li>
                            <a href="javascript::void(0)" class="has-arrow"><i class="icon-grid"></i>
                                <span>Post Category</span>
                            </a>
                            <ul>
                                <li><a href="app-inbox.html">All Department</a></li>
                                <li><a href="app-inbox.html">Add Department</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript::void(0)" class="has-arrow"><i class="icon-tag"></i>
                                <span>Post Tags</span>
                            </a>
                            <ul>
                                <li><a href="app-inbox.html">All Department</a></li>
                                <li><a href="app-inbox.html">Add Department</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript::void(0)" class="has-arrow"><i class="icon-control-pause"></i>
                                <span>Post Management</span>
                            </a>
                            <ul>
                                <li><a href="app-inbox.html">All Department</a></li>
                                <li><a href="app-inbox.html">Add Department</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript::void(0)" class="has-arrow"><i class="icon-star"></i>
                                <span>Review Management</span>
                            </a>
                            <ul>
                                <li><a href="app-inbox.html">All Department</a></li>
                                <li><a href="app-inbox.html">Add Department</a></li>
                            </ul>
                        </li>

                        <li class="@yield('manage-coupon')">
                            <a href="javascript::void(0)" class="has-arrow"><i class="icon-check"></i>
                                <span>Coupon Management</span>
                            </a>
                            <ul>
                                <li class="@yield('all-coupon')"><a href="{{ route('coupon.index') }}">All Coupons</a></li>
                                <li class="@yield('create-coupon')"><a href="{{ route('coupon.create') }}">Add Coupons</a></li>
                            </ul>
                        </li>

                        <li class="@yield('manage-user')">
                            <a href="javascript::void(0)" class="has-arrow"><i class="icon-briefcase"></i>
                                <span>Users Management</span>
                            </a>
                            <ul>
                                <li class="@yield('all-user')">
                                    <a href="{{ route('user.index') }}">All Users</a>
                                </li>
                                <li class="@yield('create-user')">
                                    <a href="{{ route('user.create') }}">Add User/Seller</a>
                                </li>
                            </ul>
                        </li>


                        <li>
                            <a href="javascript::void(0)" class="has-arrow"><i class="icon-bubbles"></i>
                                <span>Comments Management</span>
                            </a>
                            <ul>
                                <li><a href="app-inbox.html">All Department</a></li>
                                <li><a href="app-inbox.html">Add Department</a></li>
                            </ul>
                        </li>

                        <li class="{{ \Request::is('admin/settings*') ? 'active':'' }}">
                            <a href="{{ route('setting.create') }}"><i class="icon-settings"></i> <span>Settings</span></a>
                        </li>

                    </ul>
                </nav>
            </div>
            <div class="tab-pane p-l-15 p-r-15" id="Chat">
                <form>
                    <div class="input-group m-b-20">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-magnifier"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                </form>
                <ul class="right_chat list-unstyled">
                    <li class="online">
                        <a href="javascript:void(0);">
                            <div class="media">
                                <img class="media-object " src="{{ asset('backend/assets') }}/images/xs/avatar4.jpg" alt="">
                                <div class="media-body">
                                    <span class="name">Chris Fox</span>
                                    <span class="message">Designer, Blogger</span>
                                    <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="online">
                        <a href="javascript:void(0);">
                            <div class="media">
                                <img class="media-object " src="{{ asset('backend/assets') }}/images/xs/avatar5.jpg" alt="">
                                <div class="media-body">
                                    <span class="name">Joge Lucky</span>
                                    <span class="message">Java Developer</span>
                                    <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="offline">
                        <a href="javascript:void(0);">
                            <div class="media">
                                <img class="media-object " src="{{ asset('backend/assets') }}/images/xs/avatar2.jpg" alt="">
                                <div class="media-body">
                                    <span class="name">Isabella</span>
                                    <span class="message">CEO, Thememakker</span>
                                    <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="offline">
                        <a href="javascript:void(0);">
                            <div class="media">
                                <img class="media-object " src="{{ asset('backend/assets') }}/images/xs/avatar1.jpg" alt="">
                                <div class="media-body">
                                    <span class="name">Folisise Chosielie</span>
                                    <span class="message">Art director, Movie Cut</span>
                                    <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="online">
                        <a href="javascript:void(0);">
                            <div class="media">
                                <img class="media-object " src="{{ asset('backend/assets') }}/images/xs/avatar3.jpg" alt="">
                                <div class="media-body">
                                    <span class="name">Alexander</span>
                                    <span class="message">Writter, Mag Editor</span>
                                    <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-pane p-l-15 p-r-15" id="setting">
                <h6>Choose Skin</h6>
                <ul class="choose-skin list-unstyled">
                    <li data-theme="purple">
                        <div class="purple"></div>
                        <span>Purple</span>
                    </li>
                    <li data-theme="blue">
                        <div class="blue"></div>
                        <span>Blue</span>
                    </li>
                    <li data-theme="cyan" class="active">
                        <div class="cyan"></div>
                        <span>Cyan</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div>
                        <span>Green</span>
                    </li>
                    <li data-theme="orange">
                        <div class="orange"></div>
                        <span>Orange</span>
                    </li>
                    <li data-theme="blush">
                        <div class="blush"></div>
                        <span>Blush</span>
                    </li>
                </ul>
                <hr>
                <h6>General Settings</h6>
                <ul class="setting-list list-unstyled">
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="checkbox">
                            <span>Report Panel Usag</span>
                        </label>
                    </li>
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="checkbox" checked>
                            <span>Email Redirect</span>
                        </label>
                    </li>
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="checkbox" checked>
                            <span>Notifications</span>
                        </label>
                    </li>
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="checkbox">
                            <span>Auto Updates</span>
                        </label>
                    </li>
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="checkbox">
                            <span>Offline</span>
                        </label>
                    </li>
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="checkbox">
                            <span>Location Permission</span>
                        </label>
                    </li>
                </ul>
            </div>
            <div class="tab-pane p-l-15 p-r-15" id="question">
                <form>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-magnifier"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                </form>
                <ul class="list-unstyled question">
                    <li class="menu-heading">HOW-TO</li>
                    <li><a href="javascript:void(0);">How to Create Campaign</a></li>
                    <li><a href="javascript:void(0);">Boost Your Sales</a></li>
                    <li><a href="javascript:void(0);">Website Analytics</a></li>
                    <li class="menu-heading">ACCOUNT</li>
                    <li><a href="javascript:void(0);">Cearet New Account</a></li>
                    <li><a href="javascript:void(0);">Change Password?</a></li>
                    <li><a href="javascript:void(0);">Privacy &amp; Policy</a></li>
                    <li class="menu-heading">BILLING</li>
                    <li><a href="javascript:void(0);">Payment info</a></li>
                    <li><a href="javascript:void(0);">Auto-Renewal</a></li>
                    <li class="menu-button m-t-30">
                        <a href="javascript:void(0);" class="btn btn-primary"><i class="icon-question"></i> Need Help?</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
