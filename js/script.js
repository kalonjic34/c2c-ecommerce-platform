document.querySelectorAll(".btn-add, .add-to-cart").forEach(button => {
    button.addEventListener("click", function () {
        const itemId = this.dataset.id;
        fetch("cart.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({ id: itemId })
        })
            .then(response => response.json())
            .then(data => {
                const countEl = document.getElementById("items-count");
                if (countEl && data.count !== undefined) {
                    countEl.textContent = data.count;
                }
            })
            .catch(error => console.error("Cart update error:", error));
    });
});