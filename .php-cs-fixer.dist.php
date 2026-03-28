<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__.'/app')
    ->exclude('var');

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        'class_attributes_separation' => [
            'elements' => [
                'const' => 'one',
                'property' => 'one',
                'method' => 'one',
            ],
        ],
        'method_argument_space' => [
            'on_multiline' => 'ignore',
        ],
        'modifier_keywords' => false,
        'no_unused_imports' => true,
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
        ],
        'strict_param' => true,
        'binary_operator_spaces' => [
            'default' => 'single_space',
        ],
    ])
    ->setFinder($finder);
