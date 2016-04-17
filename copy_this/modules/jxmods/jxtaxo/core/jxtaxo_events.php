<?php
/*
 *    This file is part of the module jxTaxo for OXID eShop Community Edition.
 *
 *    OXID eShop Community Edition is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    OXID eShop Community Edition is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      https://github.com/job963/jxTaxo
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @copyright (C) Joachim Barthel 2014-2015
 * 
 */

class jxTaxo_Events
{ 
    public static function onActivate() 
    { 
        $oDb = oxDb::getDb(); 
        
        $sLogPath = oxRegistry::get("oxConfig")->getConfigParam("sShopDir") . '/log/';
        $fh = fopen( $sLogPath.'jxmods.log', "a+" );

        $aSql = array();
        $aSql[] = array(
                    "table"     => "oxcategories",
                    "field"     => "JXGOOGLETAXONOMY",
                    "statement" => "ALTER TABLE oxcategories ADD COLUMN `JXGOOGLETAXONOMY` VARCHAR(255) NULL "
                ); 
        $aSql[] = array(
                    "table"     => "oxcategories",
                    "field"     => "JXAMAZONCATEGORY",
                    "statement" => "ALTER TABLE oxcategories ADD COLUMN `JXAMAZONCATEGORY` VARCHAR(255) NULL "
                ); 
        $aSql[] = array(
                    "table"     => "oxcategories",
                    "field"     => "JXNEXTAGCATEGORY",
                    "statement" => "ALTER TABLE oxcategories ADD COLUMN `JXNEXTAGCATEGORY` VARCHAR(255) NULL "
                ); 
                
        try {
            foreach ($aSql as $sSql) {
                if ( !$oDb->getOne( "SHOW COLUMNS FROM {$sSql['table']} LIKE '{$sSql['field']}'", false, false ) ) {
                    $oRs = $oDb->Execute($sSql['statement']);
                }
            }
        }
        catch (Exception $e) {
            fputs( $fh, date("Y-m-d H:i:s ").'jxTaxo: '.$e->getMessage() );
            echo '<div style="border:2px solid #dd0000;margin:10px;padding:5px;background-color:#ffdddd;font-family:sans-serif;font-size:14px;">';
            echo '<b>SQL-Error '.$e->getCode().' in SQL statement</b><br />'.$e->getMessage().'';
            echo '</div>';
        }
        fclose($fh);
        
        return TRUE; 
    } 

    
    public static function onDeactivate() 
    { 
        // do nothing
        
        return TRUE; 
    }  
}
