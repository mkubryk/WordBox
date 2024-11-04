import { Link } from "react-router-dom";

function MdpOublie() {
    return (
        <main>
            <div class="wrapper">
                <form action="connexion.php" method="post">
                    <h2>Mot de passe oublié ?</h2>
                    <div class="input-box">
                        <input type="password" placeholder="Nouveau mot de passe" required />
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Confirmer mot de passe" required />
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <button type="submit" class="btn"><Link to="/connexion">OK</Link></button>
                </form>
            </div>
        </main>
    )
}

export default MdpOublie;