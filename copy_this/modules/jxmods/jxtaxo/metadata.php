<?php

/**
 * Metadata version
 */
$sMetadataVersion = '1.1';
 
/**
 * Module information
 * 
 * @link      https://github.com/job963/jxTaxo
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @copyright (C) Joachim Barthel, 2014-2017
 * @author    Joachim Barthel <jobarthel@gmail.com>
 * 
 */
$aModule = array(
    'id'           => 'jxtaxo',
    'title'        => 'jxTaxo - Product Taxonomy for Shopping Portals',
    'description'  => array(
                        'de' => 'Definition der Taxonomie/Klassifizierung je Kategorie für die Preissuchmaschinen'
                                . '<ul>'
                                . '<li>Google Shopping'
                                . '<li>Amazon Produktanzeigen'
                                . '<li>NexTag/Guenstiger.de'
                                . '</ul>',
                        'en' => 'Define the Taxonomy/Classification of each Category for the Shopping Portals'
                                . '<ul>'
                                . '<li>Google Shopping'
                                . '<li>Amazon Product Ads'
                                . '<li>NexTag/Guenstiger.de'
                                . '</ul>'
                        ),
    'thumbnail'    => 'jxtaxo.png',
    'version'      => '0.5.0',
    'author'       => 'Joachim Barthel',
    'url'          => 'https://github.com/job963/jxTaxo',
    'email'        => 'jobarthel@gmail.com',
    'extend'       => array(
                        ),
    'files'        => array(
                        'jxtaxo_events'        => 'jxmods/jxtaxo/core/jxtaxo_events.php',
                        'jxamazoncategory'     => 'jxmods/jxtaxo/application/controllers/admin/jxamazoncategory.php',
                        'jxgoogletaxonomy'     => 'jxmods/jxtaxo/application/controllers/admin/jxgoogletaxonomy.php',
                        'jxnextagcategory'     => 'jxmods/jxtaxo/application/controllers/admin/jxnextagcategory.php',
                        'jxtaxoshowexport'     => 'jxmods/jxtaxo/application/controllers/admin/jxtaxoshowexport.php'
                            ),
    'templates'    => array(
                        'jxamazoncategory.tpl' => 'jxmods/jxtaxo/application/views/admin/tpl/jxamazoncategory.tpl',
                        'jxgoogletaxonomy.tpl' => 'jxmods/jxtaxo/application/views/admin/tpl/jxgoogletaxonomy.tpl',
                        'jxnextagcategory.tpl' => 'jxmods/jxtaxo/application/views/admin/tpl/jxnextagcategory.tpl',
                        'jxtaxoshowexport.tpl' => 'jxmods/jxtaxo/application/views/admin/tpl/jxtaxoshowexport.tpl'
                            ),
    'events'       => array(
                        'onActivate'   => 'jxtaxo_events::onActivate', 
                        'onDeactivate' => 'jxtaxo_events::onDeactivate'
                        ),
    'settings'     => array(
                        array(
                            'group' => 'JXTAXO_DISPLAY', 
                            'name'  => 'sJxTaxoDisplayInactive', 
                            'type'  => 'bool', 
                            'value' => TRUE
                            ),
                        array(
                            'group' => 'JXTAXO_DISPLAY', 
                            'name'  => 'sJxTaxoDisplayHidden', 
                            'type'  => 'bool', 
                            'value' => TRUE
                            ),
                        array(
                            'group' => 'JXTAXO_DISPLAY', 
                            'name'  => 'sJxTaxoCountAllProducts', 
                            'type'  => 'bool', 
                            'value' => TRUE
                            ),
                        array(
                            'group' => 'JXTAXO_PROPOSALS', 
                            'name'  => 'sJxTaxoAmazonCategoryLocation',  
                            'type'  => 'str', 
                            'value' => 'out/admin/src/amazoncategories.txt'
                            ),
                        array(
                            'group' => 'JXTAXO_PROPOSALS', 
                            'name'  => 'sJxTaxoNextagCategoryLocation',  
                            'type'  => 'str', 
                            'value' => 'out/admin/src/nextagcategories.txt'
                            ),
                        array(
                            'group' => 'JXTAXO_EXPORT', 
                            'name'  => 'sJxTaxoExportPath',  
                            'type'  => 'str', 
                            'value' => 'export'
                            ),
                        array(
                            'group' => 'JXTAXO_EXPORT', 
                            'name' => 'aJxTaxoSystems',          
                            'type' => 'arr',      
                            'value' => array('Google/google.txt/~','idealo/idalo.txt/|')
                            ),
                        )
    );

?>
