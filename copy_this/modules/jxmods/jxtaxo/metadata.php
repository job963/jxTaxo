<?php

/**
 * Metadata version
 */
$sMetadataVersion = '1.1';
 
/**
 * Module information
 */
$aModule = array(
    'id'           => 'jxtaxo',
    'title'        => 'jxTaxo - Product Taxonomy for Shopping Portals',
    'description'  => array(
                        'de' => 'Definition der Taxonomie/Klassifizierung je Kategorie f&uuml;r Preissuchmaschinen wie Google Shopping oder Amazon Produktanzeigen',
                        'en' => 'Define the Taxonomy/Classification of each Category for Shopping Portals like Google Shopping or Amazon Product Ads'
                        ),
    'thumbnail'    => 'jxtaxo.png',
    'version'      => '0.2',
    'author'       => 'Joachim Barthel',
    'url'          => 'https://github.com/job963/jxTaxo',
    'email'        => 'jobarthel@gmail.com',
    'extend'       => array(
                        ),
    'files'        => array(
        'jxtaxo_events'        => 'jxmods/jxtaxo/core/jxtaxo_events.php',
        'jxamazoncategory'     => 'jxmods/jxtaxo/application/controllers/admin/jxamazoncategory.php',
        'jxgoogletaxonomy'     => 'jxmods/jxtaxo/application/controllers/admin/jxgoogletaxonomy.php',
        'jxnextagcategory'     => 'jxmods/jxtaxo/application/controllers/admin/jxnextagcategory.php'
                            ),
    'templates'    => array(
        'jxamazoncategory.tpl' => 'jxmods/jxtaxo/application/views/admin/tpl/jxamazoncategory.tpl',
        'jxgoogletaxonomy.tpl' => 'jxmods/jxtaxo/application/views/admin/tpl/jxgoogletaxonomy.tpl',
        'jxnextagcategory.tpl' => 'jxmods/jxtaxo/application/views/admin/tpl/jxnextagcategory.tpl'
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
                        )
    );

?>
