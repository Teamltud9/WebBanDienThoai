// src/services/AmenityService.js
import axiosInstance from "./axiosInstance";
import ProductDTO from "../models/Dtos/ProductDto";
const ProductService = {
  async GetAllProducts(page, pageSize) {
    try {
      // console.log(page, pageSize);

      const token = sessionStorage.getItem("authToken");

      const config = {
        headers: {
          Authorization: token ? `Bearer ${token}` : "",
        },
        params: {
          page,
          pageSize,
        },
      };

      const response = await axiosInstance.get("/products", config);
      // console.log(response.data.result);
      return response.data.result;
    } catch (error) {
      console.error(
        "Lỗi khi lấy danh sách sản phẩm:",
        error.response?.data || error.message
      );
      throw error;
    }
  },
  async GetProductById(id) {
    const response = await axiosInstance.get(`/products/${id}`);
    return response.data;
  },
  async AddProduct(productDto) {
    const product = new ProductDTO(productDto).toFormData();
    const token = sessionStorage.getItem("authToken");
    const response = await axiosInstance.post("/products", product, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    console.log(response.data);
    return response.data;
  },
  async UpdateProduct(id, productDto) {
    const product = new ProductDTO(productDto).toFormData();
    const token = sessionStorage.getItem("authToken");
    const response = await axiosInstance.put(`/products/${id}`, product, {
      headers: {
        Authorization: `Bearer ${token}`,
        "Content-Type": "multipart/form-data",
      },
    });
    console.log(response.data);
    return response.data;
  },
  async DeleteProduct(id) {
    console.log(id);
    const token = sessionStorage.getItem("authToken");
    console.log(token);
    const response = await axiosInstance.delete(`/products/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    console.log(response.data);
    return response.data;
  },
};
export default ProductService;
