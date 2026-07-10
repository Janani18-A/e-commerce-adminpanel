// ========================================
// COMMON JS - Navbar, Sidebar, Base
// ========================================

document.addEventListener('DOMContentLoaded', function () {

    // ----- SIDEBAR ACTIVE LINK -----
    const links = document.querySelectorAll('.sidebar-menu li');
    links.forEach(link => {
        link.addEventListener('click', function () {
            links.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // ----- GLOBAL SEARCH FUNCTIONALITY -----
    const searchInput = document.getElementById('globalSearch');
    if (searchInput) {
        searchInput.addEventListener('keyup', function (e) {
            const searchTerm = this.value.toLowerCase().trim();
            console.log('Searching for:', searchTerm);

            if (searchTerm === '') {
                document.querySelectorAll('.highlight').forEach(el => {
                    el.classList.remove('highlight');
                });
                return;
            }

            const contentArea = document.querySelector('.content-area');
            if (contentArea) {
                const elements = contentArea.querySelectorAll('h1, h2, h3, h4, p, span, td, th, div');

                elements.forEach(el => {
                    const text = el.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        el.style.backgroundColor = '#FEF3C7';
                        el.style.padding = '2px 4px';
                        el.style.borderRadius = '4px';
                        el.classList.add('highlight');
                    } else {
                        if (!el.classList.contains('highlight')) {
                            el.style.backgroundColor = '';
                            el.style.padding = '';
                            el.style.borderRadius = '';
                        }
                    }
                });

                const results = document.querySelectorAll('.highlight');
                if (results.length === 0) {
                    console.log('No results found for:', searchTerm);
                }
            }
        });
    }

    // ----- NOTIFICATION CLICK -----
    const notif = document.querySelector('.notification');
    if (notif) {
        notif.addEventListener('click', function () {
            showToast('You have 5 new notifications!', 'info');
        });
    }

    // ----- SIDEBAR DROPDOWN TOGGLE -----
    const dropdowns = document.querySelectorAll('.dropdown > a');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', function (e) {
            e.preventDefault();
            const menu = this.nextElementSibling;
            if (menu) {
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            }
        });
    });

});

// ============================================================
// GLOBAL TOAST FUNCTION - Works on all pages
// ============================================================

