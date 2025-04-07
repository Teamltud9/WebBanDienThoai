import axiosInstance from "./axiosInstance";
const OrderService = {
  async AddOrder(productId) {
    console.log(productId);
    const token = sessionStorage.getItem("authToken");
    console.log(token);
    const response = await axiosInstance.post(
      `/cart/add/${productId}`,null,
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    console.log("Data: ",response); 
    if (response.data.code != 200) {
      console.log("order values invalid", response.success);
    }
    return response;
  },
  async GetAllOrder() {
    const token = sessionStorage.getItem("authToken");
    const response = await axiosInstance.get(
      "/cart",
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    console.log("Response order:  ",response); 
    return response.data;
  },
};
export default OrderService;

