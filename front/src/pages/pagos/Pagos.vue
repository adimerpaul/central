<template>
  <q-page>
    asas
  </q-page>
</template>

<script>
export default {
  data() {
    return {
      username: '',
      password: '',
      remember: false,
      loading: false,
      showPassword: false
    }
  },
  methods: {
    login() {
      this.loading = true
      this.$axios.post('login', {
        username: this.username,
        password: this.password
      }).then(res => {
        const user = res.data.user
        const token = res.data.token
        this.$axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
        this.$store.isLogged = true
        this.$store.user = user
        this.$store.permissions = user.permissions
        localStorage.setItem('tokenMorenada', token)
        localStorage.setItem('user', JSON.stringify(user))
        this.$alert.success('Bienvenido ', user.name)
        this.$router.push('/')
      }).catch(error => {
        this.$alert.error(error.response.data.message)
      }).finally(() => {
        this.loading = false
      })
    }
  }
}
</script>