function showToast(message, type = 'success') {
    // Check if toast container exists, if not create it
    let toastContainer = document.getElementById('globalToastContainer');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.id = 'globalToastContainer';
        toastContainer.className = 'position-fixed top-0 end-0 p-3';
        toastContainer.style.zIndex = '9999';
        toastContainer.style.maxWidth = '450px';
        document.body.appendChild(toastContainer);
    }

    // Create toast element
    const toastId = 'toast-' + Date.now();
    const colors = {
        success: { bg: '#10B981', border: '#059669' },
        error: { bg: '#EF4444', border: '#DC2626' },
        warning: { bg: '#F59E0B', border: '#D97706' },
        info: { bg: '#2563EB', border: '#1D4ED8' }
    };

    const color = colors[type] || colors.success;

    const toastHTML = `
        <div id="${toastId}" class="toast align-items-center text-white border-0 show" role="alert" 
             style="background: ${color.bg}; border-left: 4px solid ${color.border}; border-radius: 10px; 
                    box-shadow: 0 8px 25px rgba(0,0,0,0.15); min-width: 300px; margin-bottom: 10px;">
            <div class="d-flex align-items-center p-3">
                <div class="flex-shrink-0 me-2">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle'} fa-lg"></i>
                </div>
                <div class="toast-body flex-grow-1" style="font-size: 14px; font-weight: 500;">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;

    toastContainer.insertAdjacentHTML('beforeend', toastHTML);

    // Auto remove after 3 seconds
    setTimeout(() => {
        const toastElement = document.getElementById(toastId);
        if (toastElement) {
            toastElement.classList.remove('show');
            setTimeout(() => {
                if (toastElement.parentNode) {
                    toastElement.remove();
                }
            }, 300);
        }
    }, 3000);
}

// ========================================
// DASHBOARD DATA
// ========================================
var dashboardData = {
    today: {
        totalEarnings: '₹2,45,000',
        totalEarningsTrend: '+12.5%',
        todayEarnings: '₹0.00',
        todayEarningsTrend: 'Awaiting sales',
        totalOrders: '1,250',
        totalOrdersTrend: '+25 Today',
        todayOrders: '0',
        todayOrdersTrend: 'No orders yet',
        customers: '3,478',
        customerTrend: '+8.2%',
        productsSold: '865',
        productsTrend: '+5.7%',
        rating: '4.7 ★',
        ratingTrend: '+0.3%',
        lowStock: '15',
        stockTrend: 'Need restock',
        visitors: '1,247',
        conversion: '3.2%',
        activeUsers: '89',
        totalRevenue: '₹2,45,000',
        orderCount: '1,250',
        chartData: [85, 120, 70, 150, 200, 110, 60],
        chartLabels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        chartValues: ['₹8.5K', '₹12.2K', '₹7.8K', '₹15.4K', '₹21.9K', '₹11.3K', '₹6.7K'],
        status: {
            paid: 0, unpaid: 0, accepted: 0, pending: 8,
            awaitingPayment: 5, awaitingFulfillment: 12,
            awaitingShipment: 7, awaitingPickup: 3,
            partiallyShipped: 4, completed: 156,
            delivered: 890, shipped: 120,
            cancelled: 25, declined: 8,
            refunded: 12, disputed: 2,
            manualVerification: 6, partiallyRefunded: 3
        },
        topProducts: [
            { rank: '🥇', name: 'Premium Wireless Headphones', orders: '342', revenue: '₹2,04,000' },
            { rank: '🥈', name: 'Smartphone Stand Deluxe', orders: '287', revenue: '₹1,72,200' },
            { rank: '🥉', name: 'Ergonomic Mouse Pad', orders: '245', revenue: '₹1,22,500' },
            { rank: '4️⃣', name: 'USB-C Hub 5-in-1', orders: '198', revenue: '₹99,000' },
            { rank: '5️⃣', name: 'Wireless Charging Pad', orders: '156', revenue: '₹78,000' }
        ],
        recentOrders: [
            { id: '#1024', customer: 'Rajesh Kumar', amount: '₹1,200', status: 'pending' },
            { id: '#1025', customer: 'Priya Sharma', amount: '₹850', status: 'shipped' },
            { id: '#1026', customer: 'Amit Verma', amount: '₹2,450', status: 'delivered' },
            { id: '#1027', customer: 'Sneha Reddy', amount: '₹3,200', status: 'awaiting' },
            { id: '#1028', customer: 'Vikram Singh', amount: '₹1,800', status: 'cancelled' }
        ],
        stockAlerts: [
            { icon: '🔴', product: 'Wireless Bluetooth Mouse', status: 'danger', text: 'Only 3 Left' },
            { icon: '🟡', product: 'Laptop Stand Pro', status: 'warning', text: 'Only 2 Left' },
            { icon: '🔴', product: 'Mechanical Gaming Keyboard', status: 'danger', text: 'Out Of Stock' },
            { icon: '🟡', product: 'Webcam HD 1080p', status: 'warning', text: 'Only 5 Left' },
            { icon: '🟢', product: 'USB-C Cable 2M', status: 'success', text: 'In Stock' }
        ],
        activities: [
            { time: '10:20 AM', action: 'Product Added: Wireless Mouse', user: 'by Admin' },
            { time: '11:05 AM', action: 'Order Received: #1024', user: 'by Rajesh Kumar' },
            { time: '11:45 AM', action: 'Customer Registered', user: 'Priya Sharma' },
            { time: '12:10 PM', action: 'Coupon Created: SUMMER25', user: 'by Admin' },
            { time: '01:30 PM', action: 'Order Shipped: #1025', user: 'by Delivery Team' }
        ],
        history: [
            {
                icon: 'fa-calendar-week', bg: '#DBEAFE', color: '#2563EB',
                title: 'Last Week Orders History',
                orders: '156', revenue: '₹1,85,000', change: '+12%'
            },
            {
                icon: 'fa-calendar-alt', bg: '#D1FAE5', color: '#065F46',
                title: 'Last Month Orders History',
                orders: '845', revenue: '₹9,45,000', change: '+8.5%'
            }
        ]
    },
    week: {
        totalEarnings: '₹8,45,000',
        totalEarningsTrend: '+18.3%',
        todayEarnings: '₹1,25,000',
        todayEarningsTrend: '+23% vs last week',
        totalOrders: '3,450',
        totalOrdersTrend: '+120 Today',
        todayOrders: '45',
        todayOrdersTrend: '+12% vs yesterday',
        customers: '4,128',
        customerTrend: '+12.4%',
        productsSold: '1,234',
        productsTrend: '+8.9%',
        rating: '4.8 ★',
        ratingTrend: '+0.5%',
        lowStock: '8',
        stockTrend: 'Restocked 7 items',
        visitors: '2,847',
        conversion: '3.8%',
        activeUsers: '156',
        totalRevenue: '₹8,45,000',
        orderCount: '3,450',
        chartData: [120, 180, 150, 220, 280, 190, 160],
        chartLabels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        chartValues: ['₹12.5K', '₹18.2K', '₹15.8K', '₹22.4K', '₹28.9K', '₹19.3K', '₹16.7K'],
        status: {
            paid: 45, unpaid: 12, accepted: 34, pending: 23,
            awaitingPayment: 15, awaitingFulfillment: 28,
            awaitingShipment: 19, awaitingPickup: 8,
            partiallyShipped: 12, completed: 456,
            delivered: 2190, shipped: 320,
            cancelled: 35, declined: 10,
            refunded: 18, disputed: 3,
            manualVerification: 8, partiallyRefunded: 5
        },
        topProducts: [
            { rank: '🥇', name: 'Gaming Chair Pro', orders: '567', revenue: '₹3,40,200' },
            { rank: '🥈', name: 'Mechanical Keyboard', orders: '423', revenue: '₹2,53,800' },
            { rank: '🥉', name: 'Wireless Earbuds', orders: '389', revenue: '₹2,33,400' },
            { rank: '4️⃣', name: 'Monitor Stand', orders: '312', revenue: '₹1,87,200' },
            { rank: '5️⃣', name: 'Desk Lamp LED', orders: '267', revenue: '₹1,60,200' }
        ],
        recentOrders: [
            { id: '#2034', customer: 'Suresh Patel', amount: '₹2,500', status: 'delivered' },
            { id: '#2035', customer: 'Anjali Sharma', amount: '₹1,850', status: 'shipped' },
            { id: '#2036', customer: 'Ravi Kumar', amount: '₹4,200', status: 'pending' },
            { id: '#2037', customer: 'Meena Reddy', amount: '₹950', status: 'delivered' },
            { id: '#2038', customer: 'Arjun Singh', amount: '₹3,600', status: 'awaiting' }
        ],
        stockAlerts: [
            { icon: '🔴', product: 'Gaming Mouse', status: 'danger', text: 'Only 2 Left' },
            { icon: '🟡', product: 'USB Hub', status: 'warning', text: 'Only 4 Left' },
            { icon: '🟢', product: 'HDMI Cable', status: 'success', text: 'In Stock' }
        ],
        activities: [
            { time: '09:00 AM', action: 'New Order: #2034', user: 'by Suresh Patel' },
            { time: '10:30 AM', action: 'Product Restocked: Keyboards', user: 'by Admin' },
            { time: '11:45 AM', action: 'Customer Registered', user: 'Anjali Sharma' },
            { time: '02:00 PM', action: 'Order Shipped: #2035', user: 'by Delivery Team' },
            { time: '03:30 PM', action: 'Discount Created: FLASH25', user: 'by Admin' }
        ],
        history: [
            {
                icon: 'fa-calendar-week', bg: '#DBEAFE', color: '#2563EB',
                title: 'Last Week Orders History',
                orders: '345', revenue: '₹4,85,000', change: '+18%'
            },
            {
                icon: 'fa-calendar-alt', bg: '#D1FAE5', color: '#065F46',
                title: 'Last Month Orders History',
                orders: '1245', revenue: '₹12,45,000', change: '+12.5%'
            }
        ]
    },
    month: {
        totalEarnings: '₹18,45,000',
        totalEarningsTrend: '+22.7%',
        todayEarnings: '₹2,45,000',
        todayEarningsTrend: '+15% vs last month',
        totalOrders: '8,450',
        totalOrdersTrend: '+350 Today',
        todayOrders: '78',
        todayOrdersTrend: '+8% vs yesterday',
        customers: '5,678',
        customerTrend: '+18.6%',
        productsSold: '2,456',
        productsTrend: '+12.3%',
        rating: '4.9 ★',
        ratingTrend: '+0.7%',
        lowStock: '5',
        stockTrend: 'Restocked 12 items',
        visitors: '4,847',
        conversion: '4.2%',
        activeUsers: '234',
        totalRevenue: '₹18,45,000',
        orderCount: '8,450',
        chartData: [200, 280, 250, 320, 380, 290, 260],
        chartLabels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        chartValues: ['₹20.5K', '₹28.2K', '₹25.8K', '₹32.4K', '₹38.9K', '₹29.3K', '₹26.7K'],
        status: {
            paid: 89, unpaid: 23, accepted: 56, pending: 34,
            awaitingPayment: 25, awaitingFulfillment: 45,
            awaitingShipment: 32, awaitingPickup: 15,
            partiallyShipped: 18, completed: 789,
            delivered: 4890, shipped: 567,
            cancelled: 45, declined: 12,
            refunded: 28, disputed: 4,
            manualVerification: 10, partiallyRefunded: 7
        },
        topProducts: [
            { rank: '🥇', name: 'Laptop Pro 15"', orders: '890', revenue: '₹8,90,000' },
            { rank: '🥈', name: 'Wireless Keyboard', orders: '678', revenue: '₹4,06,800' },
            { rank: '🥉', name: '4K Monitor', orders: '545', revenue: '₹5,45,000' },
            { rank: '4️⃣', name: 'Gaming Chair', orders: '456', revenue: '₹4,56,000' },
            { rank: '5️⃣', name: 'SSD 1TB', orders: '389', revenue: '₹3,89,000' }
        ],
        recentOrders: [
            { id: '#3045', customer: 'Deepak Gupta', amount: '₹5,200', status: 'delivered' },
            { id: '#3046', customer: 'Kavya Nair', amount: '₹2,850', status: 'shipped' },
            { id: '#3047', customer: 'Rohit Sharma', amount: '₹7,200', status: 'pending' },
            { id: '#3048', customer: 'Pooja Patel', amount: '₹1,950', status: 'delivered' },
            { id: '#3049', customer: 'Vivek Singh', amount: '₹4,600', status: 'awaiting' }
        ],
        stockAlerts: [
            { icon: '🔴', product: 'Laptop Adapter', status: 'danger', text: 'Only 1 Left' },
            { icon: '🟢', product: 'Wireless Mouse', status: 'success', text: 'In Stock' },
            { icon: '🟢', product: 'USB-C Cable', status: 'success', text: 'In Stock' }
        ],
        activities: [
            { time: '08:30 AM', action: 'Bulk Order: #3045', user: 'by Deepak Gupta' },
            { time: '09:45 AM', action: 'Product Added: New Laptop', user: 'by Admin' },
            { time: '10:30 AM', action: 'Price Updated: 15 Products', user: 'by Admin' },
            { time: '12:00 PM', action: 'Order Shipped: 45 Items', user: 'by Team' },
            { time: '02:30 PM', action: 'Customer Registered: 12 New', user: 'by System' }
        ],
        history: [
            {
                icon: 'fa-calendar-week', bg: '#DBEAFE', color: '#2563EB',
                title: 'Last Week Orders History',
                orders: '890', revenue: '₹12,85,000', change: '+22%'
            },
            {
                icon: 'fa-calendar-alt', bg: '#D1FAE5', color: '#065F46',
                title: 'Last Month Orders History',
                orders: '2845', revenue: '₹25,45,000', change: '+15.5%'
            }
        ]
    },
    year: {
        totalEarnings: '₹1,25,45,000',
        totalEarningsTrend: '+34.2%',
        todayEarnings: '₹3,45,000',
        todayEarningsTrend: '+28% vs last year',
        totalOrders: '45,450',
        totalOrdersTrend: '+1,250 Today',
        todayOrders: '156',
        todayOrdersTrend: '+18% vs yesterday',
        customers: '12,678',
        customerTrend: '+28.6%',
        productsSold: '8,456',
        productsTrend: '+22.3%',
        rating: '4.9 ★',
        ratingTrend: '+0.9%',
        lowStock: '12',
        stockTrend: 'Restocked 25 items',
        visitors: '8,847',
        conversion: '5.2%',
        activeUsers: '456',
        totalRevenue: '₹1,25,45,000',
        orderCount: '45,450',
        chartData: [350, 420, 380, 480, 520, 450, 390],
        chartLabels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        chartValues: ['₹35.5K', '₹42.2K', '₹38.8K', '₹48.4K', '₹52.9K', '₹45.3K', '₹39.7K'],
        status: {
            paid: 234, unpaid: 56, accepted: 123, pending: 78,
            awaitingPayment: 45, awaitingFulfillment: 89,
            awaitingShipment: 67, awaitingPickup: 34,
            partiallyShipped: 45, completed: 2345,
            delivered: 12890, shipped: 1567,
            cancelled: 89, declined: 23,
            refunded: 56, disputed: 8,
            manualVerification: 15, partiallyRefunded: 12
        },
        topProducts: [
            { rank: '🥇', name: 'Laptop Pro 16"', orders: '2,890', revenue: '₹28,90,000' },
            { rank: '🥈', name: 'Wireless Keyboard Pro', orders: '2,678', revenue: '₹16,06,800' },
            { rank: '🥉', name: '4K OLED Monitor', orders: '2,545', revenue: '₹25,45,000' },
            { rank: '4️⃣', name: 'Gaming Chair Premium', orders: '1,456', revenue: '₹14,56,000' },
            { rank: '5️⃣', name: 'SSD 2TB', orders: '1,389', revenue: '₹13,89,000' }
        ],
        recentOrders: [
            { id: '#5045', customer: 'Manoj Kumar', amount: '₹15,200', status: 'delivered' },
            { id: '#5046', customer: 'Sara Khan', amount: '₹8,850', status: 'shipped' },
            { id: '#5047', customer: 'Rahul Verma', amount: '₹12,200', status: 'pending' },
            { id: '#5048', customer: 'Neha Patel', amount: '₹5,950', status: 'delivered' },
            { id: '#5049', customer: 'Amit Singh', amount: '₹9,600', status: 'awaiting' }
        ],
        stockAlerts: [
            { icon: '🔴', product: 'Gaming Laptop', status: 'danger', text: 'Only 1 Left' },
            { icon: '🟡', product: 'Webcam 4K', status: 'warning', text: 'Only 3 Left' },
            { icon: '🟢', product: 'USB Hub', status: 'success', text: 'In Stock' }
        ],
        activities: [
            { time: '07:00 AM', action: 'Yearly Report Generated', user: 'by System' },
            { time: '09:00 AM', action: 'Bulk Order: 50 Laptops', user: 'by Corporate' },
            { time: '10:30 AM', action: 'Inventory Updated', user: 'by Admin' },
            { time: '01:00 PM', action: 'New Collection Added', user: 'by Admin' },
            { time: '03:00 PM', action: 'Yearly Review Meeting', user: 'by Team' }
        ],
        history: [
            {
                icon: 'fa-calendar-week', bg: '#DBEAFE', color: '#2563EB',
                title: 'Last Week Orders History',
                orders: '2,890', revenue: '₹32,85,000', change: '+32%'
            },
            {
                icon: 'fa-calendar-alt', bg: '#D1FAE5', color: '#065F46',
                title: 'Last Month Orders History',
                orders: '12,845', revenue: '₹85,45,000', change: '+25.5%'
            }
        ]
    }
};

// ========================================
// DASHBOARD FUNCTIONS
// ========================================

function updateDashboard(period) {
    console.log('Updating dashboard: ' + period);
    var data = dashboardData[period];
    if (!data) {
        console.error('No data for period: ' + period);
        return;
    }

    document.getElementById('totalEarnings').textContent = data.totalEarnings;
    document.getElementById('totalEarningsTrend').innerHTML = '<i class="fas fa-arrow-up"></i> ' + data.totalEarningsTrend;
    document.getElementById('todayEarnings').textContent = data.todayEarnings;
    document.getElementById('todayEarningsTrend').innerHTML = '<i class="fas fa-clock"></i> ' + data.todayEarningsTrend;
    document.getElementById('totalOrders').textContent = data.totalOrders;
    document.getElementById('totalOrdersTrend').innerHTML = '<i class="fas fa-arrow-up"></i> ' + data.totalOrdersTrend;
    document.getElementById('todayOrders').textContent = data.todayOrders;
    document.getElementById('todayOrdersTrend').innerHTML = '<i class="fas fa-hourglass"></i> ' + data.todayOrdersTrend;

    document.getElementById('totalRevenueDisplay').textContent = data.totalRevenue;
    document.getElementById('todayVisitors').textContent = data.visitors;
    document.getElementById('conversionRate').textContent = data.conversion;
    document.getElementById('activeUsers').textContent = data.activeUsers;

    document.getElementById('totalCustomers').textContent = data.customers;
    document.getElementById('customerTrend').innerHTML = '<i class="fas fa-arrow-up"></i> ' + data.customerTrend;
    document.getElementById('productsSold').textContent = data.productsSold;
    document.getElementById('productsTrend').innerHTML = '<i class="fas fa-arrow-up"></i> ' + data.productsTrend;
    document.getElementById('avgRating').textContent = data.rating;
    document.getElementById('ratingTrend').innerHTML = '<i class="fas fa-arrow-up"></i> ' + data.ratingTrend;
    document.getElementById('lowStockItems').textContent = data.lowStock;
    document.getElementById('stockTrend').innerHTML = '<i class="fas fa-arrow-down"></i> ' + data.stockTrend;

    var statusMap = {
        paid: 'paidCount', unpaid: 'unpaidCount', accepted: 'acceptedCount',
        pending: 'pendingCount', awaitingPayment: 'awaitingPaymentCount',
        awaitingFulfillment: 'awaitingFulfillmentCount',
        awaitingShipment: 'awaitingShipmentCount',
        awaitingPickup: 'awaitingPickupCount',
        partiallyShipped: 'partiallyShippedCount',
        completed: 'completedCount', delivered: 'deliveredCount',
        shipped: 'shippedCount', cancelled: 'cancelledCount',
        declined: 'declinedCount', refunded: 'refundedCount',
        disputed: 'disputedCount', manualVerification: 'manualVerificationCount',
        partiallyRefunded: 'partiallyRefundedCount'
    };

    for (var key in statusMap) {
        var element = document.getElementById(statusMap[key]);
        if (element && data.status[key] !== undefined) {
            element.textContent = data.status[key];
        }
    }

    updateChart(data.chartData, data.chartLabels, data.chartValues);
    updateTopProducts(data.topProducts);
    updateRecentOrders(data.recentOrders, data.orderCount);
    updateStockAlerts(data.stockAlerts);
    updateRecentActivity(data.activities);
    document.getElementById('orderCount').textContent = 'Showing 5 of ' + data.orderCount + ' orders';

    var buttons = document.querySelectorAll('.filter-btn');
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('active');
        if (buttons[i].getAttribute('data-period') === period) {
            buttons[i].classList.add('active');
        }
    }
}

function updateChart(chartData, chartLabels, chartValues) {
    var container = document.getElementById('salesChart');
    if (!container) return;

    var maxHeight = Math.max.apply(null, chartData);
    var html = '';

    for (var i = 0; i < chartData.length; i++) {
        var height = (chartData[i] / maxHeight) * 40;
        html += '<div class="bar-group">';
        html += '<div class="bar" style="height: ' + height + 'px;"></div>';
        html += '<span>' + chartLabels[i] + '</span>';
        html += '<span class="bar-value">' + chartValues[i] + '</span>';
        html += '</div>';
    }

    container.innerHTML = html;
}

function updateTopProducts(products) {
    var container = document.getElementById('topProducts');
    if (!container) return;

    var html = '';
    for (var i = 0; i < products.length; i++) {
        html += '<div class="rank-item">';
        html += '<span class="rank">' + products[i].rank + '</span>';
        html += '<span class="product-name">' + products[i].name + '</span>';
        html += '<span class="orders">' + products[i].orders + ' Orders</span>';
        html += '<span class="revenue">' + products[i].revenue + '</span>';
        html += '</div>';
    }

    container.innerHTML = html;
}

function updateRecentOrders(orders, total) {
    var tableBody = document.getElementById('recentOrdersTable');
    if (!tableBody) return;

    var html = '';
    for (var i = 0; i < orders.length; i++) {
        var statusClass = orders[i].status;
        var statusText = orders[i].status.charAt(0).toUpperCase() + orders[i].status.slice(1);
        html += '<tr>';
        html += '<td><span class="order-id">' + orders[i].id + '</span></td>';
        html += '<td>' + orders[i].customer + '</td>';
        html += '<td>' + orders[i].amount + '</td>';
        html += '<td><span class="status-badge ' + statusClass + '">' + statusText + '</span></td>';
        html += '<td>';
        html += '<button class="action-btn view"><i class="fas fa-eye"></i></button>';
        html += '<button class="action-btn ship"><i class="fas fa-truck"></i></button>';
        html += '<button class="action-btn invoice"><i class="fas fa-file-invoice"></i></button>';
        html += '</td>';
        html += '</tr>';
    }

    tableBody.innerHTML = html;
    document.getElementById('orderCount').textContent = 'Showing ' + orders.length + ' of ' + total + ' orders';
}

function updateStockAlerts(alerts) {
    var container = document.getElementById('stockAlertsList');
    if (!container) return;

    var html = '';
    for (var i = 0; i < alerts.length; i++) {
        html += '<div class="alert-item ' + alerts[i].status + '">';
        html += '<span class="alert-icon">' + alerts[i].icon + '</span>';
        html += '<span class="alert-product">' + alerts[i].product + '</span>';
        html += '<span class="alert-status ' + alerts[i].status + '">' + alerts[i].text + '</span>';
        html += '</div>';
    }

    container.innerHTML = html;
}

function updateRecentActivity(activities) {
    var container = document.getElementById('recentActivityList');
    if (!container) return;

    var html = '';
    for (var i = 0; i < activities.length; i++) {
        html += '<div class="activity-item">';
        html += '<span class="time">' + activities[i].time + '</span>';
        html += '<span class="action">' + activities[i].action + '</span>';
        html += '<span class="user">' + activities[i].user + '</span>';
        html += '</div>';
    }

    container.innerHTML = html;
}

function updateHistory(period) {
    console.log('Updating history: ' + period);

    var data;
    if (period === 'week') {
        data = dashboardData.today.history;
    } else if (period === 'month') {
        data = dashboardData.week.history;
    } else {
        data = dashboardData.month.history;
    }

    var container = document.getElementById('historyGrid');
    if (!container) return;

    var html = '';
    for (var i = 0; i < data.length; i++) {
        html += '<div class="history-card">';
        html += '<div class="history-icon" style="background: ' + data[i].bg + '; color: ' + data[i].color + ';">';
        html += '<i class="fas ' + data[i].icon + '"></i>';
        html += '</div>';
        html += '<div class="history-info">';
        html += '<h4>' + data[i].title + '</h4>';
        html += '<div class="history-stats">';
        html += '<span><strong>' + data[i].orders + '</strong> Orders</span>';
        html += '<span><strong>' + data[i].revenue + '</strong> Revenue</span>';
        html += '<span><strong>' + data[i].change + '</strong> vs previous</span>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
    }

    container.innerHTML = html;

    var buttons = document.querySelectorAll('.history-btn');
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('active');
        if (buttons[i].getAttribute('data-period') === period) {
            buttons[i].classList.add('active');
        }
    }
}

// ========================================
// DASHBOARD INITIALIZE
// ========================================
document.addEventListener('DOMContentLoaded', function () {
    console.log('Dashboard JS loaded successfully!');
    updateDashboard('today');
});

// ========================================
// CUSTOMER DATA
// ========================================
const customerData = [
    { id: 1, name: 'Yaga Masamichi', email: 'yaga.masamichi@gmail.com', phone: '+1 202-555-0180', orders: 15, paid: '₹12,500', unpaid: '₹0', total: '₹12,500', created: '14 Jan 2026', status: 'Active' },
    { id: 2, name: 'Manami Suda', email: 'manami.suda@gmail.com', phone: '+44 20 7946 2233', orders: 8, paid: '₹8,200', unpaid: '₹0', total: '₹8,200', created: '07 Feb 2026', status: 'Active' },
    { id: 3, name: 'Okkotsu Yuta', email: 'okkotsu.yuta@gmail.com', phone: '+81 80 6543 8899', orders: 12, paid: '₹10,800', unpaid: '₹500', total: '₹11,300', created: '21 Jun 2026', status: 'Pending' },
    { id: 4, name: 'Kugisaki Nobara', email: 'kugisaki.nobara@gmail.com', phone: '+61 2 9374 4000', orders: 25, paid: '₹25,000', unpaid: '₹0', total: '₹25,000', created: '03 Nov 2025', status: 'VIP' },
    { id: 5, name: 'Nanami Kento', email: 'nanami.kento@gmail.com', phone: '+1 303-555-0134', orders: 18, paid: '₹15,600', unpaid: '₹0', total: '₹15,600', created: '30 Aug 2025', status: 'Active' },
    { id: 6, name: 'Fushiguro Megumi', email: 'fushiguro.megumi@gmail.com', phone: '+49 30 901820', orders: 6, paid: '₹4,200', unpaid: '₹800', total: '₹5,000', created: '19 May 2025', status: 'Inactive' },
    { id: 7, name: 'Nitta Akari', email: 'nitta.akari@gmail.com', phone: '+33 1 4020 5000', orders: 4, paid: '₹3,200', unpaid: '₹0', total: '₹3,200', created: '12 Mar 2026', status: 'Pending' },
    { id: 8, name: 'Inumaki Toge', email: 'inumaki.toge@gmail.com', phone: '+82 10-7788-5566', orders: 10, paid: '₹9,800', unpaid: '₹0', total: '₹9,800', created: '28 Jul 2025', status: 'Active' },
    { id: 9, name: 'Gojo Satoru', email: 'gojo.satoru@gmail.com', phone: '+81 90 1234 5678', orders: 30, paid: '₹35,000', unpaid: '₹0', total: '₹35,000', created: '10 Jan 2025', status: 'VIP' },
    { id: 10, name: 'Itadori Yuji', email: 'itadori.yuji@gmail.com', phone: '+81 80 9876 5432', orders: 5, paid: '₹4,500', unpaid: '₹200', total: '₹4,700', created: '15 Mar 2026', status: 'Pending' },
    { id: 11, name: 'Zenin Maki', email: 'zenin.maki@gmail.com', phone: '+81 70 1122 3344', orders: 20, paid: '₹22,000', unpaid: '₹0', total: '₹22,000', created: '20 Feb 2025', status: 'Active' },
    { id: 12, name: 'Tsurumi Reo', email: 'tsurumi.reo@gmail.com', phone: '+81 60 5566 7788', orders: 14, paid: '₹14,800', unpaid: '₹300', total: '₹15,100', created: '05 Apr 2026', status: 'Active' },
    { id: 13, name: 'Kamo Noritoshi', email: 'kamo.noritoshi@gmail.com', phone: '+81 50 9988 7766', orders: 9, paid: '₹9,200', unpaid: '₹0', total: '₹9,200', created: '12 Dec 2025', status: 'Inactive' },
    { id: 14, name: 'Mai Zenin', email: 'mai.zenin@gmail.com', phone: '+81 40 4455 6677', orders: 7, paid: '₹6,500', unpaid: '₹400', total: '₹6,900', created: '25 Aug 2025', status: 'Pending' },
    { id: 15, name: 'Miwa Kasumi', email: 'miwa.kasumi@gmail.com', phone: '+81 30 7788 9900', orders: 11, paid: '₹11,200', unpaid: '₹0', total: '₹11,200', created: '03 Jul 2026', status: 'Active' },
    { id: 16, name: 'Todo Aoi', email: 'todo.aoi@gmail.com', phone: '+81 20 6677 8899', orders: 22, paid: '₹24,000', unpaid: '₹0', total: '₹24,000', created: '18 Nov 2025', status: 'VIP' }
];

// ========================================
// CUSTOMERS PAGE - STATE VARIABLES
// ========================================
let customerCurrentPage = 1;
let customerRowsPerPage = 5;
let customerCurrentView = 'table';
let customerFilteredData = [...customerData];

// ========================================
// CUSTOMERS - RENDER TABLE
// ========================================
function renderTable() {
    const tbody = document.getElementById('customerTableBody');
    if (!tbody) return;

    const start = (customerCurrentPage - 1) * customerRowsPerPage;
    const end = start + customerRowsPerPage;
    const pageData = customerFilteredData.slice(start, end);

    if (pageData.length === 0) {
        tbody.innerHTML = `<tr><td colspan="12" style="text-align:center;padding:30px;">No customers found</td></tr>`;
        return;
    }

    let html = '';
    pageData.forEach((customer, index) => {
        const statusClass = customer.status.toLowerCase();
        html += `
            <tr>
                <td>${start + index + 1}</td>
                <td>
                    <img src="assets/images/avatar${customer.id}.jpg" alt="${customer.name}" class="avatar" 
                         onerror="this.src='https://ui-avatars.com/api/?name=${encodeURIComponent(customer.name)}&background=2563EB&color=fff'">
                </td>
                <td><strong>${customer.name}</strong></td>
                <td>${customer.email}</td>
                <td>${customer.phone}</td>
                <td>${customer.orders}</td>
                <td>${customer.paid}</td>
                <td>${customer.unpaid}</td>
                <td>${customer.total}</td>
                <td>${customer.created}</td>
                <td><span class="status-badge ${statusClass}">${customer.status}</span></td>
                <td>
                    <button class="action-btn view" onclick="viewCustomer(${customer.id})"><i class="fas fa-eye"></i></button>
                    <button class="action-btn edit" onclick="editCustomer(${customer.id})"><i class="fas fa-edit"></i></button>
                </td>
            </tr>
        `;
    });
    tbody.innerHTML = html;
    updateCustomerPagination();
    updateCustomerEntryInfo();
}

// ========================================
// CUSTOMERS - RENDER CARD VIEW
// ========================================
function renderCards() {
    const container = document.getElementById('tableContainer');
    if (!container) return;

    const start = (customerCurrentPage - 1) * customerRowsPerPage;
    const end = start + customerRowsPerPage;
    const pageData = customerFilteredData.slice(start, end);

    if (pageData.length === 0) {
        container.innerHTML = `<div style="text-align:center;padding:30px;">No customers found</div>`;
        return;
    }

    let html = '<div class="card-grid">';
    pageData.forEach((customer) => {
        const statusClass = customer.status.toLowerCase();
        html += `
            <div class="customer-card">
                <div class="card-avatar">
                    <img src="assets/images/avatar${customer.id}.jpg" alt="${customer.name}" 
                         onerror="this.src='https://ui-avatars.com/api/?name=${encodeURIComponent(customer.name)}&background=2563EB&color=fff'">
                </div>
                <div class="card-info">
                    <h4>${customer.name}</h4>
                    <p>${customer.email}</p>
                    <p>${customer.phone}</p>
                    <div class="card-stats">
                        <span>Orders: ${customer.orders}</span>
                        <span>Spent: ${customer.total}</span>
                    </div>
                    <div class="card-status">
                        <span class="status-badge ${statusClass}">${customer.status}</span>
                    </div>
                    <div class="card-actions">
                        <button class="action-btn view" onclick="viewCustomer(${customer.id})"><i class="fas fa-eye"></i></button>
                        <button class="action-btn edit" onclick="editCustomer(${customer.id})"><i class="fas fa-edit"></i></button>
                    </div>
                </div>
            </div>
        `;
    });
    html += '</div>';
    container.innerHTML = html;
    updateCustomerPagination();
    updateCustomerEntryInfo();
}

// ========================================
// CUSTOMERS - SWITCH VIEW
// ========================================
function switchView(view) {
    customerCurrentView = view;
    const btns = document.querySelectorAll('.toggle-btn');
    btns.forEach(btn => btn.classList.remove('active'));

    if (view === 'table') {
        btns[0].classList.add('active');
        const container = document.getElementById('tableContainer');
        if (container) {
            container.innerHTML = `<table class="customer-table" id="customerTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Orders</th>
                        <th>Paid</th>
                        <th>Unpaid</th>
                        <th>Total Spend</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="customerTableBody"></tbody>
            </table>`;
            renderTable();
        }
    } else {
        btns[1].classList.add('active');
        renderCards();
    }
}

// ========================================
// CUSTOMERS - PAGINATION
// ========================================
function updateCustomerPagination() {
    const totalPages = Math.ceil(customerFilteredData.length / customerRowsPerPage);
    const controls = document.getElementById('paginationControls');
    if (!controls) return;

    if (totalPages <= 1) {
        controls.innerHTML = '';
        return;
    }

    let html = `<button class="pagination-btn" onclick="customerGoToPage(${customerCurrentPage - 1})" ${customerCurrentPage === 1 ? 'disabled' : ''}>
        <i class="fas fa-chevron-left"></i>
    </button>`;

    for (let i = 1; i <= totalPages; i++) {
        html += `<button class="pagination-btn ${i === customerCurrentPage ? 'active' : ''}" onclick="customerGoToPage(${i})">${i}</button>`;
    }

    html += `<button class="pagination-btn" onclick="customerGoToPage(${customerCurrentPage + 1})" ${customerCurrentPage === totalPages ? 'disabled' : ''}>
        <i class="fas fa-chevron-right"></i>
    </button>`;

    controls.innerHTML = html;
}

function customerGoToPage(page) {
    const totalPages = Math.ceil(customerFilteredData.length / customerRowsPerPage);
    if (page < 1 || page > totalPages) return;
    customerCurrentPage = page;

    if (customerCurrentView === 'table') {
        renderTable();
    } else {
        renderCards();
    }
}

function customerPrevPage() {
    customerGoToPage(customerCurrentPage - 1);
}

function customerNextPage() {
    customerGoToPage(customerCurrentPage + 1);
}

function showAll() {
    customerRowsPerPage = customerFilteredData.length;
    customerCurrentPage = 1;
    if (customerCurrentView === 'table') {
        renderTable();
    } else {
        renderCards();
    }
}

// ========================================
// CUSTOMERS - FILTER / SEARCH
// ========================================
function filterCustomers(searchTerm) {
    const term = searchTerm.toLowerCase().trim();
    if (term === '') {
        customerFilteredData = [...customerData];
    } else {
        customerFilteredData = customerData.filter(c =>
            c.name.toLowerCase().includes(term) ||
            c.email.toLowerCase().includes(term) ||
            c.phone.includes(term)
        );
    }
    customerCurrentPage = 1;
    customerRowsPerPage = 5;

    if (customerCurrentView === 'table') {
        renderTable();
    } else {
        renderCards();
    }
}

// ========================================
// CUSTOMERS - UPDATE ENTRY INFO
// ========================================
function updateCustomerEntryInfo() {
    const start = (customerCurrentPage - 1) * customerRowsPerPage + 1;
    const end = Math.min(start + customerRowsPerPage - 1, customerFilteredData.length);
    const total = customerFilteredData.length;
    const info = document.getElementById('entryInfo');
    if (info) {
        info.textContent = `Showing ${start} to ${end} of ${total} entries`;
    }
}

// ========================================
// CUSTOMERS - ADD / EDIT / VIEW
// ========================================
function addCustomer() {
    window.location.href = 'add-customer.php';
}

function saveCustomer() {
    const name = document.getElementById('customerName').value.trim();
    const email = document.getElementById('customerEmail').value.trim();
    const phone = document.getElementById('customerPhone').value.trim();
    const password = document.getElementById('customerPassword').value;
    const confirmPassword = document.getElementById('customerConfirmPassword').value;
    const status = document.getElementById('customerStatus').value;

    if (!name || !email || !phone || !password) {
        showToast('Please fill in all required fields', 'error');
        return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showToast('Please enter a valid email address', 'error');
        return;
    }

    if (password.length < 6) {
        showToast('Password must be at least 6 characters', 'error');
        return;
    }

    if (password !== confirmPassword) {
        showToast('Passwords do not match!', 'error');
        return;
    }

    const phoneRegex = /^[0-9+\-\s()]{10,15}$/;
    if (!phoneRegex.test(phone)) {
        showToast('Please enter a valid phone number', 'error');
        return;
    }

    const newCustomer = {
        id: customerData.length + 1,
        name: name,
        email: email,
        phone: phone,
        orders: 0,
        paid: '₹0',
        unpaid: '₹0',
        total: '₹0',
        created: new Date().toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' }),
        status: status
    };

    customerData.push(newCustomer);
    customerFilteredData = [...customerData];
    customerCurrentPage = 1;
    customerRowsPerPage = 5;

    showToast(`Customer "${name}" added successfully!`, 'success');

    if (customerCurrentView === 'table') {
        renderTable();
    } else {
        renderCards();
    }
}

function exportData() {
    const exportBtn = document.querySelector('.btn-export');
    const originalText = exportBtn.innerHTML;
    exportBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Exporting...';
    exportBtn.disabled = true;

    setTimeout(() => {
        const data = customerFilteredData.length > 0 ? customerFilteredData : customerData;
        const headers = ['ID', 'Name', 'Email', 'Phone', 'Orders', 'Paid', 'Unpaid', 'Total Spent', 'Created', 'Status'];
        const rows = data.map(c => [
            c.id, c.name, c.email, c.phone, c.orders,
            c.paid.replace('₹', '').replace(',', ''),
            c.unpaid.replace('₹', '').replace(',', ''),
            c.total.replace('₹', '').replace(',', ''),
            c.created, c.status
        ]);

        const csvContent = [headers.join(','), ...rows.map(row => row.join(','))].join('\n');
        const blob = new Blob(['\uFEFF' + csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.href = url;
        link.download = `customers_${new Date().toISOString().split('T')[0]}.csv`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);

        showToast(`Exported ${data.length} customers successfully!`, 'success');
        exportBtn.innerHTML = originalText;
        exportBtn.disabled = false;
    }, 1000);
}

function viewCustomer(id) {
    const customer = customerData.find(c => c.id === id);
    showToast(`Viewing: ${customer.name} | Orders: ${customer.orders} | Spent: ${customer.total}`, 'info');
}

function editCustomer(id) {
    const customer = customerData.find(c => c.id === id);
    showToast(`Editing customer: ${customer.name}`, 'info');
}

// ========================================
// CUSTOMERS - CHART UPDATE
// ========================================
function updateCustomerChart(month) {
    const filters = document.querySelectorAll('.chart-box .filter-btn');
    filters.forEach(btn => btn.classList.remove('active'));

    const clickedBtn = Array.from(filters).find(btn =>
        btn.textContent.toLowerCase() === month
    );
    if (clickedBtn) clickedBtn.classList.add('active');

    const data = {
        jan: [20, 35, 52, 80, 110, 150],
        feb: [25, 40, 60, 90, 120, 160],
        mar: [30, 45, 70, 100, 130, 180],
        apr: [35, 50, 80, 110, 140, 200],
        may: [40, 55, 90, 120, 150, 220],
        jun: [45, 60, 100, 130, 160, 250]
    };

    const values = data[month] || data.jan;
    const bars = document.querySelectorAll('.growth-chart .bar');
    const maxHeight = Math.max(...values);

    bars.forEach((bar, index) => {
        if (values[index] !== undefined) {
            const height = (values[index] / maxHeight) * 300;
            bar.style.height = height + 'px';
            bar.style.transition = 'height 0.5s ease';
        }
    });
}

// ========================================
// CUSTOMERS - INITIALIZE
// ========================================
document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('customerTableBody')) {
        console.log('Customers page loaded!');
        renderTable();
    }
});

// ========================================
// USER ACTIVITY PAGE JS
// ========================================

let activityCurrentPage = 1;
let activityRowsPerPage = 5;

function filterDate(period) {
    const buttons = document.querySelectorAll('.filter-btn');
    buttons.forEach(btn => btn.classList.remove('active'));

    const clicked = Array.from(buttons).find(btn =>
        btn.textContent.toLowerCase().includes(period) ||
        btn.getAttribute('onclick')?.includes(period)
    );
    if (clicked) clicked.classList.add('active');

    console.log('Filtering by:', period);

    const filterSection = document.querySelector('.filter-section');
    if (filterSection) {
        filterSection.style.opacity = '0.5';
        filterSection.style.transition = 'opacity 0.3s';
    }

    setTimeout(() => {
        if (filterSection) {
            filterSection.style.opacity = '1';
        }
        updateKPIsForPeriod(period);
        updateFunnelForPeriod(period);
        showToast(`Showing data for: ${formatPeriodName(period)}`, 'info');
    }, 500);
}

function formatPeriodName(period) {
    const names = {
        'today': 'Today',
        'yesterday': 'Yesterday',
        'week': 'Last 7 Days',
        'month': 'Last 30 Days',
        'custom': 'Custom Range'
    };
    return names[period] || period;
}

function updateKPIsForPeriod(period) {
    const data = getActivityData(period);
    document.getElementById('viewsCount').textContent = data.views;
    document.getElementById('wishlistCount').textContent = data.wishlist;
    document.getElementById('cartsCount').textContent = data.carts;
    document.getElementById('checkoutCount').textContent = data.checkout;
    document.getElementById('purchasesCount').textContent = data.purchases;
}

function updateFunnelForPeriod(period) {
    const data = getFunnelData(period);
    const bars = document.querySelectorAll('.funnel-progress');
    const counts = document.querySelectorAll('.funnel-count');
    const drops = document.querySelectorAll('.funnel-drop');

    if (bars.length >= 5) {
        const maxVal = Math.max(...data.values);
        data.values.forEach((val, index) => {
            if (bars[index]) {
                const width = (val / maxVal) * 100;
                bars[index].style.width = width + '%';
            }
            if (counts[index]) {
                counts[index].textContent = val.toLocaleString();
            }
            if (drops[index] && index > 0) {
                const drop = data.values[index - 1] - val;
                drops[index].textContent = `(-${drop.toLocaleString()})`;
            }
        });
    }
}

function getActivityData(period) {
    const multipliers = {
        'today': 1,
        'yesterday': 0.8,
        'week': 5,
        'month': 20,
        'year': 200
    };
    const m = multipliers[period] || 1;
    return {
        views: Math.round(1247 * m),
        wishlist: Math.round(342 * m),
        carts: Math.round(456 * m),
        checkout: Math.round(234 * m),
        purchases: Math.round(189 * m)
    };
}

function getFunnelData(period) {
    const multipliers = {
        'today': 0.05,
        'yesterday': 0.04,
        'week': 0.3,
        'month': 1,
        'year': 10
    };
    const m = multipliers[period] || 1;
    return {
        values: [
            Math.round(1000 * m),
            Math.round(750 * m),
            Math.round(300 * m),
            Math.round(180 * m),
            Math.round(120 * m)
        ]
    };
}

function refreshActivity() {
    const btn = document.querySelector('.btn-refresh');
    if (!btn) return;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Refreshing...';
    btn.disabled = true;

    setTimeout(() => {
        btn.innerHTML = '<i class="fas fa-sync-alt"></i> Refresh';
        btn.disabled = false;
        showToast('Activity data refreshed!', 'success');
    }, 1500);
}

function exportActivity() {
    showToast('Exporting activity data...', 'info');
}

function searchActivity() {
    const searchTerm = document.getElementById('activitySearch')?.value.toLowerCase() || '';
    const rows = document.querySelectorAll('#activityTableBody tr');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });

    updateActivityEntryInfo();
}

function filterAction() {
    const filter = document.getElementById('actionFilter')?.value || 'all';
    const rows = document.querySelectorAll('#activityTableBody tr');

    rows.forEach(row => {
        if (filter === 'all') {
            row.style.display = '';
        } else {
            const actionCell = row.querySelector('.action-badge');
            if (actionCell) {
                const actionText = actionCell.textContent.toLowerCase().trim();
                const filterMap = {
                    'cart': 'cart', 'wishlist': 'wishlist', 'view': 'view',
                    'search': 'search', 'register': 'register', 'login': 'login',
                    'review': 'review', 'share': 'share', 'checkout': 'checkout',
                    'purchase': 'purchase'
                };
                row.style.display = actionText.includes(filterMap[filter] || filter) ? '' : 'none';
            }
        }
    });

    updateActivityEntryInfo();
}

function updateActivityEntryInfo() {
    const rows = document.querySelectorAll('#activityTableBody tr');
    const visible = Array.from(rows).filter(row => row.style.display !== 'none');
    const total = rows.length;
    const info = document.getElementById('entryInfo');
    if (info) {
        info.textContent = `Showing ${visible.length} of ${total} entries`;
    }
}

function activityPrevPage() {
    if (activityCurrentPage > 1) {
        activityCurrentPage--;
        activityGoToPage(activityCurrentPage);
    }
}

function activityNextPage() {
    const totalRows = document.querySelectorAll('#activityTableBody tr').length;
    const totalPages = Math.ceil(totalRows / activityRowsPerPage);
    if (activityCurrentPage < totalPages) {
        activityCurrentPage++;
        activityGoToPage(activityCurrentPage);
    }
}

function activityGoToPage(page) {
    activityCurrentPage = page;
    const rows = document.querySelectorAll('#activityTableBody tr');
    const totalRows = rows.length;
    const totalPages = Math.ceil(totalRows / activityRowsPerPage);

    const btns = document.querySelectorAll('.pagination-btn');
    btns.forEach(btn => {
        btn.classList.remove('active');
        const btnText = btn.textContent.trim();
        if (parseInt(btnText) === page) {
            btn.classList.add('active');
        }
    });

    const start = (page - 1) * activityRowsPerPage;
    const end = start + activityRowsPerPage;

    rows.forEach((row, index) => {
        if (index >= start && index < end) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });

    updateActivityEntryInfo();
}

function prevPage() {
    activityPrevPage();
}

function nextPage() {
    activityNextPage();
}

function goToPage(page) {
    activityGoToPage(page);
}

// ========================================
// ABANDONED CART ACTIONS
// ========================================

function sendWhatsApp(customerName, amount) {
    const phone = getCustomerPhone(customerName);
    const message = `Hi ${customerName}! 👋\n\nWe noticed you left some items in your cart worth ${amount}.\n\nClick here to complete your purchase: https://yourstore.com/cart\n\nDon't miss out! 🛒`;
    const encodedMessage = encodeURIComponent(message);
    const whatsappUrl = `https://wa.me/${phone}?text=${encodedMessage}`;
    window.open(whatsappUrl, '_blank');
    showToast(`📱 WhatsApp message sent to ${customerName}`, 'success');
}

