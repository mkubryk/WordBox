const axios = require('axios');
const cheerio = require('cheerio');

// Fonction pour récupérer la définition d'un mot depuis le Wiktionnaire
async function fetchDefinitionFromWiktionary(mot) {
    const url = `https://fr.wiktionary.org/wiki/${encodeURIComponent(mot)}`;
    try {
        // Récupérer le HTML de la page
        const { data } = await axios.get(url);
        const $ = cheerio.load(data);

        // JSON qui va contenir les informations
        const result = {
            mot: mot,
            definitions: [],
            exemples: [],
            etymologie: ''
        };

        // Extraire la définition
        $('#mw-content-text .mw-parser-output').find('ol li').each((i, elem) => {
            const definition = $(elem).text();
            if (definition) {
                result.definitions.push(definition.trim());
            }
        });

        // Extraire les exemples d'utilisation
        $('#mw-content-text .mw-parser-output').find('ul li').each((i, elem) => {
            const exemple = $(elem).text();
            if (exemple) {
                result.exemples.push(exemple.trim());
            }
        });

        // Extraire l'étymologie (si disponible)
        const etymologie = $('#mw-content-text .mw-parser-output').find('.etymology').first().text();
        if (etymologie) {
            result.etymologie = etymologie.trim();
        }

        return result;
    } catch (error) {
        console.error(`Erreur lors du scraping de la page Wiktionnaire pour ${mot}:`, error);
        return { error: "Erreur de chargement des données" };
    }
}

module.exports = fetchDefinitionFromWiktionary;
