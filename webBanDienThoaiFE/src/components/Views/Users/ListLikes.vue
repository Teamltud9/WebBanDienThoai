<template>
    <div class="liked-products-container">
        <h2>Sản phẩm đã thích</h2>

        <div v-if="isLoading" class="loading-indicator">
            Đang tải danh sách...
        </div>

        <div v-if="error" class="error-message">
            Lỗi khi tải danh sách: {{ error }}
        </div>

        <div v-if="!isLoading && !error && likedProducts.length === 0" class="empty-list">
            Bạn chưa thích sản phẩm nào.
        </div>

        <ul v-if="!isLoading && !error && likedProducts.length > 0" class="product-list">
            <li v-for="product in likedProducts" :key="product.id" class="product-item">
                <img class="img_like" :src="`http://127.0.0.1:8000${product.image_products[0].imagePath}`"
                    :alt="`http://127.0.0.1:8000${product.image_products[0].imagePath}`">
                <div class="product-info">
                    <router-link class="product-name" :to="{ name: `product-detail`, params: { id: product.productId } }">
                            {{ product.productName }}
                        </router-link>
                    <h3 class="product-name">Nhãn hiệu: {{ product.brand.brandName }}</h3>
                    <h3 class="product-name">Dung lượng: {{ product.storage }}</h3>
                    <p class="product-price">{{ formatPrice(product.productPrice) }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import ReviewService from '../../../services/ReviewService';

export default {
    name: 'LikedProducts',
    data() {
        return {
            likedProducts: [],
            isLoading: false,
            error: null,
        };
    },
    methods: {
        formatPrice(value) {
            const number = Number(value); // ép kiểu
            if (isNaN(number)) return '';
            if (number < 1000) {
                return `${number}đ`;
            }
            return new Intl.NumberFormat('vi-VN').format(number) + ' đ';
        },
        async fetchLikedProducts() {
            this.isLoading = true;
            this.error = null;
            this.likedProducts = [];
            try {
                const response = await ReviewService.GetLike(); // Cần được implement trong UserService
                console.log(response);
                this.likedProducts = response.result;
                //   if (response && response.data && Array.isArray(response.data)) {
                //      this.likedProducts = response.data.map(item => ({ ...item })); // Tạo bản sao
                //   }
                // ------------------------------

            } catch (err) {
                console.error("Lỗi khi tải sản phẩm đã thích:", err);
                this.error = err.message || 'Đã xảy ra lỗi không xác định.';
            } finally {
                this.isLoading = false;
            }
        },
    },
    async created() {
        // Tải danh sách khi component được tạo
        await this.fetchLikedProducts();
    },
};
</script>

<style scoped>
.img_like{
    border-radius: 5px;
    margin: 20px;
}
/* Thêm CSS styling của bạn ở đây */
.liked-products-container {
    padding: 20px;
}

.loading-indicator,
.error-message,
.empty-list {
    text-align: center;
    margin-top: 20px;
    color: gray;
}

.error-message {
    color: red;
}

.product-list {
    list-style: none;
    padding: 0;
}

.product-item {
    display: flex;
    align-items: center;
    border-bottom: 1px solid #eee;
    padding: 15px 0;
}

.product-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    margin-right: 15px;
}

.product-info {
    flex-grow: 1;
}

.product-name {
    font-size: 1.1em;
    margin: 0 0 5px 0;
}

.product-price {
    color: #c00;
    font-weight: bold;
}

.unlike-button {
    padding: 5px 10px;
    cursor: pointer;
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.unlike-button:hover {
    background-color: #e0e0e0;
}
</style>