function sendEmail(customerName, amount) {
    const email = getCustomerEmail(customerName);
    const subject = `Complete Your Purchase - ${amount} Cart`;
    const body = `Hi ${customerName},\n\nWe noticed you left some items in your cart worth ${amount}.\n\nClick here to complete your purchase: https://yourstore.com/cart\n\nDon't miss out!\n\nRegards,\nE-Shop Team`;
    const mailtoUrl = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
    window.open(mailtoUrl, '_blank');
    showToast(`📧 Email sent to ${customerName}`, 'success');
}

function recoverCart(customerName) {
    const btn = event?.target?.closest('.btn-recover') || document.querySelector('.btn-recover');
    if (btn) {
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Recovering...';
        btn.disabled = true;

        setTimeout(() => {
            btn.innerHTML = '✅ Recovered!';
            btn.style.background = '#10B981';

            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.background = '#2563EB';
                btn.disabled = false;
            }, 2000);
        }, 1500);
    }
    showToast(`🔄 Cart recovery initiated for ${customerName}`, 'info');
    console.log(`Recovering cart for: ${customerName}`);
}

function getCustomerPhone(name) {
    const phones = {
        'Janani': '919876543210',
        'Kumar': '919876543211',
        'Hari': '919876543212',
        'Priya': '919876543213',
        'Arun': '919876543214'
    };
    return phones[name] || '919876543210';
}

