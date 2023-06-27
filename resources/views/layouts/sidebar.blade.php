 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
     <div class="app-brand demo">
         <div class="user-profile mt-4">
             <div class="user-image mr-5">
                 <img style="margin-left: 60px" src="/assets/img/favicon/favicon.ico" height="30.5px">
             </div>
             <div class="user-name ">
                 <h5 class="mb-0 d-flex justify-content-center">
             </div>
             <div class="user-designation mb-4">
                 <h5 class="mb-0 d-flex justify-content-center ">
             </div>
         </div>
         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
             <i class="bx bx-chevron-left bx-sm align-middle"></i>
         </a>
     </div>
     <div class="menu-inner-shadow"></div>
     <ul class="menu-inner py-1">
         <!-- Dashboard -->
         <li class="menu-item {{ Request::is('dashboard') ? 'active ' : '' }}">
             <a href="/dashboard" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-home-smile"></i>
                 <div data-i18n="Analytics">Beranda</div>
             </a>
         </li>

         {{-- <li class="menu-item active">
              <a href="/user" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Beranda</div>
              </a>
            </li> --}}

         <li class="menu-item {{ Request::is('dashboard/kecamatan*') ? 'active ' : '' }}">
             <a href="/dashboard/kecamatan" class="menu-link">
                 <i class="menu-icon tf-icons bx bxs-map-pin"></i>
                 <div data-i18n="Analytics">Data Kecamatan</div>
             </a>
         </li>

         {{-- <li class="menu-item {{ Request::is('dashboard/cluster*') ? 'active ' : '' }}">
             <a href="/dashboard/cluster" class="menu-link">
                 <i class="menu-icon tf-icons bx bxs-component"></i>
                 <div data-i18n="Analytics">Data Cluster</div>
             </a>
         </li> --}}

         <li class="menu-item {{ Request::is('dashboard/stunting*') ? 'active ' : '' }}">
             <a href="/dashboard/stunting" class="menu-link">
                 <i class="menu-icon tf-icons bx bxs-ruler"></i>
                 <div data-i18n="Analytics">Data Stunting</div>
             </a>
         </li>

         {{-- <li class="menu-item {{ Request::is('dashboard/variable*') ? 'active ' : '' }}">
             <a href="/dashboard/variable" class="menu-link">
                 <i class="menu-icon tf-icons bx bxs-component"></i>
                 <div data-i18n="Analytics">Variable Data Stunting</div>
             </a>
         </li> --}}

         <li class="menu-item {{ Request::is('dashboard/perhitungan*') ? 'active ' : '' }}">
             <a href="/dashboard/perhitungan" class="menu-link">
                 <i class="menu-icon tf-icons bx bxs-brain"></i>
                 <div data-i18n="Analytics">Penilaian K-Means</div>
             </a>
         </li>

         <li class="menu-item {{ Request::is('dashboard/hasil*') ? 'active ' : '' }}">
             <a href="/dashboard/hasil" class="menu-link">
                 <i class="menu-icon tf-icons bx bxs-cube-alt"></i>
                 <div data-i18n="Analytics">Hasil K-Means</div>
             </a>
         </li>

         <li class="menu-item {{ Request::is('dashboard/map*') ? 'active ' : '' }}">
             <a href="/dashboard/map" class="menu-link">
                 <i class="menu-icon tf-icons bx bxs-map"></i>
                 <div data-i18n="Analytics">Peta Penyebaran </div>
             </a>
         </li>

     </ul>
 </aside>
 <div class="layout-page">
