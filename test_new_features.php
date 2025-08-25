<?php
/**
 * Simple test script to verify the new features work
 * This script simulates some of the functionality without requiring a full WordPress setup
 */

require_once 'src/MoveCommand.php';

use n5s\WpCliMove\MoveCommand;

// Test the new data types constants
$reflection = new ReflectionClass(MoveCommand::class);
$constants = $reflection->getConstants();

echo "Testing new data types constants:\n";
echo "DATA_TYPE_PLUGINS: " . (defined('n5s\WpCliMove\MoveCommand::DATA_TYPE_PLUGINS') ? 'FOUND' : 'NOT FOUND') . "\n";
echo "DATA_TYPE_MU_PLUGINS: " . (defined('n5s\WpCliMove\MoveCommand::DATA_TYPE_MU_PLUGINS') ? 'FOUND' : 'NOT FOUND') . "\n";
echo "DATA_TYPE_THEMES: " . (defined('n5s\WpCliMove\MoveCommand::DATA_TYPE_THEMES') ? 'FOUND' : 'NOT FOUND') . "\n";

// Check if DATA_TYPES array includes new types
$dataTypesReflection = $reflection->getConstant('DATA_TYPES');
echo "\nDATA_TYPES array contents:\n";
foreach ($dataTypesReflection as $type) {
    echo "- $type\n";
}

echo "\nTest completed!\n";
