$(".btn-add").click(function () {
    let itemId = $(this).data("id")
    $.post("cart-php", { id: productId }, function (response) {
        $("#items-count").text(response.court);
    })
})