<?php
  /**
   * Vendas
   *
   * @package Sistemas Divulgação Online
   * @author Geandro Bessa
   * @copyright 2018
   * @version 1
   */
   
	define('_VALID_PHP', true);
	require_once("init.php");

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	
	<!-- Page Title -->
	<title><?php echo lang('EMPRESA_NOME'); ?></title>

	<meta name="author" content="Divulgação Online - www.divulgacaoonline.com.br" />
	
	<!-- Mobile Meta Tag -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- Fav icon -->
	<?php $url = 'http://www.sige.pro.br/padraoWeb/divulgacao_online/'; ?>
	<!-- Favicons -->
	<link rel="shortcut icon" href="<?=$url;?>favicon.png">
	<link rel="apple-touch-icon" href="<?=$url;?>favicon_60x60.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?=$url;?>favicon_76x76.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?=$url;?>favicon_120x120.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?=$url;?>favicon_152x152.png">
	
	<!-- IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> 
	<![endif]-->
	
	<!-- Google Web Font -->
	<link href="http://fonts.googleapis.com/css?family=Raleway:300,500,900%7COpen+Sans:400,700,400italic" rel="stylesheet" type="text/css" />

    <!-- Revolution Slider CSS settings -->
    <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />
	
	<!-- Bootstrap CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	
	<!-- Template CSS -->
	<link href="css/style.css" rel="stylesheet" />
	
	<!-- Modernizr -->
	<script src="js/modernizr-2.8.1.min.js"></script>
    <script type="text/javascript" src="email/email.js"></script>
    <script type="text/javascript" src="email/notify.min.js"></script>
</head>
<body>
	<!-- BEGIN WRAPPER -->
	<div id="wrapper">
	
		<!-- BEGIN HEADER -->
		<header id="header">
			<div id="top-bar">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<ul id="top-info">
								<li><?php echo lang('TELEFONE'); ?>: <?php echo lang('EMPRESA_TEL'); ?> - <?php echo lang('EMPRESA_WHATSAPP'); ?></li>
								<li><?php echo lang('EMAIL'); ?>: <a href="mailto:<?php echo lang('EMPRESA_EMAIL'); ?>"><?php echo lang('EMPRESA_EMAIL'); ?></a></li>
							</ul>
							
							<ul id="top-buttons">
								<li><a href="http://sistema.joaodamascenoimoveis.com.br/login.php" target="_blank"><i class="fa fa-sign-in"></i> <?php echo lang('LINK_LOGIN_SISTEMA'); ?> </a></li>
								<!--<li><a href="#"><i class="fa fa-pencil-square-o"></i> Register</a></li>-->
								<!--<li class="divider"></li>-->
							</ul>
						</div>
					</div>
				</div>
			</div>
			
			<div id="nav-section">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<a href="index.php" class="nav-logo"><img src="images/logo.png" alt="Joao Damasceno Imoveis" /></a>
							
							<!-- BEGIN SEARCH -->
							<div id="sb-search" class="sb-search">
								<form>
									<input class="sb-search-input" placeholder="<?php echo lang('PROCURAR'); ?>" type="text" value="" name="search" id="search">
									<input class="sb-search-submit" type="submit" value="">
									<i class="fa fa-search sb-icon-search"></i>
								</form>
							</div>
							<!-- END SEARCH -->
							
							<!-- BEGIN MAIN MENU -->
							<nav class="navbar">
								<button id="nav-mobile-btn"><i class="fa fa-bars"></i></button>
								
								<ul class="nav navbar-nav">
									<li class="dropdown">
										<!-- class="active" -->
										<a href="index.php"><?php echo lang('INICIO'); ?></a>
									</li>
									
									<li class="dropdown">
										<a href="empresa.php"><?php echo lang('SOBRE'); ?></a>
									</li>
									
									<li class="dropdown">
										<a href="imoveis.php"><?php echo lang('IMOVEIS'); ?></a>
									</li>
									
									<li class="dropdown">
										<a href="#" data-toggle="dropdown" data-hover="dropdown"><?php echo lang('SIMULADORES'); ?><b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="simulador-caixa.php">Caixa</a></li>
										</ul>
									</li>									
									
									<li class="dropdown">
										<a href="faq.php"><?php echo lang('FAQ'); ?></a>
									</li>
									
									<li>
										<a href="contato.php"><?php echo lang('CONTATO'); ?></a>
									</li>
								</ul>
								
							</nav>
							<!-- END MAIN MENU -->
							
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- END HEADER -->