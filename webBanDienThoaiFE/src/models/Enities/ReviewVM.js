import BaseModelVM from "./BaseModelVM";  // Sử dụng import thay vì require

export default class ReviewVM extends BaseModelVM {
    constructor(data = {}) {
        // Gọi constructor của BaseModelVM với các tham số có giá trị mặc định hợp lý
        super(data.id || null, data.created_at || new Date(), data.updated_at || new Date(), data.isDeleted || false);
        
        this.id = data.previewId || data.id || null;  // Lấy từ previewId hoặc id
        this.content = data.content || "";            // Mặc định là chuỗi rỗng
        this.userId = data.userId || null;            // Mặc định là null
        this.productId = data.productId || null;      // Mặc định là null
    }
}
