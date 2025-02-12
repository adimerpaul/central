<template>
  <q-page>
    <q-page class="q-pa-xs">
      <q-card flat bordered>
        <q-card-section>
          <q-form @submit.prevent="registrarPago">
          <div class="row">
            <div class="col-12 q-pa-xs">
              <q-btn label="Volver" color="primary" no-caps icon="arrow_back" to="/pagos" />
            </div>
            <div class="col-12 col-md-4 q-pa-xs">
              <label class="text-bold">Fraterno</label>
              <q-select v-model="user" :options="users" outlined dense use-input
                        clearable @filter="filterFn" :option-value="'id'" :option-label="'name'"
                        :rules="[val => !!val || 'Seleccione un usuario']"
              />
<!--              <pre>{{user}}</pre>-->
            </div>
            <div class="col-12 col-md-3 q-pa-xs">
              <label class="text-bold">Concepto</label>
              <q-select v-model="concepto" :options="conceptos"  outlined dense emit-value map-options
                        clearable @filter="filterFn" :option-label="'nombreBs'"
                        :rules="[val => !!val || 'Seleccione un concepto']"
              />
            </div>
            <div class="col-8 col-md-2 q-pa-xs">
              <div class="text-bold">Monto</div>
              <div>
                <q-input v-model="concepto.monto" outlined dense :rules="[val => !!val || 'Ingrese un monto']" />
              </div>
            </div>
            <div class="col-4 col-md-1 q-pa-xs">
              <div class="text-bold">Tipo</div>
              <div>
                <q-chip :color="concepto.tipo === 'Cobro' ? 'green' : 'indigo'" text-color="white" dense v-if="concepto">
                  {{ concepto.tipo }}
                </q-chip>
              </div>
            </div>
            <div class="col-12 col-md-2 q-pa-xs flex flex-center">
              <q-btn label="Registrar pago" color="green" no-caps icon="add_circle_outline" rounded push type="submit"
                     :loading="loading"
              >
                <template v-slot:loading>
                  <q-spinner-facebook color="white" />
                </template>
              </q-btn>
            </div>
          </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-page>
  </q-page>
</template>
<script>
export default {
  data() {
    return {
      users: [],
      usersAll: [],
      user: '',
      conceptos: [],
      concepto: '',
      loading: false,
      phone: '',
    }
  },
  mounted() {
    this.usersGet();
    this.conceptosGet();
  },
  methods: {
    registrarPago() {
      this.loading = true;

      this.$q.dialog({
        title: 'Confirmar pago',
        message: `¿Está seguro de registrar el pago de ${this.concepto.nombreBs} a ${this.user.name.split('|')[0]}?`,
        ok: 'Si',
        prompt: {
          model: this.user.phone,
          type: 'text',
          placeholder: 'Escriba su contraseña'
        },
        cancel: 'No'
      }).onOk((data) => {
        const phoneUser = data
        this.$axios.post('pagoconcepto', {
          user_id: this.user.id,
          phone: this.user.phone,
          concepto_id: this.concepto.id,
          monto: this.concepto.monto,
        })
          .then(response => {
            const pago = response.data;
            const user = this.users.find(user => user.id === this.user.id);
            const monto = this.concepto.tipo === 'Cobro' ? this.concepto.monto : -this.concepto.monto;
            this.$alert.success(`Pago registrado `,`${user.name.split('|')[0]} Bs. ${monto}`);
            // enviar pow whtasapp
            let urlBack = this.$url;
            urlBack = urlBack.replace('api/', '');
            const url = `${urlBack}pagos/${pago.codigo}/print`;

            let message = `Hola ${pago.user.name}, te envio tu comprobante de pago. ${url}`;

            window.open(`https://api.whatsapp.com/send?phone=${phoneUser}&text=${message}`, '_blank');
            this.user = '';
            this.usersGet();
          })
          .catch(error => {
            console.log(error);
          })
          .finally(() => {
            this.loading = false;
          });
      }).onCancel(() => {
        this.loading = false;
      });
    },
    conceptosGet() {
      this.$axios.get('conceptos')
        .then(response => {
          this.conceptos = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    usersGet() {
      this.$axios.get('users')
        .then(response => {
          this.users = response.data.map(user => ({ id: user.id, name: user.name + '|' + user.codigo,phone: user.phone }));
          this.usersAll = this.users;
        })
        .catch(error => {
          console.log(error);
        });
    },
    filterFn(val, update) {
      update(() => {
        if (val === '') {
          this.users = this.usersAll;
          return;
        }
        const needle = val.toLowerCase();
        this.users = this.usersAll.filter(v => v.name.toLowerCase().indexOf(needle) > -1);
      });
    }
  }
}
</script>
