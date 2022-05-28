<div class="creator-section">
<h2>{l s="3. Rozstaw źrenic (PD)" d="Modules.KkGlasses.Creator"}</h2>
<div class="kkglasses-spacing">
    <div class="spacing-radio">
    <div class='radio-container'>
    {include 
        file="`$partials_dir`radio-button.tpl" 
        name="spacing_radio" 
        idradio="same_spacing"
        label="PD TAKIE SAMO DLA OBU OCZU" 
        class="spacing-input"
        checked="checked"
        value=""}
    </div>
    <div class='radio-container'>
    {include 
        file="`$partials_dir`radio-button.tpl" 
        idradio="different_spacing"
        name="spacing_radio" 
        label="PD RÓŻNE DLA OBU OCZU" 
        class="spacing-input"
        checked=""
        value=""}
    </div>

    </div>
    <div id="same_spacing_container" class="spacing-input-container">
        <input type="number" step="0.01" id="pd_same" class="spacing-input">
    </div>
    <div id="different_spacing_container" class="spacing-input-container">
        <table>
            <tr>
                <td>
                    <label for="pd_r">{l s="lewe:" d="Modules.KkGlasses.Creator"}</label>
                    <input type="number" step="0.01" id="pd_l" class="spacing-input">
                </td>
                <td>
                    <label for="pd_r">{l s="prawe:" d="Modules.KkGlasses.Creator"}</label>
                    <input type="number" step="0.01" id="pd_p" class="spacing-input">
                </td>
            </tr>
        </table>
    
    </div>
    <p class="error-msg spacing-error">Wartości nie są wprowadzone poprawnie</p>
    <div class="hahaha-container">
        <div class="hahaha">{l s="Jak zmierzyć PD?" d="Modules.KkGlasses.Creator"}</div>
        <a href="#" class="hahaha-option">{l s="Aplikacja na smartfon"|replace:" ":"&nbsp;" d="Modules.KkGlasses.Creator"}</a>
        <a href="#" class="hahaha-option">{l s="Zmierz online"|replace:" ":"&nbsp;" d="Modules.KkGlasses.Creator"}</a>
        <a href="#" class="hahaha-option">{l s="Pomiar linijką"|replace:" ":"&nbsp;" d="Modules.KkGlasses.Creator"}</a>
        <a href="#" class="hahaha-option">{l s="Jak przeczytać receptę"|replace:" ":"&nbsp;" d="Modules.KkGlasses.Creator"}</a>
    </div>
</div>
</div>