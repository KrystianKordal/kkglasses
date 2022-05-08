<h2>{l s="3. Rozstaw źrenic (PD)" d="Modules.KkGlasses.Creator"}</h2>
<div class="kkglasses-spacing">
    <div class="spacing-radio">
    <div>
        <input type="radio" id="same_spacing" name="spacing_type" checked>
        <label for="same_spacing">{l s="PD TAKIE SAMO DLA OBU OCZU" d="Modules.KkGlasses.Creator"}</label>
    </div>
    <div>
        <input type="radio" id="different_spacing" name="spacing_type">
        <label for="different_spacing">{l s="PD RÓŻNE DLA OBU OCZU" d="Modules.KkGlasses.Creator"}</label>
    </div>
    </div>
    <div id="same_spacing_container" class="spacing-input-container">
        <input type="number" step="0.01" id="pd_same">
    </div>
    <div id="different_spacing_container" class="spacing-input-container">
        <p>
            <label for="pd_r">{l s="lewe:" d="Modules.KkGlasses.Creator"}</label>
            <input type="number" step="0.01" id="pd_l">
        </p>
        <p>
            <label for="pd_r">{l s="prawe:" d="Modules.KkGlasses.Creator"}</label>
            <input type="number" step="0.01" id="pd_p">
        </p>
    </div>
    <div>
        <div>{l s="Jak zmierzyć PD?" d="Modules.KkGlasses.Creator"}</div>
        <a href="#">{l s="Aplikacja na smartfon" d="Modules.KkGlasses.Creator"}</a>
        <a href="#">{l s="Zmierz online" d="Modules.KkGlasses.Creator"}</a>
        <a href="#">{l s="Pomiar linijką" d="Modules.KkGlasses.Creator"}</a>
        <a href="#">{l s="jak przeczytać receptę" d="Modules.KkGlasses.Creator"}</a>
    </div>
</div>