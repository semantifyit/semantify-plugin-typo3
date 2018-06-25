#
# Modifying pages table
#

CREATE TABLE pages (

  semantify_it_annotationID varchar(10) DEFAULT '' NOT NULL,
  semantify_it_annotationNew_ID varchar(10) DEFAULT '' NOT NULL,
  semantify_it_annotationNew_SemantifyID varchar(255) DEFAULT '' NOT NULL,
  semantify_it_annotationNew_StepOne varchar(255) DEFAULT '' NOT NULL,
  semantify_it_annotationNew_StepTwo varchar(255) DEFAULT '' NOT NULL,
  semantify_it_annotationNew_Name varchar(255) DEFAULT '' NOT NULL,
  semantify_it_annotationNew_URL varchar(255) DEFAULT '' NOT NULL

);

#
# Modifying pages_language_overlay table
#
CREATE TABLE pages_language_overlay (
  semantify_it_annotationID varchar(10) DEFAULT '' NOT NULL,
  semantify_it_annotationNew_ID varchar(10) DEFAULT '' NOT NULL,
  semantify_it_annotationNew_SemantifyID varchar(255) DEFAULT '' NOT NULL,
  semantify_it_annotationNew_StepOne varchar(255) DEFAULT '' NOT NULL,
  semantify_it_annotationNew_StepTwo varchar(255) DEFAULT '' NOT NULL,
  semantify_it_annotationNew_Name varchar(255) DEFAULT '' NOT NULL,
  semantify_it_annotationNew_URL varchar(255) DEFAULT '' NOT NULL
);