<?php
    use \TYPO3\CMS\Core\Utility\GeneralUtility;
    use \STI\SemantifyIt\Domain\Model\SemantifyItWrapper;


    class tx_annotation_input
    {
        protected $sqlFROM = 'pages';
        protected $sqlSELECT = 'semantify_it_annotationID';

        function performNotCached(&$params, &$that)
        {
            if (!$GLOBALS['TSFE']->isINTincScript()) {
                return;
            }
            $this->main($params, $that);
        }

        function performCached(&$params, &$that)
        {
            if ($GLOBALS['TSFE']->isINTincScript()) {
                return;
            }
            $this->main($params, $that);
        }

        /**
         * performs the main injector task (reading database -> get json from semantify.it -> inject)
         *
         * @param $params object
         * @param $that   object not used at the moment
         */
        function main(&$params, &$that)
        {
            $currentPageId = $GLOBALS['TSFE']->id;

            //
            /*
             * language support
             * if language != 0 sqlFrom=pages_language_overlay ... where paramter = pid , sys_langauge_uid
             *
             */
            /* Philipp Parth added  begin */
            if ($GLOBALS['TSFE']->sys_language_uid != 0) {
                $this->sqlFROM = "pages_language_overlay";

                //read from database
                $dbEntries = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                    $this->sqlSELECT,
                    $this->sqlFROM,
                    'pid = ' . $currentPageId . ' AND sys_language_uid = ' . $GLOBALS['TSFE']->sys_language_uid
                );
            } else {

                $dbEntries = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                    $this->sqlSELECT,
                    $this->sqlFROM,
                    'uid = ' . $currentPageId
                );
            }
            /* Philipp Parth added  end */



            //check entries
            if (!isset($dbEntries) || $GLOBALS['TYPO3_DB']->sql_num_rows($dbEntries) == 0) {
                return;
            } else {

                //starting wrapper
                $Semantify = new SemantifyItWrapper();
                $annotation = "";

                //get annotations from the database
                foreach ($dbEntries as $res) {


                    $anno_id = $res[$this->sqlSELECT];


                    break;
                }


                //if it is field not empty or with 0
                if (!(($anno_id == "0") || ($anno_id == ""))) {
                    $annotation = $Semantify->getAnnotation($anno_id);
                } else {
                    $url = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL');
                    $annotation = $Semantify->getAnnotationByURL($url);
                }

                //if it is field not empty or with 0
                if (($annotation != "0") && ($annotation !== false) && ($annotation != "")) {
                    $this->addAnnotation($params['pObj']->content, $annotation);
                }
            }
        }

        /**
         * this function takes a pointer to the actual html content of the page rendered. It injects the string inside $codeToInject before the closing head tag
         *
         * @param $content      string the actual html content rendered
         * @param $codeToInject string to inject
         */
        private function addAnnotation(&$content, $annotation)
        {
            if (strlen($annotation) == 0) {
                return;
            }

            $semantify_text = '\************************ annotated by semantify.it ************************\
 ';

            $content = str_replace("</head>", '<script type="application/ld+json">'.$semantify_text . $annotation . '</script>' . '</head>', $content);
        }
    }