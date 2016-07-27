<?php namespace EulerSolverTest\Mocks;

use EulerSolver\Abstracts\AbstractSolution;

/**
 * Class SolutionMock
 * @package EulerSolverTest\Mocks
 */
class SolutionMock extends AbstractSolution
{
    /**
     * @var int
     */
    private $res;
    public function __construct($id, $name,$res)
    {
        parent::__construct($id,$name);
        $this->res = $res;
    }
    public function solve():int
    {
        return $this->res;
    }


}