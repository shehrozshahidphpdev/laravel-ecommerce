document.addEventListener("DOMContentLoaded", function () {
  document.addEventListener(
    "click",
    function (e) {
      if (window.location.pathname === "/cart") {
        const btn = e.target.closest(".tp-header-action-btn");
        if (btn) {
          e.preventDefault();
          e.stopPropagation();
        }
      }
    },
    true,
  );
  // remove from the cart
  const removeBtns = document.querySelectorAll(".tp-cart-action-btn");

  removeBtns.forEach((item) => {
    item.addEventListener("click", function (e) {
      e.preventDefault();

      const productId = item.dataset.id;

      fetch(deleteCartRoute, {
        method: "delete",
        headers: {
          "X-CSRF-TOKEN": document
            .querySelector('[name="csrf-token"]')
            .getAttribute("content"),
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify({ id: productId }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === true) {
            window.location.reload();
            toast.success("Success!", "product has been updated!");
          }
        });
    });
  });

  const increaseBtn = document.querySelectorAll(".tp-cart-plus");
  const decreaseBtn = document.querySelectorAll(".tp-cart-minus");

  increaseBtn.forEach((item) => {
    item.addEventListener("click", function () {
      console.log("from main cart");

      const container = item.closest(".tp-product-quantity");
      const input = container.querySelector(".tp-cart-input");
      input.value = parseInt(input.value) + 1;
    });
  });

  decreaseBtn.forEach((item) => {
    item.addEventListener("click", function () {
      const container = item.closest(".tp-product-quantity");
      const input = container.querySelector(".tp-cart-input");
      if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        console.log(input.value);
      }
    });
  });

  const submitBtn = document.querySelector(".tp-cart-update-btn");

  submitBtn.addEventListener("click", function (e) {
    e.preventDefault();

    const cartItems = [];

    document.querySelectorAll("tbody tr[data-id]").forEach((row) => {
      const id = row.dataset.id;
      const qty = row.querySelector(".tp-cart-input").value;

      cartItems.push({ id: id, qty: qty });
    });

    fetch(updateCartRoute, {
      method: "post",
      headers: {
        "X-CSRF-TOKEN": document
          .querySelector('[name="csrf-token"]')
          .getAttribute("content"),
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify({ items: cartItems }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === true) {
          window.location.reload();
          toast.success("Success!", data.message);
        }
      })
      .catch(console.error);
  });
});
