=== Custom API For WP ===
Contributors: cyberlord92
Tags: custom-endpoints, api, rest api, rest, endpoint, rest route, wp rest api, crud, CUSTOM, create api, rest endpoints, integrate external api
Requires at least: 3.0.1
Requires PHP: 5.4
Tested up to: 5.9
Stable tag: 2.2.0
License: MIT/Expat
License URI: https://docs.miniorange.com/mit-license

Create WordPress REST APIs endpoints to interact with the WordPress database to perform any SQL operations along with capabilities to connect to external APIs in WordPress.
== Description ==

This plugin helps you create/register custom endpoints/Custom REST APIs into WordPress directly by using Graphical User Interface(GUI) to fetch any type of data from user roles, groups to featured images, and any custom data or fields as well that you want. Apart from just fetching data you can POST, PUT, DELETE (Insert, Update, Delete) data with these created Custom endpoint / Custom REST routes. 
Any type of interaction with data is possible by creating Custom REST API endpoints with a very simple GUI. It means you can easily interact with the WordPress database to fetch/update/delete data using the custom endpoints created(generated) using this plugin. 
This plugin takes care of writing the complex SQL query to fetch/update data and provides you with a very simple User interface to create or generate custom REST endpoints.
This plugin also provides the filter operations in which you can filter the data you want to show in the API endpoint response. 
Also, this plugin takes care of the authentication/security of these custom generated API endpoints as well by providing support for highly secure API key authentication, Basic authentication, JWT authentication and most secure OAuth 2.0 authentication methods.

Additionally, you can control the visibility and customize the metadata attached to the Custom endpoint response. Also, it provides an option to protect your Custom REST API endpoints from unauthorized access such that endpoints can be secured and can only be accessed after successful validation.


= Third-party/External API Integration into WordPress = 

* This plugin also helps you to integrate any external/third-party REST API endpoints into WordPress very easily using the GUI within seconds. So with these API integrations, you can connect to any external platforms and fetch the data using these external API endpoints to display the data on your WordPress(Woocommerce) site or can also process this data to use it further. 
* These integrations can also be done on third-party plugin's events like form submission using third-party plugins like Elementor, Wpforms, Gravityforms etc. and also payment status or subscription status based on transactions done via payment gateways like that provided by WooCommerce, WPForms, GravityForms or any other services. 
* Apart from these, the external API integrations can be done on any event of the WordPress like user registration, user membership level change or any other. 
* The plugin is compatible to update Woocommerce products data based on the data fetched from an external/third-party API provider(Supplier) on a real-time basis. 
* This feature also provides the capabilities to register or login users to third-party platforms by making an API request to the third-party platforms. 


= Use Case =
*	Accessing some custom data into your mobile application or web clients via custom REST API Endpoints.
*	Create, Read, Update and Delete (CRUD) WordPress content from client-side JavaScript or from external applications, even those written in languages beyond PHP by creating easy to use Custom REST Routes.
*	Interact with any standard database schema/tables or your custom-built schema/table to fetch/update/delete data using the custom API endpoints.
*	Connect two WordPress sites or connect your WordPress site with a website built in any framework and Get/Update/Insert/Delete (CRUD) data of one website from another website with the help of Custom API and feasibility of connection with External APIs / Custom Endpoints developed in the external Website.
*	Connect with External Rest API Routes to display data in your website or process the data received from External Endpoint.
*	Integrate External/third-party REST API endpoints with third-party plugin's payment gateways like that of WooCommerce, WPForms or any other custom gateway such that the API can be called automatically based on the payment status.
*	Integrate External/third-party REST API endpoints with custom/third-party plugins' forms like that of WPForms, Elementor, GravityForms etc such that the external APIs can be called on these forms submission or any related events to perform fetch/update/delete operation based on API endpoints.
*	Sync third-party/external API provider's(Supplier's) API Inventory data into Woocommerce and display them in the products feed on a real-time basis.
*	Integrate external APIs into Woocommerce.

= Add-Ons = 

* Woocommerce Products sync via External API

