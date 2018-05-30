<?php
/**
* MPC Web Shell 
* @package project
* @author Wizard <sergejey@gmail.com>
* @copyright http://majordomo.smartliving.ru/
* @version 0.1 (wizard, 13:12:18 [Dec 23, 2016])
*/
//
//
class mpcwh extends module {
/**
* mpcwh
*
* Module class constructor
*
* @access private
*/
function mpcwh() {
  $this->name="mpcwh";
  $this->title="MPC Web Shell";
  $this->module_category="<#LANG_SECTION_APPLICATIONS#>";
  $this->checkInstalled();
}
/**
* saveParams
*
* Saving module parameters
*
* @access public
*/
   public function saveParams($data = 0)
   {
      $p = array();
      
      if(isset($this->id))
         $p["id"] = $this->id;
      
      if(isset($this->view_mode))
         $p["view_mode"] = $this->view_mode;
      
      if(isset($this->edit_mode))
         $p["edit_mode"] = $this->edit_mode;
      
      if(isset($this->tab))
         $p["tab"] = $this->tab;
      
      return parent::saveParams($p);
   }
/**
* getParams
*
* Getting module parameters from query string
*
* @access public
*/
   public function getParams()
   {
      global $id;
      global $mode;
      global $view_mode;
      global $edit_mode;
      global $tab;
      global $fact;
      global $forecast;
	  
      if (isset($id))
         $this->id=$id;
      
      if (isset($mode))
         $this->mode = $mode;
      
      if (isset($view_mode))
         $this->view_mode = $view_mode;
      
      if (isset($edit_mode))
         $this->edit_mode = $edit_mode;
      
      if (isset($tab))
         $this->tab = $tab;
      
      if (isset($forecast))
         $this->forecast = $forecast;
      
      if (isset($fact))
         $this->fact = $fact;
   }
/**
* Run
*
* Description
*
* @access public
*/
   public function run()
   {
      global $session;
      $out = array();
      
      if ($this->action == 'admin')
         $this->admin($out);
      else
         $this->usual($out);
      
      if (isset($this->owner->action))
         $out['PARENT_ACTION'] = $this->owner->action;
      
      if (isset($this->owner->name))
         $out['PARENT_NAME'] = $this->owner->name;
      
      $out['VIEW_MODE'] = $this->view_mode;
      $out['EDIT_MODE'] = $this->edit_mode;
      $out['MODE']      = $this->mode;
      $out['ACTION']    = $this->action;
      if ($this->single_rec)
         $out['SINGLE_REC'] = 1;
      
      $this->data = $out;
      $p = new parser(DIR_TEMPLATES . $this->name . "/" . $this->name . ".html", $this->data, $this);
      $this->result = $p->result;
   }
/**
* BackEnd
*
* Module backend
*
* @access public
*/
function admin(&$out) {
 $this->getConfig();
 $out['API_URL']=$this->config['API_URL'];
 if (!$out['API_URL']) {
  $out['API_URL']='http://';
 }
 $out['API_KEY']=$this->config['API_KEY'];
 $out['API_USERNAME']=$this->config['API_USERNAME'];
 $out['API_PASSWORD']=$this->config['API_PASSWORD'];
 if ($this->view_mode=='update_settings') {
   global $api_url;
   $this->config['API_URL']=$api_url;
   global $api_key;
   $this->config['API_KEY']=$api_key;
   global $api_username;
   $this->config['API_USERNAME']=$api_username;
   global $api_password;
   $this->config['API_PASSWORD']=$api_password;
   $this->saveConfig();
   $this->redirect("?");
 }
}
/**
* FrontEnd
*
* Module frontend
*
* @access public
*/
function usual(&$out) {
 if ($this->owner->action=='apps') {
  $this->redirect(ROOTHTML."modules/mpcwh/index.php");
 }
 $this->admin($out);
}
/**
* Install
*
* Module installation routine
*
* @access private
*/
 function install($data='') {
  parent::install();
 }
// --------------------------------------------------------------------
}
/*
*
* TW9kdWxlIGNyZWF0ZWQgRGVjIDIzLCAyMDE2IHVzaW5nIFNlcmdlIEouIHdpemFyZCAoQWN0aXZlVW5pdCBJbmMgd3d3LmFjdGl2ZXVuaXQuY29tKQ==
*
*/
