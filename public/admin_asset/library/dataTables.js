$(document).ready(function () {
    let searchTimeout = "";
    let array = {
        actions: 0,
        perpage: 10,
        publish: 0,
        sort: "id,asc",
        keyword: null,
        filter: null,
    };
    fetchData();
    getModel();
    function getModel() {
        let _this = $("#filter");
        let model = _this.data("model");
        return model;
    }
    function fetchData(params = {}) {
        $("#tbody").html(
            `<tr><td colspan="100%" class="text-center"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></td></tr>`
        );
        const model = getModel();
        $.ajax({
            type: "GET",
            url: `/${model}/getData`,
            model,
            data: { ...array, ...params },
            success: function (data) {
                $("#tbody").html(data);
            },
            error: function (xhr, status, error) {
                console.log(error);
                $("#tbody").html(
                    `<tr><td colspan="100%" class="text-center">Lỗi khi tải dữ liệu</td></tr>`
                );
            },
        });
    }

    // Search form
    $("#keyword").on("input", function (e) {
        let _this = $(this);
        let keyword = _this.val();
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function () {
            fetchData({ keyword });
        }, 500);
    });

    // Filter form
    $(".filter-option").on("change", function () {
        let key = $(this).attr("name");
        let value = $(this).val();
        if (key && value !== undefined) {
            array[key] = value;
        }
        fetchData(array);
    });

    // Pagination form
    $(document).on("click", ".pagination a", function (event) {
        event.preventDefault();
        let page = $(this).attr("href").split("page=")[1];
        fetchData({ page });
    });
});
