<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li>
                            <!-- User Profile-->
                            <div class="user-profile d-flex no-block dropdown m-t-20">
                                <div class="user-pic"><img src="{{ asset('images/frontend_images/users/1.jpg')}}" alt="users" class="rounded-circle" width="40" /></div>
                                <div class="user-content hide-menu m-l-10">
                                    <a href="javascript:void(0)" class="" id="Userdd"  aria-expanded="false">
                                        <h5 class="m-b-0 user-name font-medium">{{ $user->first_name . ' ' . $user->last_name}}</h5>
                                        <span class="op-5 user-email">{{ $user->email}}</span>
                                    </a>
                                </div>
                            </div>
                            <!-- End User Profile-->
                        </li>
                        <li class="p-15 m-t-10"><a href="{{url('/admin/footer-message')}}" class="btn btn-block create-btn text-white no-block d-flex align-items-center"><i class="fa fa-edit-square"></i> <span class="hide-menu m-l-5">Modifier le pied de Page</span> </a></li>
                        <!-- User Profile-->
                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Menu Principal</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/admin/view-users')}}" aria-expanded="false"><i class="mdi mdi-account-circle"></i><span class="hide-menu">Tous les utilisateurs</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/admin/view-messages')}}" aria-expanded="false"><i class="mdi mdi-email-open-outline"></i><span class="hide-menu">Tous les messages</span></a></li>
                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Plus</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/logout')}}" aria-expanded="false"><i class="mdi mdi-directions"></i><span class="hide-menu">Deconnexion</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
