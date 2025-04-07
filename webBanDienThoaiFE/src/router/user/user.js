const user = [
  {
    path: "/users",
    component: () => import("../../components/Views/Home/ViewsUser.vue"),
    children: [
      {
        path: "product",
        name: "product",
        component: () => import("../../Views/Customer/Views/Chart/Chart.vue"),
        meta: { requiresRole: 'User' }
      },
      {
        path: "product",
        name: "product",
        component: () => import("../../Views/Customer/Views/Chart/Chart.vue"),
        meta: { requiresRole: 'User' }
      },
    ],  
  },
];
export default user;
