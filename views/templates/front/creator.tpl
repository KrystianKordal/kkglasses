{extends file='page.tpl'}
{block name='head_seo_title'}{l s="Kreator soczewek" d="Modules.KkGlasses.Creator"}{/block}
{block name="page_content"}
<div id="kk-creator">
    <div class="row">
        <div class="col-md-8">
            <input type="hidden" name="token" value="{$static_token}">
            {include file="`$partials_dir`use.tpl"}
            {include file="`$partials_dir`correction.tpl"}
            {include file="`$partials_dir`spacing.tpl"}
            {include file="`$partials_dir`type.tpl"}
            {include file="`$partials_dir`thin.tpl"}
        </div>
        <div class="col-md-4 creator-sidebar">
            <h2>{$product.name}</h2>
            <img class="creator-product-cover" src="{$product.image}">
            <div class="summary-row">
                <span class="summary-title">Oprawki</span>
                <span class="summary-value" id="frame_price" data-price="{$product.price_amount}">{$product.price}</span>
            </div>
            <hr>
            <div class="summary-row">
                <span class="summary-title">Soczewki</span>
                <span class="summary-value" id="lenses_price"></span>
            </div>
            <hr>
            <div class="summary-row total">
                <span class="summary-title">Suma</span>
                <span class="summary-value" id="total_price"></span>
            </div>
            {include file="`$partials_dir`add_to_cart.tpl"}
        </div>
    </div>
</div>
{/block}