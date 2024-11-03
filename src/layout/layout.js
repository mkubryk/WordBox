import { Link, Outlet } from "react-router-dom";

export default function Layout() {
    return (
        <div id="sidebar">
            <nav>
                <ul>
                    <li>
                        <Link to={`/connexion`}>Connexion</Link>
                    </li>
                    <li>
                        <Link to={`/inscription`}>Inscription</Link>
                    </li>

                    <li>
                        <Link to={`/mdp-oublie`}>Mot de passe oublié</Link>
                    </li>
                </ul>
            </nav>
            <div>
                <Outlet />
            </div>
        </div>


    );
}