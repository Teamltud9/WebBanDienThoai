<template>
    <div class="form-container">
        <div class="form-box">
            <h2 v-if="isLogin">Đăng Nhập</h2>
            <h2 v-if="!isLogin">Đăng Ký</h2>

            <form @submit.prevent="handleSubmit">
                <div v-if="isLogin">
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input v-model="user.email" type="email" id="email" required />
                    </div>
                    <div class="input-group">
                        <label for="password">Mật khẩu</label>
                        <input v-model="user.password" type="password" id="password" required />
                    </div>
                </div>

                <!-- Đăng ký -->
                <div v-if="!isLogin">
                    <div class="input-group">
                        <label for="username">Tên người dùng</label>
                        <input v-model="user.userName" type="text" id="username" required />
                    </div>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input v-model="user.email" type="email" id="email" required />
                    </div>
                    <div class="input-group">
                        <label for="email">PhoneNumber</label>
                        <input v-model="user.phoneNumber" pattern="[0-9]{10,11}" minlength="10" maxlength="11" type="tel" required />
                    </div>
                    <div class="input-group">
                        <label for="password">Mật khẩu</label>
                        <input v-model="user.password" type="password" id="password" required />
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="submit-btn">
                    <button type="submit">{{ isLogin ? 'Đăng Nhập' : 'Đăng Ký' }}</button>
                </div>
            </form>

            <!-- Switch between login and register -->
            <div class="toggle-form">
                <p v-if="isLogin">Chưa có tài khoản? <a href="#" @click.prevent="toggleForm">Đăng ký ngay</a></p>
                <p v-if="!isLogin">Đã có tài khoản? <a href="#" @click.prevent="toggleForm">Đăng nhập</a></p>
            </div>
        </div>
    </div>
    <div v-if="showSuccessMessage" class="success-toast">
        Đăng ký thành công! Hãy đăng nhập để trải nghiệm.
    </div>
</template>

<script>
import AuthDTO from '../../../models/Dtos/Auth';
import AuthService from '../../../services/authService';

export default {
    data() {
        return {
            isLogin: true,
            user: new AuthDTO(),
            showSuccessMessage: false,
        };
    },
    methods: {
        toggleForm() {
            this.isLogin = !this.isLogin;
        },
        async handleSubmit() {
            if (this.isLogin) {
                const res = await AuthService.Login(this.user);
                sessionStorage.setItem('authToken', res.token);
                // this.$router.push('/');
                this.$emit("GetInfoUser");
            } else {
                const res = await AuthService.Register(this.user);
                this.showSuccessMessage = true;
                setTimeout(() => {
                    this.showSuccessMessage = false;
                    this.isLogin != this.isLogin;
                }, 3000);
            }
        },
    },
};
</script>

<style scoped>
/* CSS thuần */
.form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f7fafc;
}

.form-box {
    width: 100%;
    max-width: 400px;
    padding: 2rem;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 1rem;
}

.input-group {
    margin-bottom: 1.5rem;
}

.input-group label {
    display: block;
    font-size: 14px;
    font-weight: 500;
    color: #4a5568;
    margin-bottom: 0.5rem;
}

.input-group input {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    color: #2d3748;
}

.input-group input:focus {
    outline: none;
    border-color: #3182ce;
}

.submit-btn {
    display: flex;
    justify-content: center;
}

.submit-btn button {
    padding: 0.75rem 1.5rem;
    background-color: #3182ce;
    color: white;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.submit-btn button:hover {
    background-color: #2b6cb0;
}

.toggle-form {
    text-align: center;
    margin-top: 1.5rem;
    font-size: 14px;
}

.toggle-form a {
    color: #3182ce;
    text-decoration: none;
}

.toggle-form a:hover {
    text-decoration: underline;
}

/* Thông báo đăng ký thành công */
.success-toast {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #38a169;
    color: white;
    padding: 1rem 2rem;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    font-weight: 600;
    z-index: 1000;
    animation: fadeOut 3s forwards;
}

@keyframes fadeOut {
    0% {
        opacity: 1;
    }

    80% {
        opacity: 1;
    }

    100% {
        opacity: 0;
        transform: translateX(100px);
    }
}
</style>