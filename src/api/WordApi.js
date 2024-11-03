import { useState } from "react";
import $ from "jquery";

function WordApi() {

    const [name, setName] = useState("");
    const [result, setResult] = useState("");

    const handleChange = (e) => {
        setName(e.target.value);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        const form = $(e.target);
        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: form.serialize(),
            success(data) {
                setResult(data);
            },
        });
    };



    const addWord = (word) => {
        $.ajax({
            type: "POST",
            url: "http://localhost:8000/routeur.php?action=create",
            data: word.serialize(),
            success(data) {
                console.log(data);
            },
        });

    }

    const deleteWord = (word) => {
        $.ajax({
            type: "DELETE",
            url: "http://localhost:8000/routeur.php",
            data: word.setrialize(),
            success(data) {
                console.log(data);
            },
        });

    }

  
}

export default WordApi;