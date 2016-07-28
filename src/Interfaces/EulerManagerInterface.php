<?php namespace EulerSolver\Interfaces;

interface EulerManagerInterface
{
    /**
     * @param int[]|null $ids
     * @return array
     */
    public function solveProblems(array $ids = null);

    /**
     * @param $id
     * @return SolutionResponseInterface[]
     */
    public function solveProblem($id);

    public function getProblem($id);

    public function addProblem(ProblemInterface $problem);
}