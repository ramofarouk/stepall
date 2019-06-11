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
                        <li class="p-15 m-t-10"><a href="{{url('/user/add-contact')}}" class="btn btn-block create-btn text-white no-block d-flex align-items-center"><i class="fa fa-plus-square"></i> <span class="hide-menu m-l-5">Ajouter un contact</span> </a></li>
                        <!-- User Profile-->
                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Menu Principal</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-email-open-outline"></i><span class="hide-menu">Messages </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{url('/user/send-message')}}" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Envoyer un message </span></a></li>
                                <!--<li class="sidebar-item"><a href="{{url('/user/view-messages-receive')}}" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Messages reçus </span></a></li>-->
                                <li class="sidebar-item"><a href="{{url('/user/view-messages-send')}}" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Messages envoyés </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-circle"></i><span class="hide-menu">Contacts</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{url('/user/add-contact')}}" class="sidebar-link"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> Ajouter un contact </span></a></li>
                                <li class="sidebar-item"><a href="{{url('/user/view-contacts')}}" class="sidebar-link"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Tous mes contacts</span></a></li>
                            </ul>
                        </li>
                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Plus</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/logout')}}" aria-expanded="false"><i class="mdi mdi-directions"></i><span class="hide-menu">Deconnexion</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
