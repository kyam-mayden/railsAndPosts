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

    //postRailsDeclared()
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
    public function testpostRailsDeclaredMalformedInt ()
    {
        $input1=43;
        $this->expectException(TypeError::class);
        userDecision($input1);
    }

    public function testpostRailsDeclaredMalformedStr ()
    {
        $input1="43";
        $this->expectException(TypeError::class);
        userDecision($input1);
    }

    //lengthDeclared()
    //success

    public function testlengthDeclaredSuccess ()
    {
        $input1=[5.0, 0, 0];
        $expected=[4, 5, 6.5, 1.5, 5];
        $case= userDecision($input1);
        $this->assertEquals($case, $expected);
    }

    //failure

    public function testlengthDeclaredfailureStr ()
    {
        $input1=["5.0", "5", "8"];
        $expected=[5, 4, 6.5, 4, 0];
        $case= userDecision($input1);
        $this->assertEquals($case, $expected);
    }

    public function testlengthDeclaredfailureInt ()
    {
        $input1=[3, 0, 0];
        $expected=[2, 3, 3.3, 0.3, 3];
        $case= userDecision($input1);
        $this->assertEquals($case, $expected);
    }

    //malformed
    public function testlengthDeclaredMalformedStr ()
    {
        $input1="43";
        $this->expectException(TypeError::class);
        userDecision($input1);
    }

    public function testlengthDeclaredMalformedInt ()
    {
        $input1=43;
        $this->expectException(TypeError::class);
        userDecision($input1);
    }

    //answer()
    //success

    public function testanswersuccessLen ()
    {
        $input1=[5, 0, 0];
        $input2=[4, 5, 6.5, 1.5, 5];
        $expected="You requested a fence of 5 meters.\n 
        With 5 posts and  4 rails you get a fence of 
       6.5 meters with an overshoot of 1.5 meters.";
        $case= answer($input1, $input2);
        $this->assertEquals($case, $expected);
    }

    public function testanswersuccessPR ()
    {
        $input1=[0, 5, 4];
        $input2=[5, 4, 6.5, 0, 0];
        $expected="You provided 5 posts and 4 rails.\n
        With the provided materials, you can build a fence of 6.5 meters\n
        with an overshoot of 0 rails and 0 posts.";
        $case= answer($input1, $input2);
        $this->assertEquals($case, $expected);
    }


}
