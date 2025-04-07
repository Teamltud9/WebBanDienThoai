<template>
    <div class="admin-layout-container">
      <AdminSidebar />
      <main class="admin-main-content">
        <router-view />
      </main>
    </div>
  </template>
  
  <script>
  import AdminSidebar from '../Admin/AdminSidebar.vue';
  
  export default {
    name: 'AdminLayout',
    components: {
      AdminSidebar,
    },
  };
  </script>
  
  <style scoped>
  .admin-layout-container {
    display: flex;
    min-height: 100vh;
    background-color: #f4f6f9; /* Màu nền sáng cho khu vực nội dung */
  }
  
  .admin-main-content {
    flex-grow: 1;
    padding: 25px;
    overflow-y: auto;
  }
  
  /* Có thể thêm các style global cho admin tại đây hoặc trong style.css */
  .admin-main-content h1,
  .admin-main-content h2 {
      color: #333;
      margin-bottom: 20px;
  }
  
  /* Styling cho bảng (ví dụ) */
  .admin-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background-color: #fff;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
      overflow: hidden; /* Để border-radius hoạt động với a */
  }
  
  .admin-table th, .admin-table td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #dee2e6;
  }
  
  .admin-table th {
      background-color: #e9ecef;
      font-weight: 600;
      color: #495057;
  }
  
  .admin-table tbody tr:hover {
      background-color: #f8f9fa;
  }
  
  .admin-table td .actions a,
  .admin-table td .actions button {
      margin-right: 8px;
      color: #007bff;
      cursor: pointer;
      background: none;
      border: none;
      padding: 0;
      text-decoration: none;
  }
  .admin-table td .actions a:hover,
  .admin-table td .actions button:hover {
      text-decoration: underline;
  }
  .admin-table td .actions .delete-btn {
      color: #dc3545;
  }
  
  
  /* Styling cho nút (ví dụ) */
  .admin-button {
      display: inline-block;
      padding: 8px 15px;
      font-size: 0.9em;
      font-weight: 600;
      color: #fff;
      background-color: #007bff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      transition: background-color 0.2s ease;
      margin-bottom: 15px; /* Khoảng cách với bảng hoặc nội dung khác */
  }
  .admin-button:hover {
      background-color: #0056b3;
  }
  .admin-button.add-button {
       background-color: #28a745; /* Màu xanh lá cho nút Add */
  }
  .admin-button.add-button:hover {
       background-color: #218838;
  }
  
  
  </style>