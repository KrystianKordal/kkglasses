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
            {include file="`$partials_dir`add_to_cart.tpl"}
        </div>
        <div class="col-md-4">
            <h2>{$product.name}</h2>
            <img src="{$product.image}">
        </div>
    </div>
</div>
{/block}