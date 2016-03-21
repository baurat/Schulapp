<?php
// http://stackoverflow.com/questions/7405342/casting-attributes-for-ordering-on-a-doctrine2-dql-query
//http://stackoverflow.com/questions/19096429/error-when-use-custom-dql-function-with-doctrine-and-symfony2
namespace AppBundle\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class SortByKlassenstufe extends FunctionNode
{
    public $firstDateExpression = null;
    public $unit = null;    

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->firstDateExpression = $parser->StringPrimary();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        return sprintf('klassenstufe(%s)',  $this->firstDateExpression->dispatch($sqlWalker));
    }
}