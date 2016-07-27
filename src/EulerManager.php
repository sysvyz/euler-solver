<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 27.07.16
 * Time: 23:46
 */

namespace EulerSolver;


use Doctrine\Instantiator\Exception\InvalidArgumentException;
use EulerSolver\Interfaces\ProblemInterface;

class EulerManager
{
    /**
     * @var ProblemInterface[]
     */
    private $problems = [];


    /**
     * EulerManager constructor.
     * @param Interfaces\ProblemInterface[] $problems
     */
    public function __construct(array $problems)
    {
        $this->problems = $problems;
    }

    /**
     * @param int[]|null $ids
     * @return array
     */
    public function solveProblems(array $ids = null)
    {

        if (is_null($ids)) {
            $ids = array_map(function (ProblemInterface $p) {
                return $p->getId();
            }, $this->problems);
        }
        $res = [];
        foreach ($ids as $id) {
            $res[$id] = $this->solveProblem($id);
        }
        return $res;
    }

    public function solveProblem($id)
    {
        $res = [];

        foreach ($this->getProblem($id)->getSolutions() as $solution) {
            $res[$solution->getId()] = $solution->solve();
        }

        return $res;
    }

    public function getProblem($id)
    {
        if (!isset($this->problems[$id])) {
            throw new InvalidArgumentException("Problem with id: $id not found", 2);
        }

        return $this->problems[$id];
    }

    public function setProblem(ProblemInterface $problem)
    {
        $this->problems[$problem->getId()] = $problem;
    }


}