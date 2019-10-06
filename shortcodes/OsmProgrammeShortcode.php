<?php
namespace Grav\Plugin\Shortcodes;

use Grav\Common\Grav;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

require_once(__DIR__ . '/../OsmShortcode.php');

class OsmProgrammeShortcode extends OsmShortcode {
    public function init() {
        $this->shortcode->getHandlers()->add('osm-programme', function(ShortcodeInterface $sc) {

            $sectionid = $sc->getParameter('sectionid');

            if (!is_numeric($sectionid)) {
                return '<h2>Error - a numeric section id must be provided</h2>';
            }

            $terms = $this->getTerms();
            foreach ($terms[$sectionid] as $term) {
                if ($term['past']) {
                    $termid = $term['termid'];
                }
            }

            $programme = $this->getProgramme($sectionid, $termid);
            if (!isset($programme['items'])) {
                return '';
            }
            $retval = '<table class="osm-programme-table"><tr><th>Date</th><th>Title</th><th>Notes</th></tr>';
            //dump($programme);

            foreach ($programme['items'] as $item) {
                $retval .= '<tr><td>' . $item['meetingdate'] . '</td><td>' . $item['title'] . '</td><td>' . $item['notesforparents'] . '</td></tr>';
            }

            $retval .= '</table>';
            return $retval;


        });
    }


}
