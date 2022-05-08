<h2>{l s="1. Wybierz zastosowanie soczewek" d="Modules.KkGlasses.Creator"}</h2>
<div class="kkglasses-use">
    {foreach $product.attributes[$id_use].values key="attribute_id" item="attribute"}
    <label class="kkglasses-card" for="group_{$id_use}_{$attribute_id}">
        <input id="group_{$id_use}_{$attribute_id}" type="radio" name="group[{$id_use}]" value="{$attribute_id}">
        <p class="use-title">{$attribute.name}</p>
        <p>{$attribute.desc nofilter}</p>
    </label>
    {/foreach}
</div>