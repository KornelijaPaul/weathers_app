<?php

namespace App\Tests\App\Form;

use App\Form\Model\WeatherSearchDTO;
use App\Form\WeatherSearchFormType;
use Symfony\Component\Form\Test\TypeTestCase;

class WeatherSearchFormTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'token' => '21bfdf46d57dd5af15fbe3d4c0c989f6',
            'city' => 'Vilnius',
        ];

        $model = new WeatherSearchDTO();

        $form = $this->factory->create(WeatherSearchFormType::class, $model);

        $expected = new WeatherSearchDTO();
        $expected->setToken($formData['token']);
        $expected->setCity($formData['city']);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($expected, $model);
    }

    public function testCustomFormView()
    {
        $formData = new WeatherSearchDTO();

        $view = $this->factory->create(WeatherSearchFormType::class, $formData)
            ->createView();

        $this->assertSame(true, $view->vars['required']);
        $this->assertArrayHasKey('token', $view->vars['form']);
        $this->assertArrayHasKey('city', $view->vars['form']);
    }
}