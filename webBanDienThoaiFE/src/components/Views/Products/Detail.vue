<template>
    <div>
        <section class="product-main-info">
            <div class="product-gallery">
                <div class="main-image">
                    <img v-if="activeThumbnailSrc" :src="`http://127.0.0.1:8000${activeThumbnailSrc}`"
                        alt="Main Product Image">
                    <img v-else src="../../../assets/images/dienthoai.png" alt="No Image Available">
                </div>
                <div class="thumbnail-images">
                    <img v-for="thumb in product.image_products" :key="thumb.imageId"
                        :src="`http://127.0.0.1:8000${thumb.imagePath}`" :alt="thumb.imagePath" class="thumbnail"
                        :class="{ active: thumb.imagePath === activeThumbnailSrc }"
                        @click="changeImage(thumb.imagePath)">
                </div>
            </div>

            <div class="product-details">
                <h1 class="product-title">{{ product.productName }}</h1>
                <div class="product-rating">
                    <span>⭐⭐⭐⭐⭐</span>
                </div>
                <div class="product-price">
                    <span class="current-price">{{ product.productPrice }}</span>
                    <!-- <span class="original-price">16.500.000₫</span>
                <span class="discount-badge">-10%</span> -->
                </div>
                <p class="product-short-description">
                    {{ product.description }}
                </p>

                <div class="product-options">
                    <div class="option-group">
                        <label for="storage-select">Dung lượng:</label>
                        <div class="storage-options">
                            {{ product.storage }}
                        </div>
                    </div>
                </div>

                <div class="product-actions">
                    <!-- <div class="quantity-selector">
                        <label for="quantity">Số lượng:</label>
                        <button class="quantity-btn minus" @click="decreaseQuantity">-</button>
                        <input type="number" id="quantity" name="quantity" v-model.number="quantity" min="1">
                        <button class="quantity-btn plus" @click="increaseQuantity">+</button>
                    </div> -->
                    <button class="add-to-cart-btn" style="display: flex;" @click="AddOrder()">{{ mess }}</button>
                    <button class="none" v-if="like==true && login==true" @click="Addlike()"><img width="48" height="48"
                            src="https://img.icons8.com/emoji/48/heart-suit.png" alt="heart-suit" /></button>
                    <button class="none" v-if="like == false && login == true" @click="Addlike()"><img width="48" height="48"
                            src="https://img.icons8.com/forma-light/48/hearts.png" alt="hearts" /></button>
                </div>

                <div class="product-policies">
                    <ul>
                        <li><i class="fas fa-shield-alt"></i> Bảo hành chính hãng 12 tháng.</li>
                        <li><i class="fas fa-sync-alt"></i> Lỗi 1 đổi 1 trong 30 ngày.</li>
                        <li><i class="fas fa-truck"></i> Miễn phí vận chuyển toàn quốc.</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="product-detailed-info">
            <div class="tab-navigation">
                <button class="tab-link" :class="{ active: activeTab === 'description' }"
                    @click="activeTab = 'description'">
                    Mô Tả Sản Phẩm
                </button>
                <button class="tab-link" :class="{ active: activeTab === 'specifications' }"
                    @click="activeTab = 'specifications'">
                    Thông Số Kỹ Thuật
                </button>
                <button class="tab-link" :class="{ active: activeTab === 'reviews' }" @click="activeTab = 'reviews'">
                    Đánh Giá (125)
                </button>
            </div>

            <div id="description" class="tab-content" v-show="activeTab === 'description'">
                <h2>Mô Tả Chi Tiết Điện Thoại {{ product.productName }}</h2>
                <p>{{ product.description }}</p>
                <img v-if="activeThumbnailSrc" :src="`http://127.0.0.1:8000${activeThumbnailSrc}`"
                    alt="Ảnh mô tả sản phẩm" style="margin-top: 15px;">
            </div>

            <div id="specifications" class="tab-content" v-show="activeTab === 'specifications'">
                <h2>Thông Số Kỹ Thuật</h2>
                <table class="specs-table">
                    <tbody>
                        <tr>
                            <td>Màn hình:</td>
                            <td>{{ product.display }}</td>
                        </tr>
                        <tr>
                            <td>Camera sau:</td>
                            <td>Chính 108 MP & Phụ 12 MP, 8 MP</td>
                        </tr>
                        <tr>
                            <td>Camera trước:</td>
                            <td>32 MP</td>
                        </tr>
                        <tr>
                            <td>Dung lượng:</td>
                            <td>{{ product.storage }}</td>
                        </tr>
                        <tr>
                            <td>RAM:</td>
                            <td>{{ product.RAM }}</td>
                        </tr>
                        <tr>
                            <td>CPU:</td>
                            <td>{{ product.CPU }}</td>
                        </tr>
                        <tr>
                            <td>SIM:</td>
                            <td>2 Nano SIM, Hỗ trợ 5G</td>
                        </tr>
                        <tr>
                            <td>Pin:</td>
                            <td>{{ product.battery }} mAh, Sạc nhanh 65W</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="reviews" class="tab-content" v-show="activeTab === 'reviews'">
                <h2>Đánh Giá Từ Khách Hàng</h2>
                <div class="review-item" v-for="item in reviews" :key="item.userId">
                    <div class="review-author" v-if="item.user"><strong>{{ item.user.userName }}</strong> -
                        <span>⭐⭐⭐⭐⭐</span>
                    </div>
                    <p class="review-text">{{ item.content }}</p>
                    <span class="review-date">Đã mua vào ngày 15/03/2025</span>
                </div>


            </div>
            <div id="reviews" class="tab-content" v-show="activeTab === 'reviews'">
                <h2>Đánh Giá Từ Khách Hàng</h2>
                <div class="review-item">
                </div>

                <h2 class="your-review-heading">Đánh Giá của bạn</h2>
                <div class="your-review-form"> <label for="yourReviewInput">Nội dung: </label>
                    <input type="text" id="yourReviewInput" v-model="reviewDTO.content"> <button
                        @click="submitReview()">Gửi</button>
                </div>
                <div v-if="reviewSubmitSuccess" class="submit-success your-review-success">
                    Cảm ơn bạn đã gửi đánh giá!
                </div>
            </div>
        </section>
    </div>


