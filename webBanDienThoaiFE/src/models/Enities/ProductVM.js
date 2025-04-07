import BaseModelVM from "./BaseModelVM";  // Sử dụng import thay vì require

export default class ProductVM extends BaseModelVM {
    constructor(data = {}) {
        // Gọi constructor của BaseModelVM với các tham số có giá trị mặc định hợp lý
        super(data.id || null, data.created_at || new Date(), data.updated_at || new Date(), data.isDeleted || false);
        
        this.id = data.productId || data.id || null;  // Lấy từ productId hoặc id
        this.productName = data.productName || "";    // Mặc định là chuỗi rỗng
        this.productPrice = data.productPrice || 0;   // Mặc định là 0
        this.description = data.description || "";    // Mặc định là chuỗi rỗng
        this.CPU = data.CPU || "";                    // Mặc định là chuỗi rỗng
        this.RAM = data.RAM || "";                    // Mặc định là chuỗi rỗng
        this.storage = data.storage || "";            // Mặc định là chuỗi rỗng
        this.display = data.display || "";            // Mặc định là chuỗi rỗng
        this.battery = data.battery || "";            // Mặc định là chuỗi rỗng
        this.brandId = data.brandId || null;          // Mặc định là null
        this.productImages = data.productImages || null; // Giả định đây là đối tượng File
    }
}
