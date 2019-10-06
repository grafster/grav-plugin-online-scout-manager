<?php
namespace Grav\Plugin\Shortcodes;

use Grav\Common\Grav;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Grav\Plugin\Shortcodes;

abstract class OsmShortcode extends Shortcode {
    protected function getTerms() {
        return $this->getFromOSM('api.php?action=getTerms', 'terms');
    }

    protected function getRoles() {
        return $this->getFromOSM('api.php?action=getUserRoles', 'roles');
    }

    protected function getProgramme($sectionid, $termid) {
        return $this->getFromOsm('programme.php?action=getProgramme&sectionid=' . $sectionid . '&termid=' . $termid, 'programme-' . $sectionid . '-' . $termid);
    }

    protected function getEvents($sectionid) {
        return $this->getFromOsm('events.php?action=getEvents&futureonly=true&sectionid=' . $sectionid, 'events-' . $sectionid);
    }


    private function getFromOSM($url, $cacheid) {
        $terms = $this->get_cached_osm($cacheid);
        if (!$terms) {

            $terms = $this->osm_query($url);
            $this->update_cached_osm($cacheid, $terms);
        }
        return $terms;
    }




    private function update_cached_osm($key, $val, $timeOffset = 0) {
        $id = 'onlinescoutmanager-' . $key;
        $this->grav['cache']->save($id, $val, 86400);
    }

    private function get_cached_osm($key) {

        $id  = 'onlinescoutmanager-' . $key;
        $val = $this->grav['cache']->fetch($id);
        if ($val) {
            return $val;
        } else {
            return false;
        }
    }


    private function osm_query($url, $parts = null) {
        global $OnlineScoutManager_userid, $OnlineScoutManager_secret;
        if ($parts == null) {
            $parts           = array();
            $parts['userid'] = $this->grav['config']->get('plugins.online-scout-manager.osm_username');
            $parts['secret'] = $this->grav['config']->get('plugins.online-scout-manager.osm_password');
        }


        $parts['token'] = '9f2efda43d953e9b7b9060ce0c7a3fc1';
        $parts['apiid'] = 307;


        $data = '';
        foreach ($parts as $key => $val) {
            $data .= '&' . $key . '=' . urlencode($val);
        }

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, 'https://www.onlinescoutmanager.co.uk/' . $url);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, substr($data, 1));
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $msg = curl_exec($curl_handle);
        return json_decode($msg, true);
    }

}