</template>
<script>
import ProductDTO from '../../../models/Dtos/ProductDto';
import ReviewDTO from '../../../models/Dtos/ReviewDto';
import OrderService from '../../../services/OrderService'
// Bỏ ProductVM và ProductDTO nếu không cần khởi tạo mặc định phức tạp
// import ProductVM from '../../../models/Enities/ProductVM';
import ProductService from '../../../services/ProductService';
import ReviewService from '../../../services/ReviewService';
// import ProductDTO from '../../../models/Dtos/ProductDto';

export default {
    data() {
        return {
            // Thay vì mảng products, dùng một đối tượng product
            product: new ProductDTO(), // Khởi tạo là null
            activeTab: 'description',
            activeThumbnailSrc: '', // Khởi tạo rỗng
            quantity: 1, // Thêm quantity vào data nếu chưa có
            reviewSubmitSuccess: false, // Thêm nếu chưa có
            // Bạn có thể thêm một trạng thái loading
            isLoading: false,
            error: null,
            reviewDTO: new ReviewDTO(),
            reviews: [new ReviewDTO()],
            login: false,
            like: false,
            mess: 'Thêm vào giỏ hàng'
        }
    },
    methods: {
        async AddOrder(){
            const res = await OrderService.AddOrder(this.$route.params.id);
            this.mess = 'Đã thêm thành công';
            setTimeout(() => {
                    this.mess = 'Thêm vào giỏ hàng';
                }, 3000);

        },
        async Addlike() {
            const res = await ReviewService.AddLike(this.$route.params.id);
            this.AllLike();
        },
        async AllLike() {
            const res = await ReviewService.GetLike();
            let arr = res.result;
            const isLiked = arr.some(product => product.productId === this.$route.params.id);
            this.like = isLiked;
            console.log(res);
        },
        async GetProductID(id) {
            this.isLoading = true; // Bắt đầu loading
            this.error = null;     // Reset lỗi
            try {
                const res = await ProductService.GetProductById(id);
                // Gán trực tiếp đối tượng sản phẩm trả về từ API
                this.product = res.data[0];
                console.log('Product Data:', this.product);
                if (this.product && Array.isArray(this.product.image_products) && this.product.image_products.length > 0) {
                    // Set ảnh đầu tiên trong mảng image_products làm ảnh active mặc định
                    this.activeThumbnailSrc = this.product.image_products[0].imagePath; // SỬA Ở ĐÂY
                    console.log("Setting active image:", this.product.image_products[0].imagePath); // SỬA Ở ĐÂY
                } else {
                    // Nếu không có ảnh, có thể set một ảnh mặc định hoặc để trống
                    this.activeThumbnailSrc = ''; // Hoặc '/path/to/default-image.jpg';
                    // Sửa lại cảnh báo cho nhất quán (tùy chọn nhưng nên làm)
                    console.warn('Product loaded but has no images or image_products is not a valid array.'); // SỬA Ở ĐÂY
                }
            } catch (err) {
                console.error("Failed to fetch product:", err);
                this.error = "Không thể tải thông tin sản phẩm.";
                this.product = null; // Đặt lại product thành null nếu có lỗi
            } finally {
                this.isLoading = false; // Kết thúc loading
            }

        },
        async getReviews(id) {
            const res = await ReviewService.GetAllReviewProduct(id);
            this.reviews = res.result;
        },
        async submitReview() {
            this.reviewDTO.productId = this.$route.params.id;
            const res = await ReviewService.AddReview(this.reviewDTO);
            if (res.code == 200) {
                await this.getReviews(this.$route.params.id);
                this.reviewSubmitSuccess = !this.reviewSubmitSuccess;
                setTimeout(() => {
                    this.reviewSubmitSuccess = !this.reviewSubmitSuccess;
                }, 3000);
            }
            console.log(res)
        },
        changeImage(imagePath) {
            this.activeThumbnailSrc = imagePath;
        },

        increaseQuantity() {
            this.quantity++;
        },

        decreaseQuantity() {
            if (this.quantity > 1) {
                this.quantity--;
            }
        },

        // Thêm các hàm xử lý khác nếu cần
        // async addToCart() { ... }
        // async buyNow() { ... }
        // async submitReview() { ... }

        async Order() {
            // const res = await OrderService. // Hoàn thiện hàm này nếu cần
        }
    },
    created() {
        const id = this.$route.params.id;
        if (id) {
            console.log('Fetching Product with ID:', id);
            this.GetProductID(id);
            this.getReviews(id);
            const userString = sessionStorage.getItem('authToken');
            if (userString == null) {
                console.log("Chưa đăng nhập");
                this.login = false;
            }
            else {
                this.login = true;
                this.AllLike();
            }

        } else {
            console.error('No product ID found in route params.');
            this.error = "Không tìm thấy ID sản phẩm.";
        }

    },
}
</script>
<style scoped>
.none {
    border: none;
    background-color: white;
}

