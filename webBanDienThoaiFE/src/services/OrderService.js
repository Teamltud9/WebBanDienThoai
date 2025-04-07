import axiosInstance from "./axiosInstance";
const OrderService = {
  async History() {
    const token = sessionStorage.getItem("authToken");
    const response = await axiosInstance.get(`/cart/history`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    return response;
  },
  async Checkout() {
    const token = sessionStorage.getItem("authToken");
    const response = await axiosInstance.post(`/cart/checkout`, null, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    return response;
  },
  async AddOrder(productId) {
    console.log(productId);
    const token = sessionStorage.getItem("authToken");
    console.log(token);
    const response = await axiosInstance.post(`/cart/add/${productId}`, null, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    console.log("Data: ", response);
    if (response.data.code != 200) {
      console.log("order values invalid", response.success);
    }
    return response;
  },
  async RemoveOrder(productId) {
    console.log(productId);
    const token = sessionStorage.getItem("authToken");
    console.log(token);
    const response = await axiosInstance.delete(`/cart/delete/${productId}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    console.log("Data: ", response);
    if (response.data.code != 200) {
      console.log("order values invalid", response.success);
    }
    return response;
  },
  async RemoveAllOrder(productId) {
    console.log(productId);
    const token = sessionStorage.getItem("authToken");
    console.log(token);
    const response = await axiosInstance.delete(`/cart/clear`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    console.log("Data: ", response);
    if (response.data.code != 200) {
      console.log("order values invalid", response.success);
    }
    return response;
  },
  async GetAllOrder() {
    const token = sessionStorage.getItem("authToken");
    const response = await axiosInstance.get("/cart", {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    console.log("Response order:  ", response);
    return response.data;
  },
};
export default OrderService;
