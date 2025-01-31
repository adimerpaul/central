<template>
  <q-page class="">
    <div v-for="i in 10" :key="i">
      <q-card class="q-mb-md">
        <q-card-section>
          <q-item>
            <q-item-section>
              <q-item-label>
                <q-icon name="person" />
                User {{ i }} Central al Día
              </q-item-label>
            </q-item-section>
            <q-item-section side>
              <q-btn flat label="Action" />
            </q-item-section>
          </q-item>
        </q-card-section>
        <q-card-section>
          {{ lorem }}
        </q-card-section>
      </q-card>
    </div>
  </q-page>
</template>

<script setup>
const lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.'
</script>
