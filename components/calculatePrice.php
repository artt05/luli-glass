<?php
$heightMeters = floatval($_POST['heightMeters'] ?? 0);
$heightCentimeters = floatval($_POST['heightCentimeters'] ?? 0);
$heightMillimeters = floatval($_POST['heightMillimeters'] ?? 0);

$widthMeters = floatval($_POST['widthMeters'] ?? 0);
$widthCentimeters = floatval($_POST['widthCentimeters'] ?? 0);
$widthMillimeters = floatval($_POST['widthMillimeters'] ?? 0);

$thickness = floatval($_POST['thickness'] ?? 0);
$borderRadius = floatval($_POST['borderRadius'] ?? 0);
$quantity = intval($_POST['quantity'] ?? 1); // Default quantity is 1 if not provided

// Convert height and width to meters
$totalHeightInMeters = $heightMeters + ($heightCentimeters / 100) + ($heightMillimeters / 1000);
$totalWidthInMeters = $widthMeters + ($widthCentimeters / 100) + ($widthMillimeters / 1000);

// Base price per square meter
$basePricePerSquareMeter = 20;

// Calculate area in square meters
$areaInSquareMeters = $totalHeightInMeters * $totalWidthInMeters;

// Price calculation based on area
$pricePerPiece = ($areaInSquareMeters * $basePricePerSquareMeter);

// Add thickness and border radius impact (optional customization)
$pricePerPiece += ($thickness * 2) + ($borderRadius * 0.5);

// Total price considering quantity
$totalPrice = $pricePerPiece * $quantity;

// Return the total price formatted to 2 decimal places
echo number_format($totalPrice, 2);
