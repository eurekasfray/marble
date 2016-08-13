<?php

namespace Marble;

class View
{
    private $vars = array();
    private $template;

    public function __construct($template)
    {
        $template = trim($template);
        $template = trim($template,'/\\');
        $template = preg_replace('{/|\\\}', DS, $template);
        $this->template = APP_VIEW_DIR . DS . $template . '.php';
    }

    public function set($name, $value)
    {
        $this->vars[$name] = $value;
    }

    public function render()
    {
        extract($this->vars);
        ob_start();
        $template = $this->template;
        if (!file_exists($template) || is_dir($template)) {
            trigger_error("Marble: Missing file: Could not load template file: \"" . $template . "\"", E_USER_ERROR);
        }
        require($template);
        $content = ob_get_clean();
        ob_end_clean();
        return $content;
    }

    public function __toString()
    {
        $content = $this->render();
        return $content;
    }
}
