<div class="creator-section">
    <h2>{l s="4. Wybierz typ soczewek korekcyjnych" d="Modules.KkGlasses.Creator"}</h2>
    <div class="type-container">
        {if isset($product.attributes[$id_type])}
            {foreach $product.attributes[$id_type].values key="attribute_id" item="attribute"}
                <label class='type-card' for="group_{$id_type}_{$attribute_id}">
                    {include 
                        file="`$partials_dir`radio-button.tpl" 
                        name="group[`$id_type`]" 
                        idradio="group_`$id_type`_`$attribute_id`"
                        label=$attribute.name
                        class="type-radio"
                        checked="{if $attribute@first}checked{else}{/if}"
                        value=$attribute_id
                        extracontent="data-price=`$attribute.price_amount`"
                        }
                    <div class="card-price">
                        +&nbsp;{$attribute.price}
                    </div>
                </label>
            {/foreach}
        {/if}
    </div>
    <p class="error-msg type-error">{l s="Musisz wybrać jedną z opcji"}</p>
</div>
