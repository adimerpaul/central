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
            <q-btn label="Buscar" color="primary" no-caps icon="search" :loading="loading" @click="getPagos" />
          </div>
          <div class="col-6 col-md-2 flex flex-center">
            <q-btn label="Pago" color="green" no-caps icon="add_circle_outline" to="/pagos/add" :loading="loading" />
          </div>
          <div class="col-12">
            <q-markup-table dense flat bordered>
              <thead>
                <tr>
                  <th>Acciones</th>
                  <th>Fraterno</th>
                  <th>Descripción</th>
                  <th>Estado</th>
                  <th>Monto</th>
                  <th>Fecha</th>
                  <th>Usuario</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="pago in pagos" :key="pago.id">
                  <td>
<!--                    <q-btn flat dense icon="edit" color="primary" @click="editarPago(pago)" />-->
<!--                    <q-btn flat dense icon="delete" color="negative" @click="eliminarPago(pago)" />-->
                  </td>
                  <td>
                    <div style="width: 100px; white-space: normal; overflow-wrap: break-word;line-height: 0.9;">
                      {{ $filters.textCapitalize(pago.user.name) }}
                    </div>
                  </td>
                  <td>
                    <div style="width: 100px; white-space: normal; overflow-wrap: break-word;line-height: 0.9;">
                      {{ $filters.textCapitalize(pago.descripcion) }}
                    </div>
                  </td>
                  <td>
                    <q-chip :color="pago.estado === 'Activo' ? 'green' : 'red'" text-color="white" dense>
                      {{ pago.estado }}
                    </q-chip>
                  </td>
                  <td>{{ pago.monto }}</td>
                  <td>
                    {{ $filters.dateDmYHis(pago.fecha_pago + ' ' + pago.hora_pago) }}
                  </td>
                  <td>{{ pago.user_pago.name }}</td>
                </tr>
              </tbody>
            </q-markup-table>
          </div>
          <div class="col-12">
<!--            <pre>{{ pagos }}</pre>-->
<!--            [-->
<!--            {-->
<!--            "id": 7,-->
<!--            "user_id": 1684,-->
<!--            "user_pago_id": 1,-->
<!--            "concepto_id": 5,-->
<!--            "comprobante": "",-->
<!--            "descripcion": "Expulsión de recorrido",-->
<!--            "monto": 1000,-->
<!--            "estado": "Activo",-->
<!--            "fecha_pago": "2025-02-06",-->
<!--            "hora_pago": "06:08:13",-->
<!--            "user": {-->
<!--            "id": 1684,-->
<!--            "name": "OSCAR OMAR AREVALO PLATA",-->
<!--            "gestion": "2025",-->
<!--            "bloque": "REYES MORENOS",-->
<!--            "codigo": "500138",-->
<!--            "avatar": "default.png",-->
<!--            "email": null,-->
<!--            "username": null,-->
<!--            "phone": null-->
<!--            },-->
<!--            "user_pago": {-->
<!--            "id": 1,-->
<!--            "name": "Administrador",-->
<!--            "gestion": null,-->
<!--            "bloque": null,-->
<!--            "codigo": null,-->
<!--            "avatar": "default.png",-->
<!--            "email": "admin@gmail.com",-->
<!--            "username": "admin",-->
<!--            "phone": "admin"-->
<!--            }-->
<!--            },-->
<!--            {-->
<!--            "id": 6,-->
<!--            "user_id": 1638,-->
<!--            "user_pago_id": 1,-->
<!--            "concepto_id": 2,-->
<!--            "comprobante": "",-->
<!--            "descripcion": "Cuota de velada",-->
<!--            "monto": 50,-->
<!--            "estado": "Activo",-->
<!--            "fecha_pago": "2025-02-06",-->
<!--            "hora_pago": "06:07:40",-->
<!--            "user": {-->
<!--            "id": 1638,-->
<!--            "name": "REYNALDO OSCAR MONTALVO RODRIGUEZ",-->
<!--            "gestion": "2025",-->
<!--            "bloque": "REYES MORENOS",-->
<!--            "codigo": "500175",-->
<!--            "avatar": "default.png",-->
<!--            "email": null,-->
<!--            "username": null,-->
<!--            "phone": null-->
<!--            },-->
<!--            "user_pago": {-->
<!--            "id": 1,-->
<!--            "name": "Administrador",-->
<!--            "gestion": null,-->
<!--            "bloque": null,-->
<!--            "codigo": null,-->
<!--            "avatar": "default.png",-->
<!--            "email": "admin@gmail.com",-->
<!--            "username": "admin",-->
<!--            "phone": "admin"-->
<!--            }-->
<!--            },-->
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
      loading: false,
    }
  },
  mounted() {
    this.getPagos();
  },
  methods: {
    getPagos() {
      this.loading = true;
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
        }).finally(() => {
          this.loading = false;
        });
    }
  }
}
</script>
