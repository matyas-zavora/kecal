<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /Users/vinhquangtran/Documents/VSFS/PP/kecal/app/UI/@layout.latte */
final class Template_9d8e10121c extends Latte\Runtime\Template
{
	public const Source = '/Users/vinhquangtran/Documents/VSFS/PP/kecal/app/UI/@layout.latte';

	public const Blocks = [
		['scripts' => 'blockScripts'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo '<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">

	<title>';
		if ($this->hasBlock('title')) /* line 7 */ {
			$this->renderBlock('title', [], function ($s, $type) {
				$ʟ_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($ʟ_fi, 'html', $this->filters->filterContent('stripHtml', $ʟ_fi, $s));
			}) /* line 7 */;
			echo ' | ';
		}
		echo 'Nette Web</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link
			href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
			rel="stylesheet"
	/>
	<style>
		.login-form{
			object-position: center;
			object-fit: cover;
		}
		.login-form{
			backdrop-filter: blur(10px);
		}
		.login-input{
			background: none;
		}
		.login-label{
			top: 5px;
		}
		.login-input:focus + .login-label{
			top:-20px;

		}
		.login-input:focus{
			background: none;
		}
		.login-input:not(:placeholder-shown).login-input:not(:focus) + .login-label{
			top:-20px;
		}


	</style>
</head>

<body>
';
		foreach ($flashes as $flash) /* line 44 */ {
			echo '	<div';
			echo ($ʟ_tmp = array_filter(['flash', $flash->type])) ? ' class="' . LR\Filters::escapeHtmlAttr(implode(" ", array_unique($ʟ_tmp))) . '"' : "" /* line 44 */;
			echo '>';
			echo LR\Filters::escapeHtmlText($flash->message) /* line 44 */;
			echo '</div>
';

		}

		echo "\n";
		$this->renderBlock('content', [], 'html') /* line 46 */;
		echo "\n";
		$this->renderBlock('scripts', get_defined_vars()) /* line 48 */;
		echo '</body>
</html>
';
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['flash' => '44'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block scripts} on line 48 */
	public function blockScripts(array $ʟ_args): void
	{
		echo '	<script src="https://unpkg.com/nette-forms@3"></script>
';
	}
}
