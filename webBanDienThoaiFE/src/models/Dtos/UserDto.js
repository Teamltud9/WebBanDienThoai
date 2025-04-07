class UserDTO {
    constructor(data = {}) {
        this.id = data.userId || data.id || null;
        this.userName = data.userName || "";
        this.email = data.email || "";
        this.phoneNumber = data.phoneNumber || "";
        this.address = data.address || "";
        this.roleId = data.roleId || null;
    }

    toJSON() {
        const json = {};
        if (this.id !== null) json.id = this.id;
        if (this.userName) json.userName = this.userName;
        if (this.email) json.email = this.email;
        if (this.phoneNumber) json.phoneNumber = this.phoneNumber;
        if (this.address) json.address = this.address;
        if (this.roleId !== null) json.roleId = this.roleId;
        return json;
    }
}

export default UserDTO;  // ✅ Xuất mặc định để đồng bộ với các DTO khác
