import { useState } from "react";
import $ from "jquery";

function UserApi() {

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



    const addClient = (client) => {
        $.ajax({
            type: "POST",
            url: "http://localhost:8000/routeur.php?action=create",
            data: client,
            success(data) {
                console.log(data);
            },
        });

    }

    const deleteClient = (client) => {
        $.ajax({
            type: "DELETE",
            url: "http://localhost:8000/routeur.php",
            data: client,
            success(data) {
                console.log(data);
            },
        });

    }

    const updateClient = (client) => {
        $.ajax({
            type: "PUT",
            url: "http://localhost:8000/routeur.php",
            data: client,
            success(data) {
                console.log(data);
            },
        });

    }

  /*  return (
        <div className="App">
            <form
                action="addClient"
                method="post"
                onSubmit={(event) => handleSubmit(event)}
            >
                <label htmlFor="name">Name: </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value={name}
                    onChange={(event) =>
                        handleChange(event)
                    }
                />
                <br />
                <button type="submit">Submit</button>
            </form>
            <h1>{result}</h1>
        </div>
    ); */
}

export default UserApi;