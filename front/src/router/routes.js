const routes = [
  {
    path: '/',
    component: () => import('layouts/MenuLayout.vue'),
    children: [
      { path: '', component: () => import('pages/MenuPage.vue'), meta: { requiresAuth: true } },
      { path: 'usuarios', component: () => import('pages/usuarios/Usuarios.vue'), meta: { requiresAuth: true } },
      { path: 'fraternos', component: () => import('pages/fraternos/Fraternos.vue'), meta: { requiresAuth: true } },
      { path: 'pagos', component: () => import('pages/pagos/Pagos.vue'), meta: { requiresAuth: true } },
      { path: 'pagos/add', component: () => import('pages/pagos/PagosAdd.vue'), meta: { requiresAuth: true } },
    ]
  },
  {
    path: '/login',
    component: () => import('pages/login/Login.vue'),
  },
  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
