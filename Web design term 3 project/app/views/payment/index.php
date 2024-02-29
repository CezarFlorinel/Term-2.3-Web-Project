<?php
include __DIR__ . '/../header.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Information</title>
<!-- Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<style>
  body {
    font-family: 'Open Sans', sans-serif;
  }
  .step-circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: green;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 4px;
  }
  .step-line {
    flex-grow: 1;
    height: 2px;
    background: black;
  }
  .placeholder-map {
    background: black;
    height: 200px;
    border-radius: 8px;
  }
</style>
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4">
  <div class="bg-white p-6 rounded-lg shadow-lg mt-6">
    <!-- Steps Indicator -->
    <div class="flex items-center mb-8">
      <div class="step-circle">1</div>
      <div class="step-line"></div>
      <div class="step-circle bg-gray-300">2</div>
      <div class="step-line"></div>
      <div class="step-circle bg-gray-300">3</div>
      <div class="step-line"></div>
      <div class="step-circle bg-gray-300">4</div>
      <div class="step-line"></div>
      <div class="step-circle bg-gray-300">5</div>
    </div>

    <!-- Form Title -->
    <div class="mb-6">
      <h2 class="text-2xl font-semibold">Payment Information</h2>
      <p class="text-red-500">*All fields are mandatory to complete a purchase</p>
    </div>

    <!-- Form Fields -->
    <form>
      <div class="mb-4">
        <label class="block text-gray-700">Country/Region:</label>
        <input type="text" class="w-full px-3 py-2 border rounded-lg" required>
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700">Full Name (First & Last name):</label>
        <input type="text" class="w-full px-3 py-2 border rounded-lg" required>
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700">Phone Number:</label>
        <input type="tel" class="w-full px-3 py-2 border rounded-lg" required>
        <span class="text-xs text-gray-600">We need your phone number to contact you in case something goes wrong</span>
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700">Email Address:</label>
        <input type="email" class="w-full px-3 py-2 border rounded-lg" required>
        <span class="text-xs text-gray-600">We need your email address to send you all information related to the tickets</span>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700">Street Address:</label>
        <input type="text" placeholder="Street Name" class="w-full px-3 py-2 border rounded-lg mb-2" required>
        <input type="text" placeholder="Extra Information" class="w-full px-3 py-2 border rounded-lg" required>
      </div>

      <div class="flex mb-4">
        <div class="w-1/2 pr-2">
          <label class="block text-gray-700">City:</label>
          <input type="text" class="w-full px-3 py-2 border rounded-lg" required>
        </div>
        <div class="w-1/2 pl-2">
          <label class="block text-gray-700">County:</label>
          <input type="text" class="w-full px-3 py-2 border rounded-lg" required>
        </div>
      </div>

      <div class="mb-4">

      ===================
      ===================
      ===================
<?php
include __DIR__ . '/../footer.php';
?>