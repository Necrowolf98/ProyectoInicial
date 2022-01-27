<template>
  <admin-layout>
    <div class="d-flex flex-wrap align-center">
      <v-text-field v-model="search" prepend-inner-icon="mdi-magnify" label="Search" single-line dense clearable hide-details class="py-4" solo style="max-width: 300px" />
      <v-spacer />
      <v-btn color="primary" @click="OpenDialog">
        <v-icon dark left> mdi-plus </v-icon> New
      </v-btn>
    </div>
    <v-data-table
      :items="users.data"
      :headers="headers"
      :header-props="{ sortByText: 'Ordenar por' }"
      :options.sync="options"
      :server-items-length="users.total"
      :loading="isLoadingTable"
      class="elevation-1"
      no-data-text="Lo sentimos, no hay nada para mostrar aquí"
      dense
      sortByText="Ordenar por"
      loading-text="Cargando... Espere por favor"
      :footer-props="{
        'items-per-page-options' : [15, 25, 35, 45, 75, 150],
        'show-current-page': true,
        'show-first-last-page': true,
        'items-per-page-text': 'Filas por página',
      }">
        <template v-slot:[`item.id`]="{ item }">
            <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                    <v-icon small color="lime" class="mr-2" v-bind="attrs" v-on="on" @click.prevent="EditUser(item)">mdi-pencil</v-icon>
                </template>
                <span>Editar usuario</span>
            </v-tooltip>

            <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                    <v-icon small color="red" v-bind="attrs" v-on="on" @click.prevent="DeleteUser(item.id)">mdi-delete</v-icon>
                </template>
                <span>Eliminar usuario</span>
            </v-tooltip>
        </template>
    </v-data-table>


    <v-dialog v-model="dialog" max-width="650px" style="z-index: 9999;">
      <v-card>
        <v-card-title class="mb-2 grey lighten-4" style="border-bottom: 1px solid #B0BEC5 !important;">
          <span class="headline">{{ formTitle }}</span>
          <v-btn icon white outlined top absolute right @click="CloseDialog">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-card-title>

        <v-card-text class="pt-4">
          <v-form>
            <v-row>
              <v-col sm="4" md="3" lg="3" xl="3" class="my-0 py-0 px-0">
                <v-subheader class="sub_header_form float-right mx-0 px-0">Nombres:</v-subheader>
              </v-col>
              <v-col sm="8" md="9" lg="9" xl="9" class="my-0 py-0">
                <v-text-field v-model="form.name" label="Escriba los nombres del usuario" append-icon="fas fa-user" dense outlined class="input_form icons_formularios my-0 py-0" :error-messages="form.errors.name" hint="Por ejemplo, Mauricio Antonio">
                </v-text-field>
              </v-col>
            </v-row>

            <v-row>
              <v-col sm="4" md="3" lg="3" xl="3" class="my-0 py-0 px-0">
                <v-subheader class="sub_header_form float-right mx-0 px-0">Apellidos:</v-subheader>
              </v-col>
              <v-col sm="8" md="9" lg="9" xl="9" class="my-0 py-0">
                <v-text-field v-model="form.lastname" label="Escriba los apellidos del usuario" append-icon="fas fa-user" dense outlined class="input_form icons_formularios my-0 py-0" :error-messages="form.errors.lastname" hint="Por ejemplo, Cevallos Andrade">
                </v-text-field>
              </v-col>
            </v-row>

            <v-row>
              <v-col sm="4" md="3" lg="3" xl="3" class="my-0 py-0 px-0">
                <v-subheader class="sub_header_form float-right mx-0 px-0">Dirección:</v-subheader>
              </v-col>
              <v-col sm="8" md="9" lg="9" xl="9" class="my-0 py-0">
                <v-text-field v-model="form.direction" label="Escriba la dirección del usuario" append-icon="fas fa-home" dense outlined class="input_form icons_formularios my-0 py-0" :error-messages="form.errors.direction" hint="Por ejemplo, Las piñas">
                </v-text-field>
              </v-col>
            </v-row>

            <v-row>
              <v-col sm="4" md="3" lg="3" xl="3" class="my-0 py-0 px-0">
                <v-subheader class="sub_header_form float-right mx-0 px-0">Email:</v-subheader>
              </v-col>
              <v-col sm="8" md="9" lg="9" xl="9" class="my-0 py-0">
                <v-text-field v-model="form.email" label="Escriba el email del usuario" append-icon="fas fa-at" dense outlined class="input_form icons_formularios my-0 py-0" :error-messages="form.errors.email" hint="Por ejemplo, ejemplo@gmail.com">
                </v-text-field>
              </v-col>
            </v-row>

            <v-row>
              <v-col sm="4" md="3" lg="3" xl="3" class="my-0 py-0 px-0">
                <v-subheader class="sub_header_form float-right mx-0 px-0">Celular:</v-subheader>
              </v-col>
              <v-col sm="8" md="9" lg="9" xl="9" class="my-0 py-0">
                <v-text-field v-model="form.phone" label="Escriba el email del usuario" append-icon="fas fa-phone-alt" dense outlined class="input_form icons_formularios my-0 py-0" :error-messages="form.errors.phone" hint="Por ejemplo, 099 998 4128">
                </v-text-field>
              </v-col>
            </v-row>

            <v-row>
              <v-col sm="4" md="3" lg="3" xl="3" class="my-0 py-0 px-0">
                <v-subheader class="sub_header_form float-right mx-0 px-0">Clave:</v-subheader>
              </v-col>
              <v-col sm="8" md="9" lg="9" xl="9" class="my-0 py-0">
                <v-text-field v-model="form.password" label="Escriba la clave del usuario" prepend-inner-icon="mdi-lock" dense outlined class="input_form icons_formularios my-0 py-0" :error-messages="form.errors.password" :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'" :type="showPassword ? 'text' : 'password'" @click:append="showPassword = !showPassword" >
                </v-text-field>
              </v-col>
            </v-row>

            <v-row>
              <v-col sm="4" md="3" lg="3" xl="3" class="my-0 py-0 px-0">
                <v-subheader class="sub_header_form float-right mx-0 px-0">Confirmar clave:</v-subheader>
              </v-col>
              <v-col sm="8" md="9" lg="9" xl="9" class="my-0 py-0">
                <v-text-field v-model="form.password_confirmation" label="Escriba la clave confirmación del usuario" prepend-inner-icon="mdi-lock" dense outlined class="input_form icons_formularios my-0 py-0" :error-messages="form.errors.password_confirmation" :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'" :type="showPassword ? 'text' : 'password'" @click:append="showPassword = !showPassword" >
                </v-text-field>
              </v-col>
            </v-row>

          </v-form>
        </v-card-text>

        <v-card-actions class="mt-0 pt-0 py-3">
          <v-btn color="primary" block @click.prevent="SubmitUser">
            <v-icon left>mdi-content-save</v-icon>
            {{ buttonTitle }}
          </v-btn>
        </v-card-actions>

      </v-card>
    </v-dialog>
  </admin-layout>
