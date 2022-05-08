<h2>{l s="4. Wybierz typ soczewek korekcyjnych" d="Modules.KkGlasses.Creator"}</h2>
<div class="type-container">
    {foreach $product.attributes[$id_type].values key="attribute_id" item="attribute"}
        <label class='type-card' for="group_{$id_type}_{$attribute_id}">
            <div class="card-radio">
                <input id="group_{$id_type}_{$attribute_id}" type="radio" name="group[{$id_type}]" value="{$attribute_id}">
            </div>
            <div class="card-description">
                <p>{$attribute.name}</p>
            </div>
            <div class="card-price">
                + 220zł
            </div>
        </label>
    {/foreach}
</div>