<template>
    <div class="paid-invoices-container">
        <h2>Hóa đơn đã thanh toán</h2>

        <div v-if="isLoading" class="loading-indicator">
            Đang tải danh sách hóa đơn...
        </div>


        <div v-if="!isLoading && !error && paidInvoices.length === 0" class="empty-list">
            Bạn chưa có hóa đơn nào đã thanh toán.
        </div>

        <table v-if="!isLoading && paidInvoices.length > 0" class="invoice-table">
            <thead>
                <tr>
                    <th>Mã hóa đơn</th>
                    <th>Ngày tạo</th>
                    <th>Tổng tiền</th>
                    <!-- <th>Hành động</th> -->
                </tr>
            </thead>
            <tbody>
                <tr v-for="invoice in paidInvoices" :key="invoice.orderId">
                    <td>{{ invoice.orderId }}</td>
                    <td>{{ formatDate(invoice.created_at) }}</td>
                    <td>{{ formatPrice(invoice.totalPrice) }}</td>
                    <!-- <td>
                        <router-link :to="{ name: 'InvoiceDetail', params: { id: invoice.id } }">
                            Xem chi tiết
                        </router-link>
                    </td> -->
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import OrderService from '../../../services/OrderService';

export default {
    name: 'PaidInvoices',
    data() {
        return {
            paidInvoices: [],
            isLoading: false,
            error: null,
        };
    },
    methods: {
        formatDate(isoString) {
            // 1. Tạo đối tượng Date từ chuỗi ISO
            const date = new Date(isoString);

            // 2. Kiểm tra xem Date có hợp lệ không
            if (isNaN(date.getTime())) {
                return "Invalid Date"; // Hoặc xử lý lỗi theo cách khác
            }

            // 3. Lấy các thành phần (giờ, phút, ngày, tháng, năm) theo giờ địa phương
            const hours = date.getHours();
            const minutes = date.getMinutes();
            const day = date.getDate();
            const month = date.getMonth() + 1; // getMonth() trả về từ 0-11 nên cần +1
            const year = date.getFullYear();

            // 4. Định dạng các thành phần để có 2 chữ số (thêm '0' nếu cần)
            const formattedHours = String(hours).padStart(2, '0');
            const formattedMinutes = String(minutes).padStart(2, '0');
            const formattedDay = String(day).padStart(2, '0');
            const formattedMonth = String(month).padStart(2, '0');

            // 5. Ghép lại thành chuỗi kết quả
            return `${formattedHours}:${formattedMinutes} ${formattedDay}/${formattedMonth}/${year}`;
        },
        formatPrice(value) {
            const number = Number(value); // ép kiểu
            if (isNaN(number)) return '';
            if (number < 1000) {
                return `${number}đ`;
            }
            return new Intl.NumberFormat('vi-VN').format(number) + ' đ';
        },
        async fetchPaidInvoices() {
            this.isLoading = true;
            this.error = null;
            this.paidInvoices = [];
            try {
                const response = await OrderService.History();
                this.paidInvoices = response.data.orders;
                this.isLoading = false;
                console.log("History: ", this.paidInvoices);
            } catch (err) {
                console.error("Lỗi khi tải hóa đơn đã thanh toán:", err);
                this.error = err.message || 'Đã xảy ra lỗi không xác định.';
            } finally {
                this.isLoading = false;
            }
        },
    },
    async created() {
        // Tải danh sách khi component được tạo
        await this.fetchPaidInvoices();
    },
};
</script>

<style scoped>
/* Thêm CSS styling của bạn ở đây */
.paid-invoices-container {
    padding: 20px;
}

.loading-indicator,
.error-message,
.empty-list {
    text-align: center;
    margin-top: 20px;
    color: gray;
}

.error-message {
    color: red;
}

.invoice-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.invoice-table th,
.invoice-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.invoice-table th {
    background-color: #f2f2f2;
}
</style>