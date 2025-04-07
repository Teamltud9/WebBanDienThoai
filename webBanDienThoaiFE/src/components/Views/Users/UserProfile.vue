<template>
  <div class="user-profile container">
    <h1>Thông tin cá nhân</h1>

    <div v-if="isLoading" class="loading">Đang tải thông tin...</div>
    <div v-else-if="error" class="error-message">{{ error }}</div>

    <div v-else class="profile-content">
      <div class="profile-details">
        <h2>Thông tin tài khoản</h2>
        <div class="detail-item">
          <label>Họ và tên:</label>
          <p>{{ userProfile.userName }}</p>
        </div>
        <div class="detail-item">
          <label>Email:</label>
          <p>{{ userProfile.email }}</p>
        </div>
        <div class="detail-item">
          <label>Số điện thoại:</label>
          <p>{{ userProfile.phoneNumber || 'Chưa cập nhật' }}</p>
        </div>
        <div class="detail-item">
          <label>Địa chỉ:</label>
          <p>{{ userProfile.address || 'Chưa cập nhật' }}</p>
        </div>
      </div>

      <div class="profile-actions">
        <button @click="editProfile" class="action-button edit-button">
          Chỉnh sửa thông tin
        </button>
        <button @click="changePassword" class="action-button change-password-button">
          Đổi mật khẩu
        </button>
        <button @click="viewOrderHistory" class="action-button">
          Lịch sử đơn hàng
        </button>
      </div>
    </div>

    <EditProfileModal v-if="showEditModal" :user="userProfile" @close="showEditModal = false"
      @save="handleProfileUpdate" />
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import UserVM from '../../../models/Enities/UserVM'; // Import UserVM
import AuthService from '../../../services/authService';

export default {
  data() {
    return {
      userProfile: new UserVM(),
    }
  },
  methods: {
    async GetUser() {
      const response = await AuthService.GetProfile();
      this.userProfile = response;
      console.log(this.userProfile);
    },
  },
  async created() {
      await this.GetUser();
  },

  // name: 'UserProfile',
  // // components: { EditProfileModal },
  // setup() {
  //   const router = useRouter();
  //   const isLoading = ref(true); // Ban đầu vẫn là true
  //   const error = ref(null);
  //   const showEditModal = ref(false);

  //   const fetchUserProfile = () => { // Không cần async nữa nếu chỉ dùng mock data
  //     isLoading.value = true;
  //     error.value = null;

  //     // --- BẮT ĐẦU: Sử dụng dữ liệu giả ---
  //     try {

  //       // Giả lập thời gian chờ của API (tùy chọn)
  //       setTimeout(() => {
  //         userProfile.value = new UserVM(mockUserData); // Gán dữ liệu giả vào userProfile
  //         isLoading.value = false; // Đặt isLoading thành false sau khi "nhận" dữ liệu
  //       }, 500); // Giả lập độ trễ 0.5 giây

  //     } catch (err) {
  //       // Xử lý lỗi nếu có vấn đề khi tạo UserVM (ít khả năng xảy ra với mock data)
  //       console.error("Lỗi khi tạo UserVM từ dữ liệu giả:", err);
  //       error.value = 'Có lỗi xảy ra khi hiển thị thông tin người dùng.';
  //       isLoading.value = false;
  //     }
  //     // --- KẾT THÚC: Sử dụng dữ liệu giả ---

  //     /* --- Bỏ hoặc comment phần gọi API thật ---
  //     try {
  //       const response = await AuthService.GetProfile();
  //       if (response && response.data) {
  //         userProfile.value = new UserVM(response.data);
  //       } else {
  //          throw new Error('Không nhận được dữ liệu người dùng.');
  //       }
  //     } catch (err) {
  //       console.error("Lỗi khi lấy thông tin người dùng:", err);
  //       error.value = 'Không thể tải thông tin người dùng. Vui lòng thử lại.';
  //       if (err.response && err.response.status === 401) {
  //          sessionStorage.removeItem('authToken');
  //          sessionStorage.removeItem('User');
  //          router.push({ name: 'Login' });
  //       }
  //     } finally {
  //       isLoading.value = false;
  //     }
  //     */
  //   };


  //   // const editProfile = () => {
  //   //   showEditModal.value = true;
  //   //   console.log("Chức năng chỉnh sửa hồ sơ");
  //   // };

  //   // const handleProfileUpdate = (updatedUser) => {
  //   //   // Khi dùng mock data, cập nhật lại trực tiếp
  //   //    console.log("Đã cập nhật hồ sơ (mock):", updatedUser);
  //   //    userProfile.value = new UserVM(updatedUser); // Cập nhật lại hiển thị với dữ liệu mới
  //   //    showEditModal.value = false;
  //   // };

  //   // const changePassword = () => {
  //   //   console.log("Chức năng đổi mật khẩu");
  //   //   // router.push({ name: 'change-password' });
  //   // };

  //   // const viewOrderHistory = () => {
  //   //   console.log("Chức năng xem lịch sử đơn hàng");
  //   //    router.push({ name: 'order-history' }); // Chuyển hướng thật
  //   // };

  //   // const logout = async () => {
  //   //    try {
  //   //        // Có thể bạn vẫn muốn gọi API Logout thật
  //   //        // await AuthService.Logout();
  //   //        console.log("Đã gọi logout (mock hoặc thật)");
  //   //    } catch (logoutError) {
  //   //        console.error("Lỗi khi đăng xuất:", logoutError);
  //   //    } finally {
  //   //        sessionStorage.removeItem('authToken');
  //   //        sessionStorage.removeItem('User');
  //   //        router.push({ name: 'HomeView' });
  //   //        window.location.reload();
  //   //    }
  //   // };

  //   onMounted(() => {
  //     fetchUserProfile(); // Gọi hàm để load mock data khi component được mount
  //   });

  //   return {
  //     userProfile,
  //     isLoading,
  //     error,
  //     showEditModal,
  //     //   editProfile,
  //     //   changePassword,
  //     //   viewOrderHistory,
  //     //   logout,
  //     //   handleProfileUpdate
  //   };
  // },

};
</script>

