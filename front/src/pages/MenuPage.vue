<template>
  <q-page class="q-pa-md">
    <q-card flat bordered>
      <q-card-section class="bg-primary text-white text-bold">
        PRESENTACIÓN
      </q-card-section>
      <q-card-section class="flex flex-center">
        <q-img src="logo.png" width="30%" style="border-radius: 10px;" />
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script setup>
import { onMounted, getCurrentInstance } from 'vue';

const instance = getCurrentInstance();

onMounted(() => {
  const alert = instance.appContext.config.globalProperties.$alert;
  // alert.success('Bienvenido al sistema', 'Acceso correcto');
});
</script>

<style>
.fondo {
  background-image: url('./logo_fnd.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  width: 100%;
  min-height: 200px; /* Ajusta según necesites */
}
</style>
