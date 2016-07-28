<?php namespace EulerSolver;


use Cofi\Filter\SimpleFilter;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use EulerSolver\Interfaces\ProblemInterface;
use EulerSolver\Interfaces\SolutionInterface;
use Hurl\Node\Statics\_Array;

class Problem implements ProblemInterface
{


    private $id;
    private $name;
    private $description;
    private $solutions = [];

    /**
     * AbstractProblem constructor.
     * @param $id
     * @param $name
     * @param $description
     */
    public function __construct($id, $name, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription():string
    {
        return $this->description;
    }

    public function getSolutions():array
    {
        return $this->solutions;
    }

    public static function filterID($id)
    {
        return new SimpleFilter(function (SolutionInterface $elem) use ($id) {
            return $id == $elem->getId();
        });
    }

    public static function filterName($name)
    {
        return function (SolutionInterface $elem) use ($name) {
            return $name == $elem->getName();
        };
    }

    /**
     * @param int $id
     * @return SolutionInterface|null
     */
    public function getSolutionById(int $id)
    {
        if (!isset($this->solutions[$id])) {
            throw new InvalidArgumentException("Solution with id: $id not found", 2);
        }
        return $this->solutions[$id];
    }

    public function getSolutionByName(string $name)
    {

        $func = _Array::filter(self::filterName($name))->values();

        $arr = $func($this->solutions);
   
        return count($arr) ? $arr[0] : null;
    }

    public function addSolution(SolutionInterface $solution):bool
    {
        $id = $solution->getId();

        if (isset($this->solutions[$id])) {
            throw new InvalidArgumentException("Solution with id: $id added twice", 2);
        }

        $this->solutions[$id] = $solution;
        $solution->addedProblem($this);
        return true;
    }


    /**
     * @param int $id
     * @throws InvalidArgumentException
     */
    public function removeSolution(int $id)
    {

        if (!isset($this->solutions[$id])) {
            throw new InvalidArgumentException("Solution with id: $id not found", 2);
        }
        unset($this->solutions[$id]);
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}