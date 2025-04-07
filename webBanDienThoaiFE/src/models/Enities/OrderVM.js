import BaseModelVM from "./BaseModelVM"; // Dùng import thay vì require

export default class OrderVM extends BaseModelVM {
    constructor(data = {}) {
        // Gọi constructor của BaseModelVM
        super(data.id || null, data.created_at || new Date(), data.updated_at || new Date(), data.isDeleted || false); 
        
        this.id = data.orderId || data.id || null;   // Sử dụng orderId nếu có, nếu không dùng id
        this.totalPrice = data.totalPrice || 0;       // Mặc định là 0
        this.userId = data.userId || null;            // Mặc định là null
    }
}
