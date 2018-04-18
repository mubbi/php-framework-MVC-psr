<?php

namespace Mubbi;

/**
* Base Controller
*/
class BaseController
{
    /**
     * load the view
     * @param  string $view   view name
     * @param  array  $params additional variables to pass in view
     * @return view template with variables
     */
    public function view($view, $params = [])
    {
        // Check if view exists
        if (!file_exists(VIEWS . $view.'.php')) {
            die('View: ' . $view . ' file not found');
        }
        // Get Variables
        if (count($params)) {
            extract($params);
        }

        // Swap template engine based on user config
        if (USE_TWIG) {
            // Load TWIG
            $loader = new \Twig_Loader_Filesystem(VIEWS);
            // Load TWIG ENV
            $twig = new \Twig_Environment($loader, array(
                'cache' => FRAMEWORK . '/storage/cache',
                'debug' => true,
                'auto_reload' => true
            ));
            // Load View and Pass params
            echo $twig->render($view.'.php', $params);
        } else {
            // Load View
            include VIEWS . $view.'.php';
        }
    }

    /**
     * load the model
     * @param  string $model  model name
     * @return object         model class object
     */
    public function loadModel($model)
    {
        // Check if model exists
        if (!file_exists(MODELS . $model.'.php')) {
            die('MODEL: ' . $model . ' file not found');
        }
        // Load Model
        include MODELS . $model.'.php';
        // Return Model object
        return new $model;
    }
}
