<template>
  <q-page class="q-pa-xs">
    <q-card flat bordered>
      <q-card-section>
        <div class="row">
          <div class="col-6 col-md-2">
            <q-input v-model="fechaInicio" label="Fecha Inicio" type="date" outlined dense />
          </div>
          <div class="col-6 col-md-2">
            <q-input v-model="fechaFin" label="Fecha Fin" type="date" outlined dense />
          </div>
          <div class="col-6 col-md-2 flex flex-center">
            <q-btn label="Buscar" color="primary" no-caps icon="search" />
          </div>
          <div class="col-6 col-md-2 flex flex-center">
            <q-btn label="Pago" color="green" no-caps icon="add_circle_outline" to="/pagos/add" />
          </div>
          <div class="col-12">
            <pre>{{ pagos }}</pre>
          </div>
        </div>
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script>
import moment from "moment";

export default {
  data() {
    return {
      fechaInicio: moment().format("YYYY-MM-DD"),
      fechaFin: moment().format("YYYY-MM-DD"),
      pagos: [],
    }
  },
  mounted() {
    this.getPagos();
  },
  methods: {
    getPagos() {
      this.$axios.get('pagos', {
        params: {
          fechaInicio: this.fechaInicio,
          fechaFin: this.fechaFin,
        }
      })
        .then(response => {
          this.pagos = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    }
  }
}
</script>
