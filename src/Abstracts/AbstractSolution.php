<?php namespace EulerSolver\Abstracts;

use EulerSolver\Interfaces\ProblemInterface;
use EulerSolver\Interfaces\SolutionInterface;

/**
 * Class AbstractSolution
 * @package EulerSolver\Abstracts
 */
abstract class AbstractSolution implements SolutionInterface
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var ProblemInterface
     */
    private $problem;

    /**
     * SolutionMock constructor.
     * @param $id
     * @param $name
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }


    /**
     * @return int
     */
    abstract public function solve():int;

    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @return ProblemInterface
     */
    public function getProblem():ProblemInterface
    {
        return $this->problem;
    }

    public function addedProblem(ProblemInterface $problem):bool
    {
        $this->problem = $problem;
        return true;
    }

    function __invoke():int
    {
        return $this->solve();
    }


}