.your-review-heading {
    margin-top: 40px;
    /* Khoảng cách phía trên tiêu đề */
    margin-bottom: 15px;
    /* Khoảng cách dưới tiêu đề */
    font-size: 1.6em;
    /* Cỡ chữ */
    color: #333;
    font-weight: 600;
    padding-bottom: 10px;
    /* Khoảng cách trước đường kẻ */
    border-bottom: 1px solid #eee;
    /* Đường kẻ phân cách */
}

/* Container cho form đơn giản */
.your-review-form {
    display: flex;
    /* Sắp xếp label, input, button trên một hàng */
    align-items: center;
    /* Căn giữa các phần tử theo chiều dọc */
    gap: 15px;
    /* Khoảng cách giữa các phần tử */
    margin-bottom: 15px;
    /* Khoảng cách dưới form */
    flex-wrap: wrap;
    /* Cho phép xuống dòng nếu không đủ chỗ */
}

/* Nhãn "Nội dung:" */
.your-review-form label {
    font-weight: 500;
    color: #495057;
    flex-shrink: 0;
    /* Không cho phép label bị co lại */
    margin-bottom: 0;
    /* Bỏ margin mặc định nếu có */
}

/* Ô input nhập text */
.your-review-form input[type="text"] {
    flex-grow: 1;
    /* Cho phép ô input chiếm hết không gian còn lại */
    padding: 10px 15px;
    /* Padding bên trong input */
    border: 1px solid #ced4da;
    /* Viền input */
    border-radius: 5px;
    /* Bo góc */
    font-size: 1rem;
    /* Cỡ chữ */
    min-width: 200px;
    /* Chiều rộng tối thiểu để không quá nhỏ */
    height: 40px;
    /* Chiều cao cố định */
    box-sizing: border-box;
    /* Tính cả padding, border vào kích thước */
}

