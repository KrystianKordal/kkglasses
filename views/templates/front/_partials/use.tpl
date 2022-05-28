<div class="creator-section">
    <h2>{l s="1. Wybierz zastosowanie soczewek" d="Modules.KkGlasses.Creator"}</h2>
    <div class="kkglasses-use">
        {if isset($product.attributes[$id_use])}
            {foreach $product.attributes[$id_use].values key="attribute_id" item="attribute"}
            <label class="kkglasses-card" for="group_{$id_use}_{$attribute_id}">
                <div>
                    <input class="use-radio" id="group_{$id_use}_{$attribute_id}" type="radio" name="group[{$id_use}]" value="{$attribute_id}">
                    <p class="use-title">{$attribute.name}</p>
                    <p>{$attribute.desc nofilter}</p>
                </div>
                <button class="btn btn-primary card-button">Wybierz</button>
            </label>
            {/foreach}
        {/if}
    </div>
    <p class="error-msg use-error">{l s="Musisz wybrać jedną z opcji"}</p>
</div>