<style scoped>
.user-profile {
  padding: 30px 0;
}

h1 {
  text-align: center;
  margin-bottom: 30px;
  font-size: 2em;
}

.loading,
.error-message {
  text-align: center;
  padding: 40px 0;
  font-size: 1.2em;
  color: #555;
}

.error-message {
  color: #e74c3c;
}

.profile-content {
  display: flex;
  flex-wrap: wrap;
  /* Cho phép xuống dòng trên màn hình nhỏ */
  gap: 30px;
  /* Khoảng cách giữa details và actions */
  background-color: #fff;
  padding: 30px;
  border: 1px solid #eee;
  border-radius: 5px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.profile-details {
  flex: 2;
  /* Chiếm nhiều không gian hơn */
  min-width: 280px;
  /* Đảm bảo không quá hẹp */
}

.profile-details h2 {
  margin-bottom: 20px;
  border-bottom: 1px solid #eee;
  padding-bottom: 10px;
}

.detail-item {
  margin-bottom: 15px;
  display: flex;
  gap: 10px;
  /* Khoảng cách giữa label và value */
}

.detail-item label {
  font-weight: bold;
  color: #555;
  width: 120px;
  /* Độ rộng cố định cho label */
  flex-shrink: 0;
  /* Không co lại */
}

.detail-item p {
  margin: 0;
  flex-grow: 1;
  /* Chiếm phần còn lại */
}

.profile-actions {
  flex: 1;
  /* Chiếm ít không gian hơn */
  min-width: 200px;
  /* Độ rộng tối thiểu */
  display: flex;
  flex-direction: column;
  /* Xếp nút theo cột */
  gap: 15px;
  /* Khoảng cách giữa các nút */
  border-left: 1px solid #eee;
  /* Đường phân cách (trên màn hình lớn) */
  padding-left: 30px;
  /* Khoảng cách với đường phân cách */
}

.action-button {
  padding: 10px 20px;
  border: 1px solid #ccc;
  background-color: #f8f8f8;
  cursor: pointer;
  border-radius: 4px;
  text-align: center;
  transition: background-color 0.3s ease, border-color 0.3s ease;
  font-size: 1em;
}

.action-button:hover {
  background-color: #e2e2e2;
  border-color: #bbb;
}

.edit-button {
  background-color: #3498db;
  color: white;
  border-color: #2980b9;
}

.edit-button:hover {
  background-color: #2980b9;
}

.change-password-button {
  background-color: #f39c12;
  color: white;
  border-color: #e67e22;
}

.change-password-button:hover {
  background-color: #e67e22;
}

.logout-button {
  background-color: #e74c3c;
  color: white;
  border-color: #c0392b;
  margin-top: auto;
  /* Đẩy nút logout xuống cuối */
}

.logout-button:hover {
  background-color: #c0392b;
}


/* Responsive adjustments */
@media (max-width: 768px) {
  .profile-content {
    flex-direction: column;
    /* Chuyển thành cột trên mobile */
  }

  .profile-actions {
    border-left: none;
    /* Bỏ đường phân cách */
    padding-left: 0;
    border-top: 1px solid #eee;
    /* Thêm đường phân cách phía trên */
    padding-top: 30px;
    /* Khoảng cách với details */
  }

  .logout-button {
    margin-top: 15px;
    /* Reset margin-top */
  }
}

/* CSS cho modal (nếu bạn tạo) cần được thêm riêng */
</style>