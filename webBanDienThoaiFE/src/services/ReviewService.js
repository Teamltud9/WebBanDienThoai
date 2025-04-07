// src/services/AmenityService.js
import axiosInstance from "./axiosInstance";
import ReviewDTO from "../models/Dtos/ReviewDto";
const ReviewService = {

    async GetLike(productId) {
        try {
          console.log(productId)
            const token = sessionStorage.getItem("authToken");
            const response = await axiosInstance.get(`/like`,
              {
                headers: {
                  Authorization: `Bearer ${token}`,
                },
              }
            );
            return response.data;
        } catch (error) {
            console.error("Lỗi khi lấy danh sách sản phẩm:", error.response?.data || error.message);
            throw error;
        }
    },
    
  async AddLike(productId) {
    const token = sessionStorage.getItem("authToken");
    console.log(token);
    const response = await axiosInstance.post(
      `/like/${productId}`,
      null,
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    console.log(response.data);
    return response.data;
  },
    async GetAllReviewProduct(productId) {
        try {
          console.log(productId)
            // const token = sessionStorage.getItem("authToken"); // Lấy token từ sessionStorage
            const response = await axiosInstance.get(`/reviews/product/${productId}`);
            console.log(response.data);
            return response.data;
        } catch (error) {
            console.error("Lỗi khi lấy danh sách sản phẩm:", error.response?.data || error.message);
            throw error;
        }
    },
    
  async AddReview(reviewDTO) {
    const review  = new ReviewDTO(reviewDTO).toJSON();
    const token = sessionStorage.getItem("authToken");
    console.log(token);
    const response = await axiosInstance.post(
      "reviews",
      review,
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    console.log(response.data);
    return response.data;
  },
  async DeleteReview(id) {
    const token = sessionStorage.getItem("authToken");
    const response = await axiosInstance.delete(
      "/products/${id}/reviews",
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    return response.data;
  },
};
export default ReviewService;