[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign box=" "}]
<link href="[{$oViewConf->getModuleUrl('jxtaxo','out/admin/src/jxtaxo.css')}]" type="text/css" rel="stylesheet">

<script type="text/javascript">
  if(top)
  {
    top.sMenuItem    = "[{ oxmultilang ident="mxjxexport" }]";
    top.sMenuSubItem = "[{ oxmultilang ident="jxataxo_menu" }]";
    top.sWorkArea    = "[{$_act}]";
    top.setTitle();
  }

    function resizeCodeFrame () {
        var codeframe = document.getElementById('codeframe');
        codeframe.style.height = (window.innerHeight - 150) + "px";;
    }
</script>

[{assign var="oConfig" value=$oViewConf->getConfig()}]

<body>
<div class="center" style="height:100%;">
    <h1><img src="http://upload.wikimedia.org/wikipedia/commons/thumb/6/62/Amazon.com-Logo.svg/320px-Amazon.com-Logo.svg.png" style="height:32px;width:auto;position:relative;top:13px;" />&nbsp;[{ oxmultilang ident="JXATAXO_TITLE" }]</h1>
    <div style="position:absolute;top:4px;right:8px;color:gray;font-size:0.9em;border:1px solid gray;border-radius:3px;">&nbsp;[{$sModuleId}]&nbsp;[{$sModuleVersion}]&nbsp;</div>
    
    [{*<p>*}]
        <form name="transfer" id="transfer" action="[{ $shop->selflink }]" method="post">
            [{ $shop->hiddensid }]
            <input type="hidden" name="oxid" value="[{ $oxid }]">
            <input type="hidden" name="cl" value="article" size="40">
            <input type="hidden" name="updatelist" value="1">
        </form>
        
        <div class="jxgtaxo">

            <form name="jxgtaxo" id="jxgtaxo" action="[{ $oViewConf->getSelfLink() }]" method="post">
                [{ $oViewConf->getHiddenSid() }]
                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                <input type="hidden" name="fnc" value="">
                <input type="hidden" name="oxid" value="[{ $oxid }]">
                
                <input type="submit"
                    onClick="document.forms['jxgtaxo'].elements['fnc'].value = 'saveAmazonCategoryValues';" 
                    value=" [{ oxmultilang ident="GENERAL_SAVE" }] " [{ $readonly }]>

                <div style="text-align:right;margin-right:1%;float:right;">
                    [{if $actIsoLang == "de"}]
                        [<a href="http://www.google.com/basepages/producttype/taxonomy.de-DE.txt" target="_blank">taxonomy.de-DE.txt</a>]
                    [{elseif $actIsoLang == "en"}]
                        [<a href="http://www.google.com/basepages/producttype/taxonomy.en-US.txt" target="_blank">taxonomy.en-US.txt</a>]
                        [{* http://www.google.com/basepages/producttype/taxonomy.en-GB.txt *}]
                    [{elseif $actIsoLang == "fr"}]
                        [<a href="http://www.google.com/basepages/producttype/taxonomy.fr-FR.txt" target="_blank">taxonomy.fr-FR.txt</a>]
                    [{elseif $actIsoLang == "it"}]
                        [<a href="http://www.google.com/basepages/producttype/taxonomy.it-IT.txt" target="_blank">taxonomy.it-IT.txt</a>]
                    [{elseif $actIsoLang == "es"}]
                        [<a href="http://www.google.com/basepages/producttype/taxonomy.es-ES.txt" target="_blank">taxonomy.es-ES.txt</a>]
                    [{/if}]
                </div>
                <div>&nbsp;</div>

                <div id="liste">
                    <table cellspacing="0" cellpadding="0" border="0" width="99%">
                        <tr>
                            [{ assign var="headStyle" value="border-bottom:1px solid #C8C8C8; font-weight:bold;" }]
                            <td class="listfilter first" style="[{$headStyle}]" height="15" width="30" align="center">
                                <div class="r1"><div class="b1">[{ oxmultilang ident="GENERAL_ACTIVTITLE" }]</div></div>
                            </td>
                            [{ if $oConfig->getConfigParam("sJxTaxoDisplayHidden") }]
                                <td class="listfilter" style="[{$headStyle}]" width="30" align="center"><div class="r1"><div class="b1">[{ oxmultilang ident="JXTAXO_HIDDEN" }]</div></div></td>
                            [{/if}]
                            <td class="listfilter" style="[{$headStyle}]"><div class="r1"><div class="b1"> </div></div></td>
                            <td class="listfilter" style="[{$headStyle}]"><div class="r1"><div class="b1">[{ oxmultilang ident="GENERAL_CATEGORY" }]</div></div></td>
                            <td class="listfilter" style="[{$headStyle}]"><div class="r1"><div class="b1"> </div></div></td>
                            <td class="listfilter" style="[{$headStyle}]"><div class="r1"><div class="b1">[{ oxmultilang ident="JXATAXO_TAXOEDITHERE" }]</div></div></td>
                        </tr>
                        
                [{foreach name=rows item=category from=$aCategories}]
                    [{ cycle values="listitem,listitem2" assign="listclass" }]
                    <tr>
                        <td valign="top" class="[{ $listclass}][{if $category.oxactive == 1}] active[{/if}]">
                            <div class="listitemfloating">
                                &nbsp;
                            </div>
                        </td>
                        [{ if $oConfig->getConfigParam("sJxTaxoDisplayHidden") }]
                            <td valign="top" class="[{ $listclass}][{if $category.oxhidden == 1 }] hidden[{/if}]">
                                <div class="listitemfloating" align="center">
                                    &nbsp;
                                </div>
                            </td>
                        [{/if}]
                        <td class="[{$listclass}]">
                            <div class="listitemfloating">&nbsp;[{ $category.path }]&nbsp;</div>
                            <input type="hidden" name="jxtx_catid[]" value="[{$category.oxid}]">
                        </td>
                        <td class="[{$listclass}]">&nbsp;[{ $category.oxtitle }]&nbsp;</td>
                        <td class="[{$listclass}]" align="right">&nbsp;[{ $category.artcount }]&nbsp;</td>
                        <td class="[{$listclass}]"><input id="" name="jxtx_taxoval[]" size="120" value="[{ $category.taxonomy }]" class="flatInput"></td>
                    </tr>
                [{/foreach}]
                </table>
                </div>
                <input type="submit"
                    onClick="document.forms['jxgtaxo'].elements['fnc'].value = 'saveAmazonCategoryValues';" 
                    value=" [{ oxmultilang ident="GENERAL_SAVE" }] " [{ $readonly }]>
            </form>
        </div>
    </p>
    <div style="position:absolute; bottom:0px; left:0px; height:50px; background-color:#dd0000;"></div>

</div>

</body>

