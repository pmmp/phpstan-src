<?php declare(strict_types = 1);

namespace PHPStan\Rules\Comparison;

/**
 * @extends \PHPStan\Testing\RuleTestCase<TernaryOperatorConstantConditionRule>
 */
class TernaryOperatorConstantConditionRuleTest extends \PHPStan\Testing\RuleTestCase
{

	protected function getRule(): \PHPStan\Rules\Rule
	{
		return new TernaryOperatorConstantConditionRule(
			new ConstantConditionRuleHelper(
				new ImpossibleCheckTypeHelper(
					$this->createReflectionProvider(),
					$this->getTypeSpecifier(),
					[]
				)
			)
		);
	}

	public function testRule(): void
	{
		$this->analyse([__DIR__ . '/data/ternary.php'], [
			[
				'Ternary operator condition is always true.',
				11,
			],
			[
				'Ternary operator condition is always false.',
				15,
			],
		]);
	}

}
