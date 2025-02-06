<template>
  <q-page>
    <q-page class="q-pa-xs">
      <q-card flat bordered>
        <q-card-section>
          <div class="row">
            <div class="col-12 q-pa-xs">
              <q-btn label="Volver" color="primary" no-caps icon="arrow_back" to="/pagos" />
            </div>
            <div class="col-12 col-md-6">
              <q-select v-model="user" :options="users" label="Usuario" outlined dense use-input emit-value map-options
                        clearable @filter="filterFn" :option-value="'id'" :option-label="'name'" />
            </div>
          </div>
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
      user: ''
    }
  },
  mounted() {
    this.usersGet();
  },
  methods: {
    usersGet() {
      this.$axios.get('users')
        .then(response => {
          this.users = response.data.map(user => ({ id: user.id, name: user.name + '|' + user.id }));
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