function getCustomerEmail(name) {
    const emails = {
        'Janani': 'janani@email.com',
        'Kumar': 'kumar@email.com',
        'Hari': 'hari@email.com',
        'Priya': 'priya@email.com',
        'Arun': 'arun@email.com'
    };
    return emails[name] || 'customer@email.com';
}

// ============================================================
// SETTINGS PAGE - COMPLETE WORKING VERSION
// ============================================================

// ----- DATA STORE -----
let paymentMethods = [
    {
        id: 1,
        name: 'Bank Transfer',
        enabled: false,
        type: 'bank',
        details: {
            accountNumber: '1234567890',
            ifscCode: 'SBIN0001234',
            beneficiaryName: 'My Store Pvt Ltd',
            bankName: 'State Bank of India',
            branchName: 'Main Branch',
            accountType: 'Current'
        }
    },
    {
        id: 2,
        name: 'PayPal',
        enabled: false,
        type: 'paypal',
        details: {
            email: 'paypal@mystore.com',
            merchantId: 'PP-123456789',
            clientId: 'Abc123XYZ789',
            secret: '••••••••••••••'
        }
    },
    {
        id: 3,
        name: 'PhonePe',
        enabled: false,
        type: 'phonepe',
        details: {
            merchantId: 'PHONEPE123',
            apiKey: '••••••••••••••',
            upiId: 'store@phonepe'
        }
    },
    {
        id: 4,
        name: 'Google Pay',
        enabled: false,
        type: 'gpay',
        details: {
            upiId: 'store@gpay',
            merchantId: 'GP123456789'
        }
    },
    {
        id: 5,
        name: 'Credit Card',
        enabled: true,
        type: 'card',
        details: {
            gateway: 'Razorpay',
            merchantId: 'RZP123456',
            apiKey: 'rzp_live_xxxxxxxxxxxx',
            secret: '••••••••••••••',
            acceptedCards: 'Visa, Mastercard, Amex, RuPay'
        }
    },
    {
        id: 6,
        name: 'Cash',
        enabled: false,
        type: 'cash',
        details: {
            note: 'Cash on delivery available'
        }
    }
];

