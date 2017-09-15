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

class jxTaxoShowExport extends oxAdminView
{
    /**
     *
     * @var type 
     */
    protected $_sThisTemplate = "jxtaxoshowexport.tpl";
            
    
    /**
     * 
     * @return type
     */
    public function render()
    {
        parent::render();
        
        $oConfig = oxRegistry::get("oxConfig");
        $aSystems = $oConfig->getConfigParam("aJxTaxoSystems");
        foreach ($aSystems as $key => $sSystem) {
            $aSystems[$key] = explode('/', $sSystem);
        }
        
        $sExportPath = oxRegistry::get("oxConfig")->getConfigParam("sShopDir") . '/export/';
        $sSelSystem = $this->getConfig()->getRequestParameter( 'jxselsystem' );
        
        $aExport = array();
        foreach ($aSystems as $aSystem) {
            if ($aSystem[0] == $sSelSystem) {
                $aExportData = $this->_getExportData($sExportPath.$aSystem[1], $aSystem[2]);
            }
        }
        
        $oModule = oxNew('oxModule');
        $oModule->load('jxtaxo');
        $this->_aViewData["sModuleId"] = $oModule->getId();
        $this->_aViewData["sModuleVersion"] = $oModule->getInfo('version');
        foreach ($this->_aViewData["languages"] as $lang) {
            if ($lang->selected)
                $this->_aViewData["actIsoLang"] = $lang->abbr;
        }
        
        $this->_aViewData["aSystems"] = $aSystems;
        $this->_aViewData["sSelSystem"] = $sSelSystem;
        $this->_aViewData["aExportData"] = $aExportData;

        return $this->_sThisTemplate;
    }
    
    
    /**
     * 
     * @param type $sFilename
     * @param type $sDelimeter
     * 
     * @return type
     */
    private function _getExportData($sFilename, $sDelimeter) 
    {
        $fh = fopen($sFilename, 'r');
        $aData = array();
        
        if ($fh) {
            $aData[] = explode($sDelimeter, fgets($fh));

            while (!feof($fh)) { 
                $aData[] = explode($sDelimeter, fgets($fh, 9999));
            }
            fclose($fh);
        }
        
        return $aData;
    }
    
}