 <!-- Sidebar menu-->
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
 <aside class="app-sidebar">
     <div class="app-sidebar__user"><img class="app-sidebar__user-avatar"
             src="https://t4.ftcdn.net/jpg/02/27/45/09/360_F_227450952_KQCMShHPOPebUXklULsKsROk5AvN6H1H.jpg"
             width="50px" alt="User Image">
         <div>
             <p class="app-sidebar__user-name"><b>Van Doan</b></p>
             <p class="app-sidebar__user-designation">Welcome</p>
         </div>
     </div>
     <hr>
     <ul class="app-menu">
         <li>
             <a class="app-menu__item {{ Request::RouteIs('admin') ? 'active' : '' }}" href="#">
                 <i class='app-menu__icon bx bx-tachometer'></i>
                 <span class="app-menu__label">
                     Dashboard
                 </span>
             </a>
         </li>
         <li>
             <a class="app-menu__item {{ Request::RouteIs('admin.catalogues.index') ? 'active' : '' }}"
                 href="{{ route('admin.catalogues.index') }}">
                 <i class='app-menu__icon bx bx-category'></i>
                 <span class="app-menu__label">
                     Catalogue Manager
                 </span>
             </a>
         </li>
     </ul>
 </aside>
