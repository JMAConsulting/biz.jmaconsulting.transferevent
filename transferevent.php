<?php

require_once 'transferevent.civix.php';

/**
 * Implementation of hook_civicrm_config
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function transferevent_civicrm_config(&$config) {
  _transferevent_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function transferevent_civicrm_xmlMenu(&$files) {
  _transferevent_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function transferevent_civicrm_install() {
  _transferevent_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function transferevent_civicrm_uninstall() {
  _transferevent_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function transferevent_civicrm_enable() {
  _transferevent_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function transferevent_civicrm_disable() {
  _transferevent_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function transferevent_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _transferevent_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function transferevent_civicrm_managed(&$entities) {
  $entities[] = array(
    'module' => 'biz.jmaconsulting.transferevent',
    'name' => 'transferevent',
    'update' => 'never',
    'entity' => 'OptionValue',
    'params' => array(
      'label' => "Event Transferred",
      'name' => "event_transfer",
      'description' => "The event has been transferred for a single participant.",
      'option_group_id' => 'activity_type',
      'component_id' => CRM_Core_Component::getComponentID('CiviEvent'),
      'is_reserved' => 1,
      'is_active' => 1,
      'version' => 3,
    ),
  );
  _transferevent_civix_civicrm_managed($entities);
}

/**
 * Implementation of hook_civicrm_caseTypes
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function transferevent_civicrm_caseTypes(&$caseTypes) {
  _transferevent_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implementation of hook_civicrm_alterSettingsFolders
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function transferevent_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _transferevent_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

function transferevent_civicrm_links($op, $objectName, $objectId, &$links, &$mask, &$values) {
  if ($objectName == "Participant" && $op == "participant.selector.row") {
    $transferLink = array(
      'name' => ts('Transfer Event'),
      'url' => 'civicrm/event/transfer',
      'qs' => "reset=1&pid=%%participantId%%",
    );
    $links[] = $transferLink;
    $values['participantId'] = $objectId;
  }
}

function transferevent_civicrm_searchTasks($objectType, &$tasks) {
  if ($objectType == 'event') {
    $tasks[] = array(
      'title' => 'Transfer Event for participant(s)',
      'class' => 'CRM_TransferEvent_Form_Task_TransferEvent',
      'result' => 1,
    );
  }
}