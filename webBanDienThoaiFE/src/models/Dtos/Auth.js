class AuthDTO {
    constructor(data = {}) {
        this.userName = data.userName || "";
        this.email = data.email || "";
        this.phoneNumber = data.phoneNumber || "";
        this.password = data.password || "";
        this.password_confirmation = data.password_confirmation || "";
    }

    toJSONLogin() {
        return {
            email: this.email,
            password: this.password,
        };
    }
    toJSONRegister() {
        return {
            userName: this.userName,
            email: this.email,
            phoneNumber: this.phoneNumber,
            password: this.password
        };
    }
}

export default AuthDTO; 
