<template>
    <v-app style="overflow: auto !important;">
        <Navbar :user="user"></Navbar>

        <Sidebar :user="user"></Sidebar>

        <div class="content-wrapper pb-5">
            <section class="content">
                <v-main>
                    <v-container fluid>
                        <slot />
                    </v-container>
                </v-main>
            </section>
        </div>

        <Footer></Footer>
    </v-app>
</template>

<script>
    import Navbar from './plantilla/Navbar.vue'
    import Sidebar from './plantilla/Sidebar.vue'
    import Footer from './plantilla/Footer.vue'

    export default {
        components: {Navbar, Sidebar, Footer},
        
        computed: {
            appName() {
                return this.$page.props.appName;
            },

            user() {
                return this.$page.props.auth.user;
            },
        },

        watch: {
            $page: {
            handler() {
                const message = this.$page.props.flash.message;
                if (message != null) {
                    switch (message.type) {
                        case "success":
                        this.$toast.success(message.text);
                        break;
                        case "error":
                        this.$toast.error(message.text);
                        break;
                    }
                }
            },
            },
        },
    }
</script>
