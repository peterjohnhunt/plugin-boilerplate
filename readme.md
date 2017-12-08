# PLUGIN_LABEL

## Instructions:
This boiler plate is intended to be used as the starting point for any WordPress Object Oriented Plugin. Start by doing a find and replace for the following variables:
 - PLUGIN_COMPANY | (Your Name or Company Name)
 - PLUGIN_WEBSITE | (Your Website or Company Website)
 - PLUGIN_GIT_REPO | (Link to Git Version Control Repo)
 - PLUGIN_LABEL | (Formatted Plugin Name)
 - PLUGIN_DESCRIPTION | (Formatted Plugin Description)
 - PLUGIN_NAMESPACE | (Plugin Label with Underscores for Spaces)
 - PLUGIN_SLUG | (Lowercase Plugin Label with Hyphens for Spaces)
 - PLUGIN_GLOBAL | (Uppercase Plugin Label with Underscores for Spaces)
 - PLUGIN_FUNCTION | (Lowercase Plugin Label with Underscores for Space)
 - PLUGIN_PREFIX | (Lowercase Plugin Initials with No Spaces)
 - PLUGIN_DATE | (v1 Initial Release Date)

## Code Structure:
This boiler plate is built to be used as a top down structure. As the structure is built out, additional functionality (if large enough) should be made into a class utlized by one of the primary managers as a property of that manager. This top down hierarchy can be built out to include as many levels as makes structurally organized sense, however the structure should always maintain the entry point as follows: Manager_Class->Parent_Class->Needed_Class.

This will result in some classes being used as a standard recurring object, and others as a single point of entry to manage other sub classes.

The primary initial entry facets include:

### Plugin File
The main plugin file serves as the top level manager of the entire plugin. This acts as the primary facilitator of integrating all the functionality form the plugin into Wordpress. One of the main facets of the main plugin file is to manage all actions and hooks via the included action loader. Essentially all hooks should be wired up through the main plugin file separating the functionality and it being integrated into the WordPress hooks.

### Library:
These are 3rd party modules or modules that are generalized and can be used in any plugin.

By default this includes an auto loader for name spacing, as well as a functions library that includes prefixed functions for global use; helper functions that can't directly adhere to a subclass structure.

### Setup:
This is the manager of everything from a data perspective the starting point for post types, taxonomies, or other things that will be shared on both the front end and back end of the website.

### Admin:
This is the manager of everything that relates specifically to the backend and admin portal of the site. Custom settings pages, meta-boxes, widgets, styles, scripts, etc

### Public:
This is the manager of everything that relates to the front end of the site. Page templates, partials, styles, scripts, etc.

## Templates
Utilizing the prefixed helper functions for template parts and locating templates, all front end partials or template overrides can be made in an extendable way utilizing files within the templates folder. This allows for template organization, as well as templates being easily overridable within a theme for more in depth customizations.

## Assets
Assets contain all the admin and public styles, scripts, imagery, and fonts as needed. Plugin manager files will enqueue these as needed. Prefixed helper functions can be used to link to file URL or DIR paths.

## Todo:
 - Add standard settings admin class
 - Add example setup of post type with custom page for archives with vanity URL structure
 - Add public manager function examples for template overrides
 - Add public manager function examples for styles / scripts
