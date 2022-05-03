<h2>{l s="4. Wybierz typ soczewek korekcyjnych" d="Modules.KkGlasses.Creator"}</h2>
<div>
    {foreach $product.attributes[$id_type].values key="attribute_id" item="attribute"}
        <p>
        <input type="radio" name="group[{$id_type}]" value="{$attribute_id}">
        <label>{$attribute.name}</label>
        </p>
    {/foreach}
</div>