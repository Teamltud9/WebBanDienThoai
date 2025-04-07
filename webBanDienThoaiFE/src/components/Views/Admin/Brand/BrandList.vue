<template>
    <div class="brand-list-container">
        <h1>Quản lý Thương hiệu</h1>

        <div class="actions">
            <router-link :to="{ name: 'admin-brand-add' }" class="btn btn-add">
                <i class="fas fa-plus"></i> Thêm Thương hiệu mới
            </router-link>
        </div>

        <div v-if="isLoading" class="loading-indicator">
            <p>Đang tải dữ liệu...</p>
        </div>

        <div v-if="error" class="error-message">
            {{ error }}
        </div>

        <div v-if="!isLoading && !error" class="brand-table-container">
            <table class="brand-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <!-- <th>Logo</th> -->
                        <th>Tên Thương hiệu</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="brands.length === 0">
                        <td colspan="5" class="no-data">Không có dữ liệu thương hiệu.</td>
                    </tr>
                    <tr v-for="brand in brands" :key="brand.id">
                        <td>{{ brand.id }}</td>
                        <!-- <td>
                             <img v-if="brand.logo" :src="getImageUrl(brand.logo)" alt="Logo" class="brand-logo" /> 
                             <span v-else>N/A</span> 
                        </td> -->
                        <td>{{ brand.brandName }}</td>
                        <td>{{ formatDate(brand.created_at) }}</td>
                        <td>
                            <router-link :to="{ name: 'admin-brand-edit', params: { brandId: brand.brandId } }"
                                class="btn btn-edit" title="Sửa">
                                <i class="fas fa-edit"></i>
                            </router-link>
                            <button @click="confirmDelete(brand.brandId)" class="btn btn-delete" title="Xóa">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import BrandDTO from '../../../../models/Dtos/BrandDto';
import BrandService from '../../../../services/BandService';

export default {
    data() {
        return {
            brands: [new BrandDTO()],
            isLoading: false,
            currentPage: 1,
            itemsPerPage: 10,
            totalItems: 0,
            error: null
        }
    },

    methods: {
        totalPages() {
            return Math.ceil(totalItems.value / itemsPerPage.value);
        },
        formatPrice(price) {
            if (price === null || price === undefined) return 'N/A';
            return price.toLocaleString('vi-VN'); // Định dạng số theo kiểu Việt Nam
        },


        // Hàm định dạng ngày tháng
        formatDate(dateString) {
            if (!dateString) return 'N/A';
            try {
                const date = new Date(dateString);
                return date.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit', year: 'numeric' });
            } catch (e) { return 'Invalid Date'; }
        },
        async fetchBrands() {
            this.isLoading = true;
            this.error = null;
            this.brands = [];

            const params = {
                page: this.currentPage,
                limit: this.itemsPerPage,
                // brandId: filterBrand.value || null, // Thêm filter nếu có
                // sort: sortOption.value || null,    // Thêm sort nếu có
            };
            try {
                const response = await BrandService.GetAllBrands();
                console.log(response);
                // Giả sử API trả về cấu trúc: { data: [products], meta: { total, current_page, last_page } }
                if (response && response.result) {
                    this.brands = response.result || []; // Lấy mảng sản phẩm
                    if (response.meta) { // Lấy thông tin phân trang nếu API trả về
                        this.totalItems = response.meta.total || 0;
                        this.currentPage = response.meta.current_page || 1;
                        // itemsPerPage.value có thể set lại từ response.meta.per_page nếu cần
                    } else {
                        // Nếu API không trả về meta, tự tính toán dựa trên dữ liệu trả về (ít chính xác hơn)
                        this.totalItems = this.brands.length; // Chỉ đúng nếu API trả hết dữ liệu
                    }

                    // Đảm bảo products luôn là mảng
                    if (!Array.isArray(this.brands)) {
                        console.warn("Dữ liệu sản phẩm trả về không phải mảng:", response.data);
                        this.brands = [];
                        this.totalItems = 0;
                    }

                } else {
                    this.brands = [];
                    this.totalItems = 0;
                }
            } catch (err) {
                console.error('Lỗi khi tải danh sách sản phẩm:', err);
                this.error = `Không thể tải danh sách sản phẩm. Lỗi: ${err.message || err}`;
                this.brands = [];
                this.totalItems = 0;
            } finally {
                this.isLoading = false;
            }
        },


        // --- Delete Product ---
        confirmDelete(id) {
            if (window.confirm(`Bạn có chắc chắn muốn xóa sản phẩm có ID ${id}?`)) {
                this.deleteBrand(id);
            }
        },

        async deleteBrand(id) {
            const originalError = this.error; // Lưu lỗi cũ
            this.error = null;
            try {
                await BrandService.DeleteBrand(id);
                alert(`Đã xóa thành công nhãn hàng ID ${id}.`);
                this.fetchBrands();
            } catch (err) {
                if (originalError && !this.error) {
                    this.error = originalError;
                }
            }
        },
    },
    async created() {
        await this.fetchBrands();
    },
}
</script>

<style scoped>
/* Responsive (Tùy chọn) */
@media (max-width: 768px) {

    .brand-table th,
    .brand-table td {
        padding: 8px;
        font-size: 0.9em;
    }

    .btn {
        padding: 6px 10px;
        font-size: 0.8rem;
    }

    .brand-logo {
        max-width: 40px;
    }
}
</style>