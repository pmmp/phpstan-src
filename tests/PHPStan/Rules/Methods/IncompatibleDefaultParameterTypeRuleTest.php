<?php declare(strict_types = 1);

namespace PHPStan\Rules\Methods;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/**
 * @extends \PHPStan\Testing\RuleTestCase<IncompatibleDefaultParameterTypeRule>
 */
class IncompatibleDefaultParameterTypeRuleTest extends RuleTestCase
{

	protected function getRule(): Rule
	{
		return new IncompatibleDefaultParameterTypeRule();
	}

	public function testMethods(): void
	{
		$this->analyse([__DIR__ . '/data/incompatible-default-parameter-type-methods.php'], [
			[
				'Default value of the parameter #6 $resource (false) of method IncompatibleDefaultParameter\Foo::baz() is incompatible with type resource.',
				49,
			],
			[
				'Default value of the parameter #6 $resource (false) of method IncompatibleDefaultParameter\Foo::bar() is incompatible with type resource.',
				60,
			],
		]);
	}

	public function testTraitCrash(): void
	{
		$this->analyse([__DIR__ . '/data/incompatible-default-parameter-type-trait-crash.php'], []);
	}

}
