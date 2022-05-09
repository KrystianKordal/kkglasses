<div class="container">
    <h2>Typ soczewek</h2>
    {foreach from=$attributes[$id_type] item="attribute"}
    <div>
        <h3>{$attribute.name}</h3>
        <p><input type="checkbox" name="kkglasses[{$id_type}][{$attribute.id_attribute}][active]"> <label>Aktywny</label></p>
        <p>Cena <input type="number" class="form-control col-md-3" name="kkglasses[{$id_type}][{$attribute.id_attribute}][price]"></p>
    </div>
    {/foreach}
    <h2>Przycienienie soczewek</h2>
    {foreach from=$attributes[$id_thin] item="attribute"}
    <div>
        <h3>{$attribute.name}</h3>
        <p><input type="checkbox" name="kkglasses[{$id_thin}][{$attribute.id_attribute}][active]"> <label>Aktywny</label></p>
        <p>Cena <input type="number" class="form-control col-md-3" name="kkglasses[{$id_thin}][{$attribute.id_attribute}][price]"></p>
    </div>
    {/foreach}
</div>