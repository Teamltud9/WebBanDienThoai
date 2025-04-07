<template>
    <main class="site-main" id="home">
        <section class="product-filters">
            <div class="container">
                <h2>Tìm kiếm & Lọc Sản phẩm</h2>
                <div class="filter-controls">
                    <div class="filter-group">
                        <label for="search">Tìm kiếm:</label>
                        <input type="text" id="search" v-model.lazy="searchName" placeholder="Nhập tên sản phẩm..."
                            class="filter-input" @keyup.enter="applySearchAndFilter" />
                    </div>

                    <!-- <div class="filter-group filter-group-price">
                        <label>Giá (VNĐ):</label>
                        <div class="price-inputs">
                            <input type="number" v-model.number.lazy="filterPriceMin" placeholder="Từ" min="0"
                                class="filter-input price-input" />
                            <span>-</span>
                            <input type="number" v-model.number.lazy="filterPriceMax" placeholder="Đến" min="0"
                                class="filter-input price-input" />
                        </div>
                    </div>

                    <div class="filter-group">
                        <label for="brand">Thương hiệu:</label>
                        <select id="brand" v-model="filterBrandId" class="filter-select" :disabled="brandLoading">
                            <option value="">Tất cả thương hiệu</option>
                            <option v-if="brandLoading" value="" disabled>Đang tải...</option>
                            <option v-for="brand in brands" :key="brand.id" :value="brand.id">
                                {{ brand.brandName }}
                            </option>
                        </select>
                        <div v-if="brandError" class="filter-error-text">{{ brandError }}</div>
                    </div>


                    <div class="filter-group">
                        <label for="ram">RAM:</label>
                        <select id="ram" v-model="filterRam" class="filter-select">
                            <option value="">Tất cả RAM</option>
                            <option value="4GB">4GB</option>
                            <option value="8GB">8GB</option>
                            <option value="16GB">16GB</option>
                            <option value="32GB">32GB</option>
                            <option value="64GB">64GB</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="storage">Bộ nhớ trong:</label>
                        <select id="storage" v-model="filterStorage" class="filter-select">
                            <option value="">Tất cả bộ nhớ</option>
                            <option value="128GB SSD">128GB SSD</option>
                            <option value="256GB SSD">256GB SSD</option>
                            <option value="512GB SSD">512GB SSD</option>
                            <option value="1TB SSD">1TB SSD</option>
                            <option value="2TB SSD">2TB SSD</option>
                            <option value="1TB HDD">1TB HDD</option>
                        </select>
                    </div> -->

                    <div class="action-buttons">
                        <button @click="searchProduct()" class="btn-apply">Áp dụng</button>
                        <button @click="resetFiltersAndSearch" class="btn-reset">Xóa lọc</button>
                    </div>
                </div>
            </div>
        </section>
        <section class="featured-products">
            <div class="container">
                <h2>Sản Phẩm</h2>
                <div class="product-grid">
                    <article class="product-item" v-for="item in products" :key="item.productId">
                        <img v-if="item.image_products" :src="`http://127.0.0.1:8000${item.image_products[0].imagePath}`" :alt="`http://127.0.0.1:8000${item.image_products[0].imagePath}`">
                        <router-link :to="`/controllers/product/detail/${item.productId}`">{{ item.productName
                        }}</router-link>
                        <p class="price">{{ formatPrice(item.productPrice) }}</p>
                        <button>Thêm vào giỏ</button>
                    </article>
                </div>

                <div class="pagination-controls" v-if="products.length > 0">
                    <button @click="prevPage" :disabled="page <= 1">Trang Trước</button>
                    <span>Trang {{ page }}</span>
                    <button @click="nextPage" :disabled="!hasNextPage">Trang Sau</button>
                </div>
                <div v-else>
                    <p>Không có sản phẩm nào để hiển thị.</p>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import ProductVM from '@/models/Enities/ProductVM';
import ProductService from '@/services/ProductService';
import ListBrand from '../Brand/ListBrand.vue';
// Đảm bảo đường dẫn này đúng với cấu trúc dự án của bạn
import axiosInstance, { IMAGE_BASE_URL } from '../../../services/axiosInstance'; // Kiểm tra lại đường dẫn này
import SearchService from '../../../services/SearchService';

export default {
    data() {
        return {
            products: [new ProductVM()],
            page: 1,         // Trang hiện tại
            pagesize: 12,    // Số sản phẩm mỗi trang
            hasNextPage: true, // Biến cờ để biết có trang tiếp theo không (khởi tạo là true)
            searchName: ''
        }
    },
    methods: {
        async searchProduct(){
            // this.page = 1;
            const res = await SearchService.SearchProducts(this.searchName);
            this.products = res.result.map(item => ({
                        ...item,
                    }));
            console.log("Response = ", this.products);
        },
        formatPrice(value) {
            const number = Number(value); 

            if (isNaN(number)) return '';

            if (number < 1000) {
                return `${number}đ`;
            }

            return new Intl.NumberFormat('vi-VN').format(number) + ' đ';
        },
        /**
         * Lấy danh sách sản phẩm theo trang và kích thước trang
         * @param {number} pageToFetch - Số trang cần lấy
         * @param {number} size - Kích thước trang
         */
        async GetAllProducts(pageToFetch, size) {
            try {
                console.log(`Đang tải trang ${pageToFetch} với kích thước ${size}`); // Ghi log để kiểm tra
                const res = await ProductService.GetAllProducts(pageToFetch, size);
                if (res.data && res.data.length > 0) {
                    this.products = res.data;
                    this.page = pageToFetch;
                    this.hasNextPage = res.data.length === size;
                } else {
                    console.log("Không tìm thấy sản phẩm nào trên trang này.");
                    this.hasNextPage = false; // Không còn trang tiếp theo
                }
            } catch (error) {
                console.error("Lỗi khi tải sản phẩm:", error);
                this.hasNextPage = false; // Giả sử lỗi xảy ra thì không chắc có trang tiếp theo
            }
        },

        /**
         * Chuyển đến trang tiếp theo
         */
        async nextPage() {
            if (this.hasNextPage) { // Chỉ chuyển trang nếu biết chắc còn trang sau
                await this.GetAllProducts(this.page + 1, this.pagesize);
            } else {
                console.log("Đã ở trang cuối cùng.");
            }
        },

        /**
         * Quay lại trang trước đó
         */
        async prevPage() {
            if (this.page > 1) { // Chỉ quay lại nếu không phải trang đầu tiên
                await this.GetAllProducts(this.page - 1, this.pagesize);
            } else {
                console.log("Đang ở trang đầu tiên.");
            }
        }
    },
    async created() {
        // Tải trang đầu tiên khi component được tạo
        await this.GetAllProducts(this.page, this.pagesize);
    },
    name: 'Home',
    components: {
        ListBrand
    }
}
</script>


