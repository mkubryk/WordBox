import { Link } from 'react-router-dom'
import React from 'react';
import '../css/footer.css';

function Footer() {
    return (
        <footer>
            <h2>&copy; 2023 Your Company. All rights reserved.</h2>
            <nav>
                <Link to="/about"><p>About Us</p></Link>
                <Link to="/contact"><div class="contact">
                    <p>Numéro de téléphone : 06 92 69 26 02</p>
                    <p>Propriétaire : Rey Crusty</p>
                    <p>Adresse : 1 Crusty Caliente Pizza Del Pollo, Barbès 75018</p>
                </div></Link>
            </nav>


        </footer>
    );
}

export default Footer;