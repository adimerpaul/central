<template>
  <q-layout view="hHh Lpr fff">
    <q-header>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
          v-if="$q.screen.lt.md"
        />

        <q-toolbar-title>
          <!-- Quasar App -->
        </q-toolbar-title>

        <!-- q-tabs se muestra solo si el drawer está cerrado -->
        <q-tabs dense v-if="!$q.screen.lt.md">
          <q-route-tab
            v-for="link in linksList"
            :key="link.title"
            :label="link.title"
            no-caps
            :to="link.link"
          />
        </q-tabs>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      bordered
      class="bg-primary"
    >
      <q-list>
<!--        <q-item>-->
<!--          <q-item-section avatar>-->
<!--            <q-icon name="account_circle" />-->
<!--          </q-item-section>-->
<!--          <q-item-section>-->
<!--            &lt;!&ndash;            <pre>&ndash;&gt;-->
<!--            &lt;!&ndash;              {{ $store.user}}&ndash;&gt;-->
<!--            &lt;!&ndash;            </pre>&ndash;&gt;-->
<!--            <q-item-label >-->
<!--              {{ $store.user.name }}-->
<!--              &lt;!&ndash;              <q-chip color="white" text-color="primary" dense>&ndash;&gt;-->
<!--              &lt;!&ndash;              <span class="text-bold">&ndash;&gt;-->
<!--              &lt;!&ndash;                {{ $store.user.role }}&ndash;&gt;-->
<!--              &lt;!&ndash;              </span>&ndash;&gt;-->
<!--              &lt;!&ndash;              </q-chip>&ndash;&gt;-->
<!--            </q-item-label>-->
<!--            <q-item-label caption>-->
<!--              <q-chip :color="$store.user.color" text-color="white" dense>-->
<!--                {{ $store.user.role }}-->
<!--              </q-chip>-->
<!--            </q-item-label>-->
<!--          </q-item-section>-->
<!--        </q-item>-->
<!--        <q-separator  class="bg-white" inset />-->
        <q-item-label class="text-white q-pa-md text-center text-bold">
          Opciones
        </q-item-label>

        <!--        <EssentialLink-->
        <!--          v-for="link in linksList"-->
        <!--          :key="link.title"-->
        <!--          v-bind="link"-->
        <!--        />-->
        <q-item v-for="link in linksList" :key="link.title" clickable :to="link.link" exact
                class="text-grey"
                active-class="menu"
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

    <q-footer>
      <q-toolbar>
        <q-toolbar-title>
          Quasar App
        </q-toolbar-title>
      </q-toolbar>
    </q-footer>
  </q-layout>
</template>

<script setup>
import { ref } from 'vue'
import EssentialLink from 'components/EssentialLink.vue'

const linksList = [
  {
    title: 'Inicio',
    caption: 'Inicio',
    icon: 'home', // Ícono de casa
    link: '/'
  },
  {
    title: 'Morenada Central',
    caption: 'Morenada Central',
    icon: 'groups', // Ícono de grupos
    link: '/morenada-central'
  },
  {
    title: 'Central TV',
    caption: 'Central TV',
    icon: 'live_tv', // Ícono de televisión
    link: '/central-tv'
  },
  {
    title: 'Galería',
    caption: 'Galería',
    icon: 'photo_library', // Ícono de galería de fotos
    link: '/galeria'
  },
  {
    title: 'Cancionero',
    caption: 'Cancionero',
    icon: 'library_music', // Ícono de música
    link: '/cancionero'
  },
  {
    title: 'Carnaval de Oruro',
    caption: 'Carnaval de Oruro',
    icon: 'celebration', // Ícono de celebración
    link: '/carnaval-de-oruro'
  },
  {
    title: 'Central al Día',
    caption: 'Central al Día',
    icon: 'article', // Ícono de artículo o noticias
    link: '/central-al-dia'
  },
  {
    title: 'Fraternos',
    caption: 'Fraternos',
    icon: 'diversity_3', // Ícono de diversidad o grupos
    link: '/fraternos'
  },
  {
    title: 'Contacto',
    caption: 'Contacto',
    icon: 'contact_mail', // Ícono de contacto
    link: '/contacto'
  },
  {
    title: 'Descargas',
    caption: 'Descargas',
    icon: 'download', // Ícono de descarga
    link: '/descargas'
  }
];
// Inicializa el drawer cerrado
const leftDrawerOpen = ref(false)

function toggleLeftDrawer() {
  leftDrawerOpen.value = !leftDrawerOpen.value
}
function logout() {
}
</script>
<style>
.menu{
  background-color: #f00;
  border-radius: 10px;
  margin: 5px;
  padding: 5px
}
</style>