•  If you have a Woocommerce store and want to sync (add/update/delete) the products from external inventory warehouse/store's platform via APIs then it can be achieved using our solution. 
• Following the are key features - 

  1. The data can be synced automatically in a duration of custom time interval very securely (For example in every 4 hours a day).
  2. All the product details like name, description, price, stock status can be updated along with other custom attributes as well.
  3. The sync can be done in the background such that customers using your WP site won't get affected.
  4. The sync can also be done by clicking on the sync button manually in the User Interface.
  5. Woocommerce product images can also be added or updated with ease based on external API data.
  6. No headache to import and export CSV/TXT files manually. API Integration will do the job automatically.


* Sync Products between WordPress and Google Merchant Center feed (Integrate Wordpress/Woocommerce Store with Google Merchant Center)
 
•  If you have a WordPress/Woocommerce store or third-party dropshipping plugins like Alidropship and want to sync (add/update/delete) the products between WordPress site and Google Merchant Center feed via APIs then it can be achieved using our solution. 
• Following the are key features - 

 1. Real-time data sync between the WordPress and Google Merchant center platforms.
 2. No CSV or TXT files import and export are required. Everything will be handled dynamically via REST APIs.
 3. Any attribute like Image, pricing, variations, quantity, stock status, description can be updated easily.
 4. Solution can be made compatible with WordPress as Woocommerce store, Alidropship store or any third-party plugin which manages the products in WordPress.

* WooCommerce API Product Sync with Multiple WooCommerce Stores

• We do provide the solution in which the products data stored in one Woocommerce store can also be synced with others Woocommerce stores using the REST APIs such that the WC stores will be updated on real-time basis.

These solutions can be used additionally along with the plugin. To know more details, contact us at oauthsupport@xecurify.com and let us know your requirements. 

= Free Version Features =

•	Unlimited Custom REST APIs(endpoints) can be created
•	Give names to Custom Endpoints/Custom REST routes
•	Build custom REST routes for all tables within WordPress
•	Build custom REST routes for fetching posts and taxonomies
•	Fetch any type of data available in WordPress via custom REST API endpoints
•	Full control of Custom REST API responses without writing a single line of PHP code.
•	Fetch operation available with single WHERE condition
•	Can be integrated with all types of applications 
•	Can perform simple and advanced SQL queries on the WordPress database by creating custom rest API routes


= Premium Version Features =

•	Create/register custom namespaces and routes
•	Multiple endpoints allowed per REST route
•	Create(generate)Custom API route for posts and taxonomies creation, modification, deletion.
•	Supports all kinds of HTTP Methods(GET, PUT, POST, DELETE)
•	Filters included to alter and extend default functionality 
•	Fetch operation available with multiple custom conditions
•	Limit the no of responses you get as a result of Custom Endpoints (API). 
•	Option to enable or disable the Custom API endpoints according to your requirements.
•	Complex queries formation with an Advance mechanism.
•	Restrict public access to all Custom REST API Routes with API KEY Authentication method and some other Authentication methods can also be provided as ADD-ON as per requirement like
	1. REST API endpoints authentication using OAuth 2.0
	2. REST API endpoints authentication using JWT Tokens
	3. Basic Authorization with Username and Password
	4. OAuth 2.0 authentication for REST API endpoints
	5. Authentication from external OAuth/OIDC provider's token for REST API endpoints 


= Enterprise Version Features =

•	All Premium Version Features 
•	Create(generate) Custom API endpoints with custom SQL Query to create custom API with your complex SQL query.
•	Connect with External REST API / External Endpoints, also known as third-party REST API endpoints.
•	External API integration to fetch data in the WordPress, update data on the External API provider side. 
•	Supports all kinds of HTTP(GET/POST/PUT/UPDATE) Methods.
•	Supports integration with Custom API / Custom Endpoints of External Website or Platform
•	Dynamic WordPress hooks for each External API / Endpoint connection to perform operations on external data
•	Compatibility with Third-Party Plugin Events like WooCommerce, WPForms, GravityForms, Membership Plugins, etc. 
•	Support for calling External / Custom Endpoints on third party plugin events.
•	Compatibility with third-party plugin’s payment gateways provided by Woocoomerce, Wpforms, PayPal, Stripe or any custom payment gateway.
•	Support for connection with Custom API / Custom Endpoints developed in any framework like Java, PHP, NodeJS, .NET, etc.
•	Support of Dynamic headers for the External REST APIs / Custom APIs request 
•	Securely access External Endpoints by passing the required authentication parameter either in Header or Body  


