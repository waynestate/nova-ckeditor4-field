<?php

use PhpCsFixer\Finder;
use PhpCsFixer\Config;

$finder = Finder::create()
    ->in(__DIR__ . '/database')
    ->in(__DIR__ . '/config')
    ->in(__DIR__ . '/routes')
    ->in(__DIR__ . '/src')
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$fixers = [
    '@PSR2' => true,
    'full_opening_tag' => true,
    'blank_line_after_namespace' => true,
    'class_definition' => true,
    'indentation_type' => true,
    'array_indentation' => true,
    'line_ending' => true,
    'method_argument_space' => [
        'on_multiline' => 'ensure_fully_multiline'
    ],
    'no_break_comment' => true,
    'no_closing_tag' => true,
    'no_spaces_after_function_name' => true,
    'no_spaces_inside_parenthesis' => true,
    'no_trailing_whitespace' => true,
    'no_trailing_whitespace_in_comment' => true,
    'no_unused_imports' => true,
    'single_blank_line_at_eof' => true,
    'single_class_element_per_statement' => [
        'elements' => ['property']
    ],
    'single_import_per_statement' => true,
    'switch_case_semicolon_to_colon' => true,
    'switch_case_space' => true,
    'visibility_required' => true,
    'no_trailing_comma_in_singleline_array' => true,
    'whitespace_after_comma_in_array' => true,
    'no_whitespace_before_comma_in_array' => true,
    'trailing_comma_in_multiline' => true,
];

return (new Config())
    ->setFinder($finder)
    ->setRules($fixers);
