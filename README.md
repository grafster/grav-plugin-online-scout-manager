# Online Scout Manager Plugin

The **Online Scout Manager** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav). Downloads programme and event data from Online Scout Manager (OSM) for display in Grav

## Installation

Installing the Online Scout Manager plugin can be done manualally via a zip file.

## Dependencies

Depends on the shortcode-core plugin.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `online-scout-manager`. You can find these files on [GitHub](https://github.com/grafster/grav-plugin-online-scout-manager).

You should now have all the plugin files under

    /your/site/grav/user/plugins/online-scout-manager
	
> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com/grafster/grav-plugin-online-scout-manager/blob/master/blueprints.yaml).

## Configuration

Before configuring this plugin, you should copy the `user/plugins/online-scout-manager/online-scout-manager.yaml` to `user/config/plugins/online-scout-manager.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
route: /osm-login
```

Route - sets the url you can use to login to OSM and get your API user ID and secret.

Note that if you use the Admin Plugin, a file with your configuration named online-scout-manager.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.



## Usage

First visit the /osm-login path on your site and login using your OSM details to get your OSM API UserID and Secret. (This is a bit messy but I'm not sure how to improve on it). Then paste them into the fields on the admin panel, or set them in your online-scout-manager.yaml as the osm_userid and osm_secret values.

You can then use the following shortcodes on your page

\[osm-sections/\] - To display a list of sections you have access to in OSM
\[osm-programme sectionid="xxxxx"/\] - to display the current programme for the specified section (use the previous shortcode to get a list of section ids
\[osm-events sectionid="xxxxx/\] - to display any upcoming events for the specified section



## Credits

[Online Scout manager](https://onlinescoutmanager.co.uk)

## To Do

- [ ] Improve the login process, if possible.

