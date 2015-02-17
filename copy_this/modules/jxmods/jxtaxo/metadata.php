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
    'title'        => 'jxTaxo -Product Taxonomy for Shopping Portals',
    'description'  => array(
                        'de' => 'Definition der Google Produkt Taxonomie je Kategorie',
                        'en' => 'Define the Google Product Taxonomy for each Category'
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
        'jxgoogletaxonomy'     => 'jxmods/jxtaxo/application/controllers/admin/jxgoogletaxonomy.php'
                        ),
    'templates'    => array(
        'jxamazoncategory.tpl' => 'jxmods/jxtaxo/application/views/admin/tpl/jxamazoncategory.tpl',
        'jxgoogletaxonomy.tpl' => 'jxmods/jxtaxo/application/views/admin/tpl/jxgoogletaxonomy.tpl'
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
                            )
                        )
    );

?>
