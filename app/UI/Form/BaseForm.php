<?php declare(strict_types = 1);

namespace App\UI\Form;

use Nette\Application\UI\Form;
use Nette\Forms\Controls\TextInput;

class BaseForm extends Form
{

	public function addNumeric(string $name, ?string $label = null): TextInput
	{
		$input = $this->addText($name, $label);
		$input->addCondition($this::Filled)
			->addRule($this::MaxLength, null, 255)
			->addRule($this::Numeric);

		return $input;
	}

}
