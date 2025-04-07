// src/services/AmenityService.js
import axiosInstance from "./axiosInstance";
import BrandDTO from "../models/Dtos/BrandDto";
import axios from "axios";
const BrandService = {

  async GetAllBrands() {
    const res = await axiosInstance.get('/brand');
    return res.data;
  },
  async GetBrandById(id) {
    // const token = sessionStorage.getItem("authToken");

    const response = await axiosInstance.get(
      `/brand/${id}`,
    );
    console.log(response.data);
    return response.data;
  },
  async AddBrand(brandDto) {
    const brand = new BrandDTO(brandDto).toFormData();
    const token = sessionStorage.getItem("authToken");
    const response = await axiosInstance.post(
      "/brand",
      brand,
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    console.log(response.data);
    return response.data;
  },
  async UpdateBrand(id, brandDto) {
    const brand = new BrandDTO(brandDto).toFormData();
    const token = sessionStorage.getItem("authToken");
    const response = await axiosInstance.put(
      `/brand/${id}`,
      brand,
      {
        headers: {
          Authorization: `Bearer ${token}`,
          "Content-Type": "multipart/form-data",
        },
      }
    );
    console.log(response.data);
    return response.data;
  },
  async DeleteBrand(id) {
    const token = sessionStorage.getItem("authToken");
    console.log(id);
    const response = await axiosInstance.delete(
      `/brand/${id}`,
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    console.log(response.data);
    return response.data;
  },
};
export default BrandService;