<style>
/* --- CSS cho Bộ lọc Sản phẩm --- */
/* Thêm vào phần CSS của bạn */
.filter-error-text {
    font-size: 0.85em;
    color: #dc3545;
    /* Màu đỏ lỗi */
    margin-top: 4px;
}

.filter-select:disabled {
    background-color: #e9ecef;
    /* Màu nền khi bị disable */
    cursor: not-allowed;
}

.product-filters {
    background-color: #ffffff;
    padding: 30px 0;
    margin-bottom: 40px;
    border-bottom: 1px solid #e9ecef;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.product-filters h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 1.75em;
    color: #343a40;
    font-weight: 600;
}

.filter-controls {
    display: flex;
    flex-wrap: wrap;
    gap: 25px 20px;
    align-items: flex-end;
    /* Quan trọng: căn chỉnh đáy */
    justify-content: center;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
    /* Điều chỉnh flex cho các nhóm chung */
    flex-grow: 1;
    /* Cho phép các nhóm khác co giãn */
    flex-shrink: 1;
    flex-basis: 180px;
    /* Chiều rộng cơ sở nhỏ hơn cho nhóm thường */
    min-width: 160px;
}

/* **QUAN TRỌNG:** Ưu tiên không gian cho nhóm lọc giá */
.filter-group-price {
    flex-grow: 1.5;
    /* Cho phép nhóm giá chiếm nhiều không gian hơn chút */
    flex-shrink: 1;
    /* Vẫn cho phép co lại nếu cần */
    flex-basis: 240px;
    /* Chiều rộng cơ sở lớn hơn */
    min-width: 220px;
    /* Đảm bảo chiều rộng tối thiểu lớn hơn */
}


.filter-group label {
    font-weight: 500;
    font-size: 0.9rem;
    color: #495057;
    margin-bottom: 0;
}

.filter-input,
.filter-select {
    padding: 10px 15px;
    border: 1px solid #ced4da;
    border-radius: 6px;
    font-size: 0.95rem;
    width: 100%;
    box-sizing: border-box;
    background-color: #fff;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    /* Đảm bảo chiều cao cố định để căn chỉnh flex-end hoạt động tốt */
    height: 41px;
    /* Hoặc một giá trị phù hợp với padding + font-size + border */
}

.filter-input::placeholder {
    color: #adb5bd;
    opacity: 1;
}

.filter-input:focus,
.filter-select:focus {
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Container chứa 2 ô input giá */
.price-inputs {
    display: flex;
    align-items: center;
    /* Căn giữa theo chiều dọc */
    gap: 8px;
    width: 100%;
    /* Đảm bảo container chiếm đủ chiều rộng */
}

/* Input giá (Từ - Đến) */
.price-input {
    /* Cho phép co giãn bên trong .price-inputs */
    flex-grow: 1;
    flex-shrink: 1;
    /* width: auto; không cần thiết khi có flex-grow */
    min-width: 70px;
    /* **QUAN TRỌNG:** Đặt chiều rộng tối thiểu để không bị ẩn */
    text-align: right;
    /* Ghi đè chiều cao nếu cần để khớp với các input khác */
    height: 41px;
    /* Đảm bảo chiều cao nhất quán */
}

/* Dấu gạch ngang */
.price-inputs span {
    color: #6c757d;
    font-weight: 500;
    flex-shrink: 0;
    /* Không cho phép dấu gạch co lại */
    padding-bottom: 0;
    /* Căn chỉnh với đáy input nếu cần */
}

.price-input::-webkit-outer-spin-button,
.price-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.price-input[type=number] {
    -moz-appearance: textfield;
}

/* Nút Apply và Reset */
.action-buttons {
    display: flex;
    gap: 10px;
    flex-basis: auto;
    flex-grow: 0;
    min-width: fit-content;
    /* Đảm bảo các nút cũng được căn đáy */
    align-self: flex-end;
}

.btn-apply,
.btn-reset {
    padding: 10px 20px;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.95rem;
    font-weight: 500;
    transition: background-color 0.2s ease, transform 0.1s ease;
    white-space: nowrap;
    height: 41px;
    /* Chiều cao nhất quán với input */
}

.btn-apply {
    background-color: #007bff;
}

.btn-apply:hover {
    background-color: #0056b3;
}

.btn-reset {
    background-color: #6c757d;
}

.btn-reset:hover {
    background-color: #5a6268;
}

.btn-apply:active,
.btn-reset:active {
    transform: scale(0.97);
}
</style>