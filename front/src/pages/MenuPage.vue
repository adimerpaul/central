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
const lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.'
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
