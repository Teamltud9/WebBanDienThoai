class OrderDTO {
    constructor(data = {}) {
        this.id = data.orderId || data.id || null;
        this.totalPrice = data.totalPrice || 0;
        this.userId = data.userId || null;
    }

    toJSON() {
        const json = {};
        if (this.id !== null) json.id = this.id;
        if (this.totalPrice !== null) json.totalPrice = this.totalPrice;
        if (this.userId !== null) json.userId = this.userId;
        return json;
    }
}

export default OrderDTO;  // ✅ Xuất mặc định để dùng giống các DTO khác
