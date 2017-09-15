[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign box=" "}]
<link href="[{$oViewConf->getModuleUrl('jxtaxo','out/admin/src/jxtaxo.css')}]" type="text/css" rel="stylesheet">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

<style>
    .wd20 {
        width:20px;
    }
    .wd100 {
        width:100px;
    }
    .iffyTip {
        overflow:hidden;
        white-space:nowrap;
        text-overflow:ellipsis;
    }
</style>

<body>
<div class="center" style="height:100%;">
    <h2>&nbsp;[{ oxmultilang ident="JXTAXO_SHOWEXPORT" }]</h2>
    <div style="position:absolute;top:4px;right:8px;color:gray;font-size:0.9em;border:1px solid gray;border-radius:3px;">
        &nbsp;[{$sModuleId}]&nbsp;[{$sModuleVersion}]&nbsp;
    </div>
    
    [{*<p>*}]
        <form name="transfer" id="transfer" action="[{ $shop->selflink }]" method="post">
            [{ $shop->hiddensid }]
            <input type="hidden" name="oxid" value="[{ $oxid }]">
            <input type="hidden" name="cl" value="jxtaxoshowexport" size="40">
            <input type="hidden" name="updatelist" value="1">
        </form>
        <form name="jxtaxo" id="jxtaxo" action="[{ $oViewConf->getSelfLink() }]" method="post">
            [{ $oViewConf->getHiddenSid() }]
            <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
            <input type="hidden" name="fnc" value="">
            <input type="hidden" name="jxselsystem" value="">
            <input type="hidden" name="oxid" value="[{ $oxid }]">
            [{foreach item=aSystem from=$aSystems }]
                &nbsp;
                <input type="submit"
                    [{*onClick="document.forms['jxtaxo'].elements['fnc'].value = 'saveNextagCategoryValues';" *}]
                    onClick="document.forms['jxtaxo'].elements['jxselsystem'].value = '[{$aSystem[0]}]';" 
                    style="[{if $aSystem[0] == $sSelSystem}]font-weight:bold;background-color:lightgray;[{else}][{/if}]" 
                    value=" [{$aSystem[0]}] " [{ $readonly }]>
            [{/foreach}]
        </form>
        
        <div class="jxgtaxo">
                <div id="liste" style="width:100%;">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                [{foreach item=sCell from=$aExportData[0] }]
                                    [{cycle values="listitem,listitem2" assign="listclass" }]
                                    <th class="wd100">
                                        [{$sCell}]
                                    </th>
                                [{/foreach}]
                            </tr>
                        </thead>
                        <tbody>
                        [{foreach name=csv item=aLine from=$aExportData}]
                            [{if $smarty.foreach.csv.first}]
                            [{else}]
                                <tr>
                                    [{foreach item=sCell from=$aLine }]
                                        [{cycle values="listitem,listitem2" assign="listclass" }]
                                        <td>
                                            <div class="iffyTip wd100">
                                                [{$sCell}]
                                            </div>
                                        </td>
                                    [{/foreach}]
                                </tr>
                            [{/if}]
                        [{/foreach}]
                        </tbody>
                </table>
                </div>
        </div>
    </p>
    <div style="position:absolute; bottom:0px; left:0px; height:50px; background-color:#dd0000;"></div>

</div>

</body>

<script>
$(document).on('mouseenter', ".iffyTip", function () {
     var $this = $(this);
     if (this.offsetWidth < this.scrollWidth && !$this.attr('title')) {
         $this.tooltip({
             title: $this.text(),
             placement: "bottom"
         });
         $this.tooltip('show');
     }
 });
</script>