<?php
namespace Acme\Foundation;

use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Action
 * @package Acme\Foundation
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
abstract class Action implements \ArrayAccess
{

    /** @var */
    protected $parameters;

    /** @var   */
    protected $body = "<h2>sample</h2>";


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

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->parameters[] = $value;
        } else {
            $this->parameters[$offset] = $value;
        }
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->parameters[$offset]);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->parameters[$offset]);
    }

    /**
     * @param mixed $offset
     * @return null
     */
    public function offsetGet($offset)
    {
        return isset($this->parameters[$offset]) ? $this->parameters[$offset] : null;
    }

}
