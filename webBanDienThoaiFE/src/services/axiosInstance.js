import axios from "axios";

const API_BASE_URL = "http://127.0.0.1:8000/api";
const IMAGE_BASE_URL = `http://127.0.0.1:8000`;

const instance = axios.create({
  baseURL: API_BASE_URL,
  withCredentials: true,
  headers: {
    "ngrok-skip-browser-warning": "true",
  },
});

instance.interceptors.response.use(
  response => response,
  error => {
    return Promise.reject(error);
  }
);

export { IMAGE_BASE_URL };
export default instance;




// use

// getImageUrl(url);
// import axiosInstance, { IMAGE_BASE_URL } from "@/services/api/axiosInstance";
// getImageUrl(imagePath) {
//     return `${IMAGE_BASE_URL}/${imagePath}`;
//   },