let taxRules = [
    { id: 1, category: 'Electronics', tax: '18%', applicable: 'All States' },
    { id: 2, category: 'Clothing', tax: '5%', applicable: 'All States' },
    { id: 3, category: 'Books', tax: '0%', applicable: 'All States' }
];

let locations = [
    { id: 1, name: 'Main Warehouse', address: '123, Main St', city: 'Chennai', status: 'Active' },
    { id: 2, name: 'Branch Office', address: '456, Anna Nagar', city: 'Chennai', status: 'Active' }
];

let deliveryMethods = [
    { id: 1, name: 'Standard', charge: '₹50', time: '3-5 Days', status: 'Active' },
    { id: 2, name: 'Express', charge: '₹150', time: '1-2 Days', status: 'Active' },
    { id: 3, name: 'Overnight', charge: '₹300', time: 'Next Day', status: 'Inactive' }
];

let staffList = [
    { id: 1, name: 'John Doe', email: 'john@email.com', role: 'Admin', status: 'Active' },
    { id: 2, name: 'Jane Smith', email: 'jane@email.com', role: 'Manager', status: 'Active' },
    { id: 3, name: 'Bob Wilson', email: 'bob@email.com', role: 'Staff', status: 'Inactive' }
];

let nextId = 100;

// ============================================================
// SETTINGS TOAST
// ============================================================
function showSettingsToast(msg) {
    showToast(msg, 'success');
}

// ============================================================
// SAVE SETTING
// ============================================================
function saveSetting() {
    showToast('Settings saved successfully!', 'success');
}

function saveSubModal() {
    showToast('Action completed!', 'success');
}

// ============================================================
// TAB SWITCHING
// ============================================================
function switchTab(tab) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
    const btn = document.querySelector(`.tab-btn[data-tab="${tab}"]`);
    if (btn) btn.classList.add('active');
    const pane = document.getElementById('tab-' + tab);
    if (pane) pane.classList.add('active');
}

// ============================================================
// TOGGLE FUNCTIONS
// ============================================================
function togglePaymentGateways(el) {
    const container = document.getElementById('paymentGateways');
    if (container) {
        container.style.opacity = el.checked ? '1' : '0.5';
        container.style.pointerEvents = el.checked ? 'auto' : 'none';
    }
}

function toggleSocialLinks(el) {
    const container = document.getElementById('socialLinksContent');
    if (container) {
        container.style.opacity = el.checked ? '1' : '0.4';
        container.style.pointerEvents = el.checked ? 'auto' : 'none';
    }
}

function toggleStaff(el) {
    const container = document.getElementById('staffContent');
    if (container) {
        container.style.opacity = el.checked ? '1' : '0.4';
        container.style.pointerEvents = el.checked ? 'auto' : 'none';
    }
}

function toggleOtp(el) {
    const container = document.getElementById('otpContent');
    if (container) {
        container.style.opacity = el.checked ? '1' : '0.4';
        container.style.pointerEvents = el.checked ? 'auto' : 'none';
    }
}

function showGatewayConfig(value) {
    document.querySelectorAll('.gateway-config').forEach(el => el.style.display = 'none');
    const config = document.getElementById(value + 'Config');
    if (config) config.style.display = 'block';
}

function showProviderConfig(value) {
    document.querySelectorAll('.provider-config').forEach(el => el.style.display = 'none');
    const config = document.getElementById(value + 'Config');
    if (config) config.style.display = 'block';
}

// ============================================================
// PAYMENT METHODS - FULL CRUD
// ============================================================
function togglePaymentMethod(id) {
    const method = paymentMethods.find(m => m.id === id);
    if (method) {
        method.enabled = !method.enabled;
        renderPaymentMethods();
        showToast(`${method.name} ${method.enabled ? 'enabled' : 'disabled'}!`, 'success');
    }
}

function getPaymentFormHTML(method) {
    const type = method ? method.type : 'bank';
    const d = method ? method.details : {};

    const forms = {
        'bank': `
            <div class="form-group"><label>Account Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="bankAccount" value="${d.accountNumber || ''}" placeholder="Enter account number"></div>
            <div class="form-group"><label>IFSC Code <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="bankIfsc" value="${d.ifscCode || ''}" placeholder="Enter IFSC code"></div>
            <div class="form-group"><label>Beneficiary Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="bankBeneficiary" value="${d.beneficiaryName || ''}" placeholder="Enter beneficiary name"></div>
            <div class="form-group"><label>Bank Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="bankName" value="${d.bankName || ''}" placeholder="Enter bank name"></div>
            <div class="form-group"><label>Branch Name</label>
                <input type="text" class="form-control" id="bankBranch" value="${d.branchName || ''}" placeholder="Enter branch name"></div>
            <div class="form-group"><label>Account Type</label>
                <select class="form-control" id="bankAccountType">
                    <option value="Current" ${d.accountType === 'Current' ? 'selected' : ''}>Current</option>
                    <option value="Savings" ${d.accountType === 'Savings' ? 'selected' : ''}>Savings</option>
                </select>
            </div>
        `,
        'paypal': `
            <div class="form-group"><label>PayPal Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="paypalEmail" value="${d.email || ''}" placeholder="Enter PayPal email"></div>
            <div class="form-group"><label>Merchant ID</label>
                <input type="text" class="form-control" id="paypalMerchantId" value="${d.merchantId || ''}" placeholder="Enter merchant ID"></div>
            <div class="form-group"><label>Client ID</label>
                <input type="text" class="form-control" id="paypalClientId" value="${d.clientId || ''}" placeholder="Enter client ID"></div>
            <div class="form-group"><label>Secret</label>
                <input type="password" class="form-control" id="paypalSecret" value="${d.secret || ''}" placeholder="Enter secret"></div>
        `,
        'phonepe': `
            <div class="form-group"><label>Merchant ID <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="phonepeMerchantId" value="${d.merchantId || ''}" placeholder="Enter merchant ID"></div>
            <div class="form-group"><label>API Key</label>
                <input type="password" class="form-control" id="phonepeApiKey" value="${d.apiKey || ''}" placeholder="Enter API key"></div>
            <div class="form-group"><label>UPI ID <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="phonepeUpi" value="${d.upiId || ''}" placeholder="Enter UPI ID"></div>
            <div class="form-group"><label>QR Code</label>
                <div style="border:2px dashed #DBEAFE; border-radius:12px; padding:15px; text-align:center; background:#F8FAFC;">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=upi://pay?pa=${d.upiId || 'store@phonepe'}" alt="QR" style="width:80px; height:80px;">
                    <p style="margin-top:5px; font-size:12px; color:#64748B;">UPI ID: ${d.upiId || 'store@phonepe'}</p>
                </div>
            </div>
        `,
        'gpay': `
            <div class="form-group"><label>UPI ID <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="gpayUpi" value="${d.upiId || ''}" placeholder="Enter UPI ID"></div>
            <div class="form-group"><label>Merchant ID</label>
                <input type="text" class="form-control" id="gpayMerchantId" value="${d.merchantId || ''}" placeholder="Enter merchant ID"></div>
            <div class="form-group"><label>QR Code</label>
                <div style="border:2px dashed #DBEAFE; border-radius:12px; padding:15px; text-align:center; background:#F8FAFC;">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=upi://pay?pa=${d.upiId || 'store@gpay'}" alt="QR" style="width:80px; height:80px;">
                    <p style="margin-top:5px; font-size:12px; color:#64748B;">UPI ID: ${d.upiId || 'store@gpay'}</p>
                </div>
            </div>
        `,
        'card': `
            <div class="form-group"><label>Gateway <span class="text-danger">*</span></label>
                <select class="form-control" id="cardGateway">
                    <option value="Razorpay" ${d.gateway === 'Razorpay' ? 'selected' : ''}>Razorpay</option>
                    <option value="Stripe" ${d.gateway === 'Stripe' ? 'selected' : ''}>Stripe</option>
                    <option value="PayU" ${d.gateway === 'PayU' ? 'selected' : ''}>PayU</option>
                </select>
            </div>
            <div class="form-group"><label>Merchant ID</label>
                <input type="text" class="form-control" id="cardMerchantId" value="${d.merchantId || ''}" placeholder="Enter merchant ID"></div>
            <div class="form-group"><label>API Key</label>
                <input type="text" class="form-control" id="cardApiKey" value="${d.apiKey || ''}" placeholder="Enter API key"></div>
            <div class="form-group"><label>Secret</label>
                <input type="password" class="form-control" id="cardSecret" value="${d.secret || ''}" placeholder="Enter secret"></div>
            <div class="form-group"><label>Accepted Cards</label>
                <input type="text" class="form-control" id="cardAccepted" value="${d.acceptedCards || ''}" placeholder="e.g. Visa, Mastercard, Amex"></div>
        `,
        'cash': `
            <div class="form-group"><label>Note</label>
                <input type="text" class="form-control" id="cashNote" value="${d.note || ''}" placeholder="Cash on delivery available"></div>
        `
    };

    return forms[type] || forms['bank'];
}

