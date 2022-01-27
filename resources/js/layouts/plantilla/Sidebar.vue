<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="/img/AdminLTELogo.png" alt="Sistema Laravel y Vue" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Sistema Laravel</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <v-avatar color="rgb(240, 233, 233)" size="33">
                        <span class="rgb(139, 93, 93)" v-text="user.name.charAt(0)+user.lastname.charAt(0)"></span>
                    </v-avatar>
                    <!-- <img :src="ruta+'/img/user2-160x160.jpg'" class="img-circle elevation-2" alt="User Image"> -->
                </div>
                <div class="info" style="background: none !important">
                    <a href="#" class="d-block" v-text="user.name.split(' ', 1)+ ' ' +user.lastname"></a>
                </div>
            </div>

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image" style="background: none !important">
                    <a href="#" class="d-block" @click.prevent="logout">
                        <i class="fas fa-sign-out-alt ml-3 mt-2"></i>
                    </a>
                </div>

                <div class="info" style="background: none !important">
                    <a href="#" class="d-block" @click.prevent="logout">
                        Cerrar sesión
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">

                <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column ml-0 pl-0" data-widget="treeview" role="menu" data-accordion="false">


                    <li class="nav-item">
                        <Link class="nav-link" :href="route('home')" :class="route().current('home') ? 'active' : ''">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </Link>
                    </li>

                    <li class="nav-item">
                        <Link class="nav-link" :href="route('user.index')" :class="route().current('user.index') ? 'active' : ''">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Usuarios</p>
                        </Link>
                    </li>

                    <li class="nav-header">ADMINISTRACIÓN</li>

                    <li class="nav-item">
                        <Link class="nav-link" :href="route('profile.index')" :class="route().current('profile.index') ? 'active' : ''">
                            <i class="fas fa-user-circle"></i>
                            <p>Profile</p>
                        </Link>
                    </li>

                    


<!--                     <li class="nav-header">ADMINISTRACIÓN</li>

                    <li class="nav-item">
                        <router-link class="nav-link" to="/users">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Usuarios</p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" to="/roles">
                            <i class="nav-icon fas fa-unlock-alt"></i>
                            <p>Roles</p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" to="/permissions">
                            <i class="nav-icon fas fa-key"></i>
                            <p>Permisos</p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Profile</p>
                        </a>
                    </li> -->
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
    export default {
        props: ["user"],

        methods: {
            logout() {
                this.$inertia.post("/logout");
            },
        }

    }
</script>

