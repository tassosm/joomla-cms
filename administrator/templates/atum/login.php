<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.Atum
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

/** @var JDocumentHtml $this */

$app  = Factory::getApplication();
$lang = Factory::getLanguage();

// Add JavaScript Frameworks
HTMLHelper::_('script', 'vendor/focus-visible/focus-visible.min.js', ['version' => 'auto', 'relative' => true]);
HTMLHelper::_('script', 'vendor/css-vars-ponyfill/css-vars-ponyfill.min.js', ['version' => 'auto', 'relative' => true]);

// Load template CSS file
HTMLHelper::_('stylesheet', 'bootstrap.css', ['version' => 'auto', 'relative' => true]);
HTMLHelper::_('stylesheet', 'font-awesome.css', ['version' => 'auto', 'relative' => true]);
HTMLHelper::_('stylesheet', 'template' . ($this->direction === 'rtl' ? '-rtl' : '') . '.css', ['version' => 'auto', 'relative' => true]);

// Load custom CSS file
HTMLHelper::_('stylesheet', 'user.css', array('version' => 'auto', 'relative' => true));

// Load specific language related CSS
HTMLHelper::_('stylesheet', 'administrator/language/' . $lang->getTag() . '/' . $lang->getTag() . '.css', array('version' => 'auto'));

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');
$logoBlue = $this->baseurl . '/templates/' . $this->template . '/images/logo-joomla-blue.svg';
$logo = $this->baseurl . '/templates/' . $this->template . '/images/logo-blue.svg';

// Template params
$showSitename = $this->params->get('showSitename', '1');
$loginLogo    = $this->params->get('loginLogo', '');

// Set some meta data
$this->setMetaData('viewport', 'width=device-width, initial-scale=1');
// @TODO sync with _variables.scss
$this->setMetaData('theme-color', '#1c3d5c');

// Set page title
$this->setTitle($sitename . ' - ' . Text::_('JACTION_LOGIN_ADMIN'));

$this->addScriptDeclaration('cssVars();')

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="metas"/>
	<jdoc:include type="styles"/>
</head>
<body class="site <?php echo $option . ' view-' . $view . ' layout-' . $layout . ' task-' . $task . ' itemid-' . $itemid . ' '; ?>">
    <header id="header" class="header">
        <div class="d-flex align-items-center">
            <div class="header-title d-flex mr-auto">
                <div class="d-flex">
                    <a class="logo" href="<?php echo Route::_('index.php'); ?>" aria-label="<?php echo Text::_('TPL_BACK_TO_CONTROL_PANEL'); ?>">
                        <img src="<?php echo $logoBlue; ?>" alt="">
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div id="wrapper" class="d-flex wrapper">

	    <?php // Sidebar ?>
        <div id="sidebar-wrapper" class="sidebar-wrapper">
            <div id="main-brand" class="main-brand">
                <h1><?php echo $sitename; ?></h1>
                <a href="<?php echo Uri::root(); ?>"><?php echo Text::sprintf('TPL_ATUM_LOGIN_SIDEBAR_SITENAME_LINK', $sitename); ?></a>
            </div>
            <jdoc:include type="modules" name="sidebar" style="none"/>
        </div>

        <div class="container-fluid container-main">
            <section id="content" class="content">
                <main class="d-flex justify-content-center align-items-center h-100">
                    <div class="login">
                        <div id="content" class="main-brand d-flex align-items-center justify-content-center">
                            <img src="<?php echo $logo; ?>" alt="">
                        </div>
                        <jdoc:include type="message"/>
                        <jdoc:include type="component"/>
                    </div>
                </main>
            </section>
        </div>
    </div>
	<jdoc:include type="modules" name="debug" style="none"/>
	<jdoc:include type="scripts"/>
</body>
</html>
