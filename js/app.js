$(document).ready(function() {
    // huỷ sự kiện tự lên đầu trang của thẻ a
    $(".add_cart").click(function(event) {
        event.preventDefault();
    });

    // ajax thêm vào giỏ hàng
    $(".add_cart").click(function() {
        var values = $(this).attr("value");
        $.ajax({
            url: "core/add_cart.php",
            type: "POST",
            data: {
                id: values,
            },
            success: function(data) {
                // $("#body-table").html(data);
                if (data == "done") {

                    $("#toast-success").removeClass("d-none");
                    $("#success-body").html("Bạn đã thêm thành công sản phẩm vào giỏ hàng!");
                    $("#toast-success").toast({ delay: 1500 });
                    $("#toast-success").toast("show");

                } else if (data == "erro1") {
                    $("#toast-danger").removeClass("d-none");
                    $("#danger-body").html("Sản phẩm này tạm thời đã hết hàng!");
                    $("#toast-danger").toast({ delay: 1500 });
                    $("#toast-danger").toast("show");

                } else {
                    window.location.assign("login.php");
                }
            },
        });
    });
    var timeout;
    $("#orders").click(function() {
        var sum_money = ($("#sum_money").html().split(" "))[0].replace('.', '');
        var money_ship = ($("#money_ship").html().split(" "))[0].replace('.', '');
        $.ajax({
            url: "core/process_orders.php",
            type: "POST",
            data: {
                sum_money: sum_money,
                money_ship: money_ship,
            },
            success: function(data) {

                //$("#body-table").html(data);

                // $("#toast-success").removeClass("d-none");
                // $("#success-body").html(data);
                // $("#toast-success").toast({ delay: 5000 });
                // $("#toast-success").toast("show");
                // timeout = setInterval(window.location.assign("login.php"), 10000);

                //setTimeout(location.reload(), 5000);
                alert(data);
                location.reload();
            },
        });
    });
    clearInterval(timeout);
    $("#add_to_cart").click(function() {
        var values = $(this).attr("value");
        var number = $("#get_number").val();
        $.ajax({
            url: "core/add_to_cart.php",
            type: "POST",
            data: {
                id: values,
                quatity: number,
            },
            success: function(data) {
                // $("#body-table").html(data);
                if (data == "done") {
                    // $(".toast").toast(option);
                    $("#toast-success").removeClass("d-none");
                    $("#success-body").html("Bạn đã thêm thành công sản phẩm vào giỏ hàng!");
                    $("#toast-success").toast({ delay: 1500 });
                    $("#toast-success").toast("show");
                }
                // alert("Đăng nhập để thêm");
                else {
                    $("#toast-danger").removeClass("d-none");
                    $("#danger-body").html(data);
                    $("#toast-danger").toast({ delay: 1500 });
                    $("#toast-danger").toast("show");
                };
            },
        });
    });
    $(".cart_quatity").change(function() {
        var number = $(this).val();
        var id = $(this).attr("id_pr");
        //alert($(this).attr("id_pr"));
        $.ajax({
            url: "core/update_number_product.php",
            type: "POST",
            data: {
                pr_id: id,
                number: number,
            },
            success: function(data) {
                if (data == "erro1") {
                    alert("số lượng chọn phải lớn hơn 0");
                    // $("#toast-danger").removeClass("d-none");
                    // $("#danger-body").html("Số lượng chọn phải lớn hơn 0!");
                    // $("#toast-danger").toast({ delay: 1500 });
                    // $("#toast-danger").toast("show");
                } else if (data == "erro2") {
                    alert("số lượng trong kho không đủ");
                    // $("#toast-danger").removeClass("d-none");
                    // $("#danger-body").html("Số lượng trong kho không đủ!");
                    // $("#toast-danger").toast({ delay: 1500 });
                    // $("#toast-danger").toast("show");
                } else {

                    alert("Cập nhật thành công");
                    // $("#toast-success").removeClass("d-none");
                    // $("#success-body").html("Cập nhật thành công!");
                    // $("#toast-success").toast({ delay: 1500 });
                    // $("#toast-success").toast("show");
                }
                location.reload();
            },
        });
    });

    // ========================= Live-search ==================================
    $("#search-input").keyup(function() {
        var pr_key = $("#search-input").val();

        // var dataform = new FormData();
        // dataform.append('pr_key', pr_key);
        $.ajax({
            url: "core/live-search.php",
            method: "POST",
            // data: dataform,
            data: { pr_key: pr_key },

            success: function(response) {
                if (response == "none") {
                    $(".search-display").removeClass("d-block");
                    $(".search-display").addClass("d-none");
                } else {
                    $(".search-display").html(response);
                    $(".search-display").addClass("d-block");
                    $(".search-display").removeClass("d-none");
                    $(window).click(function() {
                        $(".search-display").removeClass("d-block");
                        $(".search-display").addClass("d-none");
                    });
                }
            },
        });
    });
});