// src/services/AmenityService.js
import axiosInstance from "./axiosInstance";
import AuthDto from "../models/Dtos/Auth";
const AuthService = {
  async Login(authDto) {
    const auth = new AuthDto(authDto).toJSONLogin();
    const response = await axiosInstance.post(
      "/login",
      auth
    );
    // console.log(response.data);
    return response.data;
  },
  async Register(authDto) {
    const auth = new AuthDto(authDto).toJSONRegister();
    const response = await axiosInstance.post(
      "/register",
      auth
    );
    console.log(response.data);
    return response.data;
  },
  async Logout() {
    const token = sessionStorage.getItem("authToken");
    console.log(token);
    const response = await axiosInstance.post(
      "/logout",null,
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    return response.data;
  },
  async Refresh() {
    const token = sessionStorage.getItem("authToken");
    const response = await axiosInstance.post(
      "/refresh",
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    console.log(response.data);
    return response.data;
  },
  async GetProfile() {
    const token = sessionStorage.getItem("authToken");
    console.log(token);
    const response = await axiosInstance.get(
      "/me",
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    return response.data.data;
  },

};
export default AuthService;