<?php
namespace Acme\Foundation;

/**
 * Interface WebViewContract
 * @package Acme\Foundation
 */
interface WebViewContract
{

    /**
     * @param array $array
     * @return mixed
     */
    public function render(array $array = []);

    /**
     * @return array
     */
    public function getContext();

}
