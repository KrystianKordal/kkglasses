{extends file='page.tpl'}
{block name='head_seo_title'}{l s="Kreator soczewek" d="Modules.KkGlasses.Creator"}{/block}
{block name="page_content"}
    <div class="row">
        <div class="col-md-8">
            <input type="hidden" name="token" value="{$static_token}">
            <h2>{l s="1. Wybierz zastosowanie soczewek" d="Modules.KkGlasses.Creator"}</h2>
            <div>
                {foreach $product.attributes[8].values key="attribute_id" item="attribute"}
                    <p>
                    <input type="radio" name="group[8]" value="{$attribute_id}">
                    <label>{$attribute.name}</label>
                    </p>
                {/foreach}
            </div>
            <h2>{l s="2. Wpisz dane z recepty" d="Modules.KkGlasses.Creator"}</h2>
                <div>
                    <table>
                    <tr>
                        <td></td>
                        <td>{l s="Moc" d="Modules.KkGlasses.Creator"}</td>
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
            <h2>{l s="3. Rozstaw źrenic (PD)" d="Modules.KkGlasses.Creator"}</h2>
            <div>
                <div>
                <p>
                    <input type="radio" id="same_spacing">
                    <label for="same_spacing">{l s="PD TAKIE SAMO DLA OBU OCZU" d="Modules.KkGlasses.Creator"}</label>
                </p>
                <p>
                    <input type="radio" id="different_spacing">
                    <label for="same_spacing">{l s="PD RÓŻNE DLA OBU OCZU" d="Modules.KkGlasses.Creator"}</label>
                </p>
                </div>
                <div>
                    <input type="number" step="0.01" id="pd_same">
                </div>
                <div>
                    <p>
                        <label for="pd_r">{l s="lewe" d="Modules.KkGlasses.Creator"}</label>
                        <input type="number" step="0.01" id="pd_l">
                    </p>
                    <p>
                        <label for="pd_r">{l s="lewe" d="Modules.KkGlasses.Creator"}</label>
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
            <h2>{l s="4. Wybierz typ soczewek korekcyjnych" d="Modules.KkGlasses.Creator"}</h2>
            <div>
                {foreach $product.attributes[9].values key="attribute_id" item="attribute"}
                    <p>
                    <input type="radio" name="group[9]" value="{$attribute_id}">
                    <label>{$attribute.name}</label>
                    </p>
                {/foreach}
            </div>
            <h2>{l s="5. Przycienienie soczewek korekcyjnych (redukcja grubości)" d="Modules.KkGlasses.Creator"}</h2>
            <div>
                {foreach $product.attributes[10].values key="attribute_id" item="attribute"}
                    <p>
                    <input type="radio" name="group[10]" value="{$attribute_id}">
                    <label>{$attribute.name}</label>
                    </p>
                {/foreach}
            </div>
            <div>
            <p>{l s="Po złożeniu zamówienia może z Państwem skontaktować się pracownik Biura Obsługi Klienta, jeżeli konieczne będą dodatkowe ustalenia." d="Modules.KkGlasses.Creator"}</p>
            <p>{l s="Okulary korekcyjne (oprawka + soczewki korekcyjne) są produktem przygotowanym zgodnie z indywidualną potrzebą i według specyfikacji konsumenta, w związku z czym zgodnie z art. 38 pkt. 3 ustawy z dnia 30 maja 2014 roku o prawach konsumenta nie podlegają zwrotowi. Przed finalizacją zamówienia upewnij się, że wybrane przez Ciebie parametry są odpowiednie." d="Modules.KkGlasses.Creator"}</p>
            </div>
            <p>
                <span class="custom-checkbox">
                    <input type="checkbox" id="conditions">
                    <span><i class="material-icons rtl-no-flip checkbox-checked"></i></span>
                </span>
                <label for="conditions">{l s="Sprawdziłem dokładnie receptę i zapoznałem się z regulaminem" d="Modules.KkGlasses.Creator"}</label>
                <p class="conditions-error" style="display: none;">{l s="Musisz zaznaczyć opcję powyżej" d="Modules.KkGlasses.Creator"}</p>
            </p>
            <p>
                <button id="add_to_cart" class="btn btn-primary">{l s="Zamówienie gotowe, przejdź do kasy" d="Modules.KkGlasses.Creator"}</button>
            </p>
        </div>
        <div class="col-md-4">
            <h2>{$product.name}</h2>
            <img src="{$product.image}">
        </div>
    </div>
{/block}