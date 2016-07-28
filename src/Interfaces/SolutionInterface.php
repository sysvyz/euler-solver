<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 27.07.16
 * Time: 22:14
 */

namespace EulerSolver\Interfaces;


use JsonSerializable;

interface SolutionInterface extends JsonSerializable
{

    public function solve():int;
    public function __invoke():int;

    public function getId():int;
    public function getName():string;
    public function getProblem():ProblemInterface;

    /**
     * @throws \BadMethodCallException
     * @param ProblemInterface $problem
     * @return bool
     */
    public function addedProblem(ProblemInterface $problem):bool ;



}