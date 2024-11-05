import React, { useEffect, useState } from 'react';

const ListeMot = () => {
    // Liste des mots
    const mots = [
        { mot: "Poulet" },
        { mot: "Glauque" },
        { mot: "Foutriquet" },
        { mot: "Inspiration" },
        { mot: "Coquelet" }
    ];

    const express = require('express');
    const fetchDefinitionFromWiktionary1 = require('../../script/wiktionaryScraper');
    
    const app = express();
    const PORT = process.env.PORT || 3000;
    
    app.get('/api/definition/:mot', async (req, res) => {
        const { mot } = req.params;
        try {
            const data = await fetchDefinitionFromWiktionary1(mot);
            res.json(data);
        } catch (error) {
            res.status(500).json({ error: "Erreur de récupération des données" });
        }
    });
    
    app.listen(PORT, () => {
        console.log(`Serveur en cours d'exécution sur le port ${PORT}`);
    });
    




    // État pour stocker les définitions obtenues
    const [definitions, setDefinitions] = useState({});

    // Fonction pour récupérer la définition de chaque mot depuis l'API Wiktionnaire
    const fetchDefinitionFromWiktionary = async (mot) => {
        const url = `https://fr.wiktionary.org/w/api.php?action=query&titles=${mot}&prop=extracts&exintro&explaintext&format=json&origin=*`;
        try {
            const response = await fetch(url);
            const data = await response.json();
            const page = data.query.pages[Object.keys(data.query.pages)[0]];
            const definition = page.extract || null; // null si aucune définition trouvée

            // Si une définition est trouvée, on la stocke
            if (definition) {
                setDefinitions((prevDefinitions) => ({
                    ...prevDefinitions,
                    [mot]: definition
                }));
            } else {
                // Si aucune définition trouvée, essayer une autre API
                fetchDefinitionFromDictionaryAPI(mot);
            }
        } catch (error) {
            console.error(`Erreur lors du chargement de la définition pour ${mot} depuis Wiktionnaire:`, error);
            fetchDefinitionFromDictionaryAPI(mot); // Si erreur, tenter l'autre API
        }
    };

    // Fonction de secours pour récupérer la définition de chaque mot depuis DictionaryAPI.dev
    const fetchDefinitionFromDictionaryAPI = async (mot) => {
        const url = `https://api.dictionaryapi.dev/api/v2/entries/en/${mot}`;
        try {
            const response = await fetch(url);
            const data = await response.json();
            const definition = data[0]?.meanings[0]?.definitions[0]?.definition || "Définition introuvable";
            setDefinitions((prevDefinitions) => ({
                ...prevDefinitions,
                [mot]: definition
            }));
        } catch (error) {
            console.error(`Erreur lors du chargement de la définition pour ${mot} depuis DictionaryAPI.dev:`, error);
            setDefinitions((prevDefinitions) => ({
                ...prevDefinitions,
                [mot]: "Erreur de chargement"
            }));
        }
    };

    // Appel des fonctions de récupération de définition pour chaque mot
    useEffect(() => {
        mots.forEach(({ mot }) => {
            fetchDefinitionFromWiktionary(mot);
        });
    }, []);

    const supprFavoris = ((item) => {
        console.log("coeur cliqué !");
        document.getElementById(item.mot).className = document.getElementById(item.mot).className == "bi bi-suit-heart-fill" ? "bi bi-suit-heart" : "bi bi-suit-heart-fill";
    });

    return (
        <div>
            {mots.map((item, index) => (
                <div key={index} className="wrapper">
                   <h1>{item.mot}</h1>
                    <i className="bi bi-suit-heart-fill" id={item.mot} onClick={() => supprFavoris(item)}></i>
                    <p>{definitions[item.mot] || "Chargement..."}</p>
                </div>
            ))}
        </div>
    );
};

export default ListeMot;


/*
* Rédiger méthode qui lorsque qu'on clique sur le coeur, le mot est supprimé de la liste des favoris
*
*
*/