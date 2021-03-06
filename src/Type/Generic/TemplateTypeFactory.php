<?php declare(strict_types = 1);

namespace PHPStan\Type\Generic;

use PHPStan\PhpDoc\Tag\TemplateTag;
use PHPStan\Type\MixedType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\ObjectWithoutClassType;
use PHPStan\Type\Type;

final class TemplateTypeFactory
{

	public static function create(TemplateTypeScope $scope, string $name, ?Type $bound, TemplateTypeVariance $variance): Type
	{
		$strategy = new TemplateTypeParameterStrategy();

		if ($bound === null) {
			return new TemplateMixedType($scope, $strategy, $variance, $name);
		}

		if ($bound instanceof ObjectType) {
			return new TemplateObjectType($scope, $strategy, $variance, $name, $bound->getClassName());
		}

		$boundClass = get_class($bound);
		if ($boundClass === ObjectWithoutClassType::class) {
			return new TemplateObjectWithoutClassType($scope, $strategy, $variance, $name);
		}

		if ($boundClass === MixedType::class) {
			return new TemplateMixedType($scope, $strategy, $variance, $name);
		}

		return new TemplateMixedType($scope, $strategy, $variance, $name);
	}

	public static function fromTemplateTag(TemplateTypeScope $scope, TemplateTag $tag): Type
	{
		return self::create($scope, $tag->getName(), $tag->getBound(), $tag->getVariance());
	}

}
