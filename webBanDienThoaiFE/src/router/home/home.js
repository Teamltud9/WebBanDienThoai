import controllers from '../../components/Views/Home/ViewsUser.vue';

const user = [
    {
      path: '/controllers',
      component:controllers,
      children: [
        {
          path: 'search',
          name: "searchproducts",
          component: () => import("../../components/Views/Home/SearchProduct.vue"),
        //   meta: { requiresRole: 'User' }
        },
        {
          path: "product/detail/:id",
          name: "product-detail",
          component: () => import("../../components/Views/Products/Detail.vue"),props: true,
          // meta: { requiresRole: 'User' }
        },
      ],  
    },
  ];
  export default user;
  