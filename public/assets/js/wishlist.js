document.addEventListener("DOMContentLoaded", function () {
  console.log("wishlist loaded");
  const wishlistBadge = document.querySelector(".header-wishlist-badge");
  const wishlists = document.querySelectorAll(
    ".tp-product-add-to-wishlist-btn",
  );
  wishlists.forEach((item) => {
    item.addEventListener("click", function () {
      const productId = this.dataset.id;
      console.log(productId);
      fetch(addWishlistRoute, {
        method: "post",
        headers: {
          "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify({ productId: productId }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === false) {
            toast.success("success", data.message);
          }
          if (data.status === true) {
            wishlistBadge.innerText = data.count;
            toast.success("success", data.message);
          }
          console.log(data);
        })
        .catch(console.error);
    });
  });

});
