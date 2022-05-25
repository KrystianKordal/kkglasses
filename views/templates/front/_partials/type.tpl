<div class="creator-section">
    <h2>{l s="4. Wybierz typ soczewek korekcyjnych" d="Modules.KkGlasses.Creator"}</h2>
    <div class="type-container">
        {if isset($product.attributes[$id_type])}
            {foreach $product.attributes[$id_type].values key="attribute_id" item="attribute"}
                <label class='type-card' for="group_{$id_type}_{$attribute_id}">
                    <div class="card-radio">
                        <input 
                        id="group_{$id_type}_{$attribute_id}" 
                        class="type-radio"
                        type="radio" 
                        name="group[{$id_type}]" 
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
