<?php namespace EulerSolverTest;


use EulerSolver\SimpleSolution;

class SimpleSolutionTest extends \PHPUnit_Framework_TestCase
{

    public function testSimpleSolution()
    {
        $solution = SimpleSolution::init(1, "simple1", function () {
            return 1729;
        });
        $this->assertEquals(1729, $solution->solve());
    }
    public function testSimpleSolution2()
    {
        $solution = SimpleSolution::init(1, "simple1",SimpleSolution::init(1, "simple1", function () {
            return 1729;
        }));
        $this->assertEquals(1729, $solution->solve());
    }
}
