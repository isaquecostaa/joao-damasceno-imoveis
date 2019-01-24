<?php
  /**
   * Classe Core
   *
   * @package Sistemas Divulgação Online
   * @author Geandro Bessa
   * @copyright 2013
   * @version 2
   */
  
  if (!defined("_VALID_PHP"))
      die('Acesso direto a esta classe não é permitido.');

  class Core
  {

      const sTable = "configuracoes";
      public $ano = null;
      public $mes = null;
      public $dia = null;
	  public $language;


      /**
       * Core::__construct()
       * 
       * @return
       */
      function __construct()
      {
          $this->getSettings();
		  $this->getLanguage();

          $this->ano = (get('ano')) ? get('ano') : strftime('%Y');
          $this->mes = (get('mes')) ? get('mes') : strftime('%m');
          $this->dia = (get('dia')) ? get('dia') : strftime('%d');

          return mktime(0, 0, 0, $this->mes, $this->dia, $this->ano);
      }


      /**
       * Core::getSettings()
       * 
       * @return
       */
      private function getSettings()
      {
          $sql = "SELECT * FROM " . self::sTable;
          $row = Registry::get("Database")->first($sql);

          $this->empresa = $row->empresa;
          $this->site_url = $row->site_url;
          $this->site_sistema = $row->site_sistema;
          $this->site_email = $row->site_email;
          $this->file_types = $row->file_types;
          $this->file_max = $row->file_max;
          $this->mailer = $row->mailer;
          $this->smtp_host = $row->smtp_host;
          $this->smtp_user = $row->smtp_user;
          $this->smtp_pass = $row->smtp_pass;
          $this->smtp_port = $row->smtp_port;

      }

      /**
       * Core::processConfig()
       * 
       * @return
       */
      public function processConfig()
      {
          if (empty($_POST['empresa']))
              Filter::$msgs['empresa'] = lang('CONF_COMPANY_R');

          if (empty($_POST['site_url']))
              Filter::$msgs['site_url'] = lang('CONF_URL_R');

          if (empty($_POST['site_email']))
              Filter::$msgs['site_email'] = lang('CONF_EMAIL_R');

          if (isset($_POST['mailer']) && $_POST['mailer'] == "SMTP") {
              if (empty($_POST['smtp_host']))
                  Filter::$msgs['smtp_host'] = lang('CONF_SMTP_HOST_R');
              if (empty($_POST['smtp_user']))
                  Filter::$msgs['smtp_user'] = lang('CONF_SMTP_USER_R');
              if (empty($_POST['smtp_pass']))
                  Filter::$msgs['smtp_pass'] = lang('CONF_SMTP_PASS_R');
              if (empty($_POST['smtp_port']))
                  Filter::$msgs['smtp_port'] = lang('CONF_SMTP_PORT_R');
          }

          if (!empty($_FILES['logo']['name'])) {
              $file_info = getimagesize($_FILES['logo']['tmp_name']);
              if (empty($file_info))
                  Filter::$msgs['logo'] = lang('CONF_LOGO_R');
          }

          if (empty(Filter::$msgs)) {
              $data = array(
					  'empresa' => sanitize($_POST['empresa']),
					  'site_url' => sanitize($_POST['site_url']),
					  'site_sistema' => sanitize($_POST['site_sistema']),
					  'site_email' => sanitize($_POST['site_email']),
					  'lang' => sanitize($_POST['lang']),
					  'enable_uploads' => intval($_POST['enable_uploads']),
					  'file_types' => trim($_POST['file_types']),
					  'file_max' => intval($_POST['file_max']*1048576),		  
					  'mailer' => sanitize($_POST['mailer']),
					  'smtp_host' => sanitize($_POST['smtp_host']),
					  'smtp_user' => sanitize($_POST['smtp_user']),
					  'smtp_pass' => sanitize($_POST['smtp_pass']),
					  'smtp_port' => intval($_POST['smtp_port'])
				  );
			  
              Registry::get("Database")->update(self::sTable, $data);
              (Registry::get("Database")->affected()) ? Filter::msgOk(lang('CONF_UPDATED')) : Filter::msgAlert(lang('NOPROCCESS'));
          } else
              print Filter::msgStatus();
      }

	  /**
	   * Core:::getLanguage()
	   * 
	   * @return
	   */
	  private function getLanguage()
	  {
		  $this->langdir = BASEPATH . "lang/";		  
		  include($this->langdir . "pt-br.lang.php");
	  }
	  
	  /**
       * Core::formatMoney()
       * 
       * @param mixed $amount
       * @return
       */
      function moeda($amount)
      {
          return "R$ " . number_format($amount, 2, ',', '.');
      }

      /**
       * Core::getRowById()
       * 
       * @param mixed $table
       * @param mixed $id
       * @param bool $and
       * @param bool $is_admin
       * @return
       */
      public static function getRowById($table, $id, $and = false, $is_admin = true)
      {
          $id = sanitize($id, 8, true);
          if ($and) {
              $sql = "SELECT * FROM " . (string )$table . " WHERE id = '" . Registry::get("Database")->escape((int)$id) . "' AND " . Registry::get("Database")->escape($and) . "";
          } else
              $sql = "SELECT * FROM " . (string )$table . " WHERE id = '" . Registry::get("Database")->escape((int)$id) . "'";

          $row = Registry::get("Database")->first($sql);

          if ($row) {
              return $row;
          } else {
              if ($is_admin)
                  Filter::error("ID selecionado inválido - #" . $id, "Core::getRowById()");
          }
      }
	  	  
      /**
       * Core::doForm()
       * 
       * @param mixed $data
       * @param string $url
       * @param integer $reset
       * @param integer $clear
       * @param string $form_id
       * @param string $msgholder
       * @return
       */
      public static function doForm($data, $form_id = "admin_form", $fechar = false, $url = "controller.php")
      {
          if($fechar) {
		  $display = '<script type="text/javascript">
						$(document).ready(function() {
							$("#' . $form_id . '").submit(function(){
								var dados = $( this ).serialize();
								$("#' . $fechar . '").modal("hide");
								$.ajax({
									type: "POST",
									url: "' . $url . '",
									data: dados+ "&' . $data . '=1",
									success: function( data )
									{
										$.gritter.add({
											title: 	"Mensagem",
											text: 	data,
											image: 	null,
											sticky: false,
											time: 	3000
										});
									}
								});
								
								return false;
							});
						});
						</script>';
			} else {
			$display = '<script type="text/javascript">
						$(document).ready(function() {
							$("#' . $form_id . '").submit(function(){
								var dados = $( this ).serialize();
					 
								$.ajax({
									type: "POST",
									url: "' . $url . '",
									data: dados+ "&' . $data . '=1",
									success: function( data )
									{
										$.gritter.add({
											title: 	"Mensagem",
											text: 	data,
											image: 	null,
											sticky: false,
											time: 	3000
										});
									}
								});
								
								return false;
							});
						});
						</script>';
			}

          print $display;
      }

  }
?>