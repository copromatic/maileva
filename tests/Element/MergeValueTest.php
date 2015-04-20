<?php
namespace Maileva;

use Maileva\Element\MergeValue;
use Maileva\Element\ValueWithOrder;
use Maileva\Element\ValueWithRef;

class MergeValueTest extends \PHPUnit_Framework_TestCase{
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testNoValue()
    {
        $value = new MergeValue();

        $value->verify();
    }
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testTwoValues()
    {
        $value = new MergeValue();

        $valueWithRef = new ValueWithRef();
        $valueWithRef->setValue('LOVE');
        $valueWithRef->setRef(1);
        $value->setValueWithRef($valueWithRef);

        $valueWithOrder = new ValueWithOrder();
        $valueWithOrder->setValue('LOVE');
        $valueWithOrder->setOrder(1);
        $value->setValueWithOrder($valueWithOrder);

        $value->verify();
    }
    public function testValidValueWithRef()
    {
        $value = new MergeValue();

        $valueWithRef = new ValueWithRef();
        $valueWithRef->setValue('LOVE');
        $valueWithRef->setRef(1);

        $value->setValueWithRef($valueWithRef);

        $value->verify();
    }
    public function testValidValueWithOrder()
    {
        $value = new MergeValue();

        $valueWithOrder = new ValueWithOrder();
        $valueWithOrder->setValue('LOVE');
        $valueWithOrder->setOrder(1);

        $value->setValueWithOrder($valueWithOrder);

        $value->verify();
    }
}