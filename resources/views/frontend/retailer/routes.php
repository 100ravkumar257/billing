<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'home/custom404';
$route['translate_uri_dashes'] = FALSE;

$route['admin'] = 'admin/home';

//$route['(news|new-launches|reviews|picture-story|mobile-videos|top-5|how-to|sponsored-article)/([0-9]+)_(:any)'] = 'home/old/$1/$2';
$route['old_article/(:any)'] = 'home/old_article/ooh/$1';
$route['old_international/(:any)'] = 'home/old_article/picture_story_news/$1';
$route['old_oohspeaks/(:any)'] = 'home/old_article/oohspeaks/$1';
$route['old_campaign/(:any)'] = 'home/old_article/campaign/$1';

$route['news'] = 'news/category/news';
$route['news/news_list'] = 'news/news_list/';
$route['news/news_list/page-([0-9]+)'] = 'news/news_list/$1';
$route['news/page-([0-9]+)'] = 'news/category/news/$1';
$route['news/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['news/(:any)-([0-9]+)'] = 'news/details/$2';

$route['chemical'] = 'news/category/chemical';
$route['chemical/page-([0-9]+)'] = 'news/category/chemical/$1';
$route['chemical/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['chemical/(:any)-([0-9]+)'] = 'news/details/$2';

$route['start-ups'] = 'news/category/start-ups';
$route['start-ups/page-([0-9]+)'] = 'news/category/start-ups/$1';
$route['start-ups/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['start-ups/(:any)-([0-9]+)'] = 'news/details/$2';
$route['general'] = 'news/category/general';
$route['general/page-([0-9]+)'] = 'news/category/general/$1';
$route['general/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['general/(:any)-([0-9]+)'] = 'news/details/$2';

$route['petro-chemical'] = 'news/category/petro-chemical';
$route['petro-chemical/page-([0-9]+)'] = 'news/category/petro-chemical/$1';
$route['petro-chemical/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['petro-chemical/(:any)-([0-9]+)'] = 'news/details/$2';

$route['research'] = 'news/category/research';
$route['research/page-([0-9]+)'] = 'news/category/research/$1';
$route['research/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['research/(:any)-([0-9]+)'] = 'news/details/$2';


$route['energy'] = 'news/category/energy';
$route['energy/page-([0-9]+)'] = 'news/category/energy/$1';
$route['energy/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['energy/(:any)-([0-9]+)'] = 'news/details/$2';

$route['gas'] = 'news/category/gas';
$route['gas/page-([0-9]+)'] = 'news/category/gas/$1';
$route['gas/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['gas/(:any)-([0-9]+)'] = 'news/details/$2';

$route['opinion'] = 'news/category/opinion';
$route['opinion/page-([0-9]+)'] = 'news/category/opinion/$1';
$route['opinion/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['opinion/(:any)-([0-9]+)'] = 'news/details/$2';

$route['digitization'] = 'news/category/digitization';
$route['digitization/page-([0-9]+)'] = 'news/category/digitization/$1';
$route['digitization/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['digitization/(:any)-([0-9]+)'] = 'news/details/$2';

$route['renewable'] = 'news/category/renewable';
$route['renewable/page-([0-9]+)'] = 'news/category/renewable/$1';
$route['renewable/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['renewable/(:any)-([0-9]+)'] = 'news/details/$2';

$route['pharma'] = 'news/category/pharma';
$route['pharma/page-([0-9]+)'] = 'news/category/pharma/$1';
$route['pharma/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['pharma/(:any)-([0-9]+)'] = 'news/details/$2';

$route['hydrogen'] = 'news/category/hydrogen';
$route['hydrogen/page-([0-9]+)'] = 'news/category/hydrogen/$1';
$route['hydrogen/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['hydrogen/(:any)-([0-9]+)'] = 'news/details/$2';

$route['battery'] = 'news/category/battery';
$route['battery/page-([0-9]+)'] = 'news/category/battery/$1';
$route['battery/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['battery/(:any)-([0-9]+)'] = 'news/details/$2';

$route['people'] = 'news/category/people';
$route['people/page-([0-9]+)'] = 'news/category/people/$1';
$route['people/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['people/(:any)-([0-9]+)'] = 'news/details/$2';

$route['videos'] = 'videos/index/videos';
$route['videos/page-([0-9]+)'] = 'videos/index/videos/$1';
$route['videos/(:any)-([0-9]+)'] = 'videos/details/$2';


$route['news/(:any)-([0-9]+)'] = 'news/details/$2';

$route['interviews'] = 'videos/index/interviews';
$route['interviews/page-([0-9]+)'] = 'videos/index/interviews/$1';
$route['interviews/lite/(:any)-([0-9]+)'] = 'videos/lite/$2';
$route['interviews/(:any)-([0-9]+)'] = 'videos/details/$2';

$route['events'] = 'events';
$route['events/page-([0-9]+)'] = 'events/index/$1';
$route['events/(:any)-([0-9]+)'] = 'events/details/$2';

### new 

$route['sustainability'] = 'news/category/sustainability';
$route['sustainability/page-([0-9]+)'] = 'news/category/sustainability/$1';
$route['sustainability/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['sustainability/(:any)-([0-9]+)'] = 'news/details/$2';


$route['rd'] = 'news/category/rd';
$route['rd/page-([0-9]+)'] = 'news/category/rd/$1';
$route['rd/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['rd/(:any)-([0-9]+)'] = 'news/details/$2';

$route['technology'] = 'news/category/technology';
$route['technology/page-([0-9]+)'] = 'news/category/technology/$1';
$route['technology/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['technology/(:any)-([0-9]+)'] = 'news/details/$2';

/*
$route['logistics'] = 'news/category/logistics';
$route['logistics/page-([0-9]+)'] = 'news/category/logistics/$1';
$route['logistics/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['logistics/(:any)-([0-9]+)'] = 'news/details/$2';
*/

$route['supply-chain'] = 'news/category/supply-chain';
$route['supply-chain/page-([0-9]+)'] = 'news/category/supply-chain/$1';
$route['supply-chain/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['supply-chain/(:any)-([0-9]+)'] = 'news/details/$2';

$route['exclusive'] = 'news/category/exclusive';
$route['exclusive/page-([0-9]+)'] = 'news/category/exclusive/$1';
$route['exclusive/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['exclusive/(:any)-([0-9]+)'] = 'news/details/$2';

$route['electric-vehicles'] = 'news/category/electric-vehicles';
$route['electric-vehicles/page-([0-9]+)'] = 'news/category/electric-vehicles/$1';
$route['electric-vehicles/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['electric-vehicles/(:any)-([0-9]+)'] = 'news/details/$2';

$route['policy'] = 'news/category/policy';
$route['policy/page-([0-9]+)'] = 'news/category/policy/$1';
$route['policy/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['policy/(:any)-([0-9]+)'] = 'news/details/$2';

$route['regulatory'] = 'news/category/regulatory';
$route['regulatory/page-([0-9]+)'] = 'news/category/regulatory/$1';
$route['regulatory/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['regulatory/(:any)-([0-9]+)'] = 'news/details/$2';

$route['policy-regulatory'] = 'news/category/regulatory';
$route['policy-regulatory/page-([0-9]+)'] = 'news/category/regulatory/$1';
$route['policy-regulatory/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['policy-regulatory/(:any)-([0-9]+)'] = 'news/details/$2';


$route['presentation'] = 'news/category/presentation';
$route['presentation/page-([0-9]+)'] = 'news/category/presentation/$1';
$route['presentation/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['presentation/(:any)-([0-9]+)'] = 'news/details/$2';

$route['pcpir'] = 'news/category/pcpir';
$route['pcpir/page-([0-9]+)'] = 'news/category/pcpir/$1';
$route['pcpir/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['pcpir/(:any)-([0-9]+)'] = 'news/details/$2';

$route['sponsored-content'] = 'news/category/sponsored-content';
$route['sponsored-content/page-([0-9]+)'] = 'news/category/sponsored-content/$1';
$route['sponsored-content/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['sponsored-content/(:any)-([0-9]+)'] = 'news/details/$2';

$route['gallery'] = 'gallery';
$route['gallery/page-([0-9]+)'] = 'gallery/index/$1';

/*
$route['news/page-([0-9]+)'] = 'news/index/$1';
$route['news/lite/(:any)-([0-9]+)'] = 'news/lite/$2';
$route['news/uc/(:any)-([0-9]+)'] = 'news/uc/$2';
$route['news/(:any)/page-([0-9]+)'] = 'news/category/$1/$2';
$route['news/(:any)-([0-9]+)'] = 'news/details/$2';
$route['news/(:any)-([0-9]+)/([0-9]+)'] = 'news/details/$2/$3';
$route['news/(:any)'] = 'news/category/$1';
*/

$route['jobs'] = 'jobs';
$route['jobs/page-([0-9]+)'] = 'jobs/index/$1';
$route['jobs/(:any)-([0-9]+)'] = 'jobs/details/$2';


$route['picture_story'] = 'picture_story';
$route['picture_story/page-([0-9]+)'] = 'picture_story/index/$1';
$route['picture_story/(:any)-([0-9]+)'] = 'picture_story/details/$2';

$route['resource'] = 'resource';
$route['resource/page-([0-9]+)'] = 'resource/index/0/0/0/$1';

$route['resource/getSubcategory'] = 'resource/getSubcategory';
$route['resource/getLocation'] = 'resource/getLocation';
$route['resource/details/(:any)-([0-9]+)'] = 'resource/details/$2';

$route['resource/(:any)/(:any)/(:any)/page([0-9]+)'] = 'resource/index/$1/$2/$3/$4';
$route['resource/(:any)/(:any)/page-([0-9]+)'] = 'resource/index/$1/$2/0/$3';
$route['resource/(:any)/page-([0-9]+)'] = 'resource/index/$1/0/0/$2';

$route['resource/(:any)/(:any)/(:any)'] = 'resource/index/$1/$2/$3';
$route['resource/(:any)/(:any)'] = 'resource/index/$1/$2';
$route['resource/(:any)'] = 'resource/index/$1';



$route['search/(:any)/page-([0-9]+)'] = 'search/index/$1/$2/$3';
$route['search/(:any)'] = 'search/index/$1';

$route['author/(:any)'] = 'author/index/$1';
$route['author/(:any)/page-([0-9]+)'] = 'author/index/$1/$2';

$route['webpage/subscribe'] = 'webpage/subscribe';
$route['contact'] = 'webpage/contact';
$route['webpage/save_contact_us'] = 'webpage/save_contact_us';
$route['webpage/(:any)'] = 'webpage/index/$1';
$route['webpage/(:any)/page-([0-9]+)'] = 'webpage/index/$1/$2';

$route['polls/page-([0-9]+)'] = 'polls/index/$1';

// $route['sitemap/sitemap/(news)/(:any)'] = 'sitemap/sitemap_news/$2';
$route['news-sitemap.xml'] = 'sitemap/news_sitemap_beta/news';
$route['sitemap.xml'] = 'sitemap/sitemap_1121';
$route['sitemap-index.xml'] = 'sitemap/sitemap_index';
// $route['sitemap-video.xml'] = 'sitemap/video_sitemap';


//register
$route['register'] = 'register/index';

$route['webinar'] = 'webinar/index';
//$route['webinar-register'] = 'webinar/webinar_register';
$route['webinar/saveRegisterData'] = 'webinar/saveRegisterData';
$route['webinar/savedata'] = 'webinar/savedata';
$route['webinar/tables'] = 'webinar/tables';  ######### for test 
$route['webinar/thanks'] = 'webinar/thanks';
$route['webinar/check_email_exists'] = 'webinar/check_email_exists';
$route['webinar/register_save'] = 'webinar/register_save';
$route['webinar/partner_save'] = 'webinar/partner_save';
$route['webinar/lite/(:any)'] = 'webinar/lite/$1';
$route['webinar/details_beta/(:any)'] = 'webinar/details_beta/$1';
$route['webinar/(:any)'] = 'webinar/details/$1';
$route['webinar/page-([0-9]+)'] = 'webinar/index/$1';


$route['admin/webinar/webinar_regitser_download'] = 'admin/webinar/webinar_download';  // for view
$route['admin/webinar/export-webinar-csv'] = 'admin/webinar/export_webinar_csv_data';      // for csv


$route['report'] = 'report/index';
$route['report/page-([0-9]+)'] = 'report/index/$1';
$route['report/saveStatsdata'] = 'report/saveStatsdata';
$route['report/savedata'] = 'report/savedata';
$route['report/(:any)'] = 'report/details/$1';

$route['statistics'] = 'report/statistics';
$route['statistics/(:any)'] = 'report/stats_details/$1';
$route['statistics/page-([0-9]+)'] = 'report/statistics/$1';



##### Whitepaper
$route['white_paper/the-sprint-to-the-summit-unlocking-lab-efficiency-through-digital-transformation-1'] = 'white_paper/white_paper_details';

$route['white_paper/the-guiding-role-of-fluidized-and-spouted-bed-technologies-in-particle-building-processes-2'] = 'white_paper/white_paper_detail';


/*compendium new routes */

$route['compendium-(:any)']                   = 'compendiums/index/$1';
$route['compendium-(:any)/(:any)-([0-9]+)']   = 'compendiums/description/$1/$3';
$route['compendium-(:any)/interview/(:any)-([0-9]+)'] = 'compendiums/interview_detail/$1/$3';
// new


/*compendium routes */
$route['compendium/(:any)-([0-9]+)'] = 'compendium/description/$2';
// $route['compendium-2023/(:any)-([0-9]+)'] = 'compendium/description_2023/$2';
$route['translate_uri_dashes'] = "-";
$route['compendium/interview/(:any)-([0-9]+)'] = 'compendium/interview_detail/$2';




// $route['compendium-2021']                   = 'compendium2021/index';
// $route['compendium-2022']                   = 'compendium/index';
// $route['compendium-2021/(:any)-([0-9]+)']   = 'compendium2021/description/$2';
// $route['translate_uri_dashes']              = "-";
// $route['compendium-2021/interview/(:any)-([0-9]+)'] = 'compendium2021/interview_detail/$2';

$route['compendium-2024/content_submit']    =   'compendiums/content_submit';
$route['compendium-2024/saveContent']       = 'compendiums/saveContent';
// $route['compendium-2021/branding']    =   'compendiums/branding';

// $route['compendium-2021/about_compendium']    =   'compendium2021/about_compendium';




$route['a2h'] = 'home/addtohome';
$route['testing-page'] = 'home/testing';

###############

$route['nextgen-chemical-and-petrochemical-summit-2021'] = "virtual2021";
$route['nextgen-chemical-and-petrochemical-summit-2021-brochure-register'] = 'virtual2021/brochure';
$route['nextgen-chemical-and-petrochemical-summit-2021-interviews/(:any)-([0-9]+)'] = 'virtual2021/interview_details/$2';
$route['showInterview-2021/(:any)'] = 'virtual2021/loadInterview/$1';
$route['nextgen-chemical-and-petrochemical-summit-2021-register'] = 'virtual2021/register';
$route['nextgen-chemical-and-petrochemical-summit-2021-thanks'] = 'virtual2021/thanks';

#######################
$route['nextgen-chemical-and-petrochemical-summit'] = "virtual/live";
$route['nextgen-chemical-and-petrochemical-summit-2022'] = "virtual";
$route['nextgen-chemical-and-petrochemical-summit-brochure-register'] = 'virtual/brochure';
$route['nextgen-chemical-and-petrochemical-summit-interviews/(:any)-([0-9]+)'] = 'virtual/interview_details/$2';
$route['showInterview/(:any)'] = 'virtual/loadInterview/$1';
$route['nextgen-chemical-and-petrochemical-summit-register'] = 'virtual/register';
$route['nextgen-chemical-and-petrochemical-summit-thanks'] = 'virtual/thanks';
