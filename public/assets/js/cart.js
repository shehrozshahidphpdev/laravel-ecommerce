document.addEventListener("DOMContentLoaded", function () {
  const cartBtns = document.querySelectorAll(".tp-product-add-cart-btn");
  const miniCartContent = document.querySelector(".cartmini__widget");
  const cartCountBadge = document.querySelector(".cart-count-badge");
  const cart = document.querySelector(".cartmini__area");
  const subTotalContent = document.querySelector(".cart-mini-subtotal");

  cartBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      let cartProductId = this.dataset.id;

      fetch(cartRoute, {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": csrfToken,
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify({ id: cartProductId }),
      })
        .then((response) => response.json())
        .then((data) => {
          let subtotal = 0;
          if (data.status === true) {
            console.log(data.cartItems);

            const cartArray = Object.values(data.cartItems);

            let html = "";

            if (cartArray.length > 0) {
              cartCountBadge.innerText = cartArray.length;

              cartArray.forEach((item) => {
                let productName = item.productName;
                let productImage = item.productImage;
                let qty = item.qty;
                let productId = item.productId;
                let price = item.discountedPrice ?? item.originalPrice;
                subtotal += item.discountedPrice
                  ? item.discountedPrice * item.qty
                  : item.originalPrice * item.qty;

                html += `
                <div class="cartmini__widget-item">

                  <div class="cartmini__thumb">
                    <a href="#">
                      <img src="/storage/${productImage}" alt="">
                    </a>
                  </div>

                  <div class="cartmini__content">
                    <h5 class="cartmini__title">
                      <a href="#">${productName}</a>
                    </h5>

                    <div class="cartmini__price-wrapper">
                      <span class="cartmini__price">$${price}</span>
                      <span class="cartmini__quantity">x${qty}</span>
                    </div>
                  </div>

                  <button type="button" class="cartmini__del" data-id="${productId}">
                    <i class="fa-regular fa-xmark"></i>
                  </button>

                </div>
              `;
              });
            } else {
              html = `<h3>Cart is Empty..</h3>`;
            }

            miniCartContent.innerHTML = html;
            subTotalContent.innerText = "$" + subtotal;
            cart.classList.toggle("cartmini-opened");
          }
        })
        .catch(console.error);
    });
  });

  // delete cart product logic

  document
    .querySelector(".cartmini__widget")
    .addEventListener("click", function (e) {
      if (!e.target.closest(".cartmini__del")) return;
      const btn = e.target.closest(".cartmini__del");

      const productId = btn.dataset.id;

      fetch(deleteCartRoute, {
        method: "delete",
        headers: {
          "X-CSRF-TOKEN": csrfToken,
          "Content-Type": "application/json",
          Accept: "application/json",
        },

        body: JSON.stringify({ id: productId }),
      })
        .then((response) => response.json())
        .then((data) => {
          console.log(data);
          let subtotal = 0;
          if (data.status === true) {
            console.log(data.cartItems);

            const cartArray = Object.values(data.cartItems);

            let html = "";

            if (cartArray.length > 0) {
              cartCountBadge.innerText = cartArray.length;

              cartArray.forEach((item) => {
                let productName = item.productName;
                let productImage = item.productImage;
                let qty = item.qty;
                let price = item.discountedPrice ?? item.originalPrice;
                subtotal += item.discountedPrice
                  ? item.discountedPrice * item.qty
                  : item.originalPrice * item.qty;

                html += `
                    <div class="cartmini__widget-item">
                        <div class="cartmini__thumb">
                            <a href="#">
                                <img src="/storage/${productImage}" alt="">
                            </a>
                        </div>
                        <div class="cartmini__content">
                            <h5 class="cartmini__title">
                                <a href="#">${productName}</a>
                            </h5>
                            <div class="cartmini__price-wrapper">
                                <span class="cartmini__price">$${price}</span>
                                <span class="cartmini__quantity">x${qty}</span>
                            </div>
                        </div>
                        <!-- ✅ Fixed: use item.productId not productId -->
                        <button type="button" class="cartmini__del" data-id="${item.productId}">
                            <i class="fa-regular fa-xmark"></i>
                        </button>
                    </div>
                `;
              });
              miniCartContent.innerHTML = html;
              subTotalContent.innerText = "$" + subtotal;
            } else {
              html = `<h3>Cart is Empty..</h3>`;
              miniCartContent.innerHTML = html;
              cartCountBadge.innerText = 0;
              subTotalContent.innerText = "$" + 0;
            }
          }
        })
        .catch(console.error);
    });
});

console.log("cart.js file loaded");
