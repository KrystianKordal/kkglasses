<h2>{l s="2. Wpisz dane z recepty" d="Modules.KkGlasses.Creator"}</h2>
<div>
    <table>
    <tr>
        <td></td>
        <td>
            <div>{l s="Moc" d="Modules.KkGlasses.Creator"}</div>
            <div class="tooltip">
                <p>{l s="Moc (sfera) - oznacza twoją sferyczną dioptrę lub moc. Jeśli pole dioptrii ma znak równości (=), wybierz wartość ujemną (-) w formularzu." d="Modules.KkGlasses.Creator"}</p>
                <p>{l s="Jeśli pole dioptrii nie jest uzupełnione lub jeśli wprowadzono tutaj wartość zero, wybierz 0,00 w naszym formularzu zamówienia." d="Modules.KkGlasses.Creator"}</p>
                <p>{l s="Pamiętaj, że moc Twoich soczewek w okularach może być inna niż moc Twoich soczewek kontaktowych." d="Modules.KkGlasses.Creator"}</p>
            </div>
        </td>
        <td>{l s="Cylinder" d="Modules.KkGlasses.Creator"}</td>
        <td>{l s="Oś" d="Modules.KkGlasses.Creator"}</td>
    </tr>
    <tr>
        <td>{l s="P" d="Modules.KkGlasses.Creator"}</td>
        <td><input type="number" step="0.01" id="strength_r"></td>
        <td><input type="number" step="0.01" id="cylinder_r"></td>
        <td><input type="number" step="0.01" id="axis_r"></td>
    </tr>
    <tr>
        <td>{l s="L" d="Modules.KkGlasses.Creator"}</td>
        <td><input type="number" step="0.01" id="strength_l"></td>
        <td><input type="number" step="0.01" id="cylinder_l"></td>
        <td><input type="number" step="0.01" id="axis_l"></td>
    </tr>
    </table>
</div>