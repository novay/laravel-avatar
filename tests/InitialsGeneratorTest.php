<?php

class InitialGeneratorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function it_accept_string()
    {
        $generator = new \Novay\Avatar\Generator\DefaultGenerator();

        $this->assertEquals('NR', $generator->make('Noviyanto Rahmadi'));
    }

    /**
     * @test
     */
    public function it_accept_stringy()
    {
        $generator = new \Novay\Avatar\Generator\DefaultGenerator();

        $this->assertEquals('NR', $generator->make(new \Stringy\Stringy('Noviyanto Rahmadi')));
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function it_cannot_accept_array()
    {
        $generator = new \Novay\Avatar\Generator\DefaultGenerator();
        $generator->make(['Noviyanto', 'Rahmadi']);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function it_cannot_accept_object_without_to_string_function()
    {
        $generator = new \Novay\Avatar\Generator\DefaultGenerator();
        $generator->make(new \Novay\Avatar\Generator\DefaultGenerator(new stdClass()));
    }

    /**
     * @test
     */
    public function it_can_generate_initials_from_single_word_name()
    {
        $generator = new \Novay\Avatar\Generator\DefaultGenerator();

        $this->assertEquals('Ra', (string)$generator->make('Raisa'));
    }

    /**
     * @test
     */
    public function it_can_generate_initials_from_multi_word_name()
    {
        $generator = new \Novay\Avatar\Generator\DefaultGenerator();

        $this->assertEquals('RM', (string)$generator->make('Raisa Maulida'));
    }

    /**
     * @test
     */
    public function it_can_generate_initials_if_name_shorter_than_expected_length()
    {
        $generator = new \Novay\Avatar\Generator\DefaultGenerator('Joe');

        $this->assertEquals('Joe', (string)$generator->make('Joe', 4));
    }

    /**
     * @test
     */
    public function it_can_generate_initials_if_name_longer_than_expected_length()
    {
        $generator = new \Novay\Avatar\Generator\DefaultGenerator();

        $this->assertEquals('RM', (string)$generator->make('Raisa Maulida Nafeeza', 2));
    }

    /**
     * @test
     */
    public function it_can_handle_empty_name()
    {
        $generator = new \Novay\Avatar\Generator\DefaultGenerator();

        $this->assertEquals('', (string)$generator->make(''));
    }

    /**
     * @test
     */
    public function it_allow_non_ascii()
    {
        $generator = new \Novay\Avatar\Generator\DefaultGenerator();

        $this->assertEquals('Nø', (string)$generator->make('Nøvay'));
    }

    /**
     * @test
     */
    public function it_can_convert_to_ascii()
    {
        $generator = new \Novay\Avatar\Generator\DefaultGenerator();

        $this->assertEquals('No', (string)$generator->make('Nøvay', 2, false, true));
    }

    /**
     * @test
     */
    public function it_can_generate_initials_from_email()
    {
        $generator = new \Novay\Avatar\Generator\DefaultGenerator();

        $this->assertEquals('nr', $generator->make('noviyanto.rahmadi@gmail.com'));
        $this->assertEquals('no', $generator->make('noviyantorahmadi@gmail.com'));
        $this->assertEquals('NO', $generator->make('NOVIYANTORAHMADI@gmail.com'));
    }
}
