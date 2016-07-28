<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 27.07.16
 * Time: 23:46
 */

namespace EulerSolver;


use Doctrine\Instantiator\Exception\InvalidArgumentException;
use EulerSolver\Interfaces\EulerManagerInterface;
use EulerSolver\Interfaces\ProblemInterface;

class EulerManager implements EulerManagerInterface
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
        $problem =$this->getProblem($id);

        foreach ($problem->getSolutions() as $solution) {
            $resTimeStart = microtime(true);
            $resSolution = $solution->solve();
            $resTime = microtime(true)- $resTimeStart;
            $res[] = new SolutionResponse($resSolution,$solution,$problem,$resTime);
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

    public function addProblem(ProblemInterface $problem)
    {
        $this->problems[$problem->getId()] = $problem;
    }


}