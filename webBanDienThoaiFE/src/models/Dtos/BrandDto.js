class BrandDTO {
  constructor(data = {}) {
      this.id = data.brandId || data.id || null; // Lấy từ brandId hoặc id
      this.brandName = data.brandName || "";
      this.logo = data.logo || null; // Giả định đây là đối tượng File khi gửi đi
  }

  toFormData() {
      const formData = new FormData();
      if (this.id !== null) {
          formData.append("Id", this.id); // Key là 'Id' theo PascalCase
      }
      formData.append("BrandName", this.brandName); // Key là 'BrandName'
      if (this.logo) {
          formData.append("Logo", this.logo); // Key là 'Logo'
      }
      return formData;
  }
}

export default BrandDTO;  // ✅ Thêm default export