function editPaymentMethod(id) {
    const method = paymentMethods.find(m => m.id === id);
    if (method) {
        window.location.href = 'edit-payment.php?id=' + id;
    }
}

function deletePaymentMethod(id) {
    if (confirm('Are you sure you want to delete this payment method?')) {
        paymentMethods = paymentMethods.filter(m => m.id !== id);
        renderPaymentMethods();
        showToast('Payment method deleted!', 'success');
    }
}

function addPaymentMethod() {
    window.location.href = 'add-payment.php';
}

function renderPaymentMethods() {
    const container = document.getElementById('paymentMethodsList');
    if (!container) return;

    let html = '';
    paymentMethods.forEach(m => {
        const typeLabel = {
            'bank': '🏦',
            'paypal': '💳',
            'phonepe': '📱',
            'gpay': '🔵',
            'card': '💳',
            'cash': '💵'
        }[m.type] || '📌';

        let detailPreview = '';
        if (m.type === 'bank') {
            detailPreview = `${m.details.bankName} - ${m.details.accountNumber}`;
        } else if (m.type === 'paypal') {
            detailPreview = m.details.email;
        } else if (m.type === 'phonepe' || m.type === 'gpay') {
            detailPreview = m.details.upiId;
        } else if (m.type === 'card') {
            detailPreview = m.details.gateway;
        } else {
            detailPreview = m.details.note || '';
        }

        html += `
            <div class="toggle-group">
                <label class="toggle-switch">
                    <input type="checkbox" ${m.enabled ? 'checked' : ''} onchange="togglePaymentMethod(${m.id})">
                    <span class="slider"></span>
                </label>
                <div style="flex:1;">
                    <div class="toggle-label">${typeLabel} ${m.name}</div>
                    <div class="toggle-desc" style="font-size:11px; color:#94A3B8;">${detailPreview}</div>
                </div>
                <div>
                    <button class="btn btn-sm btn-primary" onclick="editPaymentMethod(${m.id})"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger" onclick="deletePaymentMethod(${m.id})"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        `;
    });
    html += `<button class="btn btn-secondary btn-sm" onclick="addPaymentMethod()">+ Add Method</button>`;
    container.innerHTML = html;
}

// ============================================================
// TAX RULES - CRUD
// ============================================================
function renderTaxRules() {
    const container = document.getElementById('taxRulesList');
    if (!container) return;
    let html = '';
    taxRules.forEach(r => {
        html += `
            <tr>
                <td>${r.category}</td>
                <td>${r.tax}</td>
                <td>${r.applicable}</td>
                <td>
                    <button class="btn btn-sm btn-primary" onclick="editTaxRule(${r.id})"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger" onclick="deleteTaxRule(${r.id})"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        `;
    });
    container.innerHTML = html;
}

function deleteTaxRule(id) {
    if (confirm('Delete this tax rule?')) {
        taxRules = taxRules.filter(r => r.id !== id);
        renderTaxRules();
        showToast('Tax rule deleted!', 'success');
    }
}

function editTaxRule(id) {
    const rule = taxRules.find(r => r.id === id);
    if (rule) {
        window.location.href = 'edit-tax.php?id=' + id;
    }
}

function addTaxRule() {
    window.location.href = 'add-tax.php';
}

// ============================================================
// LOCATIONS - CRUD
// ============================================================
function renderLocations() {
    const container = document.getElementById('locationsList');
    if (!container) return;
    let html = '';
    locations.forEach(l => {
        const badge = l.status === 'Active' ? 'bg-success' : 'bg-danger';
        html += `
            <tr>
                <td>${l.name}</td>
                <td>${l.address}</td>
                <td>${l.city}</td>
                <td><span class="badge ${badge}">${l.status}</span></td>
                <td>
                    <button class="btn btn-sm btn-primary" onclick="editLocation(${l.id})"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger" onclick="deleteLocation(${l.id})"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        `;
    });
    container.innerHTML = html;
}

function deleteLocation(id) {
    if (confirm('Delete this location?')) {
        locations = locations.filter(l => l.id !== id);
        renderLocations();
        showToast('Location deleted!', 'success');
    }
}

function editLocation(id) {
    const loc = locations.find(l => l.id === id);
    if (loc) {
        window.location.href = 'edit-location.php?id=' + id;
    }
}

function addLocation() {
    window.location.href = 'add-location.php';
}

// ============================================================
// DELIVERY METHODS - CRUD
// ============================================================
function renderDeliveryMethods() {
    const container = document.getElementById('deliveryMethodsList');
    if (!container) return;
    let html = '';
    deliveryMethods.forEach(d => {
        const badge = d.status === 'Active' ? 'bg-success' : 'bg-danger';
        html += `
            <tr>
                <td>${d.name}</td>
                <td>${d.charge}</td>
                <td>${d.time}</td>
                <td><span class="badge ${badge}">${d.status}</span></td>
                <td>
                    <button class="btn btn-sm btn-primary" onclick="editDeliveryMethod(${d.id})"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger" onclick="deleteDeliveryMethod(${d.id})"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        `;
    });
    container.innerHTML = html;
}

function deleteDeliveryMethod(id) {
    if (confirm('Delete this delivery method?')) {
        deliveryMethods = deliveryMethods.filter(d => d.id !== id);
        renderDeliveryMethods();
        showToast('Delivery method deleted!', 'success');
    }
}

function editDeliveryMethod(id) {
    const method = deliveryMethods.find(d => d.id === id);
    if (method) {
        window.location.href = 'edit-delivery.php?id=' + id;
    }
}

function addDeliveryMethod() {
    window.location.href = 'add-delivery.php';
}

// ============================================================
// STAFF - CRUD (FULLY WORKING)
// ============================================================
function renderStaff() {
    const container = document.getElementById('staffList');
    if (!container) return;
    if (staffList.length === 0) {
        container.innerHTML = `<tr><td colspan="5" class="text-center text-muted">No staff members found</td></tr>`;
        return;
    }
    let html = '';
    staffList.forEach(s => {
        const badge = s.status === 'Active' ? 'bg-success' : 'bg-danger';
        html += `
            <tr>
                <td><strong>${s.name}</strong></td>
                <td>${s.email}</td>
                <td>${s.role}</td>
                <td><span class="badge ${badge}">${s.status}</span></td>
                <td>
                    <button class="btn btn-sm btn-primary" onclick="editStaff(${s.id})"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger" onclick="deleteStaff(${s.id})"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        `;
    });
    container.innerHTML = html;
}

function deleteStaff(id) {
    if (confirm('Delete this staff member?')) {
        staffList = staffList.filter(s => s.id !== id);
        renderStaff();
        showToast('Staff deleted!', 'success');
    }
}

function editStaff(id) {
    const staff = staffList.find(s => s.id === id);
    if (!staff) {
        showToast('Staff not found!', 'error');
        return;
    }
    window.location.href = 'edit-staff.php?id=' + id;
}

function addStaffFromForm() {
    const name = document.getElementById('newStaffNameForm')?.value;
    const email = document.getElementById('newStaffEmailForm')?.value;
    const role = document.getElementById('newStaffRoleForm')?.value;
    const password = document.getElementById('newStaffPassForm')?.value;

    if (!name || !email || !password) {
        showToast('Please fill all required fields!', 'error');
        return;
    }

    staffList.push({
        id: ++nextId,
        name: name,
        email: email,
        role: role || 'Staff',
        status: 'Active'
    });
    renderStaff();
    showToast(`Staff "${name}" added successfully!`, 'success');

    document.getElementById('newStaffNameForm').value = '';
    document.getElementById('newStaffEmailForm').value = '';
    document.getElementById('newStaffPassForm').value = '';
}

// ============================================================
// OPEN SETTING (REDIRECT TO NEW PAGE)
// ============================================================
function openSetting(setting) {
    window.location.href = '../settings/' + setting + '.php';
}

// ============================================================
// LOGOUT FUNCTIONS
// ============================================================
function openLogoutModal(e) {
    if (e) e.preventDefault();
    const modalElement = document.getElementById('logoutModal');
    if (modalElement) {
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
    } else {
        if (confirm('Are you sure you want to logout?')) {
            window.location.href = 'index.php';
        }
    }
}

function confirmLogout() {
    const btn = document.querySelector('#logoutModal .btn-danger');
    if (btn) {
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging out...';
        btn.disabled = true;
        setTimeout(function () {
            const modal = bootstrap.Modal.getInstance(document.getElementById('logoutModal'));
            if (modal) modal.hide();
            window.location.href = 'index.php';
        }, 800);
    } else {
        window.location.href = 'index.php';
    }
}

// ==========================================
// PRODUCTS FUNCTIONALITY
// ==========================================

let editingRow = null;

document.getElementById('saveProductBtn')?.addEventListener('click', function () {
    const name = document.getElementById('productName').value.trim();
    if (!name) { showToast('Please enter product name', 'warning'); return; }
    showToast('Product added successfully!', 'success');
});

console.log('Products page initialized');

// ==========================================
// CATEGORIES FUNCTIONALITY
// ==========================================

document.getElementById('saveCategoryBtn')?.addEventListener('click', function () {
    const name = document.getElementById('categoryName').value.trim();
    if (!name) { showToast('Please enter category name', 'warning'); return; }
    showToast('Category added successfully!', 'success');
});

console.log('Product Categories page initialized');

// ==========================================
// STOCK MANAGEMENT FUNCTIONALITY
// ==========================================

document.getElementById('updateStockBtn')?.addEventListener('click', function () {
    showToast('Stock updated successfully!', 'success');
});

console.log('Stock Management page initialized');

// ==========================================
// DISCOUNTS FUNCTIONALITY
// ==========================================

document.getElementById('saveDiscountBtn')?.addEventListener('click', function () {
    const code = document.getElementById('couponCode').value.trim().toUpperCase();
    if (!code) { showToast('Please enter coupon code', 'warning'); return; }
    showToast(`Coupon "${code}" created successfully!`, 'success');
});

