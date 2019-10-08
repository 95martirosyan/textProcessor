<?php
require __DIR__ . "/../src/TextProcessor.php";
use PHPUnit\Framework\TestCase;

final class TextProcessorTest extends TestCase
{
    public $data = [
        "job" => [
            "text" => "Привет, мне на <a href=\"test@test.ru\">test@test.ru</a> пришло приглашение встретиться, попить кофе с <strong>10%</strong> содержанием молока за <i>$5</i>, пойдем вместе!",
            "methods" => []
        ]
    ];

    public $class_obj;

    public function testStripTags() {
        $this->data['job']['methods'] = ['stripTags'];
        $text_processor = new TextProcessor($this->data);

        $this->assertSame(
            $text_processor->text,
            "Привет, мне на test@test.ru пришло приглашение встретиться, попить кофе с 10% содержанием молока за $5, пойдем вместе!");
    }

    public function testRemoveSpaces() {
        $this->data['job']['methods'] = ['removeSpaces'];
        $text_processor = new TextProcessor($this->data);

        $this->assertEquals(
            $text_processor->text,
            "Привет,мнена<ahref=\"test@test.ru\">test@test.ru</a>пришлоприглашениевстретиться,попитькофес<strong>10%</strong>содержаниеммолоказа<i>$5</i>,пойдемвместе!"
        );
    }

    public function testReplaceSpacesToEol() {
        $this->data['job']['methods'] = ['replaceSpacesToEol'];
        $text_processor = new TextProcessor($this->data);

        $this->assertEquals(
            $text_processor->text,
            "Привет,
мне
на
<a
href=\"test@test.ru\">test@test.ru</a>
пришло
приглашение
встретиться,
попить
кофе
с
<strong>10%</strong>
содержанием
молока
за
<i>$5</i>,
пойдем
вместе!"
        );
    }

    public function testHtmlspecialchars() {
        $this->data['job']['methods'] = ['htmlspecialchars'];
        $text_processor = new TextProcessor($this->data);

        $this->assertEquals(
            $text_processor->text,
            "Привет, мне на &lt;a href=&quot;test@test.ru&quot;&gt;test@test.ru&lt;/a&gt; пришло приглашение встретиться, попить кофе с &lt;strong&gt;10%&lt;/strong&gt; содержанием молока за &lt;i&gt;$5&lt;/i&gt;, пойдем вместе!"
        );
    }

    public function testRemoveSymbols() {
        $this->data['job']['methods'] = ['removeSymbols'];
        $text_processor = new TextProcessor($this->data);

        $this->assertEquals(
            $text_processor->text,
            "Привет мне на <a href=\"testtestru\">testtestru<a> пришло приглашение встретиться попить кофе с <strong>10<strong> содержанием молока за <i>5<i> пойдем вместе"
        );
    }

    public function testToNumber() {
        $this->data['job']['methods'] = ['toNumber'];
        $text_processor = new TextProcessor($this->data);

        $this->assertEquals(
            $text_processor->text,
            10
        );
    }

    public function testAll() {
        $this->data['job']['methods'] = [
            "stripTags",
            "removeSpaces",
            "replaceSpacesToEol",
            "htmlspecialchars",
            "removeSymbols",
            "toNumber"
        ];
        $text_processor = new TextProcessor($this->data);

        $this->assertEquals(
            $text_processor->text,
            10
        );
    }

}