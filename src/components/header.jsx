import { Link } from 'react-router-dom'
import '../css/header.css';

function Header() {
    return (
        <header class="header">
            <img src="../img/logo.jpg" alt="logo"/>
            <div class="Title"> <h1>Boîte à mot</h1></div>
            <nav  class="navbar">
                    <li>
                        <Link to={`/home`}>Home</Link>
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
               
            </nav>
        </header>
    );
}

export default Header;