/* Hiệu ứng khi focus vào input */
.your-review-form input[type="text"]:focus {
    border-color: #86b7fe;
    /* Màu viền xanh dương nhạt */
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    /* Bóng đổ nhẹ */
}

/* Nút "Gửi" */
.your-review-form button {
    padding: 0 25px;
    /* Padding ngang cho nút */
    background-color: #0d6efd;
    /* Màu nền xanh dương */
    color: white;
    /* Màu chữ trắng */
    border: none;
    border-radius: 5px;
    /* Bo góc giống input */
    cursor: pointer;
    font-size: 1rem;
    /* Cỡ chữ */
    font-weight: 500;
    transition: background-color 0.2s ease, transform 0.1s ease;
    white-space: nowrap;
    /* Không xuống dòng chữ trong nút */
    height: 40px;
    /* Chiều cao bằng input */
    line-height: 40px;
    /* Căn chữ giữa theo chiều dọc (nếu chỉ có 1 dòng) */
    flex-shrink: 0;
    /* Không cho nút bị co lại */
}

.your-review-form button:hover {
    background-color: #0b5ed7;
    /* Màu nền đậm hơn khi hover */
}

.your-review-form button:active {
    transform: scale(0.98);
    /* Hiệu ứng nhấn nút */
}

/* Thông báo thành công */
/* Sử dụng cả 2 class để tăng độ ưu tiên nếu cần ghi đè style cũ */
.your-review-success.submit-success {
    padding: 12px 15px;
    border-radius: 5px;
    font-size: 0.95em;
    text-align: center;
    background-color: #d1e7dd;
    /* Nền xanh lá cây nhạt */
    color: #0f5132;
    /* Chữ xanh lá cây đậm */
    border: 1px solid #badbcc;
    margin-top: 0;
    /* Reset margin-top nếu class submit-success cũ có */
    margin-bottom: 20px;
    /* Khoảng cách dưới thông báo */
}

/* Responsive cho màn hình nhỏ */
@media (max-width: 576px) {
    .your-review-form {
        flex-direction: column;
        /* Xếp chồng các phần tử */
        align-items: stretch;
        /* Kéo dài các phần tử full width */
        gap: 10px;
        /* Giảm khoảng cách dọc */
    }

    .your-review-form label {
        /* Có thể thêm style cho label nếu cần */
    }

    .your-review-form input[type="text"] {
        min-width: 0;
        /* Bỏ chiều rộng tối thiểu */
    }

    .your-review-form button {
        width: 100%;
        /* Nút full width */
    }
}



.product-detail-page .container {
    max-width: 1300px;
    /* Có thể rộng hơn trang chủ */
}

/* Breadcrumbs */
.breadcrumbs {
    padding: 15px 0;
    margin-bottom: 20px;
    font-size: 0.9em;
    color: #555;
    border-bottom: 1px solid #eee;
}

.breadcrumbs a {
    color: #007bff;
}

.breadcrumbs a:hover {
    text-decoration: underline;
}

.breadcrumbs span {
    color: #333;
    /* Màu cho trang hiện tại */
    font-weight: 500;
}

/* Khu vực thông tin chính */
.product-main-info {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    /* Tỉ lệ cột ảnh và cột thông tin */
    gap: 40px;
    /* Khoảng cách lớn hơn giữa 2 cột */
    margin-bottom: 50px;
}

