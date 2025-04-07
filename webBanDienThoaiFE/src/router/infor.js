import CustomerLayout from '../components/Views/Users/UserLayout.vue';

const userRoutes = [ // Đổi tên biến để tránh trùng lặp nếu cần
  {
    path: "/users",
    component: CustomerLayout,
    meta: { requiresAuth: true },
    children: [
      {
        path: '',
        redirect: { name: 'user-profile' }
        // Hoặc bạn có thể tạo một trang dashboard riêng
        // path: 'dashboard',
        // name: 'customer-dashboard',
        // component: () => import(...)
      },
      {
        // Route cho trang User Profile
        path: "profile", // URL sẽ là /customer/profile
        name: "user-profile", // Đặt tên route để dùng trong <router-link>
        component: () => import("../components/Views/Users/UserProfile.vue"), // Component UserProfile đã tạo
        // meta riêng nếu cần
      },
      {
        // Route cho trang Giỏ hàng
        path: "cart", // URL sẽ là /customer/cart
        name: "shopping-cart",
        component: () => import("../components/Views/Users/ShoppingCart.vue"), // Component ShoppingCart đã tạo
      },
      {
        // Route cho trang Giỏ hàng
        path: "like", // URL sẽ là /customer/cart
        name: "list-like",
        component: () => import("../components/Views/Users/ListLikes.vue"), // Component ShoppingCart đã tạo
      },
      {
        // Route cho trang Giỏ hàng
        path: "history", // URL sẽ là /customer/cart
        name: "list-history",
        component: () => import("../components/Views/Users/History.vue"), // Component ShoppingCart đã tạo
      },
      
    ],
  },
];

export default userRoutes; // Xuất mảng routes


// {
      //     // Route cho Lịch sử mua hàng
      //     path: 'orders', // URL: /customer/orders
      //     name: 'order-history',
      //     // Tạo component OrderHistory.vue tương tự UserProfile.vue
      //     component: () => import('../../components/Views/Customer/OrderHistory.vue'),
      //     meta: { requiresAuth: true }
      // },
      //  {
      //     // Route cho Tra cứu bảo hành
      //     path: 'warranty', // URL: /customer/warranty
      //     name: 'warranty-lookup',
      //     component: () => import('../../components/Views/Customer/WarrantyLookup.vue'),
      //     meta: { requiresAuth: true }
      // },
      //  {
      //     // Route cho Ưu đãi
      //     path: 'offers', // URL: /customer/offers
      //     name: 'user-offers',
      //     component: () => import('../../components/Views/Customer/UserOffers.vue'),
      //     meta: { requiresAuth: true }
      // },
      // --- Thêm các route con khác ở đây ---
      // Ví dụ: đổi mật khẩu, địa chỉ,...
      // {
      //   path: 'change-password',
      //   name: 'change-password',
      //   component: () => import('.../ChangePassword.vue'),
      // }