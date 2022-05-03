<h2>{l s="1. Wybierz zastosowanie soczewek" d="Modules.KkGlasses.Creator"}</h2>
<div>
    {foreach $product.attributes[$id_use].values key="attribute_id" item="attribute"}
        <p>
        <input type="radio" name="group[{$id_use}]" value="{$attribute_id}">
        <label>{$attribute.name}</label>
        </p>
        <p>{$attribute.desc nofilter}</p>
    {/foreach}
</div>