/* Gallery Ảnh */
.product-gallery {
    display: flex;
    flex-direction: column;
}

.main-image {
    border: 1px solid #eee;
    margin-bottom: 15px;
    border-radius: 8px;
    overflow: hidden;
    /* Đảm bảo ảnh bo góc */
    position: relative;
    /* Cho các hiệu ứng sau này nếu cần */
}

.main-image img {
    width: 100%;
    height: auto;
    display: block;
}

.thumbnail-images {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    /* Hiển thị tối đa 5 ảnh nhỏ */
    gap: 10px;
}

.thumbnail-images .thumbnail {
    border: 2px solid transparent;
    /* Border mặc định trong suốt */
    border-radius: 5px;
    cursor: pointer;
    transition: border-color 0.3s ease, transform 0.3s ease;
    overflow: hidden;
    /* Bo góc ảnh nhỏ */
    aspect-ratio: 1 / 1;
    /* Giữ tỷ lệ vuông cho ảnh nhỏ */
    object-fit: cover;
    /* Cắt ảnh nhỏ nếu cần */
}

.thumbnail-images .thumbnail:hover {
    transform: scale(1.05);
    border-color: #ddd;
}

.thumbnail-images .thumbnail.active {
    border-color: #007bff;
    /* Border màu xanh cho ảnh đang được chọn */
}

/* Chi tiết sản phẩm (cột phải) */
.product-details {
    display: flex;
    flex-direction: column;
}

.product-title {
    font-size: 2.2em;
    /* Tăng kích thước tiêu đề */
    font-weight: 600;
    margin-bottom: 10px;
    line-height: 1.3;
}

.product-rating {
    margin-bottom: 15px;
    color: #666;
    display: flex;
    align-items: center;
}

.product-rating span:first-child {
    color: #f39c12;
    /* Màu vàng cho sao */
    margin-right: 8px;
    font-size: 1.1em;
    /* Kích thước sao */
}

.product-price {
    margin-bottom: 20px;
    display: flex;
    align-items: baseline;
    /* Căn chỉnh các giá */
    flex-wrap: wrap;
    /* Xuống dòng nếu cần */
}

.current-price {
    font-size: 2em;
    /* Giá chính nổi bật */
    font-weight: bold;
    color: #e74c3c;
    /* Màu đỏ cho giá */
    margin-right: 15px;
}

.original-price {
    font-size: 1.1em;
    color: #999;
    text-decoration: line-through;
    /* Gạch ngang giá gốc */
    margin-right: 10px;
}

.discount-badge {
    background-color: #e74c3c;
    color: #fff;
    padding: 3px 8px;
    border-radius: 3px;
    font-size: 0.85em;
    font-weight: bold;
}

.product-short-description {
    margin-bottom: 25px;
    font-size: 1.05em;
    color: #555;
    line-height: 1.7;
}

/* Tùy chọn sản phẩm */
.product-options {
    margin-bottom: 25px;
}

