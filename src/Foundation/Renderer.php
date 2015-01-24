<?php
namespace Acme\Foundation;

/**
 * Class Renderer
 * @package Acme\Foundation
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Renderer
{

    /** @var \Twig_Environment  */
    protected $twig;

    /** @var string  */
    protected $namespace = "Acme\\WebViews\\";

    /**
     * @param $path
     */
    public function __construct($path)
    {
        $fileLoader = new \Twig_Loader_Filesystem($path . '/resources/views');
        $this->twig = new \Twig_Environment($fileLoader, [
            'cache' => $path . '/tmp/cache',
        ]);
    }

    /**
     * @return mixed
     */
    public function renderer(WebViewContract $view)
    {
        $template = str_replace($this->namespace, "", get_class($view));
        return $this->twig->render($template . ".twig", $view->getContext());
    }

}
