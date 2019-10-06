<?php
// Authenticate with OSM
$email = $this->grav['config']->get('plugins.online-scout-manager.osm_username');;
$password = $this->grav['config']->get('plugins.online-scout-manager.osm_password');;

$retVal = $this->osm_query('users.php?action=authorise', array('email' => $email, 'password' => $password));
if ($retVal['userid'] and $retVal['userid'] > 0) {
  $userid = $retVal['userid'];
  $secret = $retVal['secret'];
  $cache = Grav::instance()['cache'];
  $cache->save('OnlineScoutManager_userid', $userid);
  $cache->save('OnlineScoutManager_secret', $secret);
  dump('userid' . $userid);
}
?>
