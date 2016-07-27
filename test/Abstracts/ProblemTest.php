<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 27.07.16
 * Time: 22:39
 */

namespace EulerSolverTest\Abstracts;


use Doctrine\Instantiator\Exception\InvalidArgumentException;
use EulerSolver\Interfaces\ProblemInterface;
use EulerSolver\Interfaces\SolutionInterface;
use EulerSolver\Problem;
use EulerSolverTest\Mocks\SolutionMock;
use PHPUnit_Framework_TestCase;

class ProblemTest extends PHPUnit_Framework_TestCase
{

    public function testAbstractProblem()
    {
        $obj = new Problem(1, 'Problem 1', 'aaaaa');
        $this->assertInstanceOf(ProblemInterface::class, $obj);
        return $obj;
    }


    /**
     * @depends clone testAbstractProblem
     * @param ProblemInterface $problem
     * @return ProblemInterface
     */
    public function testAddSolution(ProblemInterface $problem)
    {
        $solution = new SolutionMock(1, "sol.1.1",5);

        $problem->addSolution($solution);
        $solutions = $problem->getSolutions();

        $this->assertSame($solution->getProblem(), $problem);
        $this->assertCount(1, $solutions);
        $this->assertSame($solution, $solutions[1]);
        return $problem;
    }
    /**
     * @depends clone testAddSolution
     * @param ProblemInterface $problem
     * @return ProblemInterface
     */
    public function testAddMoreSolutions(ProblemInterface $problem)
    {
        $solution = new SolutionMock(2, "sol.1.2",5);
        $problem->addSolution($solution);
        $solution = new SolutionMock(3, "sol.1.3",5);
        $problem->addSolution($solution);
        $solution = new SolutionMock(4, "sol.1.4",5);
        $problem->addSolution($solution);
        $solution = new SolutionMock(5, "sol.1.5",5);
        $problem->addSolution($solution);

        $solutions = $problem->getSolutions();

        $this->assertCount(5, $solutions);

        return $problem;
    }

    /**
     * @depends clone testAddMoreSolutions
     * @param ProblemInterface $problem
     */
    public function testGetSolutionByID(ProblemInterface $problem)
    {

        $solution = $problem->getSolutionById(1);
        $this->assertInstanceOf(SolutionInterface::class,$solution);
        $this->assertEquals($solution->getId(),1);
        $this->assertEquals($solution->getName(),"sol.1.1");


        $solution = $problem->getSolutionById(4);
        $this->assertInstanceOf(SolutionInterface::class,$solution);
        $this->assertEquals($solution->getId(),4);
        $this->assertEquals($solution->getName(),"sol.1.4");


    }

    /**
     * @depends clone testAddMoreSolutions
     * @param ProblemInterface $problem
     * @expectedException InvalidArgumentException
     * @expectedExceptionCode 2
     * @expectedExceptionMessage Solution with id: 666 not found
     */
    public function testGetSolutionByIDFail(ProblemInterface $problem)
    {

        $solution = $problem->getSolutionById(666);



    }

    /**
     * @depends clone testAddMoreSolutions
     * @param ProblemInterface $problem
     */
    public function testGetSolutionByName(ProblemInterface $problem)
    {

        $solution = $problem->getSolutionByName("sol.1.1");
        $this->assertInstanceOf(SolutionInterface::class,$solution);
        $this->assertEquals($solution->getId(),1);
        $this->assertEquals($solution->getName(),"sol.1.1");


        $solution = $problem->getSolutionByName("sol.1.4");
        $this->assertInstanceOf(SolutionInterface::class,$solution);
        $this->assertEquals($solution->getId(),4);
        $this->assertEquals($solution->getName(),"sol.1.4");


        $solution = $problem->getSolutionByName('dsfsdfd');
        $this->assertNull($solution);
    }
    /**
     * @depends clone testAddMoreSolutions
     * @param ProblemInterface $problem
     */
    public function testGetSolutionSolve(ProblemInterface $problem)
    {

        $solution = $problem->getSolutionByName("sol.1.1");
        $this->assertInstanceOf(SolutionInterface::class,$solution);
        $this->assertEquals($solution->solve(),5);

    }


    /**
     * @depends clone testAddMoreSolutions
     * @param ProblemInterface $problem
     * @return ProblemInterface
     * @expectedException InvalidArgumentException
     * @expectedExceptionCode 2
     * @expectedExceptionMessage Solution with id: 2 added twice
     */
    public function testAddSolutionTwice(ProblemInterface $problem)
    {
        $solution = new SolutionMock(2, "sol.1.2",5);
        $problem->addSolution($solution);

        return $problem;
    }

    /**
     * @depends clone testAddMoreSolutions
     */
    public function testRemoveSolution(ProblemInterface $problem)
    {

        $this->assertCount(5,$problem->getSolutions());

        $problem->removeSolution(2);

        $this->assertCount(4,$problem->getSolutions());

        return $problem;
    }

    /**
     * @depends clone testRemoveSolution
     * @param ProblemInterface $problem
     * @return ProblemInterface
     * @expectedException InvalidArgumentException
     * @expectedExceptionCode 2
     * @expectedExceptionMessage Solution with id: 2 not found
     */
    public function testRemoveSolutionTwice(ProblemInterface $problem)
    {
        $problem->removeSolution(2);

        return $problem;
    }
}
