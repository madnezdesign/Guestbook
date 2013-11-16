<?php

class CObject {

  /**
   * Members
   */
   
  public $config;
  public $request;
  public $data;
  public $db;
  public $views;
  public $session;

  /**
   * Constructor
   */
   
  protected function __construct() {
    $ml = CMad::Instance();
    $this->config   = &$ml->config;
    $this->request  = &$ml->request;
    $this->data     = &$ml->data;
    $this->db       = &$ml->db;
    $this->views    = &$ml->views;
    $this->session  = &$ml->session;
  }

  /**
   * Redirect to another url and store the session
   */
   
  protected function RedirectTo($url) {
    $ml = CMad::Instance();
    if(isset($ml->config['debug']['db-num-queries']) && $ml->config['debug']['db-num-queries'] && isset($ml->db)) {
      $this->session->SetFlash('database_numQueries', $this->db->GetNumQueries());
    }    
    if(isset($ml->config['debug']['db-queries']) && $ml->config['debug']['db-queries'] && isset($ml->db)) {
      $this->session->SetFlash('database_queries', $this->db->GetQueries());
    }    
    if(isset($ml->config['debug']['timer']) && $ml->config['debug']['timer']) {
      $this->session->SetFlash('timer', $ml->timer);
    }    
    $this->session->StoreInSession();
    header('Location: ' . $this->request->CreateUrl($url));
  }


}