export default class ImageProductDTO {
    constructor(data = {}) {
        this.id = data.imageId || data.id || null;
        this.imageFile = data.imageFile || data.imagePath || null;
        this.productId = data.productId || null;
    }
}