Authentication related information can be sent by any suitable REST client for eg-  You can use CURL calls to send HTTP Requests or even any IDE like PHPSTORM or you can go with POSTMAN to send an authentication key.


= Type of APIs supported: =
•	‘HTTP GET` (This can be used to retrieve data from your WordPress)
•	‘HTTP POST’ (This can be used to insert data in your WordPress)
•	‘HTTP PUT’ (This can be used to update data in your WordPress)
•	‘HTTP DELETE’ (This can be used to delete data in your WordPress)

= Type of Data which you can retrieve with Custom Endpoints: =
•	WP Users and User Meta
•	WP Roles and Capabilities
•	WP Posts, Pages and custom post types
•	WP Options
•	WP Taxonomy
•	Woocommerce products, WordPress Membership plugins data
•	Custom data, Custom posts, Custom parameters, Custom fields and many more
•	Any third-party plugin's or custom table's data can be fetched/updated using these custom API endpoints


== Installation ==

= From your WordPress dashboard =
1. Visit `Plugins > Add New`
2. Search for `Custom API for WP`. Find and Install `Custom API for WP` plugin by miniOrange
3. Activate the plugin

= From WordPress.org =
1. Download `Custom API for WP` plugin
2. Unzip and upload the `custom-api-for-wp` directory to your `/wp-content/plugins/` directory.
3. Activate the miniOrange API plugin from your Plugins page.

= Once Activated =
1. Go to the `Settings-> Custom API` menu
2. Click on the `Create API` button
3. Choose data that you want to retrieve with API and conditions to retrieve data
4. Save the configuration and your API will be ready to use.

== Frequently Asked Questions ==

= I do not see the data which I want to send with API? =
Please email us at info@xecurify.com or submit your query from the plugin support form so that we can provide support to you to achieve what you are looking for.
= Can I write create or generate API endpoints in WordPress using my own complex custom SQL Query? =
Yes, the plugin provides this functionality so that any custom endpoints can be created or generated based on your self-defined custom SQL query with any complexity, so SQL query can be used to perform operations using even multiple WP database tables.
= How to integrate External/third-party side(Non-WordPress) REST API endpoints into WordPress? = 
The plugin provides the Graphical User Interface based feature to integrate or connect to any external API endpoints easily within WordPress and these connections can be used to fetch/update data via these external API endpoints on any WordPress events on a real-time basis.
= How to create API endpoints in WordPress = 
This plugin is exactly meant to do that in which you can easily create any APIs to interact with WordPress database perform any operations like GET, POST, PUT, DELETE within seconds along with security.


== Screenshots ==
1. List all created API's
2. Create API UI
3. Response of API call


== Changelog ==

= 1.1.1 =
* Initial version

= 1.1.2 =
* Added UI changes and contact form bug fix

= 1.1.3 =
* Added feedback form at deactivation

= 1.1.4 =
* Improved SEO and added compatibility with WP 5.5

= 1.1.5 =
* Showing all premium features and Added customer registration tab

= 1.1.6 =
* Bugs and UI fixes 

= 1.1.7 =
* Bugs and UI fixes 

= 1.1.8 =
* Added compatibility with WordPress v5.6

= 1.1.9 =
* Bugfix - Added support for LIKE condition

= 2.1.0 =
* Bug Fixes, Compatibility with WordPress v5.7 and integration with external APIs

= 2.1.1 =
* UI Updates, Bug Fixes

= 2.1.2 = 
* Bug Fixes, Usability improvements, WordPress 5.8 compatibility

= 2.1.3 =
* Security Fixes, UI improvements, WordPress 5.8.2 compatibility 

= 2.1.4 =
* UI bug Fixes and security Fixes

= 2.2.0 = 
* Compatiblity with WordPress 5.9
* Fix for _ (underscore) issue with custom endpoints
* Minor UI Fixes
