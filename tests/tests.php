<?php

use PHPUnit\Framework\TestCase;

require('../index.php');

class StackTest extends TestCase
{
    //userDecision()

    //Success

    public function testuserDecisionSuccessLength ()
    {
        $input1=5.0;
        $input2=0;
        $input3=0;
        $expected=[5, 0, 0];
        $case= userDecision($input1, $input2, $input3);
        $this->assertEquals($case, $expected);
    }

    public function testuserDecisionSuccessPR ()
    {
        $input1=0.0;
        $input2=5;
        $input3=10;
        $expected=[0, 5, 10];
        $case= userDecision($input1, $input2, $input3);
        $this->assertEquals($case, $expected);
    }

    public function testuserDecisionSuccessNone ()
    {
        $input1=0.0;
        $input2=0;
        $input3=0;
        $expected=[0, 0, 0];
        $expec_session=false;
        $case= userDecision($input1, $input2, $input3);
        $this->assertEquals($case, $expected);
    }

    //failure

    public function testuserDecisionfailureString ()
    {
        $input1="20.0";
        $input2="0";
        $input3="0";
        $expected=[20, 0, 0];
        $case= userDecision($input1, $input2, $input3);
        $this->assertEquals($case, $expected);
    }

    public function testuserDecisionfailureInt ()
    {
        $input1=20;
        $input2=0;
        $input3=0;
        $expected=[20, 0, 0];
        $case= userDecision($input1, $input2, $input3);
        $this->assertEquals($case, $expected);
    }

    public function testuserDecisionfailureDbl ()
    {
        $input1=0;
        $input2=10.5;
        $input3=10.4;
        $expected=[20, 0, 0];
        $case= userDecision($input1, $input2, $input3);
        $this->assertEquals($case, $expected);
    }

    //malformed

    public function testuserDecisionMalformedArray ()
    {
        $input1=[1, 2, 3];
        $input2=[1, 2, 3];
        $input3=[1, 2, 3];
        $this->expectException(TypeError::class);
        userDecision($input1, $input2, $input3);
    }

    //postRailsDeclared
    //success

    public function testpostRailsDeclaredSuccess ()
    {
        $input1=[0, 5, 8];
        $expected=[5, 4, 6.5, 4, 0];
        $case= userDecision($input1);
        $this->assertEquals($case, $expected);
    }

    public function testpostRailsDeclaredFailure ()
    {
        $input1=[0, 4, 3];
        $expected=[4, 3, 3.3, 2, 0];
        $case= userDecision($input1);
        $this->assertEquals($case, $expected);
    }

    //failure
    public function testpostRailsDeclaredFailureArr ()
    {
        $input1=["0", "5", "8"];
        $expected=[4, 3, 3.3, 2, 0];
        $case= userDecision($input1);
        $this->assertEquals($case, $expected);
    }

    public function testpostRailsDeclaredFailureInp ()
    {
        $input1=[10, 4, 3];
        $expected=[4, 3, 3.3, 2, 0];
        $case= userDecision($input1);
        $this->assertEquals($case, $expected);
    }

    //malformed
    public function testpostRailsDeclaredMalformed ()
    {
        $input1=43;
        $this->expectException(TypeError::class);
        userDecision($input1);
    }


}
