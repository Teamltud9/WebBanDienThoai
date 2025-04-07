

const adminRoutes = [
  {
    path: "/admin",
    component: () => import("../../components/Views/Home/ViewAdminEmployee.vue"),
    meta: { requiresAuth: true, requiresRole: 'Admin' },
    children: [
      {
        path: '',
        name: 'admin-dashboard',
        component: () => import('../../components/Views/Admin/AdminDashboard.vue'),
      },
      // --- Quản lý Sản phẩm ---
      {
        path: 'products', // URL: /admin/products
        name: 'admin-product-list',
        component: () => import('../../components/Views/Admin/Product/ProductList.vue'),
      },
      {
        path: 'products/add',
        name: 'admin-product-add',
        component: () => import('../../components/Views/Admin/Product/ProductForm.vue'),
        props: { isEditMode: false } // Truyền props để biết là chế độ thêm mới
      },
      {
        path: 'products/edit/:productId', // URL: /admin/products/edit/123
        name: 'admin-product-edit',
        component: () => import('../../components/Views/Admin/Product/ProductForm.vue'),
        props: route => ({ isEditMode: true, productId: route.params.productId }) // Truyền props để biết là edit và lấy productId
      },
      // --- Quản lý Thương hiệu ---
      {
        path: 'brands', // URL: /admin/brands
        name: 'admin-brand-list',
        component: () => import('../../components/Views/Admin/Brand/BrandList.vue'), // Trang danh sách thương hiệu (cần tạo)
      },
      {
        path: 'brands/add', // URL: /admin/brands/add
        name: 'admin-brand-add',
        component: () => import('../../components/Views/Admin/Brand/BrandForm.vue'), // Trang thêm thương hiệu (cần tạo)
        props: { isEditMode: false }
      },
      {
        path: 'brands/edit/:brandId', // URL: /admin/brands/edit/456
        name: 'admin-brand-edit',
        component: () => import('../../components/Views/Admin/Brand/BrandForm.vue'), // Dùng chung form
        props: route => ({ isEditMode: true, brandId: route.params.brandId })
      },
      // --- Thêm các route quản lý khác (Orders, Users,...) tương tự ---
       {
        path: 'orders', // URL: /admin/orders
        name: 'admin-order-list',
        component: () => import('../../components/Views/Admin/OrderList.vue'), // Cần tạo OrderList.vue
      },
       {
        path: 'users', // URL: /admin/users
        name: 'admin-user-list',
        component: () => import('../../components/Views/Admin/UserList.vue'), // Cần tạo UserList.vue
      },
    ],
  },
];

export default adminRoutes;