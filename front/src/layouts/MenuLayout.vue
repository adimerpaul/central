<template>
  <q-layout view="hHh Lpr lFf">
    <q-header
      class="bg-white text-primary"
      bordered
    >
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
        />

        <q-toolbar-title>
          <q-btn no-caps flat dense round icon="o_search" />
        </q-toolbar-title>
        <div>
          <!--          Quasar v{{ $q.version }}-->
          <q-btn-group flat>
            <q-btn no-caps icon="o_notifications" />
            <q-btn no-caps >
<!--              <q cambiar icono-->
              <q-img :src="$url + '../images/' + $store.user?.avatar" alt="Logo" width="30px"
                      style="border-radius: 50%"
                     v-if="$store.user?.avatar"
              />
              <q-menu>
                <q-list>
                  <q-item clickable>
                    <q-item-section avatar>
<!--                      <q-icon name="account_circle" />-->
                      <q-img :src="$url + '../images/' + $store.user?.avatar" alt="Logo" width="35px" v-if="$store.user?.avatar" />
                    </q-item-section>
                    <q-item-section>
                      <q-item-label>
                        {{ $store.user?.name }}
                      </q-item-label>
<!--                      <q-item-label caption>-->
<!--                        {{ $store.user?.role }}-->
<!--                      </q-item-label>-->
                    </q-item-section>
                  </q-item>
                  <q-separator />
                  <q-item clickable @click="logout" v-close-popup>
                    <q-item-section avatar>
                      <q-icon name="exit_to_app" />
                    </q-item-section>
                    <q-item-section>
                      <q-item-label>Salir</q-item-label>
                    </q-item-section>
                  </q-item>
                </q-list>
              </q-menu>
            </q-btn>
          </q-btn-group>
        </div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      :width="200"
      :breakpoint="500"
      class="bg-primary text-white"
    >
      <q-list>
        <q-item>
          <q-item-section avatar>
<!--            <q-icon name="account_circle" />-->
            <q-img :src="$url + '../images/' + $store.user?.avatar" alt="Logo" width="35px" v-if="$store.user?.avatar" />
          </q-item-section>
          <q-item-section>
            <!--            <pre>-->
            <!--              {{ $store.user}}-->
            <!--            </pre>-->
            <q-item-label >
              {{ $store.user.name }}
              <!--              <q-chip color="white" text-color="primary" dense>-->
              <!--              <span class="text-bold">-->
              <!--                {{ $store.user.role }}-->
              <!--              </span>-->
              <!--              </q-chip>-->
            </q-item-label>
<!--            <q-item-label caption>-->
<!--              <q-chip :color="$store.user.color" text-color="white" dense>-->
<!--                {{ $store.user.role }}-->
<!--              </q-chip>-->
<!--            </q-item-label>-->
          </q-item-section>
        </q-item>
        <q-separator  class="bg-white" inset />
        <div class="text-white q-pa-xs text-center text-bold">
          Opciones
        </div>
<!--        <pre>{{$store.permissions}}</pre>-->
<!--        [-->
<!--        {-->
<!--        "id": 1,-->
<!--        "name": "Usuarios",-->
<!--        "guard_name": "web",-->
<!--        "created_at": "2025-02-02T12:01:36.000000Z",-->
<!--        "updated_at": "2025-02-02T12:01:36.000000Z",-->
<!--        "pivot": {-->
<!--        "model_type": "App\\Models\\User",-->
<!--        "model_id": 1,-->
<!--        "permission_id": 1-->
<!--        }-->
<!--        },-->
<!--        {-->
<!--        "id": 2,-->
<!--        "name": "Fraterno",-->
<!--        "guard_name": "web",-->
<!--        "created_at": "2025-02-02T12:01:36.000000Z",-->
<!--        "updated_at": "2025-02-02T12:01:36.000000Z",-->
<!--        "pivot": {-->
<!--        "model_type": "App\\Models\\User",-->
<!--        "model_id": 1,-->
<!--        "permission_id": 2-->
<!--        }-->
<!--        },-->
        <template v-for="link in linksList" :key="link.title">
          <q-item  clickable :to="link.link" exact
                  class="text-grey"
                  active-class="menu"
                   v-if="link.can === 'Todos' || $store.permissions.some(permission => permission.name === link.can)"
          >
            <q-item-section avatar>
              <q-icon :name="$route.path === link.link ? 'o_' + link.icon : link.icon"
                      :class="$route.path === link.link ? 'text-white' : ''"/>
            </q-item-section>
            <q-item-section>
              <q-item-label :class="$route.path === link.link ? 'text-white text-bold' : ''">
                {{ link.title }}
              </q-item-label>
            </q-item-section>
          </q-item>
        </template>
        <q-item clickable class="text-red" @click="logout">
          <q-item-section avatar>
            <q-icon name="exit_to_app" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Salir</q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </q-drawer>

    <q-page-container class="bg-grey-3">
      <router-view />
    </q-page-container>
  </q-layout>
</template>
<script>
import {Dialog} from "quasar";
import Icon from "components/Icon.vue";

export default {
  name: 'MainLayout',
  data () {
    return {
      leftDrawerOpen: false,
      linksList: [
        { title: 'Principal', icon: 'home', link: '/', can: 'Todos' },
        { title: 'Usuarios', icon: 'account_circle', link: '/usuarios', can: 'Usuarios' },
        // { title: 'Fraternos', icon: 'people', link: '/fraternos', can: 'Fraternos' },
        { title: 'Pagos', icon: 'payment', link: '/pagos', can: 'Pagos' },
      ]
    }
  },
  mounted() {
  },
  methods: {
    logout () {
      this.$alert.dialog('¿Desea salir del sistema?')
        .onOk(() => {
          this.$store.isLogged = false
          this.$store.user = {}
          localStorage.removeItem('tokenEducation')
          this.$router.push('/login')
        })
      // Dialog.create({
      //   component: Icon,
      //
      //   // props forwarded to your custom component
      //   componentProps: {
      //     text: 'something',
      //     persistent: true,
      //     // ...more..props...
      //   }
      // }).onOk(() => {
      //   console.log('OK')
      // }).onCancel(() => {
      //   console.log('Cancel')
      // }).onDismiss(() => {
      //   console.log('Called on OK or Cancel')
      // })
    },
    toggleLeftDrawer () {
      this.leftDrawerOpen = !this.leftDrawerOpen
    }
  },
  computed: {
    rutaActual () {
      return this.$route.path
    }
  }
}
</script>
<style>
.menu{
  background-color: #1976D2;
  border-radius: 10px;
  margin: 5px;
  padding: 5px
}
</style>
