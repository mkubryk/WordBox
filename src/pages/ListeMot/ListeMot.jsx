import React from 'react';

const ListeMot = () => {
    const mots = ['mot1', 'mot2', 'mot3', 'mot4'];

    return (
        <div>
            <h1>Liste de Mots</h1>
            <ul>
                {mots.map((mot, index) => (
                    <li key={index}>{mot}</li>
                ))}
            </ul>
        </div>
    );
};

export default ListeMot;