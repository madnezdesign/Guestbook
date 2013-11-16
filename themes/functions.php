<?php

/**
 * Helpers for theming, available for all themes in their template files and functions.php.
 * This file is included right before the themes own functions.php
 */
 

/**
 * Print debuginformation from the framework.
 */
 
function get_debug() {
  // Only if debug is wanted.
  $ml = CMad::Instance();  
  if(empty($ml->config['debug'])) {
    return;
  }
  
  // Get the debug output
  
  $html = null;
  if(isset($ml->config['debug']['db-num-queries']) && $ml->config['debug']['db-num-queries'] && isset($ml->db)) {
    $flash = $ml->session->GetFlash('database_numQueries');
    $flash = $flash ? "$flash + " : null;
    $html .= "<p>Database made $flash" . $ml->db->GetNumQueries() . " queries.</p>";
  }    
  if(isset($ml->config['debug']['db-queries']) && $ml->config['debug']['db-queries'] && isset($ml->db)) {
    $flash = $ml->session->GetFlash('database_queries');
    $queries = $ml->db->GetQueries();
    if($flash) {
      $queries = array_merge($flash, $queries);
    }
    $html .= "<p>Database made the following queries.</p><pre>" . implode('<br/><br/>', $queries) . "</pre>";
  }    
  if(isset($ml->config['debug']['timer']) && $ml->config['debug']['timer']) {
    $html .= "<p>Page was loaded in " . round(microtime(true) - $ml->timer['first'], 5)*1000 . " msecs.</p>";
  }    
  if(isset($ml->config['debug']['lydia']) && $ml->config['debug']['mad']) {
    $html .= "<hr><h3>Debuginformation</h3><p>The content of Mad:</p><pre>" . htmlent(print_r($ml, true)) . "</pre>";
  }    
  if(isset($ml->config['debug']['session']) && $ml->config['debug']['session']) {
    $html .= "<hr><h3>SESSION</h3><p>The content of Mad->session:</p><pre>" . htmlent(print_r($ml->session, true)) . "</pre>";
    $html .= "<p>The content of \$_SESSION:</p><pre>" . htmlent(print_r($_SESSION, true)) . "</pre>";
  }    
  return $html;
}

/**
 * Get messages stored in flash-session.
 */
 
function get_messages_from_session() {
  $messages = CMad::Instance()->session->GetMessages();
  $html = null;
  if(!empty($messages)) {
    foreach($messages as $val) {
      $valid = array('info', 'notice', 'success', 'warning', 'error', 'alert');
      $class = (in_array($val['type'], $valid)) ? $val['type'] : 'info';
      $html .= "<div class='$class'>{$val['message']}</div>\n";
    }
  }
  return $html;
}

/**
 * Prepend the base_url.
 */
 
function base_url($url=null) {
  return CMad::Instance()->request->base_url . trim($url, '/');
}

/**
 * Create a url to an internal resource.
 */
 
function create_url($url=null) {
  return CMad::Instance()->request->CreateUrl($url);
}

/**
 * Prepend the theme_url, which is the url to the current theme directory.
 */
 
function theme_url($url) {
  $ml = CMad::Instance();
  return "{$ml->request->base_url}themes/{$ml->config['theme']['name']}/{$url}";
}

/**
 * Return the current url.
 */
 
function current_url() {
  return CMad::Instance()->request->current_url;
}

/**
 * Render all views.
 */
 
function render_views() {
  return CMad::Instance()->views->Render();
}