console.log('Discounts page initialized');

// ==========================================
// UTILITY FUNCTIONS
// ==========================================

function updatePaginationInfo() {
    const tables = [
        { id: 'productTableBody', info: document.getElementById('paginationInfo') },
        { id: 'categoryTableBody', info: document.getElementById('categoryPaginationInfo') },
        { id: 'discountTableBody', info: document.getElementById('discountPaginationInfo') }
    ];

    tables.forEach(({ id, info }) => {
        if (info) {
            const tbody = document.getElementById(id);
            if (tbody) {
                const visibleRows = tbody.querySelectorAll('tr:not([style*="display: none"])');
                const totalRows = tbody.querySelectorAll('tr').length;
                const start = visibleRows.length > 0 ? 1 : 0;
                const end = visibleRows.length;
                info.textContent = `Showing ${start} to ${end} of ${totalRows} entries`;
            }
        }
    });
}

// ---- SLIDE IN ANIMATION ----
const styleEl = document.createElement('style');
styleEl.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
`;
document.head.appendChild(styleEl);

// ============================================================
// PROFILE DROPDOWN TOGGLE
// ============================================================

function toggleProfileDropdown(e) {
    e.stopPropagation();
    const dropdown = document.getElementById('profileDropdown');
    dropdown.classList.toggle('show');
}

document.addEventListener('click', function (e) {
    const dropdown = document.getElementById('profileDropdown');
    const profile = document.querySelector('.admin-profile');
    if (dropdown && !dropdown.contains(e.target) && !profile.contains(e.target)) {
        dropdown.classList.remove('show');
    }
});

function openProfileModal(e) {
    if (e) e.preventDefault();
    const dropdown = document.getElementById('profileDropdown');
    dropdown.classList.remove('show');
    const modal = new bootstrap.Modal(document.getElementById('profileModal'));
    modal.show();
}

function editProfile() {
    showToast('Edit profile form will open here!', 'info');
    bootstrap.Modal.getInstance(document.getElementById('profileModal')).hide();
}
// ============================================================
// SYSTEM PREFERENCE - SAVE FUNCTION
// ============================================================
function saveSystemPreferences() {
    // Get all form values
    const language = document.querySelector('select[name="language"]')?.value;
    const currency = document.querySelector('select[name="currency"]')?.value;
    const timezone = document.querySelector('select[name="timezone"]')?.value;
    const dateFormat = document.querySelector('select[name="date_format"]')?.value;
    const timeFormat = document.querySelector('select[name="time_format"]')?.value;
    const region = document.querySelector('select[name="region"]')?.value;

    // Validate (optional)
    if (!language) {
        showToast('Please select a language', 'warning');
        return false;
    }

    // Show success toast
    showToast('System preferences saved successfully!', 'success');

    // Return true to allow form submission
    return true;
}





// ============================================================
// STORE INFORMATION - SAVE FUNCTION
// ============================================================
function saveStoreInformation() {
    // Get all form values
    const storeName = document.querySelector('input[name="store_name"]')?.value;
    const storeEmail = document.querySelector('input[name="store_email"]')?.value;
    const phone = document.querySelector('input[name="phone"]')?.value;
    const address = document.querySelector('textarea[name="address"]')?.value;
    const city = document.querySelector('input[name="city"]')?.value;
    const state = document.querySelector('input[name="state"]')?.value;
    const pincode = document.querySelector('input[name="pincode"]')?.value;
    const country = document.querySelector('input[name="country"]')?.value;
    const gst = document.querySelector('input[name="gst"]')?.value;

    // Validate
    if (!storeName) {
        showToast('Please enter store name', 'warning');
        return false;
    }

    if (!storeEmail) {
        showToast('Please enter store email', 'warning');
        return false;
    }

    // Show success toast
    showToast('Store information saved successfully!', 'success');

    // Return true to allow form submission
    return true;
}

// ============================================================
// ACCOUNT OVERVIEW - FUNCTIONS
// ============================================================

function upgradePlan() {
    // Show a toast notification
    showToast('Opening upgrade plan options...', 'info');

    // You can also open a modal or redirect
    // Example: window.location.href = 'upgrade-plan.php';

    // Or show a custom alert/modal
    // For demo, we'll just show the toast
}

function rechargeBalance() {
    // Show a toast notification
    showToast('Opening recharge balance page...', 'info');

    // You can also open a modal or redirect
    // Example: window.location.href = 'recharge-balance.php';
}

function viewHistory() {
    // Show a toast notification
    showToast('Loading transaction history...', 'info');

    // You can also open a modal or redirect
    // Example: window.location.href = 'transaction-history.php';
}

// ============================================================
// NOTIFICATIONS - FUNCTIONS
// ============================================================

function toggleNotification(checkbox, type) {
    const statusMap = {
        'push': 'pushStatus',
        'email': 'emailStatus',
        'order': 'orderStatus',
        'promo': 'promoStatus'
    };

    const statusId = statusMap[type];
    const statusEl = document.getElementById(statusId);

    if (checkbox.checked) {
        // Update toggle background
        const toggleSpan = checkbox.parentElement.querySelector('span');
        toggleSpan.style.background = '#2563EB';
        const innerSpan = toggleSpan.querySelector('span');
        if (innerSpan) {
            innerSpan.style.transform = 'translateX(22px)';
        }

        // Update status text
        if (statusEl) {
            statusEl.textContent = 'Enabled';
            statusEl.style.color = '#10B981';
        }
    } else {
        // Update toggle background
        const toggleSpan = checkbox.parentElement.querySelector('span');
        toggleSpan.style.background = '#CBD5E1';
        const innerSpan = toggleSpan.querySelector('span');
        if (innerSpan) {
            innerSpan.style.transform = 'translateX(0)';
        }

        // Update status text
        if (statusEl) {
            statusEl.textContent = 'Disabled';
            statusEl.style.color = '#94A3B8';
        }
    }
}

function saveNotifications() {
    // Get all checkbox values
    const push = document.querySelector('input[name="push_notifications"]')?.checked;
    const email = document.querySelector('input[name="email_notifications"]')?.checked;
    const order = document.querySelector('input[name="order_updates"]')?.checked;
    const promo = document.querySelector('input[name="promotional_updates"]')?.checked;

    // Build status message
    const enabled = [];
    if (push) enabled.push('Push');
    if (email) enabled.push('Email');
    if (order) enabled.push('Order Updates');
    if (promo) enabled.push('Promotional');

    // Show toast
    if (enabled.length > 0) {
        showToast(`✅ Notification settings saved! (${enabled.join(', ')})`, 'success');
    } else {
        showToast('✅ All notifications disabled!', 'info');
    }

    // Return true to allow form submission
    return true;
}


// ============================================================
// ACCOUNT VISIBILITY - FUNCTIONS
// ============================================================

function toggleVisibility(checkbox, type) {
    const statusMap = {
        'public': 'publicStatus',
        'email': 'emailStatus',
        'phone': 'phoneStatus',
        'activity': 'activityStatus'
    };

    const statusId = statusMap[type];
    const statusEl = document.getElementById(statusId);

    if (checkbox.checked) {
        // Update toggle background
        const toggleSpan = checkbox.parentElement.querySelector('span');
        toggleSpan.style.background = '#2563EB';
        const innerSpan = toggleSpan.querySelector('span');
        if (innerSpan) {
            innerSpan.style.transform = 'translateX(22px)';
        }

        // Update status text
        if (statusEl) {
            statusEl.textContent = 'Enabled';
            statusEl.style.color = '#10B981';
        }
    } else {
        // Update toggle background
        const toggleSpan = checkbox.parentElement.querySelector('span');
        toggleSpan.style.background = '#CBD5E1';
        const innerSpan = toggleSpan.querySelector('span');
        if (innerSpan) {
            innerSpan.style.transform = 'translateX(0)';
        }

        // Update status text
        if (statusEl) {
            statusEl.textContent = 'Disabled';
            statusEl.style.color = '#94A3B8';
        }
    }
}

function saveVisibility() {
    // Get all checkbox values
    const publicProfile = document.querySelector('input[name="public_profile"]')?.checked;
    const showEmail = document.querySelector('input[name="show_email"]')?.checked;
    const showPhone = document.querySelector('input[name="show_phone"]')?.checked;
    const activityStatus = document.querySelector('input[name="activity_status"]')?.checked;

    // Build status message
    const enabled = [];
    if (publicProfile) enabled.push('Public Profile');
    if (showEmail) enabled.push('Email');
    if (showPhone) enabled.push('Phone');
    if (activityStatus) enabled.push('Activity Status');

    // Show toast
    if (enabled.length > 0) {
        showToast(`✅ Visibility settings saved! (${enabled.join(', ')})`, 'success');
    } else {
        showToast('✅ All visibility settings disabled!', 'info');
    }

    // Return true to allow form submission
    return true;
}

// ============================================================
// TAXES - FUNCTIONS
// ============================================================

function toggleTaxToggle(checkbox, type) {
    const statusMap = {
        'gst': { statusId: 'gstStatus', fieldId: 'gstField' },
        'state': { statusId: 'stateStatus', fieldId: null },
        'include': { statusId: 'includeStatus', fieldId: null }
    };

    const config = statusMap[type];
    const statusEl = document.getElementById(config.statusId);
    const fieldEl = config.fieldId ? document.getElementById(config.fieldId) : null;

    if (checkbox.checked) {
        // ENABLED - Toggle ON
        const toggleSpan = checkbox.parentElement.querySelector('span');
        toggleSpan.style.background = '#2563EB';
        const innerSpan = toggleSpan.querySelector('span');
        if (innerSpan) {
            innerSpan.style.transform = 'translateX(22px)';
        }

        // Update status text
        if (statusEl) {
            statusEl.textContent = 'Enabled';
            statusEl.style.color = '#10B981';
        }

        // Enable the field (remove disabled state)
        if (fieldEl) {
            fieldEl.style.opacity = '1';
            fieldEl.style.pointerEvents = 'auto';
            const select = fieldEl.querySelector('select');
            if (select) {
                select.disabled = false;
                select.style.opacity = '1';
                select.style.background = '#FFFFFF';
            }
        }
    } else {
        // DISABLED - Toggle OFF
        const toggleSpan = checkbox.parentElement.querySelector('span');
        toggleSpan.style.background = '#CBD5E1';
        const innerSpan = toggleSpan.querySelector('span');
        if (innerSpan) {
            innerSpan.style.transform = 'translateX(0)';
        }

        // Update status text
        if (statusEl) {
            statusEl.textContent = 'Disabled';
            statusEl.style.color = '#94A3B8';
        }

        // Disable the field (grey out)
        if (fieldEl) {
            fieldEl.style.opacity = '0.5';
            fieldEl.style.pointerEvents = 'none';
            const select = fieldEl.querySelector('select');
            if (select) {
                select.disabled = true;
                select.style.opacity = '0.5';
                select.style.background = '#F1F5F9';
            }
        }
    }
}

function saveTaxSettings() {
    const gst = document.querySelector('input[name="enable_gst"]')?.checked;
    const stateTax = document.querySelector('input[name="enable_state_tax"]')?.checked;
    const includeTax = document.querySelector('input[name="include_tax"]')?.checked;
    const gstPercent = document.querySelector('select[name="gst_percentage"]')?.value;

    const enabled = [];
    if (gst) enabled.push(`GST (${gstPercent})`);
    if (stateTax) enabled.push('State Tax');
    if (includeTax) enabled.push('Tax Included in Price');

    if (enabled.length > 0) {
        showToast(`✅ Tax settings saved! (${enabled.join(', ')})`, 'success');
    } else {
        showToast('✅ All taxes disabled!', 'info');
    }

    return true;
}
// ============================================================
// TAX RULES - ADD/EDIT FUNCTIONS
// ============================================================

function saveTaxRule() {
    const category = document.querySelector('input[name="category"]')?.value;
    const taxPercent = document.querySelector('select[name="tax_percent"]')?.value;
    const applicable = document.querySelector('select[name="applicable"]')?.value;

    if (!category || !taxPercent || !applicable) {
        showToast('Please fill in all required fields!', 'error');
        return false;
    }

    showToast(`✅ Tax rule "${category}" added successfully!`, 'success');
    return true;
}

function updateTaxRule() {
    const category = document.querySelector('input[name="category"]')?.value;
    const taxPercent = document.querySelector('select[name="tax_percent"]')?.value;
    const applicable = document.querySelector('select[name="applicable"]')?.value;

    if (!category || !taxPercent || !applicable) {
        showToast('Please fill in all required fields!', 'error');
        return false;
    }

    showToast(`✅ Tax rule "${category}" updated successfully!`, 'success');
    return true;
}


// ============================================================
// LOCATIONS - FUNCTIONS
// ============================================================

function saveLocations() {
    showToast('✅ Location settings saved successfully!', 'success');
    return true;
}

function saveLocation() {
    const name = document.querySelector('input[name="name"]')?.value;
    const address = document.querySelector('textarea[name="address"]')?.value;
    const city = document.querySelector('input[name="city"]')?.value;

    if (!name || !address || !city) {
        showToast('Please fill in all required fields!', 'error');
        return false;
    }

    showToast(`✅ Location "${name}" added successfully!`, 'success');
    return true;
}

function updateLocation() {
    const name = document.querySelector('input[name="name"]')?.value;
    const address = document.querySelector('textarea[name="address"]')?.value;
    const city = document.querySelector('input[name="city"]')?.value;

    if (!name || !address || !city) {
        showToast('Please fill in all required fields!', 'error');
        return false;
    }

    showToast(`✅ Location "${name}" updated successfully!`, 'success');
    return true;
}

// ============================================================
// DELIVERY METHODS - FUNCTIONS
// ============================================================

function toggleDeliveryToggle(checkbox) {
    const statusEl = document.getElementById('shippingStatus');

    if (checkbox.checked) {
        const toggleSpan = checkbox.parentElement.querySelector('span');
        toggleSpan.style.background = '#2563EB';
        const innerSpan = toggleSpan.querySelector('span');
        if (innerSpan) {
            innerSpan.style.transform = 'translateX(22px)';
        }
        if (statusEl) {
            statusEl.textContent = 'Enabled';
            statusEl.style.color = '#10B981';
        }
    } else {
        const toggleSpan = checkbox.parentElement.querySelector('span');
        toggleSpan.style.background = '#CBD5E1';
        const innerSpan = toggleSpan.querySelector('span');
        if (innerSpan) {
            innerSpan.style.transform = 'translateX(0)';
        }
        if (statusEl) {
            statusEl.textContent = 'Disabled';
            statusEl.style.color = '#94A3B8';
        }
    }
}

function saveDeliverySettings() {
    const shipping = document.querySelector('input[name="enable_shipping"]')?.checked;
    const freeShipping = document.querySelector('input[name="free_shipping"]')?.value;

    showToast(`✅ Delivery settings saved! (Shipping: ${shipping ? 'Enabled' : 'Disabled'})`, 'success');
    return true;
}

function saveDeliveryMethod() {
    const name = document.querySelector('input[name="name"]')?.value;
    const charge = document.querySelector('input[name="charge"]')?.value;
    const time = document.querySelector('input[name="time"]')?.value;

    if (!name || !charge || !time) {
        showToast('Please fill in all required fields!', 'error');
        return false;
    }

    showToast(`✅ Delivery method "${name}" added successfully!`, 'success');
    return true;
}

function updateDeliveryMethod() {
    const name = document.querySelector('input[name="name"]')?.value;
    const charge = document.querySelector('input[name="charge"]')?.value;
    const time = document.querySelector('input[name="time"]')?.value;

    if (!name || !charge || !time) {
        showToast('Please fill in all required fields!', 'error');
        return false;
    }

    showToast(`✅ Delivery method "${name}" updated successfully!`, 'success');
    return true;
}

// ============================================================
// STAFF MANAGEMENT - FUNCTIONS
// ============================================================

function toggleStaffManagement(checkbox) {
    const statusEl = document.getElementById('staffStatus');
    const contentEl = document.getElementById('staffContent');

    if (checkbox.checked) {
        // ENABLED
        const toggleSpan = checkbox.parentElement.querySelector('span');
        toggleSpan.style.background = '#2563EB';
        const innerSpan = toggleSpan.querySelector('span');
        if (innerSpan) {
            innerSpan.style.transform = 'translateX(22px)';
        }
        if (statusEl) {
            statusEl.textContent = 'Enabled';
            statusEl.style.color = '#10B981';
        }
        // Show staff content
        if (contentEl) {
            contentEl.style.display = 'block';
            contentEl.style.opacity = '1';
            contentEl.style.pointerEvents = 'auto';
        }
    } else {
        // DISABLED
        const toggleSpan = checkbox.parentElement.querySelector('span');
        toggleSpan.style.background = '#CBD5E1';
        const innerSpan = toggleSpan.querySelector('span');
        if (innerSpan) {
            innerSpan.style.transform = 'translateX(0)';
        }
        if (statusEl) {
            statusEl.textContent = 'Disabled';
            statusEl.style.color = '#94A3B8';
        }
        // Hide staff content
        if (contentEl) {
            contentEl.style.display = 'none';
            contentEl.style.opacity = '0.5';
            contentEl.style.pointerEvents = 'none';
        }
    }
}
// ============================================================
// STAFF - UPDATE FUNCTION
// ============================================================

function updateStaffMember() {
    const name = document.querySelector('input[name="name"]')?.value;
    const email = document.querySelector('input[name="email"]')?.value;

    if (!name || !email) {
        showToast('Please fill in all required fields!', 'error');
        return false;
    }

    showToast(`✅ Staff "${name}" updated successfully!`, 'success');
    return true;
}

// ============================================================
// SOCIAL LINKS - FUNCTIONS
// ============================================================

function toggleSocialLinks(checkbox) {
    const statusEl = document.getElementById('socialStatus');
    const contentEl = document.getElementById('socialLinksContent');

    if (checkbox.checked) {
        // ENABLED - Show all social link fields
        const toggleSpan = checkbox.parentElement.querySelector('span');
        toggleSpan.style.background = '#2563EB';
        const innerSpan = toggleSpan.querySelector('span');
        if (innerSpan) {
            innerSpan.style.transform = 'translateX(22px)';
        }
        if (statusEl) {
            statusEl.textContent = 'Enabled';
            statusEl.style.color = '#10B981';
        }
        if (contentEl) {
            contentEl.style.display = 'block';
            contentEl.style.opacity = '1';
            contentEl.style.pointerEvents = 'auto';
            // Enable all inputs inside
            const inputs = contentEl.querySelectorAll('input');
            inputs.forEach(input => {
                input.disabled = false;
                input.style.opacity = '1';
                input.style.background = '#FFFFFF';
            });
        }
    } else {
        // DISABLED - Hide all social link fields
        const toggleSpan = checkbox.parentElement.querySelector('span');
        toggleSpan.style.background = '#CBD5E1';
        const innerSpan = toggleSpan.querySelector('span');
        if (innerSpan) {
            innerSpan.style.transform = 'translateX(0)';
        }
        if (statusEl) {
            statusEl.textContent = 'Disabled';
            statusEl.style.color = '#94A3B8';
        }
        if (contentEl) {
            contentEl.style.display = 'none';
            contentEl.style.opacity = '0.5';
            contentEl.style.pointerEvents = 'none';
            // Disable all inputs inside
            const inputs = contentEl.querySelectorAll('input');
            inputs.forEach(input => {
                input.disabled = true;
                input.style.opacity = '0.5';
                input.style.background = '#F1F5F9';
            });
        }
    }
}

function saveSocialLinks() {
    const enabled = document.querySelector('input[name="enable_social"]')?.checked;

    showToast(`✅ Social links ${enabled ? 'enabled' : 'disabled'} and saved!`, 'success');
    return true;
}


// ============================================================
// SMS OTP - FUNCTIONS
// ============================================================

function toggleSmsMain(checkbox) {
    const statusEl = document.getElementById('smsMainStatus');
    const contentEl = document.getElementById('otpContent');

    if (checkbox.checked) {
        // ENABLED - Show all OTP settings
        const toggleSpan = checkbox.parentElement.querySelector('span');
        toggleSpan.style.background = '#2563EB';
        const innerSpan = toggleSpan.querySelector('span');
        if (innerSpan) {
            innerSpan.style.transform = 'translateX(22px)';
        }
        if (statusEl) {
            statusEl.textContent = 'Enabled';
            statusEl.style.color = '#10B981';
        }
        if (contentEl) {
            contentEl.style.display = 'block';
            contentEl.style.opacity = '1';
            contentEl.style.pointerEvents = 'auto';
            // Enable all inputs inside
            const inputs = contentEl.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.disabled = false;
                input.style.opacity = '1';
                input.style.background = '#FFFFFF';
            });
        }
    } else {
        // DISABLED - Hide all OTP settings
        const toggleSpan = checkbox.parentElement.querySelector('span');
        toggleSpan.style.background = '#CBD5E1';
        const innerSpan = toggleSpan.querySelector('span');
        if (innerSpan) {
            innerSpan.style.transform = 'translateX(0)';
        }
        if (statusEl) {
            statusEl.textContent = 'Disabled';
            statusEl.style.color = '#94A3B8';
        }
        if (contentEl) {
            contentEl.style.display = 'none';
            contentEl.style.opacity = '0.5';
            contentEl.style.pointerEvents = 'none';
            // Disable all inputs inside
            const inputs = contentEl.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.disabled = true;
                input.style.opacity = '0.5';
                input.style.background = '#F1F5F9';
            });
        }
    }
}

function toggleOtpSub(checkbox, type) {
    const statusMap = {
        'login': 'loginStatus',
        'checkout': 'checkoutStatus'
    };

    const statusId = statusMap[type];
    const statusEl = document.getElementById(statusId);

    if (checkbox.checked) {
        const toggleSpan = checkbox.parentElement.querySelector('span');
        toggleSpan.style.background = '#2563EB';
        const innerSpan = toggleSpan.querySelector('span');
        if (innerSpan) {
            innerSpan.style.transform = 'translateX(22px)';
        }
        if (statusEl) {
            statusEl.textContent = 'Enabled';
            statusEl.style.color = '#10B981';
        }
    } else {
        const toggleSpan = checkbox.parentElement.querySelector('span');
        toggleSpan.style.background = '#CBD5E1';
        const innerSpan = toggleSpan.querySelector('span');
        if (innerSpan) {
            innerSpan.style.transform = 'translateX(0)';
        }
        if (statusEl) {
            statusEl.textContent = 'Disabled';
            statusEl.style.color = '#94A3B8';
        }
    }
}

function showProviderConfig(value) {
    // Hide all provider configs
    document.querySelectorAll('.provider-config').forEach(el => {
        el.style.display = 'none';
    });

    // Show selected provider config
    const config = document.getElementById(value + 'Config');
    if (config) {
        config.style.display = 'block';
    }
}

function saveSmsSettings() {
    const enabled = document.querySelector('input[name="enable_sms"]')?.checked;
    const loginOtp = document.querySelector('input[name="enable_login_otp"]')?.checked;
    const checkoutOtp = document.querySelector('input[name="enable_checkout_otp"]')?.checked;
    const expiry = document.querySelector('input[name="otp_expiry"]')?.value;
    const provider = document.querySelector('select[name="sms_provider"]')?.value;

    const enabledFeatures = [];
    if (enabled) {
        enabledFeatures.push('SMS OTP');
        if (loginOtp) enabledFeatures.push('Login OTP');
        if (checkoutOtp) enabledFeatures.push('Checkout OTP');
    }

    if (enabledFeatures.length > 0) {
        showToast(`✅ SMS OTP settings saved! (${enabledFeatures.join(', ')})`, 'success');
    } else {
        showToast('✅ SMS OTP disabled!', 'info');
    }

    return true;
}

// ================================================================
// MOBILE SIDEBAR TOGGLE - HAMBURGER MENU
// ================================================================

document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.querySelector('.sidebar-custom');

    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            sidebar.classList.toggle('open');
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function (e) {
        const sidebar = document.querySelector('.sidebar-custom');
        const menuToggle = document.getElementById('menuToggle');

        if (window.innerWidth <= 767 && sidebar && menuToggle) {
            if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        }
    });

    // Close sidebar when window resizes to desktop
    window.addEventListener('resize', function () {
        const sidebar = document.querySelector('.sidebar-custom');
        if (window.innerWidth > 767 && sidebar) {
            sidebar.classList.remove('open');
        }
    });
});
























console.log('All JS loaded successfully!');