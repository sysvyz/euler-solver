<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 27.07.16
 * Time: 22:14
 */

namespace EulerSolver\Interfaces;


use Doctrine\Instantiator\Exception\InvalidArgumentException;
use JsonSerializable;

interface ProblemInterface extends JsonSerializable
{

    public function getId():int;
    public function getName():string;
    public function getDescription():string;

    /**
     * @return SolutionInterface[]
     */
    public function getSolutions():array;

    /**
     * @param int $id
     * @return SolutionInterface|null
     */
    public function getSolutionById(int $id);

    /**
     * @param string $name
     * @return SolutionInterface|null
     */
    public function getSolutionByName(string $name);

    /**
     * @throws InvalidArgumentException
     * @param SolutionInterface $solution
     * @return bool
     */
    public function addSolution(SolutionInterface $solution):bool;

    /**
     * @param int $id
     * @throws InvalidArgumentException
     */
    public function removeSolution(int $id);


}