// src/models/BaseModel.js

export default class BaseModel {
    constructor(id, created_at, updated_at, isDeleted) {
      this.id = id || null;
      this.created_at = created_at || null;
      this.updated_at = updated_at || null;
       // Mặc định là ngày hiện tại
      this.isDeleted = isDeleted || false; // Mặc định là false
    }
  }
  