// src/App.js
import React from "react";
import { useState } from "react";
import $ from "jquery";
import '../../css/accueil.css';
function Home() {

    const [name, setName] = useState("");
    const [result, setResult] = useState("");

    const handleChange = (e) => {
        setName(e.target.value);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        const form = $(e.target);
        fetch(form.attr("action"), {
            method: "POST",
            headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams(new FormData(form[0])).toString(),
        })
        .then(response => response.text())
        .then(data => {
            setResult(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    };
    return (
        <div class="container">
            <div class="wrapper fit-box center-text">
                <h2>Recherche de mot à sonorité marrante</h2>
                <form
                    action="http://localhost:8000/server.php"
                    method="post"
                    onSubmit={(event) => handleSubmit(event)}
                >
                    <div class="input-box "><input
                        type="text"
                        id="search"
                        name="search"
                        value={name}
                        onChange={(event) =>
                            handleChange(event)
                        }
                    /></div>
                    <button class="btn" type="submit">Rechercher</button>

                </form>

                <div class="result">

                    
                </div>
            </div>
        </div>
    );
}

export default Home;

/*
* Rédiger méthode qui lorsque qu'on clique sur le coeur, le mot est supprimé de la liste des favoris
*
*
*/