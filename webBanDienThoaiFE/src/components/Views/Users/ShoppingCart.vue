<template>
  <div class="shopping-cart-page">
    <h1>Giỏ Hàng Của Bạn</h1>
    {{ cartItems }}
    <div v-if="isLoading" class="loading-indicator">
      <p>Đang tải giỏ hàng...</p>
    </div>

    <div v-if="error" class="error-message">
      <p>{{ error }}</p>
    </div>

    <div v-if="!isLoading && !error && cartItems.length === 0" class="empty-cart">
      <p>Giỏ hàng của bạn đang trống.</p>
      <router-link :to="{ name: 'home' }" class="btn-continue-shopping">Tiếp tục mua sắm</router-link>
    </div>

    <div v-if="!isLoading && cartItems.length > 0" class="cart-container">
      <table class="cart-table">
        <thead>
          <tr>
            <th class="col-image">Ảnh</th>
            <th class="col-product">Sản phẩm</th>
            <th class="col-price">Đơn giá</th>
            <th class="col-quantity">Số lượng</th>
            <th class="col-total">Tổng cộng</th>
            <th class="col-action">Xóa</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in cartItems" :key="item.product.productId" class="cart-item">
            {{ item }}
            <td class="col-image">
              <img v-if="item.product.image_products && item.product.image_products.length > 0"
                :src="`http://127.0.0.1:8000${item.product.image_products[0].imagePath}`"
                :alt="item.product.productName" class="product-image">
            </td>
            <td class="col-product">
              <span class="product-name">{{ item.product.productName }}</span>
            </td>
            <td class="col-price">{{ formatPrice(item.product.productPrice) }}</td>
            <td class="col-quantity">
              <input type="number" v-model.number="item.quantity" @change="updateQuantity(item)" min="1"
                class="quantity-input">
            </td>
            <td class="col-total">{{ formatItemTotal(item) }}</td>
            <td class="col-action">
              <button @click="removeItem(item.product.productId)" class="btn-remove" title="Xóa sản phẩm">
                &times;
              </button>
            </td>
          </tr>

        </tbody>
      </table>

      <div class="cart-summary">
        <div class="summary-row">
          <span class="summary-label">Tổng cộng:</span>
          <span class="summary-value total-amount">{{ formattedCartTotal }}</span>
        </div>
        <button @click="goToCheckout" class="btn-checkout">Tiến hành Thanh toán</button>
      </div>
    </div>
  </div>
</template>



<script>
import OrderService from '../../../services/OrderService';

// Import các service cần thiết (nếu có API giỏ hàng thực tế)
// import CartService from '@/services/CartService'; // Ví dụ
// import { IMAGE_BASE_URL } from '@/services/axiosInstance'; // Điều chỉnh đường dẫn nếu cần

