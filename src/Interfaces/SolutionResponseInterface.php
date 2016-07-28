<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 28.07.16
 * Time: 02:21
 */

namespace EulerSolver\Interfaces;


interface SolutionResponseInterface
{
    /**
     * @return int
     */
    public function getValue():int;

    /**
     * @return SolutionInterface
     */
    public function getSolution():SolutionInterface;

    /**
     * @return ProblemInterface
     */
    public function getProblem():ProblemInterface;

    /**
     * @return float milli seconds
     */
    public function getCalculationTime():float;

}