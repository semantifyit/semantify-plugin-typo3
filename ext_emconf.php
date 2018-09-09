<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "semantify_it"
 *
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
    'title' => 'semantify.it',
    'description' => 'Deploy your annotations from semantify.it to your typo3 website.',
    'category' => 'plugin',
    'author' => 'semantify.it',
    'author_company' => 'semantify.it',
    'author_email' => 'typo3@semantify.it',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '0.1.8',
    'constraints' => array(
        'depends' => array(
            'typo3' => '6.2.0-8.5.99',
        ),
        'conflicts' => array(
            'mayrhofen_annotator' => '0.1.0-9.9.9'
        ),
        'suggests' => array(
        ),
    ),
);
