<!DOCTYPE html>
<html class="no-scroll">
<head>

<meta charset="utf-8" />
<meta name="description" content="Zakaria Elk is a UI designer and frontend developer, from Casablanca and based in Beijing." />
<meta name="keywords" content="Web Designer, UI Designer, Frontend Developer, Web Developer, Freelance developer, China Freelance, SEO Specialist" />
<meta name="robots" content="index, follow" />
<meta name="author" content="Zakaria Elk" />
<title><?php if (is_front_page()) {?>
    <?php bloginfo('name');?> | <?php bloginfo('description')?>
    <?php } else {?>
    <?php wp_title("");?> | <?php bloginfo('name');?>
<?php }?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="xmlrpc.html">

<!-- FAVICO -->
<style type='text/css'>img#wpstats{display:none}</style><link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_site_url(); ?>/wp-content/themes/zakariaelk/src/img/favicon/zakaria-logo-57.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_site_url(); ?>/wp-content/themes/zakariaelk/src/img/favicon/zakaria-logo-72.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_site_url(); ?>/wp-content/themes/zakariaelk/src/img/favicon/zakaria-logo-144.png" />
<link rel="icon" href="<?php echo get_site_url(); ?>/wp-content/themes/zakariaelk/src/img/favicon/zakaria-logo.png" />

<!-- Call Styles -->
<?php wp_head();?>


</head>

<body   <?php
if (is_page()) {
    if (is_front_page()) {
        echo 'id="home"';
    } else {
        echo 'id="' . $post->post_name . '"';
    }
} else {echo 'id="work"';}?>
          >

    <!-- Loading Module -->
    <div id="loader">
        <div class="loader-content">
        </div>
    </div>


    <!-- Site Wrapper -->
    <div class="site-wrapper">
        <header>

        <!-- Top Header -->
            <div class="top-header">
                <!-- Logo -->
                <div class="logo-link">
                    <a href="<?php echo get_site_url(); ?>">
                        <span class="top-part">Zakaria Elk.</span>
                        <span class="bottom-part">Web designer & frontend developer</span>
                    </a>
                </div>

                <!-- Navigation -->
                <nav role="nav" class="nav-wrapper">
                    <div class="nav-container">
                        <div class="nav-menu">
                            <a href="mailto:work@zakariaelk.com">
                                get in touch

                                <svg class="chevron" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="chevron-stroke"
                                        d="M1.01026 10.322V8.27H9.12826V10.322H1.01026ZM1.01026 14.192V12.14H9.12826V14.192H1.01026ZM11.1545 7.208L19.5065 10.898V11.564L11.1545 15.254V13.13L15.6185 11.222L11.1545 9.314V7.208Z"
                                        fill="black" />
                                    <path class="chevron-bg"
                                        d="M0.941406 14.1901V8.27502H11.3785L16.1662 11.1978L11.7615 14.1901H0.941406Z"
                                        fill="black" />


                                    <path class="chevron-triangle"
                                        d="M19.7747 11.1538L11.183 5.76117V16.5464L19.7747 11.1538Z" fill="black" />


                                </svg>

                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="page-content">