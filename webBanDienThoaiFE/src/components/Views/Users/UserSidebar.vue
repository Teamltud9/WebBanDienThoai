<template>
    <aside class="customer-sidebar">
      <nav>
        <ul>
          <li>
            <router-link :to="{ name: 'HomeView' }" exact-active-class="active-link" exact>
               <i class="fas fa-home"></i> Trang chủ </router-link>
          </li>
           <li>
            <router-link :to="{ name: 'user-profile' }" active-class="active-link">
              <i class="fas fa-user"></i> Tài khoản của bạn
            </router-link>
          </li>
           <li>
            <router-link :to="{ name: 'shopping-cart' }" active-class="active-link">
               <i class="fas fa-shopping-cart"></i> Giỏ hàng
            </router-link>
          </li>
           <li>
            <router-link :to="{ name: 'list-history' }" active-class="active-link">
               <i class="fas fa-history"></i> Lịch sử mua hàng
            </router-link>
          </li> 
          <li>
            <router-link :to="{ name: 'list-like' }" active-class="active-link">
               <i class="fas fa-shield-alt"></i> Danh sách yêu thích
            </router-link>
          </li>
          <li class="separator"></li> <li>
            <a href="#" @click.prevent="logout"> <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </a>
          </li>
        </ul>
      </nav>
    </aside>
  </template>
  
  <script>
  import { useRouter } from 'vue-router';
  import AuthService from '../../../services/authService'; // Đảm bảo đường dẫn đúng
  
  export default {
    name: 'CustomerSidebar',
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
             // Chuyển hướng về trang chủ hoặc đăng nhập
             router.push({ name: 'HomeView' }).then(() => {
                  // Cần reload để đảm bảo trạng thái header/UI cập nhật
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
  .customer-sidebar {
    width: 250px; /* Độ rộng của sidebar */
    background-color: #f8f9fa; /* Màu nền giống hình ảnh */
    padding: 20px 0;
    height: 100%; /* Chiều cao tối thiểu */
    border-right: 1px solid #e0e0e0;
    flex-shrink: 0; /* Không co lại khi nội dung bên phải quá rộng */
  }
  
  nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  
  nav li {
    margin-bottom: 5px;
  }
  
  nav a {
    display: flex; /* Để icon và text thẳng hàng */
    align-items: center;
    padding: 12px 20px;
    text-decoration: none;
    color: #333;
    font-size: 0.95em;
    transition: background-color 0.2s ease, color 0.2s ease;
    border-left: 3px solid transparent; /* Border để highlight active link */
  }
  
  nav a i {
      margin-right: 12px; /* Khoảng cách giữa icon và text */
      width: 20px; /* Đảm bảo icon thẳng hàng */
      text-align: center;
      color: #555; /* Màu icon */
  }
  
  nav a:hover {
    background-color: #e9ecef;
    color: #007bff; /* Màu khi hover */
  }
  
  /* Kiểu cho link đang active */
  nav a.active-link {
    background-color: #e2f1ff; /* Màu nền khi active */
    color: #007bff; /* Màu chữ khi active */
    font-weight: 600; /* In đậm chữ */
    border-left-color: #007bff; /* Highlight border bên trái */
  }
  nav a.active-link i {
      color: #007bff; /* Đổi màu icon khi active */
  }
  
  
  .separator {
      height: 1px;
      background-color: #e0e0e0;
      margin: 15px 20px; /* Khoảng cách trên dưới và trái phải */
  }
  
  /* Thêm FontAwesome vào index.html nếu chưa có */
  /* <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" ... /> */
  
  </style>