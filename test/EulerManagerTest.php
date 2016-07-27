<?php
/**
 * Created by PhpStorm.
 * User: angus
 * Date: 27.07.16
 * Time: 23:54
 */

namespace EulerSolverTest;


use EulerSolver\EulerManager;
use EulerSolver\Problem;
use EulerSolverTest\Mocks\SolutionMock;
use InvalidArgumentException;
use PHPUnit_Framework_TestCase;

class EulerManagerTest extends PHPUnit_Framework_TestCase
{


    public function testManager()
    {
        $mgr = new EulerManager([]);
        $this->assertInstanceOf(EulerManager::class, $mgr);
        return $mgr;
    }

    /**
     * @depends clone testManager
     * @param EulerManager $eulerManager
     * @return EulerManager
     */
    public function testAddProblem(EulerManager $eulerManager)
    {

        $p1 = new Problem(1, 'p1', 'sum up some numbers');
        $s1 = new SolutionMock(1, 's1', 4);
        $s13 = new SolutionMock(13, 's1', 4);
        $p1->addSolution($s1);
        $p1->addSolution($s13);
        $eulerManager->setProblem($p1);

        $p2 = new Problem(2, 'p2', 'sum up some numbers');
        $s2 = new SolutionMock(2, 's2', 2);
        $p2->addSolution($s2);
        $eulerManager->setProblem($p2);

        $p3 = new Problem(3, 'p3', 'sum up some numbers');
        $s3 = new SolutionMock(3, 's3', 7);
        $p3->addSolution($s3);
        $eulerManager->setProblem($p3);

        $p4 = new Problem(4, 'p4', 'sum up some numbers');
        $s4 = new SolutionMock(4, 's4', 6);
        $p4->addSolution($s4);
        $eulerManager->setProblem($p4);

        $this->assertSame($p2, $eulerManager->getProblem(2));
        $this->assertSame($p3, $eulerManager->getProblem(3));
        $this->assertSame($p1, $eulerManager->getProblem(1));
        $this->assertSame($p4, $eulerManager->getProblem(4));
        $this->assertNotSame($p3, $eulerManager->getProblem(2));

        return $eulerManager;

    }

    /**
     * @depends clone testAddProblem
     * @param EulerManager $eulerManager
     */
    public function testGetProblem(EulerManager $eulerManager)
    {

        $prob = $eulerManager->getProblem(2);


        $this->assertEquals(2, $prob->getId());
        $this->assertEquals('p2', $prob->getName());

    }

    /**
     * @depends clone testAddProblem
     * @param EulerManager $eulerManager
     */
    public function testSolveProblem(EulerManager $eulerManager)
    {


        $this->assertEquals([2 => 2], $eulerManager->solveProblem(2));
        $this->assertEquals([
            1 => 4,
            13 => 4
        ], $eulerManager->solveProblem(1));

    }

    /**
     * @depends clone testAddProblem
     * @param EulerManager $eulerManager
     */
    public function testSolveProblems(EulerManager $eulerManager)
    {
        $this->assertEquals([
            1 => [
                1 => 4,
                13 => 4
            ],
            2 => [
                2 => 2
            ]
        ], $eulerManager->solveProblems([1, 2]));

    }
    /**
     * @depends clone testAddProblem
     * @param EulerManager $eulerManager
     */
    public function testSolveAllProblems(EulerManager $eulerManager)
    {
        $this->assertEquals(json_decode('{"1":{"1":4,"13":4},"2":{"2":2},"3":{"3":7},"4":{"4":6}}',true), $eulerManager->solveProblems());
    }

    /**
     * @depends clone testAddProblem
     * @param EulerManager $eulerManager
     * @expectedException InvalidArgumentException
     * @expectedExceptionCode 2
     * @expectedExceptionMessage Problem with id: 666 not found
     */

    public function testSolveProblemFail(EulerManager $eulerManager)
    {

        $prob = $eulerManager->solveProblem(666);

    }
    /**
     * @depends clone testAddProblem
     * @param EulerManager $eulerManager
     * @expectedException InvalidArgumentException
     * @expectedExceptionCode 2
     * @expectedExceptionMessage Problem with id: 666 not found
     */

    public function testSolveProblemsFail(EulerManager $eulerManager)
    {

        $prob = $eulerManager->solveProblems([666]);

    }
    /**
     * @depends clone testAddProblem
     * @param EulerManager $eulerManager
     * @expectedException InvalidArgumentException
     * @expectedExceptionCode 2
     * @expectedExceptionMessage Problem with id: 666 not found
     */

    public function testGetProblemFails(EulerManager $eulerManager)
    {

        $prob = $eulerManager->getProblem(666);

    }
}