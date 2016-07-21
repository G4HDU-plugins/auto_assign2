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

if (!defined('e107_INIT')) {
    exit;
}


/**
 * auto_assign2_event
 * 
 * @package   
 * @author Auto Assign
 * @copyright Father Barry
 * @version 2016
 * @access public
 */
class auto_assign2_event // plugin-folder + '_event'
{

    /**
     * Configure functions/methods to run when specific e107 events are triggered.
     * For a list of events, please visit: http://e107.org/developer-manual/classes-and-methods#events
     * Developers can trigger their own events using: e107::getEvent()->trigger('plugin_event',$array);
     * Where 'plugin' is the folder of their plugin and 'event' is a unique name of the event.
     * $array is data which is sent to the triggered function. eg. myfunction($array) in the example below.
     *
     * @return array
     */

    /**
     * auto_assign2_event::config()
     * 
     * @return
     */
    function config()
    {

        $event = array();

        $event[] = array(
            'name' => "user_signup_activated", // user signed up
            'function' => "assignClasses", // ..run this function (see below).
            );
        $event[] = array(
            'name' => "user_signup_submitted", // user signed up
            'function' => "assignClasses", // ..run this function (see below).
            );
        $event[] = array(
            'name' => "user_xup_signup", // user signed up
            'function' => "assignClasses", // ..run this function (see below).
            );
        $event[] = array(
            'name' => "admin_user_activate", // user signed up
            'function' => "assignClasses", // ..run this function (see below).
            );
        $event[] = array(
            'name' => "admin_user_create", // user signed up
            'function' => "assignClasses", // ..run this function (see below).
            );
        $event[] = array(
            'name' => "user_xup_signup", // user signed up
            'function' => "assignClasses", // ..run this function (see below).
            );
        return $event;

    }

    /**
     * auto_assign2_event::assignClasses()
     * 
     * @param mixed $data
     * @return
     */
    function assignClasses($data)
    {
        require_once (e_PLUGIN . "auto_assign2/includes/autoassign_class.php");
        $assign = autoAssign::assignClass($data);
    }

} //end class