export default {
  name: 'ShoppingCart',
  data() {
    // Khai báo các biến trạng thái reactive ở đây
    return {
      cartItems: [],
      isLoading: false, // Trạng thái loading khi fetch dữ liệu
      error: null,     // Lưu lỗi nếu có
      // Bạn có thể đặt dữ liệu giả lập ở đây để test nhanh nếu chưa có API
      // cartItems: [
      //   { id: 1, name: 'Laptop ABC Model X', price: 15000000, quantity: 1, image: 'placeholder.jpg' },
      //   { id: 2, name: 'Chuột không dây Z', price: 350000, quantity: 2, image: 'placeholder.jpg' },
      //   { id: 3, name: 'Bàn phím cơ Y', price: 1200000, quantity: 1, image: 'placeholder.jpg' },
      // ],
    };
  },
  computed: {
    // Các thuộc tính tính toán dựa trên 'data'
    cartTotal() {
      // Tính tổng tiền giỏ hàng
      return this.cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
    },
    formattedCartTotal() {
      // Định dạng tổng tiền cuối cùng
      return this.formatPrice(this.cartTotal);
    }
  },
  methods: {
    // Các hàm xử lý logic, sự kiện
    async fetchCartItems() {
      this.isLoading = true;
      this.error = null;
      console.log("Fetching cart items...");
      try {
        const res = await OrderService.GetAllOrder();
        this.cartItems = res.data;
        console.log("Cart:  ", this.cartItems);
        this.isLoading = false;
        // this.cartItems = [
        //   { id: 1, name: 'Laptop ABC Model X', price: 15000000, quantity: 1, image: 'https://via.placeholder.com/100' }, // Sử dụng URL placeholder
        //   { id: 2, name: 'Chuột không dây Z', price: 350000, quantity: 2, image: 'https://via.placeholder.com/100' },
        //   { id: 3, name: 'Bàn phím cơ Y', price: 1200000, quantity: 1, image: 'https://via.placeholder.com/100' },
        // ];
        // console.log("Cart items loaded (mock data).");

      } catch (err) {
        console.error("Error fetching cart items:", err);
        this.error = "Không thể tải giỏ hàng. Vui lòng thử lại.";
        this.cartItems = []; // Xóa dữ liệu cũ nếu lỗi
      } finally {
        this.isLoading = false;
      }
    },

    updateQuantity(item) {
      // Đảm bảo số lượng không nhỏ hơn 1
      if (item.quantity < 1) {
        item.quantity = 1;
      }
      // Cập nhật lại tổng tiền (computed property sẽ tự làm)
      console.log(`Updated quantity for ${item.name} to ${item.quantity}`);

      // --- Gọi API để cập nhật giỏ hàng trên server ---
      // Ví dụ:
      // try {
      //   await CartService.updateItemQuantity(item.id, item.quantity);
      // } catch (err) {
      //   console.error("Error updating quantity on server:", err);
      //   // Có thể hoàn tác thay đổi số lượng trên UI nếu API lỗi
      // }
    },

    removeItem(itemId) {
      if (!confirm(`Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?`)) {
        return;
      }
      console.log(`Removing item with id ${itemId}`);
      // Lọc ra khỏi mảng hiện tại trên UI trước
      this.cartItems = this.cartItems.filter(item => item.id !== itemId);

      // --- Gọi API để xóa sản phẩm khỏi giỏ hàng trên server ---
      // Ví dụ:
      // try {
      //    await CartService.removeItem(itemId);
      // } catch (err) {
      //   console.error("Error removing item on server:", err);
      //   alert("Xóa sản phẩm trên server thất bại. Vui lòng tải lại trang.");
      //   // Có thể thêm lại sản phẩm vào UI nếu API lỗi
      // }
    },

    // Định dạng giá tiền cho từng sản phẩm (đơn giá)
    formatPrice(value) {
      if (typeof value !== 'number') return '';
      return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
    },

    // Định dạng tổng tiền cho một dòng sản phẩm (đơn giá * số lượng)
    formatItemTotal(item) {
      if (!item || typeof item.price !== 'number' || typeof item.quantity !== 'number') return '';
      const total = item.price * item.quantity;
      return this.formatPrice(total); // Gọi lại hàm formatPrice chung
    },

    // Hàm lấy URL ảnh (giữ nguyên hoặc điều chỉnh theo thực tế)
    getImageUrl(imagePath) {
      if (!imagePath) return 'https://via.placeholder.com/100?text=No+Image'; // Ảnh mặc định

      // Nếu imagePath đã là URL đầy đủ
      if (imagePath.startsWith('http://') || imagePath.startsWith('https://')) {
        return imagePath;
      }

      // Nếu dùng IMAGE_BASE_URL
      // return `${IMAGE_BASE_URL}/${imagePath.replace(/\\/g, '/')}`;

      // Nếu không có base URL, trả về path gốc (có thể không hoạt động)
      console.warn("getImageUrl: IMAGE_BASE_URL not configured, returning raw path:", imagePath);
      return imagePath; // Hoặc trả về ảnh placeholder mặc định
      // return 'https://via.placeholder.com/100?text=No+Image';
    },

    goToCheckout() {
      console.log("Proceeding to checkout...");
      // Điều hướng đến trang thanh toán
      // this.$router.push({ name: 'checkout' }); // Ví dụ
      alert("Chuyển đến trang thanh toán (chức năng chưa hoàn thiện).");
    }
  },
  created() {
    // Gọi hàm fetch dữ liệu khi component được tạo
    this.fetchCartItems();
  },
  // mounted() {
  //   // Hoặc gọi ở mounted nếu cần truy cập DOM
  // }
};
</script>

<style scoped>
.shopping-cart-page {
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
}

h1 {
  text-align: center;
  margin-bottom: 30px;
  color: #333;
}

