import { createRouter, createWebHistory } from 'vue-router';
import admin from './admin/admin.js';
import user from './infor.js';
import home from './home/home.js';

// import authen from './authen/authen.js';
import HomeView from '../components/Views/Home/HomeView.vue';
// import HomeUser from './home.js';

// Định nghĩa các route chính
const routes = [
    ...admin,
    ...home,
    ...user,
    // ...authen,
    {
        path: '/unauthorized',
        name: 'unauthorized',
        component: () => import("../components/Views/Home/Unauthoried.vue"), // Trang Unauthorized
    },
    {
        path: '/',
        redirect: '/home',
    },
    {
        path: '/home',
        name: 'HomeView',
        component: HomeView,
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import("../components/Views/Auth/Login.vue"),
    },
];

// Tạo router
const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        // Nếu đã lưu vị trí cuộn (khi dùng nút quay lại/tiến tới)
        if (savedPosition) {
            return savedPosition;
        }
        // Mặc định cuộn về đầu trang
        return { top: 0 };
    },
});

// Hàm lấy role của người dùng từ sessionStorage
// Hàm lấy danh sách role của user từ sessionStorage
function getUserRoles() {
    const user = JSON.parse(sessionStorage.getItem('User'));
    return user?.role || ['guest']; // Nếu không có, trả về danh sách với 'guest' mặc định
}

// Hàm kiểm tra quyền truy cập
router.beforeEach((to, from, next) => {
    const requiredRole = to.meta.requiresRole; // Có thể là mảng hoặc chuỗi
    const userRole = getUserRoles(); // Lấy danh sách role của người dùng từ sessionStorage

    console.log('Required Roles:', requiredRole);
    console.log('User Roles:', userRole);

    // Nếu `requiredRoles` là mảng, kiểm tra ít nhất một role của user có nằm trong requiredRoles
    if (requiredRole && Array.isArray(requiredRole)) {
        const hasAccess = userRole.some(role => requiredRole.includes(role));
        if (!hasAccess) {
            return next({ name: 'unauthorized' }); // Chuyển hướng đến trang không có quyền truy cập
        }
    } else if (requiredRole && !userRole.includes(requiredRole)) {
        // Nếu `requiredRoles` là chuỗi, kiểm tra xem userRoles có chứa requiredRole hay không
        return next({ name: 'unauthorized' }); // Chuyển hướng đến trang không có quyền truy cập
    }

    next(); // Cho phép truy cập nếu mọi điều kiện đều đúng
});

export default router;
