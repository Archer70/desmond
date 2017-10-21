<?php
namespace Desmond\test_framework\reporters;

interface BaseReporter
{
    public function id();
    public function header();
    public function pass($testName);
    public function fail($testName, $expected, $actual, $message='');
    public function footer();
}