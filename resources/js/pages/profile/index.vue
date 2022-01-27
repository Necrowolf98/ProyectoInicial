<template>
  <admin>
    <v-card-text>
      <v-form @submit.prevent="register">
        <v-text-field v-model="form.name" prepend-inner-icon="mdi-account" label="Name" outlined dense type="text" :error-messages="form.errors.name" />

        <v-text-field v-model="form.lastname" prepend-inner-icon="mdi-account" label="Lastname" outlined dense type="text" :error-messages="form.errors.lastname" />

        <v-text-field v-model="form.direction" prepend-inner-icon="mdi-account" label="Direction" outlined dense type="text" :error-messages="form.errors.direction" />

        <v-text-field v-model="form.email" prepend-inner-icon="mdi-email" label="Email" type="email" outlined dense :error-messages="form.errors.email" />

        <v-text-field v-model="form.phone" prepend-inner-icon="mdi-account" label="Phone" outlined dense type="text" :error-messages="form.errors.phone" />

        <v-text-field v-model="form.password" prepend-inner-icon="mdi-lock" label="Password" outlined dense :error-messages="form.errors.password" :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'" :type="showPassword ? 'text' : 'password'" @click:append="showPassword = !showPassword" />

        <v-text-field v-model="form.password_confirmation" prepend-inner-icon="mdi-lock" label="Password Confirmation" :error-messages="form.errors.password_confirmation" outlined dense :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'" :type="showPassword ? 'text' : 'password'" @click:append="showPassword = !showPassword" />

        <v-btn :loading="form.processing" @click.prevent="UpdateProfile" block color="primary" class="mt-3">Register</v-btn>
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
          },
        });
      }
  },
};
</script>
