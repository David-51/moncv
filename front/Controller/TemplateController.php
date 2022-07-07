<?php

namespace Controller;

class Template
{
    public string $title = 'David GRIGNON - Web Dev';        
    public string $header ='undefined';
    public string $body = 'undefined';
    public string $footer = 'undefined';
    public string $navbar = 'undefined';
    public string $template;

    public function setTitle($title) :string{
        return $this->title = $title;        
    }
    public function getTitle() :string{
        return $this->title;
    }

    /**
     * Defined the header to use 
     * @param string $header_name Name of the Header
     * @param array $props parameters to pass through
     * @return string header's object
     */
    public function setHeader(string $header_name, array $props = []){
        ob_start();
        $props;
        require $header_name.'View.php';
        return $this->header = ob_get_clean();
    }
    public function getHeader() :string{
        return $this->header;
    }

    /**
     * Defined the header to use 
     * @param string $body_name Name of the Body who defined the files to use
     * example : body for bodyView.php
     * @param array $props parameters to pass through
     * @return string body's object
     */
    public function setBody(string $body_name, array $props = []) :string{
        ob_start();
        $props;
        require $body_name.'View.php';
        return $this->body = ob_get_clean();
        
    }

    /**
     * Defined the header to use 
     * @param string $nabar_name Name of the Body who defined the files to use
     * example : body for bodyView.php
     * @param array $props parameters to pass through
     * @return string navbar's object
     */
    public function setNavbar(string $navbar_name, $props = []) :string{
        ob_start();
        $props;
        require $navbar_name.'View.php';
        return $this->navbar = ob_get_clean();        
    }

    public function getNavbar() :string {
        return $this->navbar;
    }
    public function getBody() :string{
        return $this->body;
    }

    /**
     * Defined the header to use 
     * @param string $footer_name Name of the Body who defined the files to use
     * example : body for bodyView.php
     * @param array $props parameters to pass through
     * @return string footer's object
     */
    public function setFooter(string $footer_name, $props = []) :string{
        ob_start();
        $props;
        require $footer_name.'View.php';
        return $this->footer = ob_get_clean();
    }
    public function getFooter() :string{
        return $this->footer;
    }

    /**
     * This methods create the object content with navbar, header, body and footer
     * @param string $template Name of the template to use for the global view
     * @return string content object
     */
    public function getContent($template) :string{     
        ob_start();
        $this->navbar = $this->navbar === 'undefined' ? '' : $this->navbar; 
        $this->header = $this->header === 'undefined' ? '' : $this->header; 
        $this->body = $this->body === 'undefined' ? '<h5>Pas de contenu ...</h5>' : $this->body; 
        $this->footer = $this->footer === 'undefined' ? '' : $this->footer;       
        require $template.'View.php';
        return ob_get_clean();        
    }
}