import { Link } from 'react-router-dom'
import '../css/header.css';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-icons/font/bootstrap-icons.css';

function Header() {
    
    const changeTheme = (() => {
        console.log("thème cliqué !");
        document.getElementById("theme").className = document.getElementById("theme").className == "bi bi-brightness-high" ? "bi bi-moon-stars-fill" : "bi bi-brightness-high";
    });

    return (
        <header class="header">
            <div class="Title"><i class="bi bi-book"></i><h1 style={{ fontFamily: ' Lucida Handwriting' }}>Boîte à mot</h1></div>
             <img src="../img/logo.jpg" alt="logo" />
            <nav class="navbar">
                <div class="align-redirect-page" >
                    <li>
                        <Link to={`/home`}>Accueil</Link>
                    </li>
                    <li>
                        <Link to={`/connexion`}>Connexion</Link>
                    </li>
                    <li>
                        <Link to={`/inscription`}>Inscription</Link>
                    </li>
                    <li>
                        <Link to={`/mes-mots`}>Mes mots</Link>
                    </li>
                </div>
                <div className="settings">
                    <i class="bi bi-brightness-high" id="theme" onClick={() => changeTheme()}> </i>
                    <i class="bi bi bi-translate"  onClick={() => { /* Logic to toggle language */ }}></i>
                </div>
            </nav>
        </header>
    );
}

export default Header;