<?php
namespace Acme\WebViews;

use Acme\Foundation\WebViewContract;

/**
 * Class Index
 * @package Acme\WebViews
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Index implements WebViewContract
{

    /** @var array  */
    protected $values = [];

    /**
     * @param array $array
     * @return $this|Index
     */
    public function render(array $array = [])
    {
        $this->values = $array;
        return $this;
    }

    /**
     * @return array
     */
    public function getContext()
    {
        return $this->values;
    }

}
