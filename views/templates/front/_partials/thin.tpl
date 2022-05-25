<div class="creator-section">
<h2>{l s="5. Przycienienie soczewek korekcyjnych (redukcja grubości)" d="Modules.KkGlasses.Creator"}</h2>
<div class="thin-container">
    {if isset($product.attributes[$id_thin])}
        {foreach $product.attributes[$id_thin].values key="attribute_id" item="attribute"}
            <label class='type-card' for="group_{$id_thin}_{$attribute_id}">
                <div class="card-radio">
                    <input 
                        id="group_{$id_thin}_{$attribute_id}" 
                        class="thin-radio"
                        type="radio" 
                        name="group[{$id_thin}]" 
                        value="{$attribute_id}"
                        data-price="{$attribute.price_amount}"
                        {if $attribute@first}checked{/if}>
                </div>
                <div class="card-description">
                    <p>{$attribute.name}</p>
                </div>
                <div class="card-price">
                    +&nbsp;{$attribute.price}
                </div>
            </label>
        {/foreach}
    {/if}
</div>
</div>