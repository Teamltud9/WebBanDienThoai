<template>
    <div class="brand-form-container">
        <h2>{{ isEditMode ? 'Cập nhật Thương hiệu' : 'Thêm Thương hiệu mới' }}</h2>
        <form @submit.prevent="handleSubmit" class="brand-form">
            <div v-if="error" class="error-message">
                {{ error }}
            </div>
            <div v-if="success" class="success-message">
                {{ success }}
            </div>

            <div class="form-group">
                <label for="brandName">Tên thương hiệu:</label>
                <input type="text" id="brandName" v-model="brandDto.brandName" required
                    placeholder="Nhập tên thương hiệu" />
            </div>

            <div class="form-group">
                <label for="logo">Logo:</label>
                <input type="file" id="logo" @change="handleFileChange" accept="image/*" required />
            </div>

            <div class="form-actions">
                <button type="submit" :disabled="isLoading" class="btn-submit">
                    {{ isLoading ? 'Đang xử lý...' : (isEditMode ? 'Cập nhật' : 'Thêm mới') }}
                </button>
                <router-link :to="{ name: 'admin-brand-list' }" class="btn-cancel">
                    Hủy bỏ
                </router-link>
            </div>
        </form>
    </div>
</template>

<script>
import BrandService from '../../../../services/BandService'; // Đảm bảo đường dẫn đúng
import BrandDTO from '../../../../models/Dtos/BrandDto'; // Đảm bảo đường dẫn đúng
export default {

    data() {
        return {
            brandDto: new BrandDTO(),
            error: ""
        }
    },
    props: {
        brandId: {
            type: [String, Number],
            required: false,
        },
        isEditMode: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        handleMainImage(event) {
            const file = event.target.files[0];
            if (file) {
                this.brandDto.logo = file;
            }
        },
        async handleSubmit() {
            try {
                console.log(this.isEditMode);
                if (this.isEditMode == false) {
                    console.log("1");
                    const res = await BrandService.AddBrand(this.brandDto);
                    console.log(res);
                }
                else {
                    console.log("2");
                    const res = await BrandService.UpdateBrand(this.brandDto);
                    console.log(res);
                }
            }
            catch (error) {
                this.error = error;
            }


        }
    },
    created() {
    },

}

</script>

<style>
</style>