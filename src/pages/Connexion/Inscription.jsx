import { Link } from "react-router-dom";

function Inscription() {
    return (
        <main>
            <div class="wrapper">
                <form action="index.php" method="get">
                    <input type="hidden" name="objet" value="Traitement_inscription" />
                    <input type="hidden" name="action" value="inscrire" />
                    <h1>Inscription</h1>
                    <div class="input-box">
                        <input type="text" name="nomClient" placeholder="Nom" required />
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="text" name="prenomClient" placeholder="Prénom" required />
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="text" name="numTelClient" placeholder="Téléphone" pattern="^0[1-9]([ .-]?[0-9]{2}){4}$" title="Format attendu : 01 23 45 67 89" required />
                        <i class='bx bxs-phone'></i>
                    </div>
                    <div class="input-box">
                        <input type="text" name="userName" placeholder="User Name" required />
                        <i class='bx bxs-user-circle'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="mdp" placeholder="Mot de passe" required />
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <div class="input-box">
                        <input type="text" name="numCarte" placeholder="Numéro de carte" pattern="^\d{4} \d{4} \d{4} \d{4}$" title="Format attendu : xxxx xxxx xxxx xxxx" required />
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <div class="input-box">
                        <input type="text" name="CVV" placeholder="Cryptogramme" min="100" max="999" pattern="^\d{3}$" title="Format attendu : xxx" required />
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <div class="input-box">
                        <input type="text" name="dateExpire" placeholder="Date d'expiration" pattern="^\d{4}-\d{2}-\d{2}$" title="Format attendu : AAAA-MM-00" required />
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <div class="input-box">
                        <input type="text" name="nomVille" placeholder="Ville" required />
                        <i class='bx bxs-map'></i>
                    </div>
                    <div class="input-box">
                        <input type="int" name="codePostal" placeholder="Code Postal" pattern="^\d{5}$" title="Format attendu : xxxxx" required />
                        <i class='bx bxs-map'></i>
                    </div>

                    <div class="input-box">
                        <input type="text" name="nomAdr" placeholder="Adresse" required />
                        <i class='bx bxs-building-house'></i>
                    </div>

                    <div class="souvenir-oublie">
                        <Link to="/connexion" >Se connecter?</Link>
                    </div>
                    <button type="submit" class="btn" >S'inscrire</button>
                </form>
            </div>
        </main>
    )
}

export default Inscription