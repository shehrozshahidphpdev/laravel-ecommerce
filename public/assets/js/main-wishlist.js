document.addEventListener("DOMContentLoaded", function () {
  console.log("main-wishlist loaded");

  // quantity increase decrease

  const increaseBtn = document.querySelectorAll(".tp-cart-plus");
  const decreaseBtn = document.querySelectorAll(".tp-cart-minus");
  // const addToCart = document.querySelector(".wishlisr-cart-btn");

  increaseBtn.forEach((item) => {
    item.addEventListener("click", function () {
      console.log("from main-wishlist");

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

  const addBtns = document.querySelectorAll(".wishlisr-cart-btn");

  addBtns.forEach((btn) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault();

      const row = btn.closest(".wishlist-row");
      if (!row) return;

      const id = row.dataset.id;
      const qty = row.querySelector(".tp-cart-input").value;

      console.log(id);
      console.log(qty);

      fetch(storeWishListItemToCart, {
        method: "post",
        headers: {
          "X-CSRF-TOKEN": document
            .querySelector('[name="csrf-token"]')
            .getAttribute("content"),
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify({ id: id, qty: qty }),
      })
        .then((response) => response.json())
        .then((data) => {
          console.log(data);
          if (data.status === true) {
            window.location.reload();
            toast.success("Success!", data.message);
          }
        })
        .catch(console.error);
    });
  });
});
