<?php
namespace Grav\Plugin\Shortcodes;

use Grav\Common\Grav;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

require_once(__DIR__ . '/../OsmShortcode.php');

class OsmEventsShortcode extends OsmShortcode {
    public function init() {
        $this->shortcode->getHandlers()->add('osm-events', function(ShortcodeInterface $sc) {

            $sectionid = $sc->getParameter('sectionid');

            if (!is_numeric($sectionid)) {
                return '<h2>Error - a numeric section id must be provided</h2>';
            }



            $events = $this->getEvents($sectionid);
            //dump($events);
            if (!isset($events['items'])) {
                return '';
            }
            $retval = '<table class="osm-events-table"><tr><th>Start Date</th><th>End Date</th><th>Name</th><th>Location</th></tr>';

            foreach ($events['items'] as $item) {
                $retval .= '<tr><td>' . $item['startdate'] . '</td><td>' . $item['enddate'] . '</td><td>' . $item['name'] . '</td><td>' . $item['location'] . '</td></tr>';
            }

            $retval .= '</table>';
            return $retval;


        });
    }

}
