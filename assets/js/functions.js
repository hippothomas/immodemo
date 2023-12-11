/**
 * Loads scripts if the specified element exists in the document.
 * @param {string} pageName - id of the page name.
 * @param {Function} f - The function to be executed if the element exists.
 */
export function loadScripts(pageName, f) {
    if (document.getElementById(pageName) !== null) {
        f()
    }
}

export function demo() {
    alert("Merci de l'intérêt que vous portez à ce site mais c'est un site de démo, tout est donc fictif. Si le site vous plaît, n'hésitez pas à consulter mon site hippolyte-thomas.fr pour plus d'informations.");
}

/**
 * Formats the given input price by removing non-digit characters and adding comma separators for thousands.
 * @param {HTMLInputElement} inputPrice - The input element containing the price to be formatted.
 */
export function formatPrice(inputPrice) {
    if (inputPrice.value === '') return;
    let n = parseInt(inputPrice.value.replace(/\D/g,''), 10).toLocaleString();
    if (n === 'NaN') n = 0;
    inputPrice.value = n;
}
