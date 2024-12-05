<?php declare(strict_types = 1);

namespace App\UI\Modules\Front\Home;

use Nette;

class HomePresenter extends Nette\Application\UI\Presenter
{

	public function renderDefault(): void
	{
		$this->template->setFile(__DIR__ . '/default.latte');
	}

//    protected function createComponentLogInForm(): Form
//    {
//        $form = new Form;
//        $form->addText('email')
//            ->setRequired('Please fill your name.')
//            ->setHtmlAttribute('class', 'form-control form-control-lg m-1 border-0 border-bottom rounded-0');
//
//        $form->addPassword('password')
//            ->setRequired()
//            ->setHtmlAttribute('class', 'form-control form-control-lg m-1  border-0 border-bottom rounded-0');
//
//        return $form;
//    }

}
