
import React from "react";
import {Link} from "react-router-dom";
import '../../css/inscription.css';

function Connexion() {
    return (
        <main>
            <div class="wrapper">
                <form action="index.php" method="get">
                    <h1>Connexion</h1>
                    <input type="hidden" name="objet" value="objet" />
                    <input type="hidden" name="action" value="connect" />

                    <div class="input-box">
                        <input type="text" name="login" placeholder="Nom d'utilisateur" required />
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="mdp" placeholder="Mot de passe" required />
                        <i class='bx bxs-lock-alt'></i>
                    </div>

                    <button type="submit" class="btn">Connexion</button>
                </form>
                    <div class="souvenir-oublie">
                        <label><input type="checkbox" />Se souvenir de moi</label>

                        <Link to="/mdp-oublie">Mot de passe oublié?</Link>

                    </div>
                    <div class="lien-inscription">
                        <p>Créer un compte? <Link to="/inscription">S'inscrire</Link></p>
                    </div>
            </div>
        </main >
    )
}

export default Connexion;