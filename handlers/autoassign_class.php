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

/**
 * autoAssign
 *
 * @author Auto Assign
 * @copyright Copyright (C) 2008-2016 Barry Keal G4HDU 
 * @package     e107
 * @subpackage  auto_assign2 
 * @since 2.0.0
 * @version 2016
 * @access public
 */
class autoAssign
{
    /**
     * @var mixed $settings the pref settings
     */
    private static $settings;

    /**
     * autoAssign::__construct()
     * 
     * @return
     */

    public function __construct()
    {

    }

    /**
     * autoAssign::assignClass()
     * 
     * @param mixed $data new user data from event/trigger
     * @return
     * 
     * @uses self::isInRange
     */
    static public function assignClass($data)
    {
        self::$settings = e107::getPlugPref('auto_assign2');

        if (self::$settings['assignAuto_Active'] == 1) {

            $sql = e107::getDb();
            $name = $data['username'];
            $logname = $data['loginname'];

            // get the existing userclasses the person is a member of (on sign up)
            // has to be done as a query because insufficent info is passed across

            $string = $sql->retrieve('user', 'user_class', "user_name='{$name}' and user_loginname = '{$logname}'");
            $class_extant = explode(',', $string);

            foreach ($class_extant as $key => $value) {
                if (intval($value) == 0) {
                    unset($class_extant[$key]);
                }
            }
            if (self::isInRange(self::$settings['assignAuto_Class1'])) {
                $class_extant[] = self::$settings['assignAuto_Class1'];
            }
            if (self::isInRange(self::$settings['assignAuto_Class2'])) {
                $class_extant[] = self::$settings['assignAuto_Class2'];
            }
            if (self::isInRange(self::$settings['assignAuto_Class31'])) {
                $class_extant[] = self::$settings['assignAuto_Class3'];
            }
            if (self::isInRange(self::$settings['assignAuto_Class4'])) {
                $class_extant[] = self::$settings['assignAuto_Class4'];
            }
            if (self::isInRange(self::$settings['assignAuto_Class5'])) {
                $class_extant[] = self::$settings['assignAuto_Class5'];
            }
            $new_array = array_unique($class_extant);
            sort($new_array);

            $class_list = implode(',', $new_array);
            $update = array('user_class' => $class_list, 'WHERE' => "user_name='{$name}' and user_loginname = '{$logname}'");
            $sql->update('user', $update, false);

            $log = e107::getLog();

            $logText = "<PRE>" . LAN_PLUGIN_ASSIGN_LOGNAME . " {$name} " .
                LAN_PLUGIN_ASSIGN_LOGLOG . " {$logname} :: " . LAN_PLUGIN_ASSIGN_LOGOLD . " {$string} => " .
                LAN_PLUGIN_ASSIGN_LOGNEW . " {$class_list}";
            $log->add('auto assign', $logText, E_LOG_INFORMATIVE, '1');
        }
    }

    /**
     * autoAssign::isInRange()
     * 
     * @param mixed $classID
     * @return
     */
    static private function isInRange($classID)
    {
        $retval = false;
        if ($classID > 0 && $classID < 250) {
            $retval = true;
        }
        return $retval;
    }
}

?>