<?php

namespace Serebro;

use Phalcon\DI\Injectable;
use Phalcon\Mvc\View;

class Widget extends Injectable
{

    /** @var View */
    private $view;


    public function __construct()
    {
    }

    public function initialize()
    {
    }

    public static function widget(array $params = [])
    {
        $class = get_called_class();

        /* @var $widget Widget */
        $widget = new $class();
        foreach ($params as $key => $value) {
            if (!property_exists($class, $key)) {
                trigger_error(__METHOD__ . " property $class::$key is not defined.");
                continue;
            }

            $widget->$key = $value;
        }

        $widget->initialize();

        return $widget->run();
    }

    /**
     * @return View
     */
    public function getView()
    {
        if ($this->view === null) {
            $this->view = $this->di->get('widgetView');
            $this->view->setDi($this->di);
        }

        return $this->view;
    }

    /**
     * @param View $view
     * @return Widget
     */
    public function setView(View $view)
    {
        $this->view = $view;

        return $this;
    }


    /**
     * @param string $view_name
     * @param array  $params
     * @return string
     */
    public function render($view_name, array $params = [])
    {
        return $this->getView()->getRender('views', $view_name, $params);
    }

    /**
     * @return string
     */
    public function run()
    {
    }
}