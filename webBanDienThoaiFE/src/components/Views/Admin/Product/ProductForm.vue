<template>
    <div class="product-form-container">
        <h2>{{ isEditMode ? 'Cập nhật Sản phẩm' : 'Thêm Sản phẩm mới' }}</h2>
        <form @submit.prevent="handleSubmit" class="product-form">
            <div v-if="error" class="error-message">
                {{ error }}
            </div>
            <div v-if="success" class="success-message">
                {{ success }}
            </div>
            <div class="form-group">
                <label for="productName">Tên sản phẩm:</label>
                <input type="text" id="productName" v-model="product.productName" required
                    placeholder="Ví dụ: Laptop ABC XYZ" />
            </div>

            <div class="form-group">
                <label for="productPrice">Giá (VNĐ):</label>
                <input type="number" id="productPrice" v-model.number="product.productPrice" required min="0"
                    placeholder="Ví dụ: 15000000" />
            </div>

            <div class="form-group">
                <label for="brandId">Thương hiệu:</label>
                <select id="brandId" v-model="product.brandId" required>
                    <option :value="null" disabled>-- Chọn thương hiệu --</option>
                    <option v-for="brand in brands" :key="brand.brandId" :value="brand.brandId">
                        {{ brand.brandName }}
                    </option>
                </select>
                <div v-if="brandLoading" class="loading-text">Đang tải danh sách thương hiệu...</div>
                <div v-if="brandError" class="error-text">{{ brandError }}</div>
            </div>

            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea id="description" v-model="product.description" rows="4"
                    placeholder="Mô tả chi tiết về sản phẩm..."></textarea>
            </div>

            <div class="form-row">
                <div class="form-group form-group-inline">
                    <label for="ram">RAM:</label>
                    <input type="text" id="ram" v-model="product.RAM" placeholder="Ví dụ: 8GB DDR4" />
                </div>

                <div class="form-group form-group-inline">
                    <label for="CPU">CPU:</label>
                    <input type="text" id="CPU" v-model="product.CPU" placeholder="CPU A15..." />
                </div>

                <div class="form-group form-group-inline">
                    <label for="storage">Dung lượng:</label>
                    <input type="text" id="storage" v-model="product.storage" placeholder="Ví dụ: 512GB SSD NVMe" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group form-group-inline">
                    <label for="battery">Pin:</label>
                    <input type="text" id="battery" v-model="product.battery" placeholder="Ví dụ: 4-cell 50Wh" />
                </div>
                <div class="form-group form-group-inline">
                    <label for="display">Màn hình:</label>
                    <input type="text" id="display" v-model="product.display" placeholder="Ví dụ: 15.6 inch FHD IPS" />
                </div>
            </div>
            <div class="form-row">

            </div>


            <div class="form-group">
                <label for="productImage">Hình ảnh sản phẩm (chọn nhiều ảnh):</label>
                <input type="file" id="productImage" @change="handleMultipleImages" accept="image/*" multiple />
            </div>


            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    {{ isLoading ? 'Đang xử lý...' : (isEditMode ? 'Cập nhật' : 'Thêm mới') }}
                </button>
                <router-link :to="{ name: 'admin-product-list' }" class="btn-cancel">
                    Hủy bỏ
                </router-link>
            </div>
        </form>

    </div>
    <div v-if="isOk==1" class="success-toast">
        Tạo mới thành công!
    </div>
    <div v-if="isOk==2" class="success-toast">
        Cập nhật thành công!
    </div>
</template>

<script>
import BrandDTO from '../../../../models/Dtos/BrandDto';
import ProductDTO from '../../../../models/Dtos/ProductDto';
import BrandService from '../../../../services/BandService';
import ProductService from '../../../../services/ProductService';
export default {
    data() {
        return {
            product: new ProductDTO(),
            brands: [new BrandDTO()],
            isOk: 1
        }
    },
    props: {
        productId: {
            type: [String, Number],
            required: false,
        },
        isEditMode: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        async getDataBrand() {
            const res = await BrandService.GetAllBrands();
            this.brands = res.result;
            console.log(this.brands);
        },
        async getDataProduct() {
            if (this.productId) {
                const res = await ProductService.GetProductById(this.productId);
                this.product = res.result;
                console.log("Update");
            }
            else console.log("Add mới");

        },
        handleMultipleImages(event) {
            const files = Array.from(event.target.files);
            if (files.length != 4) {
                alert('You can select up to 4 images.');
                event.target.value = '';
                return;
            }
            this.product.productImages = files;
        },
        async handleSubmit() {
            try {
                console.log(this.product);
                if (this.isEditMode == false) {
                    const res = await ProductService.AddProduct(this.product);
                    if (res.code == 200) {
                        this.isOk = 1;
                        setTimeout(() => {
                            this.isOk = 0;
                        }, 3000);
                    }
                }
                else {
                    console.log("Vào else");
                    const res = await ProductService.UpdateProduct(this.product);
                    if (res.code == 200) {
                        this.isOk = 2;
                        setTimeout(() => {
                            this.isOk =0 ;
                        }, 3000);
                    }
                }
            }
            catch (error) {
                console.log(error);
                this.error = error;
            }
        }
    },
    async created() {
        await this.getDataBrand();
    },

}


</script>

<style>
    .success-toast {
    position: fixed;
    top: 100px;
    right: 100px;
    background-color: #38a169;
    color: white;
    padding: 1rem 2rem;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    font-weight: 600;
    z-index: 1000;
    animation: fadeOut 3s forwards;
}

@keyframes fadeOut {
    0% {
        opacity: 1;
    }

    80% {
        opacity: 1;
    }

    100% {
        opacity: 0;
        transform: translateX(100px);
    }
}   
</style>