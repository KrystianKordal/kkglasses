<div class="creator-section">
    <h2>{l s="5. Przycienienie soczewek korekcyjnych (redukcja grubości)" d="Modules.KkGlasses.Creator"}</h2>
    <div class="thin-container">
        {if isset($product.attributes[$id_thin])}
            {foreach $product.attributes[$id_thin].values key="attribute_id" item="attribute"}
                <label class='type-card' for="group_{$id_thin}_{$attribute_id}">
                    {include 
                        file="`$partials_dir`radio-button.tpl" 
                        name="group[`$id_thin`]" 
                        idradio="group_`$id_thin`_`$attribute_id`"
                        label=$attribute.name
                        class="thin-radio"
                        checked="{if $attribute@first}checked{else}{/if}"
                        value=$attribute_id}
                    <div class="card-price">
                        +&nbsp;{$attribute.price}
                    </div>
                </label>
            {/foreach}
        {/if}
    </div>
    <p class="error-msg thin-error">{l s="Musisz wybrać jedną z opcji"}</p>
</div>