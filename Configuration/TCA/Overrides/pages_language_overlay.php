<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

// Configure new fields for annotation id
include_once("Snippets/fields_annotationID.php");

//include_once("Snippets/fields_annotationNew.php");

foreach ($fields as $field){
// Add new field to translated pages:
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages_language_overlay', $field);
}
// Make field visible in the TCEforms:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'pages_language_overlay', // Table semantify_it
    '--palette--;LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.palette_title;semantify_it', // Field list to add
    '', // List of specific types to add the field list to. (If empty, all type entries are affected)
    'after:nav_title' // Insert fields before (default) or after one, or replace a field
);

// Add the new palette:
$GLOBALS['TCA']['pages_language_overlay']['palettes']['semantify_it'] = array(
    'showitem' => implode(',',$ids)
);