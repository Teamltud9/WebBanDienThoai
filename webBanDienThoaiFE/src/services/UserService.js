// src/services/AmenityService.js
import axiosInstance from "./axiosInstance";
import UserDTO from "../models/Dtos/UserDto";
const SearchService = {
  async GetAllUsers() {
    try {
      const token = sessionStorage.getItem("authToken"); // Lấy token từ sessionStorage
      const response = await axiosInstance.get(`/users`, null, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      console.log(response.data);
      return response.data;
    } catch (error) {
      console.error(
        "Lỗi khi lấy danh sách sản phẩm:",
        error.response?.data || error.message
      );
      throw error;
    }
  },
  async GetUserById(id) {
    try {
      const token = sessionStorage.getItem("authToken"); // Lấy token từ sessionStorage
      const response = await axiosInstance.get(`/users/${id}`, null, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      console.log(response.data);
      return response.data;
    } catch (error) {
      console.error(
        "Lỗi khi lấy danh sách sản phẩm:",
        error.response?.data || error.message
      );
      throw error;
    }
  },
  async UpdateUser(id, userDTO) {
    const user = new UserDTO(userDTO).toJSON();
    const token = sessionStorage.getItem("authToken");
    const response = await axiosInstance.put(`/users/${id}`, product, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    console.log(response.data);
    return response.data;
  },
  async DeleteUser(id) {
    const token = sessionStorage.getItem("authToken");
    const response = await axiosInstance.delete(`/users/${id}`, null, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    console.log(response.data);
    return response.data;
  },
};
export default SearchService;