.option-group {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.option-group label {
    font-weight: 500;
    min-width: 80px;
    /* Đảm bảo label thẳng hàng */
}

.option-group select {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    min-width: 150px;
}

.storage-options {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    /* Cho phép xuống dòng nếu có nhiều option */
}

.storage-btn {
    padding: 8px 15px;
    border: 1px solid #ccc;
    background-color: #fff;
    border-radius: 20px;
    /* Bo tròn nhiều hơn */
    cursor: pointer;
    transition: all 0.3s ease;
}

.storage-btn:hover {
    background-color: #f0f0f0;
    border-color: #aaa;
}

.storage-btn.active {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
    font-weight: bold;
}

/* Hành động (Số lượng, Nút) */
.product-actions {
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
    /* Cho phép xuống dòng trên màn hình nhỏ */
}

.quantity-selector {
    display: flex;
    align-items: center;
    border: 1px solid #ccc;
    border-radius: 5px;
    overflow: hidden;
}

.quantity-selector label {
    margin-right: 10px;
    padding-left: 10px;
    /* Thêm padding cho label */
    font-weight: 500;
    color: #555;
}

.quantity-selector input[type="number"] {
    width: 50px;
    text-align: center;
    border: none;
    padding: 8px 0;
    /* Chỉ padding trên dưới */
    font-size: 1em;
    /* Ẩn mũi tên lên xuống mặc định */
    -moz-appearance: textfield;
    appearance: textfield;
}

.quantity-selector input[type="number"]::-webkit-outer-spin-button,
.quantity-selector input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.quantity-btn {
    background-color: #f8f8f8;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    font-size: 1.2em;
    line-height: 1;
    /* Đảm bảo chiều cao nhất quán */
    color: #555;
    transition: background-color 0.3s ease;
}

.quantity-btn.minus {
    border-right: 1px solid #ccc;
}

.quantity-btn.plus {
    border-left: 1px solid #ccc;
}

.quantity-btn:hover {
    background-color: #e9e9e9;
}

.add-to-cart-btn,
.buy-now-btn {
    padding: 12px 25px;
    /* Nút to hơn */
    border: none;
    border-radius: 5px;
    color: #fff;
    font-size: 1.1em;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.add-to-cart-btn {
    background-color: #ff8c00;
    /* Màu cam cho thêm vào giỏ */
}

.add-to-cart-btn:hover {
    background-color: #e07b00;
    transform: translateY(-2px);
    /* Hiệu ứng nhấc lên khi hover */
}

.buy-now-btn {
    background-color: #e74c3c;
    /* Màu đỏ cho mua ngay */
}

.buy-now-btn:hover {
    background-color: #c0392b;
    transform: translateY(-2px);
}

/* Chính sách */
.product-policies {
    border-top: 1px dashed #eee;
    padding-top: 20px;
    margin-top: 10px;
    font-size: 0.9em;
    color: #555;
}

.product-policies ul {
    list-style: none;
    padding: 0;
}

.product-policies li {
    margin-bottom: 8px;
    display: flex;
    align-items: center;
}

.product-policies i {
    /* Giả sử dùng Font Awesome */
    margin-right: 8px;
    color: #007bff;
    /* Màu icon */
    width: 16px;
    /* Đảm bảo icon thẳng hàng */
    text-align: center;
}


/* Thông tin chi tiết (Tabs) */
.product-detailed-info {
    margin-top: 60px;
    border: 1px solid #eee;
    border-radius: 8px;
    overflow: hidden;
    /* Đảm bảo nội dung tab không tràn ra ngoài */
}

.tab-navigation {
    background-color: #f8f9fa;
    border-bottom: 1px solid #eee;
    display: flex;
    flex-wrap: wrap;
    /* Cho phép xuống dòng trên mobile */
}

.tab-link {
    padding: 15px 25px;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1.1em;
    font-weight: 500;
    color: #555;
    position: relative;
    transition: color 0.3s ease, background-color 0.3s ease;
    border-bottom: 3px solid transparent;
    /* Border dưới mặc định trong suốt */
    margin-bottom: -1px;
    /* Đè lên border-bottom của container */
}

.tab-link:hover {
    color: #0056b3;
    background-color: #e9ecef;
}

.tab-link.active {
    color: #007bff;
    border-bottom-color: #007bff;
    /* Hiện border dưới khi active */
}

.tab-content {
    padding: 30px;
    /* display: none; /* Không cần display: none nữa, v-show/v-if sẽ xử lý */
    line-height: 1.7;
    background-color: #fff;
}

/* Xóa .tab-content.active { display: block; } vì Vue quản lý hiển thị */

.tab-content h2 {
    margin-bottom: 20px;
    font-size: 1.6em;
    color: #333;
}

.tab-content p {
    margin-bottom: 15px;
    color: #444;
}

.tab-content img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
    margin: 15px 0;
}

/* Bảng thông số kỹ thuật */
.specs-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.specs-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #eee;
    font-size: 1em;
}

.specs-table tr:nth-child(even) {
    background-color: #f8f9fa;
    /* Tạo hiệu ứng dòng chẵn/lẻ */
}

