const site_url = "http://127.0.0.1:8000/";
$("body").on("keyup", "#search", function () {
    let text = $("#search").val();
    if (text.length > 0) {
        $.ajax({
            method: "post",
            url: site_url + "search-product",
            data: { search: text },
            beforeSend: function (request) {
                return request.setRequestHeader(
                    "X-CSRF-TOKEN",
                    $('meta[name="csrf-token"]').attr("content")
                );
            },
            success: function (result) {
                $("#searchProduct").html(result);
            },
        });
    }
    if (text.length < 1) $("#searchProduct").html("");
});
