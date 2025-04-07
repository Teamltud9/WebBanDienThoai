// src/services/AmenityService.js
import axiosInstance from "./axiosInstance";
import ProductDTO from "../models/Dtos/ProductDto";
const SearchService = {

    async SearchProducts(keyword) {
        try {
            const response = await axiosInstance.get(`/search/?keyword=${keyword}`);
            console.log(response.data);
            return response.data;
        } catch (error) {
            console.error("Lỗi khi lấy danh sách sản phẩm:", error.response?.data || error.message);
            throw error;
        }
    },
    
};
export default SearchService;