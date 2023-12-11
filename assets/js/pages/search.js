import { formatPrice } from "../functions"

export function search() {
    // Price input handler
    // ==================
    let inputPrice = document.getElementById("max_price");
    inputPrice.addEventListener('focusout', () => formatPrice(inputPrice));
    window.onload = () => formatPrice(inputPrice);
}