</template>

<script>
import AdminLayout from "../../layouts/AdminLayout.vue";
export default {
  props: ["users"],
  components: { AdminLayout },
  data() {
    return {
      headers: [
        { text: "Name", value: "name" },
        { text: "Lastname", value: "lastname" },
        { text: "Email", value: "email" },
        { text: "Created At", value: "created_at" },
        { text: "Actions", value: "action", sortable: false },
      ],

      dialog: false,
      dialogDelete: false,

      isUpdate: false,
      showPassword: false,

      isLoading: false,
      isLoadingTable: false,

      options: {},
      search: null,
      params: {},

      itemId: null,
      form: this.$inertia.form({
        name: null,
        lastname: null,
        direction: null,
        email: null,
        phone: null,
        password: null,
        password_confirmation: null
      }),
    };
  },

  computed: {
    formTitle() {
      return this.isUpdate ? "Editar Usuario" : "Crear Usuario";
    },

    buttonTitle(){
      return this.isUpdate ? "Actualizar usuario" : "Registrar usuario";
    }
  },
  
  watch: {
    options: function (valor){
      this.params.sortBy = valor.sortBy[0];
      this.params.sortDesc = valor.sortDesc[0];
      this.params.page = valor.page;
      this.params.itemsPerPage = valor.itemsPerPage;

      this.getListarUsuarios();
    },

    search: function (valor) {
        this.options.page = 1;
        this.params.page = 1;
        this.params.search = valor;
        this.getListarUsuarios();
    },
  },

  methods: {
    getListarUsuarios() {
      this.isLoadingTable = true
      this.$inertia.get("/user", this.params, {
        preserveState: true,
        preverseScroll: true,
        onSuccess: () => {
          this.isLoadingTable = false
        },
      });
    },

    OpenDialog() {
      this.dialog = true;
    },

    CloseDialog(){
        Fire.$emit('AfterAddUser');
    },

    EditUser(item) {
      this.form.clearErrors();
      this.form.name = item.name;
      this.form.lastname = item.lastname;
      this.form.direction = item.direction;
      this.form.email = item.email;
      this.form.phone = item.phone;
      this.isUpdate = true;
      this.itemId = item.id;
      this.dialog = true;
    },


    destroy() {
      this.form.delete(route("employee.destroy", this.itemId), {
        preverseScroll: true,
        onSuccess: () => {
          this.dialogDelete = false;
          this.itemId = null;
        },
      });
    },

    SubmitUser() {
      if (this.isUpdate) {
        this.form.put(route("employee.update", this.itemId), {
          preverseScroll: true,
          onSuccess: () => {
            this.isLoading = false;
            this.dialog = false;
            this.isUpdate = false;
            this.itemId = null;
            this.form.reset();
          },
        });
      } else {
        this.form.post(route("employee.store"), {
          preverseScroll: true,
          onSuccess: () => {
            this.isLoading = false;
            this.dialog = false;
            this.form.reset();
          },
        });
      }
    },
  },

  created(){
    Fire.$on('AfterAddUser', () => {
        this.getListarUsuarios();
        this.itemId = null;
        this.form.reset();
        this.form.clearErrors();
        this.dialog = false;
    });
    }
};
</script>
