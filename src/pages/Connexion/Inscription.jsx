import { Link } from "react-router-dom";
import '../../css/inscription.css';

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
                        <input type="text" name="login" placeholder="Nom d'utilisateur" required />
                        <i class='bx bxs-user-circle'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="mdp" placeholder="Mot de passe" required />
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                   

                    <div class="souvenir-oublie">
                        <Link to="/connexion" >Se connecter?</Link>
                    </div>
                    <button type="submit" class="btn link-color" >S'inscrire</button>
                </form>
            </div>
        </main>
    )
}

export default Inscription;