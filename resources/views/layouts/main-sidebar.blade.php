    <!--**********************************Sidebar start***********************************-->
    <div class="dlabnav">
        <div class="dlabnav-scroll">
            <ul class="metismenu" id="menu">
                <li class="nav-label first">القائمة الرئيسيه</li>

                <li><a class="ai-icon" href="{{ url('/' . $page='dashboard') }}" aria-expanded="false">
                        <i class="la la-home"></i>
                        <span class="nav-text">لوحة التحكم</span>
                    </a>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="las la-file-invoice"></i>
                        <span class="nav-text">اوردرات اونلاين</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="about-courses.html">قائمة جميع الاوردرات</a></li>
                        <li><a href="all-courses.html">أضافة اوردر جديد</a></li>
                        <li><a href="add-courses.html">اوردرات تحت التجهيز</a></li>
                        <li><a href="edit-courses.html">اوردرات تحت التسليم</a></li>
                        <li><a href="edit-courses.html">اوردرات مؤجلة</a></li>
                        <li><a href="edit-courses.html">اوردرات مرتجع</a></li>

                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="las la-file-invoice-dollar"></i>
                        <span class="nav-text">حساب الموردين</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="about-courses.html">قائمة الفواتير</a></li>
                        <li><a href="all-courses.html">أضافة فاتورة لمورد</a></li>
                        <li><a href="add-courses.html">أضافة سداد لمورد</a></li>
                        <li><a href="edit-courses.html">كشف حساب مورد</a></li>

                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="las la-donate"></i>
                        <span class="nav-text">حساب الخزينة</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="about-courses.html">كشف حساب الخزينة</a></li>
                        <li><a href="all-courses.html">أضافة مصروف</a></li>

                    </ul>
                </li>

                <li class="nav-label">إعدادات النظام</li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="la la-users"></i>
                        <span class="nav-text">المستخدمين & الصلاحيات</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('قائمة المستخدمين')
                            <li><a href="{{url('/'.$page='users')}}">قائمة المستخدمين</a></li>
                        @endcan
                        @can('أضافة مستخدمين')
                                <li><a href="{{url('/'.$page='users/create')}}">أضافة مستخدم</a></li>
                        @endcan

                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">صلاحيات المستخدمين</a>
                            <ul aria-expanded="false">
                                @can('قائمة الصلاحيات')
                                    <li><a href="{{url('/'.$page='roles')}}">قائمة الصلاحيات</a></li>
                                @endcan
                                @can('أضافة صلاحية')
                                    <li><a href="{{url('/'.$page='roles/create')}}">أضافة صلاحية</a></li>
                                @endcan
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="la la-tags"></i>
                        <span class="nav-text">الاقسام & المنتجات</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{url('/'.$page='productSection')}}">قائمة الاقسام</a></li>

                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">المنتجات</a>
                            <ul aria-expanded="false">
                                <li><a href="{{url(('/'.$page='product'))}}">قائمة المنتجات</a></li>
                                <li><a href="{{url('/'.$page='product/create')}}">أضافة منتج</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="las la-truck"></i>
                        <span class="nav-text">الشحن</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{url('/'.$page='shipping')}}">قائمة مناديب الشحن</a></li>
                        <li><a href="{{url('/'.$page='shipping/create')}}">أضافة مندوب شحن</a></li>
                        <li><a href="{{url('/'.$page='shippingArea')}}">مناطق الشحن</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="la la-user-times"></i>
                        <span class="nav-text">الموردين</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{url('/'.$page='supplier')}}">قائمة الموردين</a></li>
                        <li><a href="{{url('/'.$page='supplier/create')}}">أضافة مورد</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="la la-user"></i>
                        <span class="nav-text">العملاء</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{url('/'.$page='customer')}}">قائمة العملاء</a></li>
                        <li><a href="{{url('/'.$page='customer/create')}}">أضافة عميل</a></li>
                    </ul>
                </li>
                <li><a class="ai-icon" href="{{ url('/' . $page='store') }}" aria-expanded="false">
                        <i class="las la-campground"></i>

                        <span class="nav-text">قائمة المخازن</span>
                    </a>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="las la-landmark"></i>
                        <span class="nav-text">الخزينة</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="all-courses.html">قائمة الخزائن</a></li>
                        <li><a href="add-courses.html">أضافة خزينة</a></li>
                    </ul>
                </li>
                <li class="nav-label">أضافات أخري</li>
                <li><a class="ai-icon" aria-expanded="false">
                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span class="nav-text">تسجيل خروج</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!--**********************************Sidebar end ***********************************-->
