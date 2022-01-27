<template>
<admin>
    <v-card-text>
        <v-form>
            <v-text-field v-model="form.name" prepend-inner-icon="mdi-account" label="Nombres" outlined dense type="text" :error-messages="form.errors.name" />

            <v-text-field v-model="form.lastname" prepend-inner-icon="mdi-account" label="Apellidos" outlined dense type="text" :error-messages="form.errors.lastname" />

            <v-text-field v-model="form.direction" prepend-inner-icon="mdi-account" label="Dirección" outlined dense type="text" :error-messages="form.errors.direction" />

            <v-text-field v-model="form.email" prepend-inner-icon="mdi-email" label="Correo" type="email" outlined dense :error-messages="form.errors.email" />

            <v-text-field v-model="form.phone" prepend-inner-icon="mdi-account" label="Celular" outlined dense type="text" :error-messages="form.errors.phone" />

            <v-text-field v-model="form.password" prepend-inner-icon="mdi-lock" label="Clave" outlined dense :error-messages="form.errors.password" :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'" :type="showPassword ? 'text' : 'password'" @click:append="showPassword = !showPassword" />

            <v-text-field v-model="form.password_confirmation" prepend-inner-icon="mdi-lock" label="Confirmación de clave" :error-messages="form.errors.password" outlined dense :append-icon="show_comfirmpassword ? 'mdi-eye' : 'mdi-eye-off'" :type="show_comfirmpassword ? 'text' : 'password'" @click:append="show_comfirmpassword = !show_comfirmpassword" />

            <v-btn :loading="form.processing" @click.prevent="UpdateProfile" block color="primary" class="mt-3">Actualizar perfil</v-btn>
        </v-form>
    </v-card-text>
</admin>
</template>

<script>
import Admin from "../../layouts/Admin.vue";

export default {

    props: ["auth"],
    
    components: { Admin },

    data() {
        return {
            show_comfirmpassword: false,
            showPassword: false,
            isLoading: false,
            form: this.$inertia.form({
                name: this.auth.user.name,
                lastname: this.auth.user.lastname,
                direction: this.auth.user.direction,
                email: this.auth.user.email,
                phone: this.auth.user.phone,
                password: null,
                password_confirmation: null,
            }),
        };
    },

    methods: {
        UpdateProfile() {
            this.form.put(route("profile.update", this.auth.user.id), {
                preverseScroll: true,
                onSuccess: () => {
                    this.isLoading = false;
                    this.form.password = null;
                    this.form.password_confirmation = null;
                },
            });
        }
    },
};
</script>
