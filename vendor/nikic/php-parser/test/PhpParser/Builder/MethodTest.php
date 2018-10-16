<?php declare(strict_types=1);

namespace PhpParser\Builder;

use PhpParser\Comment;
use PhpParser\Node;
use PhpParser\Node\Expr\Print_;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt;
use PHPUnit\Framework\TestCase;

class MethodTest extends TestCase
{
    public function createMethodBuilder($name) {
        return new Method($name);
    }

    public function testModifiers() {
        $node = $this->createMethodBuilder('testController')
            ->makePublic()
            ->makeAbstract()
            ->makeStatic()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('testController', [
                'flags' => Stmt\Class_::MODIFIER_PUBLIC
                         | Stmt\Class_::MODIFIER_ABSTRACT
                         | Stmt\Class_::MODIFIER_STATIC,
                'stmts' => null,
            ]),
            $node
        );

        $node = $this->createMethodBuilder('testController')
            ->makeProtected()
            ->makeFinal()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('testController', [
                'flags' => Stmt\Class_::MODIFIER_PROTECTED
                         | Stmt\Class_::MODIFIER_FINAL
            ]),
            $node
        );

        $node = $this->createMethodBuilder('testController')
            ->makePrivate()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('testController', [
                'type' => Stmt\Class_::MODIFIER_PRIVATE
            ]),
            $node
        );
    }

    public function testReturnByRef() {
        $node = $this->createMethodBuilder('testController')
            ->makeReturnByRef()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('testController', [
                'byRef' => true
            ]),
            $node
        );
    }

    public function testParams() {
        $param1 = new Node\Param(new Variable('test1'));
        $param2 = new Node\Param(new Variable('test2'));
        $param3 = new Node\Param(new Variable('test3'));

        $node = $this->createMethodBuilder('testController')
            ->addParam($param1)
            ->addParams([$param2, $param3])
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('testController', [
                'params' => [$param1, $param2, $param3]
            ]),
            $node
        );
    }

    public function testStmts() {
        $stmt1 = new Print_(new String_('test1'));
        $stmt2 = new Print_(new String_('test2'));
        $stmt3 = new Print_(new String_('test3'));

        $node = $this->createMethodBuilder('testController')
            ->addStmt($stmt1)
            ->addStmts([$stmt2, $stmt3])
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\ClassMethod('testController', [
                'stmts' => [
                    new Stmt\Expression($stmt1),
                    new Stmt\Expression($stmt2),
                    new Stmt\Expression($stmt3),
                ]
            ]),
            $node
        );
    }
    public function testDocComment() {
        $node = $this->createMethodBuilder('testController')
            ->setDocComment('/** Test */')
            ->getNode();

        $this->assertEquals(new Stmt\ClassMethod('testController', [], [
            'comments' => [new Comment\Doc('/** Test */')]
        ]), $node);
    }

    public function testReturnType() {
        $node = $this->createMethodBuilder('testController')
            ->setReturnType('bool')
            ->getNode();
        $this->assertEquals(new Stmt\ClassMethod('testController', [
            'returnType' => 'bool'
        ], []), $node);
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Cannot add statements to an abstract method
     */
    public function testAddStmtToAbstractMethodError() {
        $this->createMethodBuilder('testController')
            ->makeAbstract()
            ->addStmt(new Print_(new String_('testController')))
        ;
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Cannot make method with statements abstract
     */
    public function testMakeMethodWithStmtsAbstractError() {
        $this->createMethodBuilder('testController')
            ->addStmt(new Print_(new String_('testController')))
            ->makeAbstract()
        ;
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Expected parameter node, got "Name"
     */
    public function testInvalidParamError() {
        $this->createMethodBuilder('testController')
            ->addParam(new Node\Name('foo'))
        ;
    }
}