.loading-indicator,
.error-message,
.empty-cart {
  text-align: center;
  padding: 40px 15px;
  color: #6c757d;
  font-size: 1.1em;
}

.error-message {
  color: #dc3545;
  background-color: #f8d7da;
  border: 1px solid #f5c6cb;
  border-radius: 5px;
  padding: 15px;
}

.empty-cart p {
  margin-bottom: 20px;
}

.btn-continue-shopping {
  display: inline-block;
  padding: 10px 20px;
  background-color: #0d6efd;
  color: white;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.2s;
}

.btn-continue-shopping:hover {
  background-color: #0b5ed7;
}

.cart-container {
  margin-top: 20px;
}

.cart-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 30px;
}

.cart-table th,
.cart-table td {
  border-bottom: 1px solid #dee2e6;
  padding: 15px 10px;
  text-align: left;
  vertical-align: middle;
}

.cart-table th {
  background-color: #f8f9fa;
  font-weight: 600;
  color: #495057;
  font-size: 0.9rem;
  text-transform: uppercase;
  white-space: nowrap;
}

.cart-item:hover {
  background-color: #f8f9fa;
  /* Highlight nhẹ khi hover */
}

.col-image {
  width: 80px;
  text-align: center;
}

.col-product {
  width: auto;
}

/* Chiếm phần lớn */
.col-price,
.col-total {
  width: 130px;
  text-align: right;
  white-space: nowrap;
}

.col-quantity {
  width: 120px;
  text-align: center;
}

.col-action {
  width: 60px;
  text-align: center;
}

.product-image {
  max-width: 60px;
  max-height: 60px;
  height: auto;
  border-radius: 4px;
  border: 1px solid #eee;
}

.product-name {
  font-weight: 500;
  color: #333;
}

.quantity-input {
  width: 60px;
  padding: 5px 8px;
  border: 1px solid #ced4da;
  border-radius: 4px;
  text-align: center;
  font-size: 1rem;
  /* Ẩn mũi tên mặc định */
  -moz-appearance: textfield;
}

.quantity-input::-webkit-outer-spin-button,
.quantity-input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

.btn-remove {
  background-color: transparent;
  border: none;
  color: #dc3545;
  font-size: 1.6rem;
  font-weight: bold;
  cursor: pointer;
  padding: 0 5px;
  line-height: 1;
  transition: color 0.2s, transform 0.1s;
}

.btn-remove:hover {
  color: #a71d2a;
  transform: scale(1.1);
}

.cart-summary {
  max-width: 400px;
  margin-left: auto;
  /* Đẩy sang phải */
  border: 1px solid #e9ecef;
  padding: 20px;
  border-radius: 5px;
  background-color: #f8f9fa;
}

.summary-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
  font-size: 1rem;
}

.summary-label {
  color: #6c757d;
}

.summary-value {
  font-weight: 500;
  color: #333;
}

.total-amount {
  font-weight: bold;
  font-size: 1.2rem;
  color: #dc3545;
  /* Màu đỏ cho tổng tiền */
}

.btn-checkout {
  display: block;
  width: 100%;
  padding: 12px 20px;
  background-color: #198754;
  /* Màu xanh lá */
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 1.1rem;
  font-weight: 500;
  margin-top: 20px;
  transition: background-color 0.2s;
}

.btn-checkout:hover {
  background-color: #157347;
}

/* Responsive */
@media (max-width: 768px) {

  .cart-table th:not(.col-product),
  .cart-table td:not(.col-product) {
    /* Ẩn bớt cột trên mobile nếu cần */
    /* display: none; */
  }

  .cart-table th,
  .cart-table td {
    padding: 10px 5px;
  }

  .col-price,
  .col-total {
    width: 100px;
  }

  .col-quantity {
    width: 90px;
  }

  .quantity-input {
    width: 50px;
  }

  .cart-summary {
    max-width: none;
    margin-left: 0;
  }
}

@media (max-width: 576px) {

  /* Có thể cần ẩn thêm cột hoặc thay đổi layout hoàn toàn */
  h1 {
    font-size: 1.5rem;
    margin-bottom: 20px;
  }

  .product-name {
    font-size: 0.9rem;
  }

  .cart-table th {
    font-size: 0.8rem;
  }

}
</style>