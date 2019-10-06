<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Grav;
use Grav\Common\Page\Page;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class OnlineScoutManagerPlugin
 * @package Grav\Plugin
 */
class OnlineScoutManagerPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        $events = [
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0]
        ];


        $uri = $this->grav['uri'];
        $route = $this->config->get('plugins.online-scout-manager.route');
      if ($route && $route == $uri->path()) {
        $events['onPageInitialized'] = ['onPageInitialized', 0];
      }

        // Enable the main event we are interested in
        $this->enable($events);

    }

/**
 * Add template directory to twig lookup path.
 */
 public function onTwigTemplatePaths()
 {
     $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
 }

    public function onPageInitialized() {
      $login_file = $this->grav['locator']->findResource('plugins://online-scout-manager/pages/osmlogin.md');
      $this->grav['page']->init(new \SplFileInfo($login_file));
      return $this->grav['page'];

    }



    public function onShortcodeHandlers() {
       $this->grav['shortcode']->registerAllShortcodes(__DIR__.'/shortcodes');
   }
}
