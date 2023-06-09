import CartClass from "../class/CartClass.js";
import { currency } from "./Helpers.js";

const btnsAddToCart = document.querySelectorAll(".btn-add");
const btnsRemoveFromCart = document.querySelectorAll(".btn-remove");
const btnClearCart = document.querySelector("#btn-clear-cart");
const productsList = document.querySelectorAll('.products-list');

const cart = new CartClass;

productsList.forEach(product => {
    const productJson = JSON.parse(product.getAttribute("data-product"));
    getProductQuantityAndPrice(productJson);
});

function getProductQuantityAndPrice(product){
    const {qty, price} = cart.getProductQuantityAndPrice(product);
    document.querySelector(`.product-in-cart${product.id}`).textContent = qty;
    document.querySelector(`.product-price-in-cart${product.id}`).textContent = price;

    const sum = cart.getTotalQuantityAndPrice();
    document.querySelector('#totalQuantity').textContent = sum.qty;
    document.querySelector('#totalPrice').textContent = currency(sum.total);
}

btnsAddToCart.forEach(button => {
    button.addEventListener('click', () => {
        const product = JSON.parse(button.getAttribute('data-product'));
        cart.add(product);
        getProductQuantityAndPrice(product);
    });
});

btnsRemoveFromCart.forEach(button => {
    button.addEventListener('click', () => {
        const product = JSON.parse(button.getAttribute('data-product'));
        cart.remove(product);
        getProductQuantityAndPrice(product);
    });
});

btnClearCart.addEventListener('click', () => {
    if (!cart.getCart().length) {
      Swal.fire({
        icon: "info",
        title: "Empty",
        text: "Cart is empty",
      });
      return;
    }
    Swal.fire({
      title: "Are you sure?",
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Yes",
      denyButtonText: `No`,
    }).then((result) => {
      if (result.isConfirmed) {
        cart.clear();
        Swal.fire("Cart clear!", "", "success");
        setTimeout(() => {
          window.location.reload();
        }, 2000);
      } 
      else if (result.isDenied){

      }
    });
  });