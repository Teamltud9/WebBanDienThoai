<template>
    <main class="site-main" id="home">
        <section class="hero-banner">
            <div class="container">
                <h1>Khám Phá Thế Giới Smartphone</h1>
                <p>Những mẫu điện thoại mới nhất với giá tốt nhất.</p>
                <a href="/controllers/search" class="cta-button">Xem Ngay</a>
            </div>
        </section>
        <ListBrand />
        <section class="featured-products">
            <div class="container">
                <h2>Sản Phẩm Nổi Bật</h2>
                <div class="product-grid">
                    <article class="product-item" v-for="item in products" :key="item.productId">
                        <img :src="`http://127.0.0.1:8000${item.image_products[0].imagePath}`"
                            :alt="`http://127.0.0.1:8000${item.image_products[0].imagePath}`">
                        <router-link :to="{ name: `product-detail`,params: { id: item.productId } }">
                            {{ item.productName }}
                        </router-link>
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

export default {
    data() {
        return {
            products: [new ProductVM()],
            page: 1,         // Trang hiện tại
            pagesize: 12,    // Số sản phẩm mỗi trang
            hasNextPage: true // Biến cờ để biết có trang tiếp theo không (khởi tạo là true)
        }
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
        /**
         * Lấy danh sách sản phẩm theo trang và kích thước trang
         * @param {number} pageToFetch - Số trang cần lấy
         * @param {number} size - Kích thước trang
         */
        async GetAllProducts(pageToFetch, size) {
            try {
                console.log(`Đang tải trang ${pageToFetch} với kích thước ${size}`); // Ghi log để kiểm tra
                const res = await ProductService.GetAllProducts(pageToFetch, size);
                console.log(res);
                if (res.data && res.data.length > 0) {
                    // Gán dữ liệu sản phẩm mới
                    this.products = res.data.map(item => ({
                        ...item,
                        // Xử lý đường dẫn ảnh nếu cần, ví dụ:
                        // imageUrl: `${IMAGE_BASE_URL}/${item.imageFileName}` // Giả sử API trả về tên file ảnh
                        // Nếu API đã trả về URL đầy đủ thì không cần dòng trên
                    }));

                    // Cập nhật lại trang hiện tại *sau khi* tải thành công
                    this.page = pageToFetch;

                    // Kiểm tra xem có trang tiếp theo không
                    // Nếu số sản phẩm trả về nhỏ hơn kích thước trang, nghĩa là đây là trang cuối cùng
                    this.hasNextPage = res.data.length === size;

                } else {
                    // Không có sản phẩm nào trên trang được yêu cầu (có thể là trang cuối cùng)
                    console.log("Không tìm thấy sản phẩm nào trên trang này.");
                    this.hasNextPage = false; // Không còn trang tiếp theo
                    // Không cập nhật this.page nếu không có dữ liệu trả về
                    // Có thể hiển thị thông báo cho người dùng nếu cần
                }
            } catch (error) {
                console.error("Lỗi khi tải sản phẩm:", error);
                // Xử lý lỗi (ví dụ: hiển thị thông báo lỗi)
                // Có thể cần đặt lại hasNextPage hoặc không thay đổi page nếu có lỗi
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

<style></style>