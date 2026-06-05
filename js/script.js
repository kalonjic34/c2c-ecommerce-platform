document.addEventListener('DOMContentLoaded', () => {
    const products = {
        1: {
            id: 1, title: 'Woven Basket', desc: 'Handmade woven basket for carriage', price: 'R149.99', image: 'images/product1.jpg'
        },
        2: { id: 2, title: 'Clay Cooking Pot', desc: 'Durable clay pot for traditional cooking', price: 'R199.00', image: 'images/product2.jpg' },
        3: { id: 3, title: 'Beaded Necklace', desc: 'Handcrafted beaded necklace', price: 'R89.50', image: 'images/product3.jpg' },
        4: { id: 4, title: 'Wooden Carving', desc: 'Artisan wooden carving', price: 'R250.00', image: 'images/product4.jpg' },
        5: { id: 5, title: 'Samsung Music Frame HW-LS60D', desc: '120W Wireless Smart Speaker', price: 'R4250.00', image: 'images/product5.jpg' },
        6: { id: 6, title: 'Google Nest Hub Max', desc: 'Smart display with Google Assistant', price: 'R6550.00', image: 'images/product6.jpg' }
    };

    const details = document.querySelector('.product-details');
    if (details) {
        const params = new URLSearchParams(window.location.search);
        let id = params.get('id') || '1';
        if (!products[id]) id = '1';
        const p = products[id];

        const img = details.querySelector('img');
        if (img) { img.src = p.image; img.alt = p.title; }

        const h3 = details.querySelector('h3');
        if (h3) h3.textContent = p.title;

        const ps = details.querySelectorAll('p');
        if (ps[0]) ps[0].textContent = p.desc;
        if (ps[1]) ps[1].textContent = `Price: ${p.price}`;

        const btn = details.querySelector('.add-to-cart');
        if (btn) btn.dataset.id = p.id;
    }

    document.querySelectorAll(".btn-add,.add-to-cart").forEach(button => {

        button.addEventListener("click", function () {
            const itemId = this.dataset.id;

            fetch("cart.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: new URLSearchParams({
                    id: itemId
                })
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
});