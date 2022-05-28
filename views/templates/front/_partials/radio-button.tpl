<label for="{$idradio}">
    <div class="row">
        <div class="custom-radio-container">
            <span class="custom-radio float-xs-left">
                <input 
                    class="{$class}"
                    type="radio" 
                    name="{$name}" 
                    id="{$idradio}" 
                    value="{$value}" 
                    {if isset($extracontent)}{$extracontent}{/if}
                    {$checked}>
                <span></span>
            </span>
        </div>
        <div class="radio-label-container">
            <div>
                <span>{$label}</span>
            </div>
        </div>
    </div>
</label>