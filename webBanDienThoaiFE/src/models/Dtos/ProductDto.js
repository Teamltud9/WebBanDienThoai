class ProductDTO {
  constructor(data = {}) {
      this.productName = data.productName || "";
      this.productPrice = data.productPrice || 0;
      this.description = data.description || "";
      this.CPU = data.CPU || "";
      this.RAM = data.RAM || "";
      this.storage = data.storage || "";
      this.display = data.display || "";
      this.battery = data.battery || "";
      this.brandId = data.brandId || null;
      this.productImages = data.productImages || [];
  }

  toFormData() {
      const formData = new FormData();
      if (this.productName) formData.append("productName", this.productName);
      if (this.productPrice) formData.append("productPrice", this.productPrice);
      if (this.description) formData.append("description", this.description);
      if (this.CPU) formData.append("CPU", this.CPU);
      if (this.RAM) formData.append("RAM", this.RAM);
      if (this.storage) formData.append("storage", this.storage);
      if (this.display) formData.append("display", this.display);
      if (this.battery) formData.append("battery", this.battery);
      if (this.brandId !== null) formData.append("brandId", this.brandId);

      // Xử lý hình ảnh (nếu là mảng)
      if (Array.isArray(this.productImages) && this.productImages.length > 0) {
          this.productImages.forEach((img) => formData.append("productImages[]", img));
      }

      return formData;
  }
}

export default ProductDTO;  // ✅ Xuất mặc định để đồng bộ với các DTO khác
