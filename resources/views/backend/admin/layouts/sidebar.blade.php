<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.brands') }}"><i class="bx bx-right-arrow-alt"></i>All Brand</a>
                </li>
                <li> <a href="{{ route('admin.add.brand') }}"><i class="bx bx-right-arrow-alt"></i>Add Brand</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Categories</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.categories') }}"><i class="bx bx-right-arrow-alt"></i>All
                        Categories</a>
                </li>
                <li> <a href="{{ route('admin.add.category') }}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">SubCategories</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.subcategories') }}"><i class="bx bx-right-arrow-alt"></i>All
                        SubCategories</a>
                </li>
                <li> <a href="{{ route('admin.add.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Add
                        SubCategory</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Product Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.products') }}"><i class="bx bx-right-arrow-alt"></i>Product List</a>
                </li>
                <li> <a href="{{ route('admin.add.product') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Slider Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.slider') }}"><i class="bx bx-right-arrow-alt"></i>Slider List</a>
                </li>
                <li> <a href="{{ route('admin.add.slider') }}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Banner Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.banner') }}"><i class="bx bx-right-arrow-alt"></i>Banner List</a>
                </li>
                <li> <a href="{{ route('admin.add.banner') }}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Cupon System</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.cupon') }}"><i class="bx bx-right-arrow-alt"></i>All Cupon</a>
                </li>
                <li> <a href="{{ route('admin.add.cupon') }}"><i class="bx bx-right-arrow-alt"></i>Add Cupon</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Shipping Area</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.division') }}"><i class="bx bx-right-arrow-alt"></i>All Division</a>
                </li>
                <li> <a href="{{ route('admin.all.district') }}"><i class="bx bx-right-arrow-alt"></i>All District</a>
                </li>
                <li> <a href="{{ route('admin.all.state') }}"><i class="bx bx-right-arrow-alt"></i>All State</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">UI Elements</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Vendor Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.vendor.inactive') }}"><i class="bx bx-right-arrow-alt"></i>Inactive
                        Vendor</a>
                </li>
                <li> <a href="{{ route('admin.vendor.active') }}"><i class="bx bx-right-arrow-alt"></i>Active
                        Vendor</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Order Manage</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.pending.order') }}"><i class="bx bx-right-arrow-alt"></i>Pending
                        Order</a>
                </li>
                <li>
                    <a href="{{ route('admin.confirmed.order') }}"><i class="bx bx-right-arrow-alt"></i>Confirmed
                        Order</a>
                </li>
                <li>
                    <a href="{{ route('admin.processing.order') }}"><i class="bx bx-right-arrow-alt"></i>Processing
                        Order</a>
                </li>
                <li>
                    <a href="{{ route('admin.deliverded.order') }}"><i class="bx bx-right-arrow-alt"></i>Deliverded
                        Order</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Return Orders</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.return.request') }}"><i class="bx bx-right-arrow-alt"></i>Return
                        Request
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.complete.return.request') }}"><i
                            class="bx bx-right-arrow-alt"></i>Complete
                        Request
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Report Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.report.view') }}"><i class="bx bx-right-arrow-alt"></i>Report View</a>
                </li>
                <li> <a href="{{ route('admin.order.by.user') }}"><i class="bx bx-right-arrow-alt"></i>Order By
                        User</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-users"></i>
                </div>
                <div class="menu-title">User Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.user') }}"><i class="bx bx-right-arrow-alt"></i>All User</a>
                </li>
                <li> <a href="{{ route('admin.all.vendor') }}"><i class="bx bx-right-arrow-alt"></i>All Vendor</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-users"></i>
                </div>
                <div class="menu-title">Blog Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.blog.category') }}"><i class="bx bx-right-arrow-alt"></i>All Blog
                        Category</a>
                </li>
                <li> <a href="{{ route('admin.blog.post') }}"><i class="bx bx-right-arrow-alt"></i>All Blog Post</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-users"></i>
                </div>
                <div class="menu-title">Review Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.pending.review') }}"><i class="bx bx-right-arrow-alt"></i>Pending
                        Reviews</a>
                </li>
                <li> <a href="{{ route('admin.publish.review') }}"><i class="bx bx-right-arrow-alt"></i>Publish
                        Reviews</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-settings text-secondary">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path
                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                        </path>
                    </svg></i>
                </div>
                <div class="menu-title">Setting Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.site.setting') }}"><i class="bx bx-right-arrow-alt"></i>Site
                        Setting</a>
                </li>
                <li> <a href="{{ route('admin.seo.setting') }}"><i class="bx bx-right-arrow-alt"></i>Seo
                        Setting</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-users"></i>
                </div>
                <div class="menu-title">Stock Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.product.stock') }}"><i class="bx bx-right-arrow-alt"></i>Stock
                        Products</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Icons</div>
            </a>
            <ul>
                <li> <a href="icons-line-icons.html"><i class="bx bx-right-arrow-alt"></i>Line Icons</a>
                </li>
                <li> <a href="icons-boxicons.html"><i class="bx bx-right-arrow-alt"></i>Boxicons</a>
                </li>
                <li> <a href="icons-feather-icons.html"><i class="bx bx-right-arrow-alt"></i>Feather Icons</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Role And Permission</li>
        <li>
            <a class="has-arrow" href="javascript:void(0);">
                <div class="parent-icon"><i class="bx bx-line-chart"></i>
                </div>
                <div class="menu-title">Role & Permission</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.permission') }}"><i class="bx bx-right-arrow-alt"></i>All
                        Permission</a>
                </li>
                <li> <a href="{{ route('admin.all.role') }}"><i class="bx bx-right-arrow-alt"></i>All Roles</a>
                </li>
                <li> <a href="{{ route('admin.add.roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>Roles
                        in
                        Permission</a>
                </li>
                <li> <a href="{{ route('admin.all.roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>All
                        Roles
                        Permission</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
