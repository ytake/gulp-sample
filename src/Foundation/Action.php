<?php
namespace Acme\Foundation;

use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Action
 * @package Acme\Foundation
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @property array $parameters
 */
abstract class Action
{

    /** @var */
    protected $parameters;

    /** @var   */
    protected $body = "<h2>sample</h2>";

    /**
     * @return mixed
     */
    abstract protected function action();

    /**
     * @return Response
     */
    public function response()
    {
        $this->action();
        return (new Response($this->body))
            ->sendHeaders()->sendContent();
    }

    /**
     * @param ParameterBag $params
     * @return $this
     */
    public function setParams(ParameterBag $params)
    {
        $this->parameters = $params->all();
        return $this;
    }

}
