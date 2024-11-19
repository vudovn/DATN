(function ($) {
    "use strict";
    var TGNT = {};

    TGNT.getOrdersAndRevenueByYear = () => {
        $.ajax({
            url: "/admin/dashboard/ajax/getOrdersAndRevenueByYear",
            type: "GET",
            dataType: "json",
            beforeSend: function () {
                
            },
            success: function (res) {
                const months = res.data.original.map(
                    (item) => `Tháng ${item.month}`
                );
                const totalOrders = res.data.original.map(
                    (item) => item.total_orders
                );
                const monthlyRevenue = res.data.original.map(
                    (item) => item.monthly_revenue
                );

                const ctx = document
                    .getElementById("ordersChart")
                    .getContext("2d");
                const ordersChart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: months,
                        datasets: [
                            {
                                label: "Số đơn hàng",
                                data: totalOrders,
                                backgroundColor: "rgba(75, 192, 192, 0.2)",
                                borderColor: "rgba(75, 192, 192, 1)",
                                borderWidth: 1,
                                type: "bar",
                            },
                            {
                                label: "Doanh thu (VNĐ)",
                                data: monthlyRevenue,
                                backgroundColor: "rgba(255, 99, 132, 0.2)",
                                borderColor: "rgb(255, 99, 132)",
                                tension: 0.4,
                                borderWidth: 1,
                                type: "line",
                                yAxisID: "y2",
                                pointStyle: "circle",
                                pointRadius: 6,
                                pointBackgroundColor: "rgb(255, 99, 132)",
                                pointHoverRadius: 8,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: "Số đơn hàng",
                                },
                            },
                            y2: {
                                beginAtZero: true,
                                position: "right",
                                title: {
                                    display: true,
                                    text: "Doanh thu (VNĐ)",
                                },
                                grid: {
                                    drawOnChartArea: false,
                                },
                            },
                        },
                    },
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Lỗi: " + textStatus + " " + errorThrown);
            },
        });
    };

    $(document).ready(function () {
        TGNT.getOrdersAndRevenueByYear();
    });
})(jQuery);
