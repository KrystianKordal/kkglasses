<div class="container">
    <h2>Typ soczewek</h2>
    <table>
        {foreach from=$attributes[$id_type] item="attribute"}
        <tr>
            <td><input type="checkbox" name="kkglasses[{$id_type}][{$attribute.id_attribute}][active]" {if $type_data[$attribute.id_attribute]['active']}checked{/if}></td>
            <th>{$attribute.name}</th>
            <td>Cena <input type="number" class="form-control col-md-5" name="kkglasses[{$id_type}][{$attribute.id_attribute}][price]" value="{$type_data[$attribute.id_attribute]['price']}"></td>
        </tr>
        {/foreach}
    </table>
    <h2>Przycienienie soczewek</h2>
    <table>
        {foreach from=$attributes[$id_thin] item="attribute"}
        <tr>
            <td><input type="checkbox" name="kkglasses[{$id_thin}][{$attribute.id_attribute}][active]" {if $thin_data[$attribute.id_attribute]['active']}checked{/if}></td>
            <th>{$attribute.name}</th>
            <td>Cena <input type="number" class="form-control col-md-5" name="kkglasses[{$id_thin}][{$attribute.id_attribute}][price]" value="{$thin_data[$attribute.id_attribute]['price']}"></td>
        </tr>
        {/foreach}
    </table>
</div>