class ReviewDTO {
    constructor(data = {}) {
        this.content = data.content || "";
        this.userId = data.userId || null;
        this.productId = data.productId || null;
    }

    toJSON() {
        const json = {};
        if (this.content) json.content = this.content;
        if (this.userId !== null) json.userId = this.userId;
        if (this.productId !== null) json.productId = this.productId;
        return json;
    }
}

export default ReviewDTO;  // ✅ Xuất mặc định để đồng bộ với các DTO khác
