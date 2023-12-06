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