const translations = {
    en: {
        welcome: "Welcome",
        goodbye: "Goodbye",
        wordBox: "Word Box",
        

    },
    fr: {
        welcome: "Bienvenue",
        goodbye: "Au revoir",
        wordBox: "Boîte à mots",

    }
};

function changeLanguage(language) {
    const elements = document.querySelectorAll("[data-translate-key]");
    elements.forEach(element => {
        const key = element.getAttribute("data-translate-key");
        if (translations[language] && translations[language][key]) {
            element.textContent = translations[language][key];
        }
    });
}

// Exemple d'utilisation : changer la langue en français
changeLanguage('fr');