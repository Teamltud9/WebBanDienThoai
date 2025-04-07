import BaseModelVM from "./BaseModelVM"; // Đảm bảo BaseModelVM được import đúng

export default class BrandVM extends BaseModelVM {
    constructor(data = {}) {
        super(data.id || null, data.created_at, data.updated_at, data.isDeleted); // Gọi constructor của BaseModelVM
        
        this.id = data.brandId || data.id || null; // Lấy từ brandId hoặc id
        this.brandName = data.brandName || "";  // Mặc định là chuỗi rỗng
        this.logo = data.logo || null; // Mặc định là null, nếu có file thì thay
    }
}
