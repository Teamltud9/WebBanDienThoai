<template>
    <div class="customer-layout-container">
      <CustomerSidebar />
      <main class="main-content">
        <router-view />
      </main>
    </div>
  </template>
  
  <script>
  import CustomerSidebar from './UserSidebar.vue'; // Import Sidebar
  
  export default {
    name: 'CustomerLayout',
    components: {
      CustomerSidebar, // Đăng ký component Sidebar
    },
  };
  </script>
  
  <style scoped>
  .customer-layout-container {
    display: flex;
    min-height: calc(100vh - /* Chiều cao của header nếu có */ 0px); /* Đảm bảo layout chiếm đủ chiều cao */
    background-color: #fff; /* Màu nền chung cho phần content */
  }
  
  .main-content {
    flex-grow: 1; /* Cho phép khu vực nội dung chiếm hết phần còn lại */
    padding: 30px; /* Khoảng cách lề cho nội dung chính */
    overflow-y: auto; /* Cho phép cuộn nếu nội dung dài */
  }
  </style>