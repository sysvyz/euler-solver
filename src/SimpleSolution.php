<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 28.07.16
 * Time: 01:36
 */

namespace EulerSolver;


use EulerSolver\Abstracts\AbstractSolution;

class SimpleSolution extends AbstractSolution
{

    public static function init($id, $name, $func)
    {
        return new self($id, $name, $func);
    }

    /**
     * @var callable
     */
    private $func;

    public function __construct($id, $name, $func)
    {
        parent::__construct($id, $name);
        $this->func = $func;
    }

    /**
     * @return int
     */
    public function solve():int
    {
        $func = $this->func;
        return $func();
    }
}