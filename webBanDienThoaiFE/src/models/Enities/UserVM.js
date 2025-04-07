import BaseModelVM from "./BaseModelVM";  // Sử dụng import thay vì require

export default class UserVM extends BaseModelVM {
    constructor(data = {}) {
        // Gọi constructor của BaseModelVM với các tham số có giá trị mặc định hợp lý
        super(data.id || null, data.created_at || new Date(), data.updated_at || new Date(), data.isDeleted || false);
        
        this.id = data.userId || data.id || null;       // Lấy từ userId hoặc id
        this.userName = data.userName || "";             // Mặc định là chuỗi rỗng
        this.email = data.email || "";                   // Mặc định là chuỗi rỗng
        this.phoneNumber = data.phoneNumber || "";       // Mặc định là chuỗi rỗng
        this.address = data.address || "";               // Mặc định là chuỗi rỗng
        this.role = data.role || null;               // Mặc định là null
    }
}
