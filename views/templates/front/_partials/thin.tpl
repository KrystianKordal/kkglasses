<h2>{l s="5. Przycienienie soczewek korekcyjnych (redukcja grubości)" d="Modules.KkGlasses.Creator"}</h2>
<div>
    {foreach $product.attributes[$id_thin].values key="attribute_id" item="attribute"}
        <p>
        <input type="radio" name="group[{$id_thin}]" value="{$attribute_id}">
        <label>{$attribute.name}</label>
        </p>
    {/foreach}
</div>