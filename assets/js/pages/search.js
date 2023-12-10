export function search() {
    // Price input handler
    // ==================
    let inputPrice = document.getElementById("max_price");
    inputPrice.addEventListener('focusout', () => {
        let n = parseInt(inputPrice.value.replace(/\D/g,''), 10).toLocaleString();
        if (n === 'NaN') n = 0;
        inputPrice.value = n;
    });
}
