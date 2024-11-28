<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /Users/vinhquangtran/Documents/VSFS/PP/kecal/app/UI/Home/default.latte */
final class Template_282a1394c3 extends Latte\Runtime\Template
{
	public const Source = '/Users/vinhquangtran/Documents/VSFS/PP/kecal/app/UI/Home/default.latte';

	public const Blocks = [
		['content' => 'blockContent'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo "\n";
		$this->renderBlock('content', get_defined_vars()) /* line 2 */;
	}


	/** {block content} on line 2 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '<div class="login d-flex vh-100 justify-content-center align-items-center position-relative text-white">
    <img src="media/background.jpg" class="login-img position-absolute w-100 h-100">
    ';
		$form = $this->global->formsStack[] = $this->global->uiControl['logInForm'] /* line 5 */;
		Nette\Bridges\FormsLatte\Runtime::initializeForm($form);
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form, []) /* line 5 */;
		echo '
        <h1 class="logint-title text-center">Log in</h1>

        <div class="login-content">
            <div class="login-box row align-items-center position-relative border-bottom py-2 my-4">
                <i class="ri-user-line col-1 fs-3"></i>
                <div class="login-box-input position-relative col mt-2 ">
                    ';
		echo Nette\Bridges\FormsLatte\Runtime::item('email', $this->global)->getControl() /* line 12 */;
		echo '
                    <label for="" class="login-label position-absolute px-2 fw-bold fs-6">Email</label>
                </div>
            </div>

            <div class="login-box row align-items-center position-relative border-bottom py-2 my-4">
                <i class="ri-lock-line col-1 fs-3"></i>
                <div class=" login-box-input position-relative col mt-2 ">
                    ';
		echo Nette\Bridges\FormsLatte\Runtime::item('password', $this->global)->getControl() /* line 20 */;
		echo '
                    <label for="" class="login-label login-label position-absolute px-2 fw-bold fs-6">Password</label>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            ';
		echo Nette\Bridges\FormsLatte\Runtime::item('submit', $this->global)->getControl() /* line 27 */;
		echo '
        </div>
        <p class="pt-3 text-center">Don\'t have an account? <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('SignUp:')) /* line 29 */;
		echo '">Sign up</a> here</p>
    ';
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack)) /* line 30 */;

		echo '

</div>

';
	}
}
