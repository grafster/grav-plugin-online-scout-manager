<?php
namespace Grav\Plugin\Shortcodes;

use Grav\Common\Grav;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

require_once(__DIR__ . '/../OsmShortcode.php');

class OsmSectionsShortcode extends OsmShortcode {
    public function init() {
        $this->shortcode->getHandlers()->add('osm-sections', function(ShortcodeInterface $sc) {

            $roles = $this->getRoles();
            $retval = '<table class="osm-section-table"><tr><th>Section ID</th><th>Name</th></tr>';


            foreach ($roles as $role) {
                $retval .= '<tr><td>' . $role['sectionid'] . '</td><td>' . $role['sectionname'] . '</td></tr>';
            }

            $retval .= '</table>';
            return $retval;
        });
    }


}
