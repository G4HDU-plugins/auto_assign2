<?php

/**
 * G4HDU Auto Assign plugin
 *
 * Copyright (C) 2008-2016 Barry Keal G4HDU http://www.keal.me.uk
 * released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * @author Barry Keal e107@keal.me.uk>
 * @copyright Copyright (C) 2008-2016 Barry Keal G4HDU
 * @package     e107
 * @subpackage  auto_assign2 
 * @license GPL
 * @version 2.1.0
 * @category e107 user management
 * 
 * @todo Documentation
 */


require_once ("../../class2.php");
if (!getperms("P")) {
    e107::redirect('admin');
    exit;
}
//error_reporting(E_ALL);
require_once (e_PLUGIN . "auto_assign2/handlers/autoassign_class.php");
require_once ("e_version.php");

// for testing
//$data['username'] = 'freddy';
//$data['loginname'] = 'freddy';
//$assign = autoAssign::assignClass($data);

/**
 * plugin_assign_admin
 * 
 * @package     e107
 * @subpackage  auto_assign2 
 * @author Barry Keal G4HDU
 * @copyright 2016 Barry Keal G4HDU
 * @version 2.1.0
 * @access public
 * @since 2.0.0
 * 
 */
class plugin_assign_admin extends e_admin_dispatcher
{
    /**
     * Format: 'MODE' => array('controller' =>'CONTROLLER_CLASS'[, 'index' => 'list', 'path' => 'CONTROLLER SCRIPT PATH', 'ui' => 'UI CLASS NAME child of e_admin_ui', 'uipath' => 'UI SCRIPT PATH']);
     * Note - default mode/action is autodetected in this order:
     * - $defaultMode/$defaultAction (owned by dispatcher - see below)
     * - $adminMenu (first key if admin menu array is not empty)
     * - $modes (first key == mode, corresponding 'index' key == action)
     * @var array
     */
    protected $modes = array('main' => array(
            'controller' => 'plugin_assign_admin_ui',
            'path' => null,
            'ui' => 'plugin_assign_admin_form_ui',
            'uipath' => null));

    /* Both are optional
    * protected $defaultMode = null;
    * protected $defaultAction = null;
    */

    /**
     * Format: 'MODE/ACTION' => array('caption' => 'Menu link title'[, 'url' => '{e_PLUGIN}assign/admin_config.php', 'perm' => '0']);
     * Additionally, any valid e107::getNav()->admin() key-value pair could be added to the above array
     * @var array
     */
    protected $adminMenu = array('main/prefs' => array('caption' => 'Settings',
                'perm' => '0'));

    /**
     * Optional, mode/action aliases, related with 'selected' menu CSS class
     * Format: 'MODE/ACTION' => 'MODE ALIAS/ACTION ALIAS';
     * This will mark active main/list menu item, when current page is main/edit
     * @var array
     */
    //	protected $adminMenuAliases = array(
    //		'main/edit'	=> 'main/list'
    //	);

    /**
     * Navigation menu title
     * @var string
     */
    protected $menuTitle = 'Auto Assign';
}


/**
 * plugin_assign_admin_ui
 * 
 * @package   
 * @author Auto Assign
 * @copyright Father Barry
 * @version 2016
 * @access public
 */
class plugin_assign_admin_ui extends e_admin_ui
{
    /**
     *
     * @var string
     */
    protected $pluginTitle = "Auto Assign";

    /**
     *
     * @var string
     */
    protected $pluginName = 'auto_assign2';

    /**
     *
     * @var array
     */
    protected $fields = array();

    /**
     *
     * @var array
     */
    protected $fieldpref = array();

    /**
     *
     * @var array
     */
    protected $prefs = array(
        'assignAuto_Active' => array(
            'title' => LAN_PLUGIN_ASSIGN_ACTIVE,
            'help' => LAN_PLUGIN_ASSIGN_ACTIVE_HELP,
            'tab' => 0,
            'type' => 'boolean',
            'data' => 'int',
            ),
        'assignAuto_Class1' => array(
            'title' => LAN_PLUGIN_ASSIGN_CLASS1,
            'help' => LAN_PLUGIN_ASSIGN_CLASS_HELP,
            'tab' => 0,
            'type' => 'userclass',
            'data' => 'int',
            'writeParms' => array('default' => 255, 'classlist' =>
                    'new,members,nobody,classes,no-excludes')),
        'assignAuto_Class2' => array(
            'title' => LAN_PLUGIN_ASSIGN_CLASS2,
            'help' => LAN_PLUGIN_ASSIGN_CLASS_HELP,
            'tab' => 0,
            'type' => 'userclass',
            'data' => 'int',
            'writeParms' => array('default' => 255, 'classlist' =>
                    'new,members,nobody,classes,no-excludes')),
        'assignAuto_Class3' => array(
            'title' => LAN_PLUGIN_ASSIGN_CLASS3,
            'help' => LAN_PLUGIN_ASSIGN_CLASS_HELP,
            'tab' => 0,
            'type' => 'userclass',
            'data' => 'int',
            'writeParms' => array('default' => 255, 'classlist' =>
                    'new,members,nobody,classes,no-excludes')),
        'assignAuto_Class4' => array(
            'title' => LAN_PLUGIN_ASSIGN_CLASS4,
            'help' => LAN_PLUGIN_ASSIGN_CLASS_HELP,
            'tab' => 0,
            'type' => 'userclass',
            'data' => 'int',
            'writeParms' => array('default' => 255, 'classlist' =>
                    'new,members,nobody,classes,no-excludes')),
        'assignAuto_Class5' => array(
            'title' => LAN_PLUGIN_ASSIGN_CLASS5,
            'help' => LAN_PLUGIN_ASSIGN_CLASS_HELP,
            'tab' => 0,
            'type' => 'userclass',
            'data' => 'int',
            'writeParms' => array('default' => 255, 'classlist' =>
                    'new,members,nobody,classes,no-excludes')),
        );

    // optional
    /**
     * plugin_assign_admin_ui::init()
     * 
     * @return
     */
    /**
     * plugin_assign_admin_ui::init()
     * 
     * @return
     */
    public function init()
    {
    }

}

/**
 * plugin_assign_admin_form_ui
 * 
 * @package   
 * @author Auto Assign
 * @copyright Father Barry
 * @version 2016
 * @access public
 */
/**
 * plugin_assign_admin_form_ui
 * 
 * @package   
 * @author Auto Assign
 * @copyright Father Barry
 * @version 2016
 * @access public
 */
class plugin_assign_admin_form_ui extends e_admin_form_ui
{

}


/*
* After initialization we'll be able to call dispatcher via e107::getAdminUI()
* so this is the first we should do on admin page.
* Global instance variable is not needed.
* NOTE: class is auto-loaded - see class2.php __autoload()
*/
/* $dispatcher = */

new plugin_assign_admin();

/*
* Uncomment the below only if you disable the auto observing above
* Example: $dispatcher = new plugin_assign_admin(null, null, false);
*/
//$dispatcher->runObservers(true);

require_once (e_ADMIN . "auth.php");

/*
* Send page content
*/
e107::getAdminUI()->runPage();


require_once (e_ADMIN . "footer.php");


/**
 * e_help()
 * 
 * @return
 */

function e_help()
{

    $helpArray = e_version::genUpdate('auto_assign2');


    return $helpArray;
}

?>