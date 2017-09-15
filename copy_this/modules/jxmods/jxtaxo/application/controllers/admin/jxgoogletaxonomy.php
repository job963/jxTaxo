<?php

/*
 *    This file is part of the module jxTaxo for OXID eShop Community Edition.
 *
 *    The module jxTaxo for OXID eShop Community Edition is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    The module jxTaxo for OXID eShop Community Edition is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      https://github.com/job963/jxTaxo
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @copyright (C) Joachim Barthel, 2014-2017
 * @author    Joachim Barthel <jobarthel@gmail.com>
 *
 */
 
class jxGoogleTaxonomy extends oxAdminView
{
    protected $_sThisTemplate = "jxgoogletaxonomy.tpl";
    protected $aCategories = array();
            
    public function render()
    {
        parent::render();
        
        $this->jxGetCategoryList( 'oxrootid', '', '' );
        $this->jxSortCategoryList();
        
        $oModule = oxNew('oxModule');
        $oModule->load('jxtaxo');
        $this->_aViewData["sModuleId"] = $oModule->getId();
        $this->_aViewData["sModuleVersion"] = $oModule->getInfo('version');
        foreach ($this->_aViewData["languages"] as $lang) {
            if ($lang->selected)
                $this->_aViewData["actIsoLang"] = $lang->abbr;
        }

        $this->_aViewData["aCategories"] = $this->aCategories;

        return $this->_sThisTemplate;
    }
    
    
    public function saveGoogleTaxonomyValues()
    {
        $oDb = oxDb::getDb();
        $aCatIds = $this->getConfig()->getRequestParameter( 'jxtx_catid' ); 
        $aTaxoVals = $this->getConfig()->getRequestParameter( 'jxtx_taxoval' ); 
        foreach ($aTaxoVals as $key => $sTaxoValue) {
            $sSql = "UPDATE oxcategories SET jxgoogletaxonomy = '{$aTaxoVals[$key]}' WHERE oxid = '{$aCatIds[$key]}' ";
            $oDb->execute($sSql);
        }
        return;
    }
    
    
    public function jxGetCategoryList( $sParent, $sNoPath, $sCatPath )
    {
        $myConfig = $this->getConfig();
        
        if ( !empty($sNoPath) ) {
            $sNoPath .= '.';
            $sCatPath .= ' / ';
        }
        
        $sWhere = "";
        if ( $myConfig->getConfigParam('sJxTaxoDisplayInactive') == FALSE )
            $sWhere .= "AND c.oxactive = 1 ";
        if ( $myConfig->getConfigParam('sJxTaxoDisplayHidden') == FALSE )
            $sWhere .= "AND c.oxhidden = 0 ";
        if ( $myConfig->getConfigParam('sJxTaxoCountAllProducts') == FALSE ) {
            $sArtCount = "SELECT COUNT(*) FROM oxobject2category o2c, oxarticles a WHERE o2c.oxcatnid = c.oxid AND o2c.oxobjectid = a.oxid AND oxactive = 1";
        } else {
            $sArtCount = "SELECT COUNT(*) FROM oxobject2category o2c WHERE o2c.oxcatnid = c.oxid";
        }
        
        $sSql = "SELECT c.oxid, c.oxtitle, c.oxactive, c.oxhidden, "
                    //. "(SELECT COUNT(*) FROM oxobject2category o2c WHERE o2c.oxcatnid = c.oxid) AS artcount, "
                    . "({$sArtCount}) AS artcount, "
                    . "(SELECT COUNT(*) FROM oxcategories c1 WHERE c1.oxparentid=c.oxid) AS count, c.jxgoogletaxonomy AS taxonomy "
                . "FROM oxcategories c "
                . "WHERE c.oxparentid = '$sParent' "
                    . $sWhere
                . "ORDER BY c.oxtitle";
        
        $oDb = oxDb::getDb( oxDB::FETCH_MODE_ASSOC );
        $rs = $oDb->Execute($sSql);

        $i = 1;
        while (!$rs->EOF) {
            $aCols = $rs->fields;
            $aCols['path'] = $sNoPath . $i;
            $aCols['oxtitle'] = $sCatPath . $aCols['oxtitle'];
            array_push($this->aCategories, $aCols);
            if ($aCols['count'] != 0) {
                $this->jxGetCategoryList($aCols['oxid'], $aCols['path'], $aCols['oxtitle']);
            }
            $rs->MoveNext();
            $i++;
        }
        
        return;
    }
    
    
    public function jxSortCategoryList()
    {
        $aSort = array();
        foreach ($this->aCategories as $key => $aRow) {
            $aSort[$key] = $aRow['oxtitle'];
        }
        array_multisort($aSort, SORT_ASC, SORT_STRING, $this->aCategories);
    }

    
    public function jxGetModulePath()
    {
        $sModuleId = $this->getEditObjectId();

        $this->_aViewData['oxid'] = $sModuleId;

        $oModule = oxNew('oxModule');
        $oModule->load($sModuleId);
        $sModuleId = $oModule->getId();
        
        $myConfig = oxRegistry::get("oxConfig");
        $sModulePath = $myConfig->getConfigParam('sShopDir') . 'modules/' . $oModule->getModulePath('jxtaxo');
        
        return $sModulePath;
    }
    
}
