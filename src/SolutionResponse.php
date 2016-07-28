<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 28.07.16
 * Time: 02:27
 */

namespace EulerSolver;


use EulerSolver\Interfaces\ProblemInterface;
use EulerSolver\Interfaces\SolutionInterface;
use EulerSolver\Interfaces\SolutionResponseInterface;

class SolutionResponse implements SolutionResponseInterface
{

    private $value;
    private $solution;
    private $problem;
    private $calculationTime;

    /**
     * SolutionResponse constructor.
     * @param $solutionId
     * @param $solution
     * @param $problem
     * @param $calculationTime
     */
    public function __construct($value, $solution, $problem, $calculationTime)
    {
        $this->value = $value;
        $this->solution = $solution;
        $this->problem = $problem;
        $this->calculationTime = $calculationTime;
    }

    /**
     * @return int
     */
    public function getValue():int
    {
        return $this->value;
    }

    /**
     * @return SolutionInterface
     */
    public function getSolution():SolutionInterface
    {
        return $this->solution;
    }

    /**
     * @return ProblemInterface
     */
    public function getProblem():ProblemInterface
    {
        return $this->problem;
    }

    /**
     * @return float
     */
    public function getCalculationTime():float
    {
        return $this->calculationTime;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'value' => $this->value,
            'solution' => $this->solution,
            'problem' => $this->problem,
            'calculationTime' => $this->calculationTime,
        ];
    }
}