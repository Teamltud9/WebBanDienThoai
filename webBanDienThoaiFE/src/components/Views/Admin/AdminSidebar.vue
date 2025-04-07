<template>
    <aside class="admin-sidebar">
      <div class="sidebar-header">
        <router-link :to="{ name: 'admin-dashboard' }" class="logo-link">
          <i class="fas fa-tachometer-alt"></i> <span>Admin Panel</span>
        </router-link>
      </div>
      <nav>
        <ul>
          <li>
            <router-link :to="{ name: 'admin-dashboard' }" active-class="active-link" exact>
               <i class="fas fa-tachometer-alt"></i> Bảng điều khiển
            </router-link>
          </li>
          <li class="menu-header">Quản lý</li>
          <li>
            <router-link :to="{ name: 'admin-product-list' }" active-class="active-link">
               <i class="fas fa-box-open"></i> Sản phẩm
            </router-link>
          </li>
          <li>
            <router-link :to="{ name: 'admin-brand-list' }" active-class="active-link">
               <i class="fas fa-copyright"></i> Thương hiệu
            </router-link>
          </li>
           <li>
            <router-link :to="{ name: 'admin-order-list' }" active-class="active-link">
               <i class="fas fa-file-invoice-dollar"></i> Đơn hàng
            </router-link>
          </li>
           <li>
            <router-link :to="{ name: 'admin-user-list' }" active-class="active-link">
               <i class="fas fa-users"></i> Người dùng
            </router-link>
          </li>
          <li class="separator"></li>
           <li>
            <a href="#" @click.prevent="logout">
               <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </a>
          </li>
        </ul>
      </nav>
    </aside>
  </template>
  
  <script>
  import { useRouter } from 'vue-router';
  import AuthService from '../../../services/authService';
  
  export default {
    name: 'AdminSidebar',
     setup() {
      const router = useRouter();
  
      const logout = async () => {
         try {
             await AuthService.Logout();
         } catch (logoutError) {
             console.error("Lỗi khi đăng xuất:", logoutError);
         } finally {
             sessionStorage.removeItem('authToken');
             sessionStorage.removeItem('User');
             // Chuyển hướng về trang đăng nhập hoặc trang chủ
             router.push({ name: 'Login' }).then(() => { // Giả sử có route 'Login'
                  window.location.reload();
             });
         }
      };
  
      return {
        logout,
      };
    }
  };
  </script>
  
  <style scoped>
  .admin-sidebar {
    width: 260px;
    background-color: #343a40; /* Màu nền tối cho admin sidebar */
    color: #adb5bd; /* Màu chữ nhạt */
    padding: 0;
    height: 100vh; /* Chiều cao đầy màn hình */
    position: sticky; /* Giữ sidebar cố định khi cuộn */
    top: 0;
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
  }
  
  .sidebar-header {
      padding: 15px 20px;
      border-bottom: 1px solid #495057; /* Đường kẻ phân cách */
      text-align: center;
  }
  
  .sidebar-header .logo-link {
      color: #fff; /* Màu chữ trắng */
      font-size: 1.2em;
      font-weight: 600;
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center; /* Căn giữa icon và text */
      gap: 10px; /* Khoảng cách giữa icon và text */
  }
  .sidebar-header .logo-link:hover {
      color: #e9ecef;
  }
  
  nav ul {
    list-style: none;
    padding: 15px 0; /* Khoảng cách trên dưới cho menu */
    margin: 0;
    flex-grow: 1; /* Cho phép menu chiếm không gian còn lại */
    overflow-y: auto; /* Thêm cuộn nếu menu quá dài */
  }
  
  nav li {
    margin: 0;
  }
  
  nav .menu-header {
      padding: 10px 20px;
      font-size: 0.8em;
      color: #6c757d; /* Màu nhạt hơn */
      text-transform: uppercase;
      font-weight: bold;
      margin-top: 15px; /* Khoảng cách với mục menu phía trên */
  }
  
  
  nav a {
    display: flex;
    align-items: center;
    padding: 12px 25px; /* Tăng padding trái */
    text-decoration: none;
    color: #adb5bd; /* Màu chữ mặc định */
    font-size: 0.95em;
    transition: background-color 0.2s ease, color 0.2s ease;
    border-left: 4px solid transparent; /* Border để highlight active link */
  }
  
  nav a i {
      margin-right: 15px;
      width: 20px;
      text-align: center;
      color: #8a95a1; /* Màu icon */
      font-size: 1.1em; /* Icon lớn hơn chút */
  }
  
  nav a:hover {
    background-color: #495057; /* Màu nền khi hover */
    color: #fff; /* Màu chữ khi hover */
  }
  
  /* Kiểu cho link đang active */
  nav a.active-link {
    background-color: #495057; /* Màu nền khi active */
    color: #fff; /* Màu chữ khi active */
    font-weight: 500;
    border-left-color: #007bff; /* Màu highlight border */
  }
  nav a.active-link i {
      color: #007bff; /* Màu icon khi active */
  }
  
  .separator {
      height: 1px;
      background-color: #495057;
      margin: 15px 20px;
  }
  </style>