.specs-table td:first-child {
    font-weight: 500;
    color: #333;
    width: 30%;
    /* Chiều rộng cột tên thông số */
    background-color: #f8f8f8;
    /* Nền nhẹ cho cột tên */
}

.specs-table td:last-child {
    color: #555;
}


/* Đánh giá */
.review-item {
    border-bottom: 1px dashed #eee;
    padding: 20px 0;
}

.review-item:last-child {
    border-bottom: none;
}

.review-author {
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.review-author strong {
    font-size: 1.1em;
}

.review-author span {
    /* Sao đánh giá */
    color: #f39c12;
}

.review-text {
    margin-bottom: 10px;
    color: #444;
}

.review-date {
    font-size: 0.85em;
    color: #888;
}

.view-all-reviews-btn {
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.view-all-reviews-btn:hover {
    background-color: #e0e0e0;
}


/* Sản phẩm liên quan */
.related-products {
    margin-top: 60px;
    padding-top: 40px;
    border-top: 1px solid #eee;
}

.related-products h2 {
    text-align: center;
    margin-bottom: 40px;
    font-size: 2em;
}

/* Tái sử dụng .product-grid và .product-item từ style.css */
/* Nếu muốn style khác biệt, bạn có thể thêm class mới */
.related-products .product-item button {
    background-color: #007bff;
    /* Đổi màu nút nếu muốn */
}

.related-products .product-item button:hover {
    background-color: #0056b3;
}

/* ----- Responsive cho trang chi tiết (giữ nguyên) ----- */
@media (max-width: 992px) {
    .product-main-info {
        grid-template-columns: 1fr;
        /* Chuyển thành 1 cột trên tablet */
        gap: 30px;
    }

    .product-gallery {
        max-width: 500px;
        /* Giới hạn chiều rộng gallery trên tablet */
        margin: 0 auto;
        /* Căn giữa */
    }

    .thumbnail-images {
        grid-template-columns: repeat(4, 1fr);
        /* Ít ảnh nhỏ hơn trên tablet */
    }
}

@media (max-width: 768px) {
    .product-title {
        font-size: 1.8em;
    }

    .current-price {
        font-size: 1.8em;
    }

    .tab-link {
        padding: 12px 15px;
        font-size: 1em;
    }

    .tab-content {
        padding: 20px;
    }

    .specs-table td {
        padding: 10px;
        font-size: 0.95em;
    }

    .specs-table td:first-child {
        width: 40%;
    }

    /* .related-products .product-grid {
          grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      } */
}

@media (max-width: 480px) {
    .product-actions {
        flex-direction: column;
        /* Xếp các nút thành cột */
        align-items: stretch;
        /* Kéo dài nút */
        gap: 10px;
    }

    .quantity-selector {
        justify-content: space-between;
        /* Phân bố đều nút +/- và input */
    }

    .thumbnail-images {
        grid-template-columns: repeat(3, 1fr);
        /* Chỉ 3 ảnh nhỏ */
    }

    .tab-navigation {
        overflow-x: auto;
        white-space: nowrap;
    }

    .tab-link {
        flex-shrink: 0;
        /* Ngăn tab bị co lại */
    }

    .specs-table td,
    .specs-table td:first-child {
        display: block;
        /* Hiển thị dạng block trên mobile */
        width: 100%;
        text-align: left !important;
        /* Căn trái */
    }

    .specs-table td:first-child {
        background-color: #e9ecef;
        /* Nền khác cho label */
        border-bottom: none;
        /* Bỏ border dưới của label */
        padding-bottom: 5px;
    }

    .specs-table td:last-child {
        border-top: none;
        /* Bỏ border trên của value */
        padding-top: 5px;
        padding-left: 20px;
        /* Thụt lề cho giá trị */
    }

    .specs-table tr {
        display: block;
        margin-bottom: 10px;
        border: 1px solid #eee;
        border-radius: 4px;
        overflow: hidden;
    }

    .specs-table tr:nth-child(even) {
        background-color: transparent;
        /* Bỏ màu nền xen kẽ */
    }

    .specs-table tbody {
        display: block;
    }
}

/* ****** Kết thúc CSS ****** */
</style>