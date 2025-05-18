<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

// Define specific rules that cause test failures
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromAssignsRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByMethodCallTypeRector;

return static function (RectorConfig $rectorConfig): void {
    // Register paths to refactor
    $rectorConfig->paths([
        __DIR__ . '/lib',
    ]);

    // Define PHP version to target
    $rectorConfig->phpVersion(\Rector\ValueObject\PhpVersion::PHP_83);
    
    // Use PHP sets - with a more careful selection to avoid breaking tests
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_74,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::EARLY_RETURN,
        SetList::NAMING,
    ]);
    
    // Configure specific rules to be more lenient
    $rectorConfig->ruleWithConfiguration(TypedPropertyFromAssignsRector::class, [
        // Make TypedPropertyFromAssignsRector not add strict typing to properties 
        // that are used in tests with mock objects
        'inferredMethodPropertyTypes' => false,
    ]);
    
    // We need to make parameter types more flexible
    $rectorConfig->ruleWithConfiguration(ParamTypeByMethodCallTypeRector::class, [
        'inferMethodCallParameterTypeExcludeMethodPatterns' => [
            // Methods that need to accept various types
            '#^set.*#',
            '#^get.*#'
        ],
    ]);
};